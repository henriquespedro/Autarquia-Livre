<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ConfigConfrontationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Config Confrontations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="config-confrontation-index">

    <div class="row">
        <div class="col-lg-3">
        <?= $this->render('/menus') ?>
        </div>
        <div class="col-lg-9">
        
        <p>
            <?= Html::a('Novo Grupo', ['create', 'viewer_id' => $_GET['viewer_id']], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'viewer_id',
                'layer:ntext',
                'name:ntext',
                //'search_field:ntext',

                [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('config-confrontation/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('config-confrontation/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
            ],
        ]); ?>
        </div>
    </div>

</div>
