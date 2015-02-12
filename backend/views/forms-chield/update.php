<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormsChield */

$this->title = 'Update Forms Chield: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forms Chields', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="forms-chield-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
