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

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Nova', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


</div>
