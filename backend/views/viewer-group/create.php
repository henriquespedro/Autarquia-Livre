<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */

$this->title = 'Adicionar Grupo ao Visualizador';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Segurança', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Novo';
?>
<div class="viewer-group-create">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
