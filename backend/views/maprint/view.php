<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Maprint */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Maprints', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maprint-view">

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
            'description:ntext',
            'description_font:ntext',
            'layer:ntext',
            'chage_data',
            'setOrder',
        ],
    ]) ?>

</div>
