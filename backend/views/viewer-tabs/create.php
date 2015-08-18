<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ViewerTabs */

$this->title = 'Novo Separador';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Módulos', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Novo';
?>
<div class="viewer-tabs-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
