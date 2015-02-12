<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\FormsChield */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Forms Chields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-chield-view">

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
            'form_id',
            'template:ntext',
            'sqlselect:ntext',
            'sqlinsert:ntext',
            'sqlupdate:ntext',
            'sqldelete:ntext',
        ],
    ]) ?>

</div>
