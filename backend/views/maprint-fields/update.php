<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaprintFields */

$this->title = 'Atualizar campo: ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->viewer_id, 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = ['label'=>'Campos de Impressão', 'url'=> array('index', 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="maprint-fields-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
