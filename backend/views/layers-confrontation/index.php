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
            <?= Html::a('Nova Layer', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'confrontation_id',
                'name:ntext',
                'layer:ntext',
                //'description_field:ntext',
                // 'regulement_field:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
        </div>
    </div>

</div>
