<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email','phone'], 'required'],
            ['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'phone' => 'Ваш телефон',
            'email' => 'Ваша почта',
            'name' => 'Ваше имя',
            'admin_phone' => 'Телефон',
            'admin_email' => 'Почта',
            'admin_name' => 'Имя',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        \Yii::$app->mailer->htmlLayout = "@common/mail/layouts/html";
        $message = \Yii::$app->mailer->compose ( [ 'html' => '@common/mail/contact' ] ,['model' => $this]);
        $message->setFrom([\Yii::$app->params['supportEmail'] => 'Обратная связь']);
        $message->setTo ($email);
        $message->setSubject ( 'Обратная связь');
        return $message->send();
    }
}
