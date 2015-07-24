<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MaprintScales */

$this->title = 'Atualizar: ' . ' ' . $model->label;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Impressão', 'url'=> array('maprint/update', 'id'=>$model->maprint_id, 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = $model->label;
?>
<div class="maprint-scales-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
