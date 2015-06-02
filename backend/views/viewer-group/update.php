<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */

$this->title = 'Update Viewer Group: ' . ' ' . $model->viewer_id;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->viewer_id, 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = ['label'=>'Segurança', 'url'=> array('index', 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="viewer-group-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
