<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormsParametersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forms Parameters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-parameters-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Forms Parameters', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'form_id',
            'type:ntext',
            'parameter:ntext',
            'label:ntext',
            // 'description_field:ntext',
            // 'sqlquery:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
