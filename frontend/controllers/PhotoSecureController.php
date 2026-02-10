<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

class PhotoSecureController extends Controller
{

    public function actionFreeForecastPhoto($forecast_id, $photo)
    {
        $path = Yii::getAlias('@secure_photo') . '/free_forecast/' . $forecast_id . '/' . $photo;
        if (file_exists($path)) {
            header('Content-type: image/jpeg');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit();
        } else
            throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNewsPhoto($news_id, $photo)
    {
        $path = Yii::getAlias('@secure_photo') . '/news/' . $news_id . '/' . $photo;
        if (file_exists($path)) {
            header('Content-type: image/jpeg');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit();
        } else
            throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNewsCatsPhoto($cat_id, $photo)
    {
        $path = Yii::getAlias('@secure_photo') . '/news_cats/' . $cat_id . '/' . $photo;
        if (file_exists($path)) {
            header('Content-type: image/jpeg');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit();
        } else
            throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionVipForecastPhoto($forecast_id, $photo)
    {
        $path = Yii::getAlias('@secure_photo') . '/vip_forecast/' . $forecast_id . '/' . $photo;
        if (file_exists($path)) {
            header('Content-type: image/jpeg');
            header('Content-Length: ' . filesize($path));
            readfile($path);
            exit();
        } else
            throw new NotFoundHttpException('The requested page does not exist.');
    }

}
