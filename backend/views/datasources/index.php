<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DatasourcesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ligações de Dados';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datasources-index">


    <?= Html::a('Nova Ligação', ['create'], ['class' => 'btn btn-success']) ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            'type',
            /*'string',
            'change_data',*/

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('update', 'id' => $model->id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('delete', 'id' => $model->id);
                        return $url;
                    }
                }],
        ],
    ]); ?>



</div>
