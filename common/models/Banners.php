<?php

namespace common\models;

use backend\components\ForecastImages;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string $href
 * @property int $type
 * @property string $image
 * @property int $sort
 * @property int $created_at
 * @property int $updated_at
 */
class Banners extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['href', 'type'], 'required'],
            [['type', 'sort'], 'integer'],
            [['href', 'image'], 'string', 'max' => 255],
            [['file'], 'file','maxFiles' => 1, 'extensions' => 'jpg,jpeg,png', 'skipOnEmpty' => true],
        ];
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'href' => 'Ссылка',
            'type' => 'Размещение',
            'image' => 'Картинка',
            'sort' => 'Sort',
        ];
    }

    public function getDir()
    {
        $dir = Yii::getAlias('@frontend/web').'/banners/' . $this->id;
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
            'quality' => 100,
            'newWidth' => 500,
        ]);
        $optimizer->optimize($thumbFile);
    }

    public function getPhotoUrl()
    {
        return 'banners/'.$this->id;
    }

    public function getPhoto()
    {
        return $this->image ? '/' . $this->getPhotoUrl() . '/' . $this->image : '';
    }

    public function getPhotoPath()
    {
        return $this->image ? $this->getDir() . '/' . $this->image : '';
    }

    public function getThumb()
    {
        return $this->image ? '/' . $this->getPhotoUrl() . '/' . 'thumb_'.$this->image : '';
    }

    public function getThumbPath()
    {
        return $this->image ? $this->getDir() . '/' . 'thumb_'.$this->image : '';
    }
}
