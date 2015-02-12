<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Group */

$this->title = 'Atualizar grupo: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Grupos', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
