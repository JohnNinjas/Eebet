<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "invoice".
 *
 * @property int $id
 * @property int $forecast_id
 * @property double $price
 * @property int $status
 * @property string $email
 * @property int $created_at
 * @property int $updated_at
 */
class Invoice extends \yii\db\ActiveRecord
{
    const STATUS_PENDING = 0;
    const STATUS_ACCEPTED = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_FAIL = 3;

    public static function getStatus()
    {
        return [
            self::STATUS_PENDING => 'Сформирован',
            self::STATUS_ACCEPTED => 'Отправлен',
            self::STATUS_SUCCESS => 'Выполен',
            self::STATUS_FAIL => 'Ошибка',
        ];
    }

    public static function getStatusText($key)
    {
        $data = self::getStatus();
        return $data[$key];

    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'invoice';
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
            [['forecast_id', 'price','email'], 'required'],
            [['email'],'email'],
            [['forecast_id', 'status'], 'integer'],
            [['price'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'forecast_id' => 'Forecast ID',
            'price' => 'Price',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
