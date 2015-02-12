<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParamFormat */

$this->title = 'Novo Tipo de Formato';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Formatos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-format-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
