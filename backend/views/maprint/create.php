<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Maprint */

$this->title = 'Nova planta';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Impressão', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Novo';
?>
<div class="maprint-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
