<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Viewers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Viewers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewers-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'description',
            'name',
            'scales',
            'init_extent',
            'max_extent',
            'projection',
            'units',
            'active:boolean',
            'author',
            'theme',
            'create_data',
            'modified_dat',
        ],
    ]) ?>

</div>
