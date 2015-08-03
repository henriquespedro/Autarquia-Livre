<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Lista de Layers';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Lista de Layers';
?>
<div class="layers-index">


    <p>
        <?= Html::a('Nova Layer', ['create', 'viewer_id' => $_GET['viewer_id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'viewer_id',
            'name:ntext',
            //'layer:ntext',
            //'layer_type:ntext',
            // 'visible:boolean',
            // 'show_toc:boolean',
            // 'opacity',
            // 'crs:ntext',
            // 'style:ntext',
            // 'serverType:ntext',
            'type:ntext',
            // 'icon:ntext',
            // 'chage_data',
            // 'setOrder',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('layers/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('layers/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
                ],
            ]);
            ?>


</div>
