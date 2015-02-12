<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Forms', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-view">

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
            'html_template:ntext',
            'sql_select:ntext',
            'sql_insert:ntext',
            'sql_update:ntext',
            'sql_delete:ntext',
            'icon:ntext',
            'chage_data',
            'setOrder',
        ],
    ]) ?>

</div>
