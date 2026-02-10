<?php
/**
 * Created by PhpStorm.
 * User: soska_report
 * Date: 18.09.2019
 * Time: 21:20
 */


namespace frontend\controllers;



use frontend\models\InvoiceForm;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use common\models\VipForecast;
use common\models\Invoice;
use kartik\form\ActiveForm;
use yii\web\Response;
use yii\helpers\Html;


class PaymentController extends Controller
{

    public function beforeAction($action)
    {
        if ($action->id == 'result' or $action->id == 'success' or $action->id == 'fail') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    public function actionPaymentForm()
    {
        $model = new InvoiceForm();
        return $this->renderAjax('payment_form', ['model' => $model]);
    }

    public function actionPayment()
    {
        \Yii::$app->getResponse()->format = Response::FORMAT_JSON;
        $model = new InvoiceForm();

        if (\Yii::$app->getRequest()->getIsAjax() && $model->load(\Yii::$app->getRequest()->post())) {

            $result = ActiveForm::validate($model);
            if (count($result) <= 0) {
                $forecast = VipForecast::findOne($model->forecast_id);
                if ($forecast) {
                    if ($model->price != $forecast->price)
                        $result[Html::getInputId($model, 'forecast_id')] = ['Цена не совпадает'];
                }
                else
                    $result[Html::getInputId($model, 'forecast_id')] = ['Прогноз не найдён'];
            }
            return $result;
        }
        if ($model->load(\Yii::$app->getRequest()->post()) && $model->validate()) {
            $invoice = new Invoice();
            $invoice->setAttributes($model->attributes);
            $invoice->status = Invoice::STATUS_ACCEPTED;
            if ($invoice->save()) {
                /** @var \robokassa\Merchant $merchant */
                $merchant = Yii::$app->get('robokassa');
                return $merchant->payment($invoice->price, $invoice->id, 'Покупка VIP прогноза', null, $invoice->email);
            }
            else
                return $invoice->errors;
        }

        return $model->errors;
    }



    /*   public function actionInvoice()
       {
           $model = new Invoice();
           if ($model->load(Yii::$app->request->post()) && $model->save()) {
               $merchant = Yii::$app->get('robokassa');
               return $merchant->payment($model->price, $model->id, 'Пополнение счета', null, Yii::$app->user->identity->email);
           } else {
               return $this->render('invoice', [
                   'model' => $model,
               ]);
           }
       }*/

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'result' => [
                'class' => '\robokassa\ResultAction',
                'callback' => [$this, 'resultCallback'],
            ],
            'success' => [
                'class' => '\robokassa\SuccessAction',
                'callback' => [$this, 'successCallback'],
            ],
            'fail' => [
                'class' => '\robokassa\FailAction',
                'callback' => [$this, 'failCallback'],
            ],
        ];
    }


    public function actionTest()
    {
        $model = $this->loadModel(11);
        $forecast = VipForecast::findOne($model->forecast_id);

        \Yii::$app->mailer->htmlLayout = "@common/mail/layouts/html";
        $message = \Yii::$app->mailer->compose ( [ 'html' => '@common/mail/test' ] ,['model' => $forecast,'img' => $forecast->getThumbPath()]);
        $message->setFrom([\Yii::$app->params['supportEmail'] => 'Покупка VIP прогноза - '.$forecast->title]);
        $message->setTo ($model->email);
        $message->setSubject ( 'Покупка VIP прогноза - '.$forecast->title);
        $ok = $message->send();





        return $this->render('success_buy', [
            'model' => $model,
            'forecast' => $forecast,
        ]);
    }


    /**
     * Callback.
     * @param \robokassa\Merchant $merchant merchant.
     * @param integer $nInvId invoice ID.
     * @param float $nOutSum sum.
     * @param array $shp user attributes.
     */
    public function successCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $model = $this->loadModel($nInvId);
        $forecast = VipForecast::findOne($model->forecast_id);
        return $this->render('success_buy', [
            'model' => $model,
            'forecast' => $forecast,
        ]);
      /*  //вы купили прогноз
        //он выслан вам на почту
        return 'вы купили прогноз';*/
    }
    public function resultCallback($merchant, $nInvId, $nOutSum, $shp)
    {

        $model = $this->loadModel($nInvId);
        $model->status = Invoice::STATUS_SUCCESS;
        $model->save();

        $messageLog = [
            'status' => 'Платеж не прошел.',
            'invoice_id' => $model->id
        ];
        Yii::info($messageLog, 'payment_success');


        $forecast = VipForecast::findOne($model->forecast_id);
        \Yii::$app->mailer->htmlLayout = "@common/mail/layouts/html";
        $message = \Yii::$app->mailer->compose ( [ 'html' => '@common/mail/test' ] ,['model' => $forecast,'img' => $forecast->getThumbPath()]);
        $message->setFrom([\Yii::$app->params['supportEmail'] => 'Покупка VIP прогноза - '.$forecast->title]);
        $message->setTo ($model->email);
        $message->setSubject ( 'Покупка VIP прогноза - '.$forecast->title);
        $ok = $message->send();


        $messageLog = [
            'status' => 'Отправка письма',
            'invoice_id' => $model->id,
            'email_send' => $ok
        ];
        Yii::info($messageLog, 'payment_email_send');

        return 'OK' . $nInvId;
    }
    public function failCallback($merchant, $nInvId, $nOutSum, $shp)
    {
        $model = $this->loadModel($nInvId);
        if ($model->status == Invoice::STATUS_PENDING) {
            $model->status = Invoice::STATUS_FAIL;
            $model->save();
            return 'Ok';
        } else {
            return 'Status has not changed';
        }
    }

    /**
     * @param integer $id
     * @return Invoice
     * @throws \yii\web\BadRequestHttpException
     */
    protected function loadModel($id) {
        $model = Invoice::findOne($id);
        if ($model === null) {
            throw new BadRequestHttpException;
        }
        return $model;
    }
}