<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use backend\models\SiteSettings;
use yii\web\Response;
use yii\web\UploadedFile;
use backend\models\UploadForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'delete-banner','tiny-mce-upload'],
                        'allow' => true,
                        'roles' => ['@'],
						'matchCallback' => function ($rule, $action) {
                         return \common\models\User::isUserAdmin(Yii::$app->user->identity->username);
						}
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'tiny-mce-upload') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

		$form = new UploadForm();

        return $this->render('index', [
            'upload_form' => $form,
		]);
    }
	
	public function actionDeleteBanner()
	{
		unlink(SiteSettings::getMainBannerPath());
		//unset(SiteSettings::getMainBannerUrl());
		Yii::$app->session->addFlash('success', 'Main banner was deleted successfuly');
		
		return $this->redirect(['site/index']);
		
	}

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->loginAdmin()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionTinyMceUpload()
    {
        $imageFolder = Yii::getAlias('@frontend/web/').'/uploads/';
        Yii::$app->response->format = Response::FORMAT_JSON;


        // Don't attempt to process the upload on an OPTIONS request
   /*     if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            header("Access-Control-Allow-Methods: POST, OPTIONS");
            return;
        }*/

        reset($_FILES);
        $temp = current($_FILES);

        if (is_uploaded_file($temp['tmp_name'])) {
        /*    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = ['error' => 'Invalid file name'];
                Yii::$app->response->send();
            }*/
            $ext = strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION));
            if (!in_array($ext, array("gif", "jpg", "png"))) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                Yii::$app->response->data = ['error' => 'Invalid extension'];
                Yii::$app->response->send();
            }


            try {
                $web_filename = Yii::$app->security->generateRandomString().".{$ext}";
                $filetowrite = $imageFolder . $web_filename;

                if (!move_uploaded_file($temp['tmp_name'], $filetowrite)) {
                    Yii::$app->response->data = ['error' => 'Could not move file'];
                    Yii::$app->response->send();
                    Yii::$app->end();
                }

                move_uploaded_file($temp['tmp_name'], $filetowrite);
                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";
                $baseurl = $protocol . $_SERVER["HTTP_HOST"] .'/uploads/';
                Yii::$app->response->data = ['location' => $baseurl .$web_filename];
                Yii::$app->response->send();
                Yii::$app->end();
            } catch (\Exception $e) {
                Yii::$app->response->data = ['error' => 'File did not upload: ' . $e->getMessage()];
                Yii::$app->response->send();
                Yii::$app->end();
            }


        } else {
            Yii::$app->response->data = ['error' => '500'];
            Yii::$app->response->send();
            Yii::$app->end();
        }


    }
}
