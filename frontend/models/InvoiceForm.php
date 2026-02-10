<?php

namespace frontend\models;

use Yii;
use yii\base\Model;


/**
 * This is the model class for table "invoice".
 *
 * @property int $forecast_id
 * @property double $price
 * @property string $email
 * @property bool $agree
 */

class InvoiceForm extends Model
{

    public $forecast_id;
    public $price;
    public $email;
    public $agree;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['forecast_id', 'price','email'], 'required'],
            [['email'],'email'],
            [['forecast_id'], 'integer'],
            [['price'], 'number'],
            ['agree', 'compare', 'compareValue' => 1, 'message' => 'Необходимо согласиться с условиями политики конфиденциальности'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [

            'agree' => 'Я принимаю <a target="_blank"  href="/privacy/">условия соглашения</a>'

        ];
    }
}
