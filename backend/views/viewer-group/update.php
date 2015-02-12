<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */

$this->title = 'Update Viewer Group: ' . ' ' . $model->id_viewer;
$this->params['breadcrumbs'][] = ['label' => 'Viewer Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_viewer, 'url' => ['view', 'id_viewer' => $model->id_viewer, 'id_group' => $model->id_group]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="viewer-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
