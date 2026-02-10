<?php

namespace common\models;

use backend\components\ForecastImages;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news_categories".
 *
 * @property int $id
 * @property string $title
 * @property string $image
 * @property string $desc
 * @property string $slug
 * @property int $created_at
 * @property int $updated_at
 */
class NewsCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news_categories';
    }

    public $file;

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
            [['title'], 'required'],
            ['title', 'unique'],
            ['slug', 'safe'],
            [['desc'], 'string'],
            [['title'], 'string', 'max' => 255],
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
            'title' => 'Название',
            'image' => 'Картинка',
            'desc' => 'Описание',
        ];
    }

    public function getDir()
    {
        $dir = Yii::getAlias('@secure_photo').'/news_cats/' . $this->id;
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

        $path = $this->getPhotoPath();
       ForecastImages::doResize($path, $thumbFile, [
            'quality' => 100,
		    'newWidth' => 350,
        ]);
    }

    public function getPhotoUrl()
    {
        return 'news-cats-photo/'.$this->id;
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
}
