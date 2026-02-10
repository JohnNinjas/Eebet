<?php

namespace backend\controllers;

use Yii;
use common\models\NewsCategories;
use backend\models\NewsCategoriesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * NewsCategoriesController implements the CRUD actions for NewsCategories model.
 */
class NewsCategoriesController extends Controller
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
     * Lists all NewsCategories models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NewsCategoriesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new NewsCategories model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NewsCategories();

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
     * Updates an existing NewsCategories model.
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
     * Deletes an existing NewsCategories model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NewsCategories model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return NewsCategories the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = NewsCategories::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPhotoDelete()
    {

        if (Yii::$app->request->isAjax) {
            $data = Yii::$app->request->post();

            $banner = NewsCategories::findOne($data['key']);
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
