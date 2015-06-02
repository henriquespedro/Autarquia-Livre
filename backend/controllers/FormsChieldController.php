<?php

namespace backend\controllers;

use Yii;
use app\models\FormsChield;
use app\models\FormsChieldSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FormsChieldController implements the CRUD actions for FormsChield model.
 */
class FormsChieldController extends Controller
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
     * Lists all FormsChield models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FormsChieldSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FormsChield model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FormsChield model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FormsChield();
        
//        if ($form_id)
//            $model->form_id = $form_id;
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['forms/update', 'id' => $model->form_id, 'viewer_id' => $_GET['viewer_id']]);
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
//            return $this->render('create', [
//                'model' => $model,
//            ]);
        }
    }

    /**
     * Updates an existing FormsChield model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['forms/update', 'id' => $model->form_id, 'viewer_id' => $_GET['viewer_id']]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FormsChield model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $form_id, $viewer_id)
    {
        $this->findModel($id)->delete();
        
        return $this->redirect(['forms/update', 'id' => $form_id, 'viewer_id' => $viewer_id]);
    }

    /**
     * Finds the FormsChield model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return FormsChield the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FormsChield::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
