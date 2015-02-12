<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormsChieldSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Forms Chields';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-chield-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Forms Chield', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'form_id',
            'template:ntext',
            'sqlselect:ntext',
            'sqlinsert:ntext',
            // 'sqlupdate:ntext',
            // 'sqldelete:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
