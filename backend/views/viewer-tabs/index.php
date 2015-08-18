<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewerTabsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Módulos';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Módulos';
?>
<div class="viewer-tabs-index">

    <p>
        <?= Html::a('Novo Separador', ['create', 'viewer_id' => $_GET['viewer_id'],'id' => ''], ['class' => 'btn btn-success']) ?>
    </p>


    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'code',
            'name',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
        ],
    ]); ?>

</div>
