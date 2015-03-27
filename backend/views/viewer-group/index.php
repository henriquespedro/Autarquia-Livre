<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ViewerGroupSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Viewer Groups';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewer-group-index">
        
        <p>
        <b>ATENÇÃO:</b> Para ativar protecção ás configurações e/ou layers, tem que adicionar os grupos pretendidos. Caso a tabela não possua nenhum grupo indentificado não adicionada segurança ao visualizador.
        </p>
        <p>
            <?= Html::a('Novo Grupo', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id_viewer',
                'id_group',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>

</div>
