<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ParamFormat */

$this->title = 'Atualizar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Formato Layers', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="param-format-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
