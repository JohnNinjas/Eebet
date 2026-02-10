<?php
namespace frontend\controllers;


use common\models\Banners;
use common\models\FreeForecast;
use common\models\News;
use common\models\NewsCategories;
use common\models\Settings;
use Yii;
use yii\base\BaseObject;
use yii\base\InvalidParamException;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\helpers\Inflector;
use yii\web\Response;
use yii\web\UploadedFile;
use common\models\Promotions;
use common\models\VipForecast;
use yii\web\Cookie;



/**
 * News controller
 */
class NewsController extends BaseController
{

	public function actionNewsAllCats()
	{
		$categories = NewsCategories::find()->indexBy('id')->all();
		$query = News::find();
		$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9, 'forcePageParam' => false, 'pageSizeParam' => false]);
		$news = $query->offset($pages->offset)
			->limit($pages->limit)
			->orderBy(['created_at' => SORT_ASC])
			->all();
		return $this->render('news_categories', [
			'pages' => $pages,
			'news' => $news,
			'categories' => $categories
		]);
	}

	/**
	 * @param string $slug
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function actionNewsCategory($slug)
	{
		$model = NewsCategories::find()->where(['slug' =>$slug])->one();
		if ($model === null)
			throw new BadRequestHttpException;
		$query = News::find()->where(['cat_id' => $model->id]);
		$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9, 'forcePageParam' => false, 'pageSizeParam' => false]);
		$news = $query->offset($pages->offset)
			->limit($pages->limit)
			->orderBy(['created_at' => SORT_ASC])
			->all();
		return $this->render('news_category', [
			'model' => $model,
			'pages' => $pages,
			'news' => $news,
		]);
	}



	/**
	 * @param integer $id
	 * @param integer $type
	 */
	public function actionVote($id,$type)
	{
		$model = News::findOne($id);
		Yii::$app->response->format = Response::FORMAT_JSON;
		if ($model === null) {
			Yii::$app->response->data = ['error' => 'Ошибка'];
			Yii::$app->response->send();
			Yii::$app->end();
		}
		if(!Yii::$app->request->cookies['vote'.$id]) {
			$cookie = new Cookie([
				'name' => 'vote'.$id,
				'value' => $type,
				'expire' => time() + 3600,
			]);
			$attr = $model->VOTE_NAME[$type];
			\Yii::$app->getResponse()->getCookies()->add($cookie);
			$model->$attr++;
			$model->save();
			Yii::$app->response->data = ['success' => ($model->upvote-$model->dislike),'add' => 1];
			Yii::$app->response->send();
			Yii::$app->end();
		} else {
			$attr = $model->VOTE_NAME[$type];
			$typeCookie = Yii::$app->request->cookies['vote'.$id]->value;
			$attrCookie = $model->VOTE_NAME[$typeCookie];
			if ($typeCookie != $type) {
				$model->$attr++;
				$model->$attrCookie--;
			}
			else {
				$model->$attrCookie--;
			}
			$model->save();
			$cookies = Yii::$app->response->cookies;
			$cookies->remove('vote'.$id);


			if ($typeCookie != $type) {
				$cookie = new Cookie([
					'name' => 'vote' . $id,
					'value' => $type,
					'expire' => time() + 3600,
				]);
				\Yii::$app->getResponse()->getCookies()->add($cookie);
			}
			Yii::$app->response->data = ['success' => ($model->upvote-$model->dislike),'add' => ($typeCookie != $type)];
			Yii::$app->response->send();
			Yii::$app->end();
		}
	}

	/**
	 * @param string $slug
	 * @throws \yii\web\BadRequestHttpException
	 */
	public function actionNews($cat_slug,$slug)
	{
		$model = News::find()->where(['slug' =>$slug])->one();
		if ($model === null)
			throw new BadRequestHttpException;

		$category = NewsCategories::find()->where(['slug' =>$cat_slug])->one();
		if ($category === null)
			throw new BadRequestHttpException;
		if(!Yii::$app->request->cookies['count']) {
			$cookie = new Cookie([
				'name' => 'count',
				'value' => '1',
				'expire' => time() + 3600,
			]);
			\Yii::$app->getResponse()->getCookies()->add($cookie);
			$model->views++;
			$model->save();
		}


		$dateFrom = \DateTime::createFromFormat('U', $model->created_at);
		$dateFrom->modify('-1 week');
		$dateTo = \DateTime::createFromFormat('U', $model->created_at);
		$dateTo->modify('+1 week');

		$relatedNews = News::find()->where(['cat_id' =>$model->cat_id])->andWhere(['<>','id', $model->id])
			->andWhere(['between', 'created_at', $dateFrom->format('U'), $dateTo->format('U') ])->limit(3)->all();

		$banners = Banners::find()->where(['type' => 1])->orderBy(['sort' => SORT_ASC])->all();
		return $this->render('news', [
			'model' => $model,
			'banners' => $banners,
			'relatedNews' => $relatedNews,
			'category' =>  $category
		]);
	}

}
