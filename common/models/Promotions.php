<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "promotions".
 *
 * @property int $id
 * @property string $bookie_name
 * @property string $bookie_link
 * @property string $login
 * @property string $password
 * @property int $balance
 * @property string $phone
 * @property string $full_name
 * @property string $social_link
 * @property string $comment
 * @property int $created_at
 * @property int $updated_at
 */
class Promotions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promotions';
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
    public function rules()
    {
        return [
            [['bookie_name', 'bookie_link', 'login', 'password', 'phone', 'full_name', 'social_link'], 'required'],
            [['balance'], 'integer'],
            [['comment'], 'string'],
            [['bookie_name', 'bookie_link', 'login', 'password', 'phone', 'full_name', 'social_link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bookie_name' => 'Букмекерская контора',
            'bookie_link' => 'Ссылка',
            'login' => 'Логин от счета',
            'password' => 'Пароль',
            'balance' => 'Баланс',
            'phone' => 'Телефон',
            'full_name' => 'ФИО',
            'social_link' => 'Соцсети',
            'comment' => 'Комментарии',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
