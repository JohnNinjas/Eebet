<?php
namespace frontend\controllers;


use backend\components\ForecastImages;
use common\models\Banners;
use common\models\FreeForecast;
use common\models\News;
use common\models\NewsCategories;
use common\models\Settings;
use Yii;
use yii\data\Pagination;
use yii\db\Expression;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\ContactForm;
use yii\web\Response;
use common\models\Promotions;
use common\models\VipForecast;
use yii\web\Cookie;



/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'details-search-redirect' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $banners = Banners::find()->where(['type' => 0])->orderBy(['sort' => SORT_ASC])->all();
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Сообщение отправлено');
            } else {
                Yii::$app->session->setFlash('error', 'Неудалось отправить письмо');
            }

            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
                'banners' => $banners
            ]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionWarranty()
    {
        return $this->render('warranty');
    }

    public function actionPromotion()
    {
        $model = new \frontend\models\PromotionsForm();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());

            if ($model->validate()) {
                $promotion = new Promotions();
                $promotion->setAttributes($model->attributes);
            if ($promotion->save()) {
                \Yii::$app->mailer->htmlLayout = "@common/mail/layouts/html";
                $message = \Yii::$app->mailer->compose (['html' => '@common/mail/promotion']);
                $message->setFrom([\Yii::$app->params['supportEmail'] => 'EEBET']);
                $message->setTo ('eebet1@yandex.ru');
                $message->setSubject ( 'Заказ раскрутки');
                $ok = $message->send();
                Yii::$app->session->setFlash('success', 'Заяка принята');
            } else {
                Yii::$app->session->setFlash('error', 'Форма заполнена невеорно');
            }
            }
            else
            {
                Yii::$app->session->setFlash('error', 'Форма заполнена невеорно');
            }
            return $this->refresh();
        }
        else {
            return $this->render('promotion', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelivery()
    {
        return $this->render('delivery');
    }


    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return $this->render('error', ['exception' => $exception]);
        }
    }

    public function actionPrivacy()
    {
    /*    $now =  new \DateTime(date('d-m-Y H:i'));
        echo $now->format('d-m-Y H:i');*/
        return $this->render('privacy');
    }


    /**
     * @param string $slug
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionFreeForecast($slug)
    {
        $banners = Banners::find()->where(['type' => 1])->orderBy(['sort' => SORT_ASC])->all();
        $model = FreeForecast::find()->where(['slug' =>$slug])->one();
        if ($model === null)
            throw new BadRequestHttpException;
        return $this->render('free_forecast', [
            'model' => $model,
            'banners' => $banners
        ]);
    }

    /**
     * @param string $slug
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionVipForecast($slug)
    {
        $model = VipForecast::find()->where(['slug' =>$slug,'open' => 1])->one();
        $banners = Banners::find()->where(['type' => 1])->orderBy(['sort' => SORT_ASC])->all();
        if ($model === null)
            throw new BadRequestHttpException;
        return $this->render('vip_forecast', [
            'model' => $model,
            'banners' => $banners
        ]);
    }

    public function actionFreeForecastList()
    {
        $expression = new Expression('*,IF (expire < 2,1,0) as sort');
        $order = new Expression('sort desc,(CASE WHEN sort = 1 THEN event_date END) asc, (CASE WHEN sort = 0 THEN event_date END) desc');
        $query = FreeForecast::find()->select($expression);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $forecasts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($order)
            ->all();
        return $this->render('free_forecast_list', [
            'pages' => $pages,
            'forecasts' => $forecasts,
        ]);
    }

    public function actionVipForecastList()
    {
        $expression = new Expression('*,IF (expire < 2,1,0) as sort');
        $order = new Expression('sort desc,(CASE WHEN sort = 1 THEN event_date END) asc, (CASE WHEN sort = 0 THEN event_date END) desc');
        $query = VipForecast::find()->select($expression);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 9, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $forecasts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy($order)
            ->all();
        $settings = Settings::find()->where(['key' => 'timer'])->one();
        $timerDate =  $settings->value;
        return $this->render('vip_forecast_list', [
            'pages' => $pages,
            'forecasts' => $forecasts,
            'timerDate' =>  $timerDate
        ]);
    }

    public function actionLox()
	{
		/* @var NewsCategories[] $cats */
		$cats = NewsCategories::find()->where(['id' => 11])->all();
		foreach ($cats as $cat) {
			$path = $cat->getPhotoPath();
			ForecastImages::doResize($path, $cat->getThumbPath(), [
				'quality' => 100,
				'newWidth' => 350,
			]);
		}



	}
}
