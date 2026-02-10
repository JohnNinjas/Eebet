<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\BaseFileHelper;
use yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;
use backend\components\ForecastImages;

/**
 * This is the model class for table "vip_forecast".
 *
 * @property int $id
 * @property string $title
 * @property double $odds_from
 * @property double $odds_to
 * @property double $price
 * @property string $image
 * @property string $event_date
 * @property string $desc
 * @property string $slug
 * @property int $expire
 * @property int $open
 * @property int $created_at
 * @property int $updated_at
 */
class VipForecast extends \yii\db\ActiveRecord
{

    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vip_forecast';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            [
                'class' => SluggableBehavior::className(),
                'attribute' => null,
                'slugAttribute' => 'slug',
                'value' => function ($event){//return slug
                    $slugParts = [];
                    $slugParts[] = $this->title;
                    $slugParts[] = $this->id;
                    $slug = \yii\helpers\Inflector::slug(implode('-', $slugParts));
                    return $slug;
                },
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'odds_from', 'odds_to', 'price'], 'required'],
            [['odds_from', 'odds_to', 'price'], 'number'],
            [['event_date'], 'safe'],
            [['desc'], 'string'],
            [['expire','open'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
            [['file'], 'file','maxFiles' => 1, 'extensions' => 'jpg,jpeg,png', 'skipOnEmpty' => true],
            ['odds_to', 'compare', 'compareAttribute' => 'odds_from', 'operator' => '>=', 'message' => 'Неверный диапозон коэффициента'],
            ['odds_from', 'compare', 'compareAttribute' => 'odds_to', 'operator' => '<=', 'message' => 'Неверный диапозон коэффициента'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'odds_from' => 'Коэффициент',
            'odds_to' => 'Коэффициент',
            'price' => 'Цена',
            'image' => 'Картинка',
            'event_date' => 'Дата и время',
            'desc' => 'Описание',
        ];
    }

    public function getDir()
    {
        $dir = Yii::getAlias('@secure_photo').'/vip_forecast/' . $this->id;
        if (!file_exists($dir) && !is_dir($dir)) {
            BaseFileHelper::createDirectory($dir);
        }
        return $dir;
    }

    /**
     * @param UploadedFile $file
     */
    public function SaveImage($file)
    {
        $this->image = 'image.'.$file->getExtension();
        $thumbFile = $this->getDir() . '/' . 'thumb_'.$this->image;
        $file->saveAs($this->getDir() . '/' . $this->image);
        $factory = new \ImageOptimizer\OptimizerFactory();
        $optimizer = $factory->get();
        $path = $this->getPhotoPath();
        $optimizer->optimize($path);
        ForecastImages::doResize($path, $thumbFile, [
            'quality' => 80,
            'width' => 450,
        ]);
        $optimizer->optimize($thumbFile);
    }

    public function getPhotoUrl()
    {
        return 'vip-bet-photo/'.$this->id;
    }

    public function getPhoto()
    {
        return $this->image ? '/' . $this->getPhotoUrl() . '/' . $this->image.'/' : '';
    }

    public function getThumb()
    {
        return $this->image ? '/' . $this->getPhotoUrl() . '/' . 'thumb_'.$this->image.'/' : '';
    }

    public function getPhotoPath()
    {
        return $this->image ? $this->getDir() . '/' . $this->image : '';
    }

    public function getThumbPath()
    {
        return $this->image ? $this->getDir() . '/' . 'thumb_'.$this->image : '';
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $changedAttributes = $this->getDirtyAttributes();
            if ($insert) {
                $time = \DateTime::createFromFormat('d-m-Y H:i', $this->event_date);
                $new = $time->format('Y-m-d H:i:s');
                $this->event_date = $new;
            } else {
                if (isset($changedAttributes['event_date'])) {
                    $time = \DateTime::createFromFormat('d-m-Y H:i', $this->event_date);
                    $new = $time->format('Y-m-d H:i:s');
                    $this->event_date = $new;
                }
            }
            return true;
        }
        return false;
    }

    public function afterFind()
    {
        parent::afterFind();
        $date = \DateTime::createFromFormat('Y-m-d H:i:s', $this->event_date);
        $this->event_date = $date->format('d-m-Y H:i');
    }

    public function GetDate()
    {
        $date = \DateTime::createFromFormat('d-m-Y H:i', $this->event_date);
        return $date->format('d-m-Y');
    }

    public function GetTime()
    {
        $date = \DateTime::createFromFormat('d-m-Y H:i', $this->event_date);
        return $date->format('H:i');
    }

    public function GetWaitTime()
    {
        $date = \DateTime::createFromFormat('d-m-Y H:i', $this->event_date);
        $now =  new \DateTime(date('d-m-Y H:i'));
        if ($date > $now) {
            $interval = $date->diff($now);
            $s = '';
            if ($interval->days > 0)
                $s.= $interval->days.' д. ';
            if ($interval->h > 0)
                $s.= $interval->h.' ч. ';
            if ($interval->i > 0 and $interval->days < 10)
                $s.= $interval->i.' мин.';
            return trim($s);
        }
        else
            return false;


    }




}
