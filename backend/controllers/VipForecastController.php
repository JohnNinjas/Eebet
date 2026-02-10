<?php

namespace backend\controllers;

use Yii;
use common\models\VipForecast;
use backend\models\VipForecastSearch;
use yii\helpers\BaseFileHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * VipForecastController implements the CRUD actions for VipForecast model.
 */
class VipForecastController extends Controller
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
     * Lists all VipForecast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new VipForecastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single VipForecast model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new VipForecast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new VipForecast();


        if (Yii::$app->request->post()) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                $file = UploadedFile::getInstance($model, 'file');
                if ($file)
                    $model->SaveImage($file);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
                $this->refresh();

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing VipForecast model.
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
                $file = UploadedFile::getInstance($model, 'file');
                if ($file)
                    $model->SaveImage($file);
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
                $this->refresh();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionPhotoDelete()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $forecast = VipForecast::findOne($data['key']);
            if (file_exists($forecast->getPhotoPath()))
                unlink($forecast->getPhotoPath());
            $forecast->image = '';
            $forecast->save();

            $output = [];
            echo json_encode($output);
            die();


        }
    }

    /**
     * Deletes an existing VipForecast model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model)
        {
            BaseFileHelper::removeDirectory($model->getDir());
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the VipForecast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return VipForecast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VipForecast::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
