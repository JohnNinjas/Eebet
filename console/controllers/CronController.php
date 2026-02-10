<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 03.07.2019
 * Time: 19:19
 */

namespace console\controllers;

use common\models\Settings;
use yii\console\Controller;
use common\models\VipForecast;
use common\models\FreeForecast;
use Yii;

class CronController extends Controller
{
    public function actionTimer()
    {
        $date = new \DateTime();
        $date->add(\DateInterval::createFromDateString('1 week'));
        $settings = Settings::find()->where(['key' => 'timer'])->one();
        if (!$settings) {

            $settings = new Settings();
            $settings->key = 'timer';
        }
        $settings->value =  $date->format('Y-m-d');
        $settings->save();
    }


    public function actionExpire()
    {
        file_put_contents('text.txt','1');
        $free = FreeForecast::find()->where(['or', ['expire' => 0], ['expire' => 1]])->all();
        /* @var $f FreeForecast*/
        foreach ($free as $f)
        {
            $date = \DateTime::createFromFormat('d-m-Y H:i', $f->event_date);
            $end =  \DateTime::createFromFormat('d-m-Y H:i', $f->event_date);
            $end->add(new \DateInterval("PT3H"));
            $now =  new \DateTime(date('d-m-Y H:i'));

            $oldExpire = $f->expire;

            if ($now >= $date and $now <= $end )
                $f->expire = 1;
            elseif ($now > $end)
                $f->expire = 2;

            if ($oldExpire != $f->expire)
                $f->save();

           $messageLog = [
                'bool' => ($date < $now),
                'bool2' => ($now >= $date and $now <= $end),
                'date' => $date->format('d-m-Y H:i'),
                'end' => $end->format('d-m-Y H:i'),
                'now' => $now->format('d-m-Y H:i')
            ];
            Yii::error($messageLog, 'cron_test_success');

        }

        $vip = VipForecast::find()->where(['or', ['expire' => 0], ['expire' => 1]])->all();
        /* @var $f VipForecast*/
        foreach ($vip as $f)
        {
            $date = \DateTime::createFromFormat('d-m-Y H:i', $f->event_date);
            $end =  \DateTime::createFromFormat('d-m-Y H:i', $f->event_date);
            $end->add(new \DateInterval("PT3H"));
            $now =  new \DateTime(date('d-m-Y H:i'));

            $oldExpire = $f->expire;

            if ($now >= $date and $now <= $end )
                $f->expire = 1;
            elseif ($now > $end)
                $f->expire = 2;


            if ($oldExpire != $f->expire)
                $f->save();

            if ($oldExpire != $f->expire)
                $f->save();

      /*      $messageLog = [
                'bool' => ($date < $now),
                'bool2' => ($now >= $date and $now <= $end),
                'date' => $date->format('d-m-Y H:i'),
                'end' => $end->format('d-m-Y H:i'),
                'now' => $now->format('d-m-Y H:i')
            ];
            Yii::error($messageLog, 'vip_cron_test_success');*/

        }

        $vip = VipForecast::find()->where(['open' => 0])->all();
        /* @var $f VipForecast*/
        foreach ($vip as $f)
        {
            $open =  \DateTime::createFromFormat('d-m-Y H:i', $f->event_date);
            $open->add(new \DateInterval("PT2H"));
            $now =  new \DateTime(date('d-m-Y H:i'));

            if ($now >= $open) {
                $f->open = 1;
                $f->save();
            }

   /*         $messageLog = [
                'bool' => ($now > $open),
                'date' => $date->format('d-m-Y H:i'),
                'open' => $open->format('d-m-Y H:i'),
                'now' => $now->format('d-m-Y H:i')
            ];
            Yii::error($messageLog, 'vip_cron_open_success');*/

        }


    }

}