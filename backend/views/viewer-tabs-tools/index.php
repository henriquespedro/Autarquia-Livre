<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewerTabsToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Viewer Tabs Tools';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewer-tabs-tools-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Viewer Tabs Tools', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'tabs_id',
            'tools_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
