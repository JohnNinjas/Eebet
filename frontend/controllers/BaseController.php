<?php
namespace frontend\controllers;


use common\models\Banners;
use yii\web\Controller;



/**
 * News controller
 */
abstract class BaseController extends Controller
{

	public $show_modal;
	public $banner;

	public function beforeAction($event)
	{
		if (!isset($_COOKIE['view-modal'])) {
			$this->show_modal = 1;
			$this->banner = Banners::find()->where(['type' => 2])->one();
		} else
			$this->show_modal = 0;
		return parent::beforeAction($event);
	}


}
