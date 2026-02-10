<?php

namespace common\models;

use backend\components\ForecastImages;
use frontend\helpers\LocaleDateFormat;
use Yii;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "news".
 *
 * @property int $id
 * @property string $title
 * @property int $cat_id
 * @property string $image
 * @property string $desc
 * @property string $slug
 * @property int $views
 * @property int $dislike
 * @property int $upvote
 * @property int $created_at
 * @property int $updated_at
 */
class News extends \yii\db\ActiveRecord
{

    public $file;

    const VOTE_POSITIVE = 1;
    const VOTE_NEGATIVE = 2;

    public $VOTE_NAME = [self::VOTE_POSITIVE => 'upvote',self::VOTE_NEGATIVE => 'dislike'];

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
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'cat_id'], 'required'],
            [['cat_id', 'views','upvote','dislike'], 'integer'],
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
            'title' => 'Заголовок',
            'cat_id' => 'Категория',
            'image' => 'Картинка',
            'desc' => 'Описание',
            'views' => 'Просмотры',
        ];
    }




    public function getDir()
    {
        $dir = Yii::getAlias('@secure_photo').'/news/' . $this->id;
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
			'newWidth' => 400,
        ]);
    }

    public function getPhotoUrl()
    {
        return 'news-photo/'.$this->id;
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

    public static function GetCategories()
    {
        return ArrayHelper::map(NewsCategories::find()->select(['id','title'])->asArray()->all(), 'id', 'title');
    }

    public function GetDate()
    {
        $date = \DateTime::createFromFormat('U', $this->created_at);
        $dateFormat = new LocaleDateFormat('MMM');
        $month = rtrim($dateFormat->localeFormat("ru_RU", $date),'.');
        return $date->format('j').' '.$month.' '.$date->format('Y');
    }

    public function GetShortDesc()
    {
        return self::ShortDesc($this->desc, 100,'...',false);
    }

    public function GetDesc($banners)
    {
        if (preg_match('/\$\{banners\}/ui',$this->desc)) {
            $list = '<div class="index-banner-block">';
            foreach ($banners as $b) {
                $list .= '<a href="' . $b->href . '" target="_blank"><img src="' . $b->getThumb() . '" /></a>';
            }
            $list.= '</div>';
            return str_replace('${banners}', $list, $this->desc);
        } else {
            return $this->desc;
        }
    }



    /**
     * shortens the supplied text after last word
     * @param string $string
     * @param int $max_length
     * @param string $end_substitute text to append, for example "..."
     * @param boolean $html_linebreaks if LF entities should be converted to <br />
     * @return string
     */
    public static function ShortDesc($string, $max_length, $end_substitute = null, $html_linebreaks = true) {

        if($html_linebreaks) $string = preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
       // $string = strip_tags($string); //gets rid of the HTML
        $string = filter_var($string, FILTER_SANITIZE_STRING);

        if(empty($string) || mb_strlen($string) <= $max_length) {
            if($html_linebreaks) $string = nl2br($string);
            return $string;
        }

        if($end_substitute) $max_length -= mb_strlen($end_substitute, 'UTF-8');

   /*     $stack_count = 0;
        while($max_length > 0){
            $char = mb_substr($string, --$max_length, 1, 'UTF-8');
            if(preg_match('#[^\p{L}\p{N}]#iu', $char)) $stack_count++; //only alnum characters
            elseif($stack_count > 0) {
                $max_length++;
                break;
            }
        }*/

        $string = mb_substr($string, 0, $max_length, 'UTF-8').$end_substitute;
        if($html_linebreaks) $string = nl2br($string);

        return $string;
    }

    public function GetViewsString()
    {
        $titles = ['%d просмотр', '%d просмотра', '%d просмотров'];
        return self::declOfNum($this->views, $titles);
    }

    /**
     * Функция склонения числительных в русском языке
     *
     * @param int    $number Число которое нужно просклонять
     * @param array  $titles Массив слов для склонения
     * @return string
     **/
    public static function declOfNum($number, $titles)
    {
        $cases = [2, 0, 1, 1, 1, 2];
        $format = $titles[ ($number%100 > 4 && $number %100 < 20) ? 2 : $cases[min($number%10, 5)] ];
        return sprintf($format, $number);
    }


}
