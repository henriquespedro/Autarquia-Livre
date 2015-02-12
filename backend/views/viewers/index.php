<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Visualizadores';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewers-index">

    <!--
    <h1><?= Html::encode($this->title) ?></h1>
    -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            //'description',
            //'scales',
            //'init_extent',
            // 'max_extent',
            // 'projection',
            // 'units',
             'active:boolean',
            // 'author',
            // 'theme',
             'create_data',
             'modified_dat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <p>
        <?= Html::a('Novo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

</div>
