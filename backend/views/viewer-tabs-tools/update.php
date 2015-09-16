<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerTabsTools */

$this->title = 'Atualizar Ferramenta';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Módulos', 'url'=> array('viewer-tabs/update', 'id'=>$model->tabs_id, 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Atualizar';
?>
<div class="viewer-tabs-tools-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
