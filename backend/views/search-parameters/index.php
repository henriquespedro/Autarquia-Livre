<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchParametersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Search Parameters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-parameters-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Search Parameters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'search_id',
            'name:ntext',
            'require:boolean',
            'type:ntext',
            // 'sqlquery:ntext',
            // 'value_field:ntext',
            // 'description_field:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
