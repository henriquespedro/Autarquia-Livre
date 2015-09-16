<?php

namespace backend\controllers;

use Yii;
use app\models\ViewerTabsTools;
use app\models\ViewerTabsToolsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ViewerTabsToolsController implements the CRUD actions for ViewerTabsTools model.
 */
class ViewerTabsToolsController extends Controller {

    public $layout = 'admin_layout';
    
    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create', 'index', 'delete', 'update'],
                        'roles' => ['@'],
                    ],
//                    [
//                        'allow' => false,
//                        'actions' => ['create'],
//                        'roles' => ['@'],
//                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all ViewerTabsTools models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ViewerTabsToolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ViewerTabsTools model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ViewerTabsTools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new ViewerTabsTools();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewer-tabs/update', 'id' => $model->tabs_id, 'viewer_id' => $_GET['viewer_id']]);
        } else {
            return $this->renderAjax('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing ViewerTabsTools model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['viewer-tabs/update', 'id' => $model->tabs_id, 'viewer_id' => $_GET['viewer_id']]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing ViewerTabsTools model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id, $tabs_id, $viewer_id) {
        $this->findModel($id)->delete();
        return $this->redirect(['viewer-tabs/update', 'id' => $tabs_id, 'viewer_id' => $viewer_id]);
    }

    /**
     * Finds the ViewerTabsTools model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ViewerTabsTools the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = ViewerTabsTools::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
