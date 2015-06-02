<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LayersConfrontationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Layers Confrontations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layers-confrontation-index">

    <div class="row">
        <div class="col-lg-3">
        <?= $this->render('/menus') ?>
        </div>
        <div class="col-lg-9">
        
        <p>
            <?= Html::a('Nova Layer', ['create', 'viewer_id' => $_GET['viewer_id']], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'name:ntext',
                'layer:ntext',

                [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('layers-confrontation/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('layers-confrontation/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
            ],
        ]); ?>
        </div>
    </div>

</div>
