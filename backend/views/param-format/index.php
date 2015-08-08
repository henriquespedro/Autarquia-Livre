<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ParamFormatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipo de Formatos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-format-index">

    <p>
        <?= Html::a('Novo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name:ntext',
            'format:ntext',

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
