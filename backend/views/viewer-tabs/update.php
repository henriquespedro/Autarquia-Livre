<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerTabs */

$this->title = 'Atualizar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->viewer_id, 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = ['label'=>'Módulos', 'url'=> array('index', 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="viewer-tabs-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
