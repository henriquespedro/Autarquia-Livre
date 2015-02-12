<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */

$this->title = $model->id_viewer;
$this->params['breadcrumbs'][] = ['label' => 'Viewer Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewer-group-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id_viewer' => $model->id_viewer, 'id_group' => $model->id_group], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id_viewer' => $model->id_viewer, 'id_group' => $model->id_group], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_viewer',
            'id_group',
        ],
    ]) ?>

</div>
