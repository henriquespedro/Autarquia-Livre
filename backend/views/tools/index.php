<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ToolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ferramentas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-index">


    <p>
        <?= Html::a('Nova', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name:ntext',
            'description:ntext',
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
            ]);
            ?>

</div>
