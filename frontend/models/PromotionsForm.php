<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property string $bookie_name
 * @property string $bookie_link
 * @property string $login
 * @property string $password
 * @property int $balance
 * @property string $full_name
 * @property string $social_link
 * @property string $comment
 * @property bool $agree
 */
class PromotionsForm extends Model
{
    public $bookie_name;
    public $bookie_link;
    public $login;
    public $password;
    public $balance;
    public $phone;
    public $full_name;
    public $social_link;
    public $comment;
    public $agree;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bookie_name', 'bookie_link', 'login', 'password', 'full_name', 'social_link','phone','balance'], 'required'],
            [['balance',], 'integer'],
            [['comment'], 'string'],
            [['bookie_name', 'bookie_link', 'login', 'password', 'full_name', 'social_link','phone'], 'string', 'max' => 255],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Необходимо согласиться с условиями политики конфиденциальности'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bookie_name' => 'Название букмекерской конторы',
            'bookie_link' => 'Ссылка букмекерской конторы',
            'login' => 'Логин от счета',
            'password' => 'Пароль',
            'balance' => 'Баланс',
            'phone' => 'Ваш контактный номер',
            'full_name' => 'Ваши инициалы полностью (ФИО)',
            'social_link' => 'Ваша страница в VK или Telegram',
            'comment' => 'Ваши пожелания',
            'agree' => 'Я принимаю <a target="_blank"  href="/privacy/">условия соглашения</a>'

        ];
    }
}
