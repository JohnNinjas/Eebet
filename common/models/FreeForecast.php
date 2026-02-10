<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\BaseFileHelper;
use yii\behaviors\SluggableBehavior;
use yii\web\UploadedFile;
use backend\components\ForecastImages;

/**
 * This is the model class for table "free_forecast".
 *
 * @property int $id
 * @property string $title
 * @property double $odds
 * @property string $image
 * @property string $event_date
 * @property string $desc
 * @property string $slug
 * @property string $tournament
 * @property int $expire
 * @property int $created_at
 * @property int $updated_at
 * @property string $file
 */
class FreeForecast extends \yii\db\ActiveRecord
{

    public $file;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'free_forecast';
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
            [['title', 'odds','event_date'], 'required'],
            [['odds'], 'number'],
            [['event_date'], 'safe'],
            [['desc'], 'string'],
            ['slug', 'safe'],
            [['expire'], 'integer'],
            [['title','tournament'], 'string', 'max' => 255],
            [['file'], 'file','maxFiles' => 1, 'extensions' => 'jpg,jpeg,png', 'skipOnEmpty' => true],
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
            'odds' => 'Коэффициент',
            'image' => 'Картинка',
            'event_date' => 'Дата и время',
            'desc' => 'Описание',
            'tournament' => 'Название турнира'
        ];
    }

    public function getDir()
    {
        $dir = Yii::getAlias('@secure_photo').'/free_forecast/' . $this->id;
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
        return 'free-bet-photo/'.$this->id;
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


                    //$date = date("Y-m-d H:i:s",strtotime(str_replace('/','-',$date)))
//13-09-2019 15:35
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
            if ($interval->i > 0)
                $s.= $interval->i.' мин.';
            return trim($s);
        }
        else
            return false;

    }


}
