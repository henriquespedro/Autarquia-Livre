<?php

namespace backend\controllers;

use Yii;
use app\models\ViewerGroup;
use app\models\ViewerGroupSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ViewerGroupController implements the CRUD actions for ViewerGroup model.
 */
class ViewerGroupController extends Controller
{
    public $layout = 'admin_layout';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all ViewerGroup models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ViewerGroupSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ViewerGroup model.
     * @param integer $id_viewer
     * @param integer $id_group
     * @return mixed
     */
    public function actionView($id_viewer, $id_group)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_viewer, $id_group),
        ]);
    }

    /**
     * Creates a new ViewerGroup model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ViewerGroup();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_viewer' => $model->id_viewer, 'id_group' => $model->id_group]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ViewerGroup model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id_viewer
     * @param integer $id_group
     * @return mixed
     */
    public function actionUpdate($id_viewer, $id_group)
    {
        $model = $this->findModel($id_viewer, $id_group);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_viewer' => $model->id_viewer, 'id_group' => $model->id_group]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ViewerGroup model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id_viewer
     * @param integer $id_group
     * @return mixed
     */
    public function actionDelete($id_viewer, $id_group)
    {
        $this->findModel($id_viewer, $id_group)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ViewerGroup model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id_viewer
     * @param integer $id_group
     * @return ViewerGroup the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_viewer, $id_group)
    {
        if (($model = ViewerGroup::findOne(['id_viewer' => $id_viewer, 'id_group' => $id_group])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
