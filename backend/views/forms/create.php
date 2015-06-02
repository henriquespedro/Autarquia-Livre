<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */

$this->title = 'Novo Formulário';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Formulários', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Novo';
?>
<div class="forms-create">
    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
