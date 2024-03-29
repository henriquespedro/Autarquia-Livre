<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewerGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Segurança';
$this->params['breadcrumbs'][] = ['label' => 'Visualizador', 'url' => array('viewers/update', 'id' => $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Segurança';
?>
<div class="viewer-group-index">

    <p>
        <b>ATENÇÃO:</b> Para ativar protecção ás configurações e/ou layers, tem que adicionar os grupos pretendidos. Caso a tabela não possua nenhum grupo indentificado não será adicionada segurança ao visualizador.
    </p>
    <p>
        <?= Html::a('Novo Grupo', ['create', 'viewer_id' => $_GET['viewer_id']], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'group_id',
                'label' => 'Grupo',
                'format' => 'text', //raw, html
                'content' => function($data) {
                    return Group::find()->where("id=" . $data->group_id)->one()->description;
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('viewer-group/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('viewer-group/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
                ],
            ]);
            ?>

</div>
