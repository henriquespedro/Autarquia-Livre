<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SearchParameters */

$this->title = 'Atualizar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Pesquisas', 'url'=> array('search/update', 'id'=>$model->search_id, 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = $model->name;

?>
<div class="search-parameters-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
