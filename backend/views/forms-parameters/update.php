<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormsParameters */

$this->title = 'Update Forms Parameters: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forms Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forms-parameters-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
