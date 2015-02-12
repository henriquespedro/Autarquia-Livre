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
            <?= Html::a('Novo Grupo', ['create'], ['class' => 'btn btn-success']) ?>
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

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>

</div>
