<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FormsParameters */

$this->title = 'Atualizar: ' . ' ' . $model->label;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Formulários', 'url'=> array('forms/update', 'id'=>$model->form_id, 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = $model->label;
?>
<div class="forms-parameters-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
