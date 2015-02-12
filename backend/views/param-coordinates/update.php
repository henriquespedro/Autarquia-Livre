<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParamCoordinates */

$this->title = 'Atualizar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Sistemas de Coordenadas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="param-coordinates-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
