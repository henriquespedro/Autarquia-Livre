<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MaprintFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Campos de Impressão';
$this->params['breadcrumbs'][] = ['label' => 'Visualizador', 'url' => array('viewers/update', 'id' => $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maprint-fields-index">

    <p>
        <?= Html::a('Novo campo', ['create', 'viewer_id' => $_GET['viewer_id'], 'id' => ''], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'viewer_id',
            'name:ntext',
            'code_field:ntext',
            'type:ntext',
            // 'validation:ntext',
            // 'required:ntext',
            // 'setOrder',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('maprint-fields/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('maprint-fields/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
                ],
            ]);
            ?>

</div>
