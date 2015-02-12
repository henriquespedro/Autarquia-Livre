<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Layers */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Layers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layers-view">

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
            'viewer_id',
            'name:ntext',
            'layer:ntext',
            'layer_type:ntext',
            'visible:boolean',
            'show_toc:boolean',
            'opacity',
            'crs:ntext',
            'style:ntext',
            'serverType:ntext',
            'type:ntext',
            'icon:ntext',
            'chage_data',
            'setOrder',
        ],
    ]) ?>

</div>
