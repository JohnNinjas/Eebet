<?php

namespace backend\controllers;

use Yii;
use common\models\Banners;
use backend\models\BannersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * BannersController implements the CRUD actions for Banners model.
 */
class BannersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Banners models.
     * @return mixed
     */
    public function actionIndex()
    {

        $searchMain = new BannersSearch();
        $mainProvider = $searchMain->search(0,Yii::$app->request->queryParams);

        $searchPage = new BannersSearch();
        $pageProvider = $searchPage->search(1,Yii::$app->request->queryParams);

        $searchModal = new BannersSearch();
        $modalProvider = $searchPage->search(2,Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchMain' => $searchMain,
            'mainProvider' => $mainProvider,
            'searchPage' => $searchPage,
            'pageProvider' => $pageProvider,
            'searchModal' => $searchModal,
            'modalProvider' => $modalProvider,
        ]);
    }

    /**
     * Creates a new Banners model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Banners();


        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file)
                    $model->SaveImage($file);
                $model->save();
                return $this->redirect(['index']);
            }
            else
                $this->refresh();

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Banners model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->post()) {
            if ($model->load(Yii::$app->request->post())) {
                /* @var UploadedFile*/
                $file = UploadedFile::getInstance($model, 'file');
                if ($file)
                    $model->SaveImage($file);
                $model->save();
                return $this->redirect(['index']);
            }
            else
                $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Banners model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $banner = $this->findModel($id);
        if (file_exists($banner->getPhotoPath()))
            unlink($banner->getPhotoPath());
        $banner->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Banners model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banners the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Banners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionBannersSort()
    {
        $keys = Yii::$app->request->post()['keys'];
        $type = Yii::$app->request->post()['type'];
        foreach (Banners::find()->where(['in', 'id', $keys])->andWhere(['type' => $type])->all() as $q)
        {
            $q->sort = array_search($q->id,$keys);
            $ok = $q->save();
            if (!$ok) {
                echo '<pre style="color:red;">';
                print_r($q->getErrors());
                echo '</pre>';
            }
        }
        exit;
    }

    public function actionPhotoDelete()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $banner = Banners::findOne($data['key']);
            if (file_exists($banner->getPhotoPath()))
                unlink($banner->getPhotoPath());
            $banner->image = '';
            $banner->save();

            $output = [];
            echo json_encode($output);
            die();


        }
    }
}
