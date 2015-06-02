<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Search */

$this->title = 'Nova Pesquisa';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Pesquisas', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Nova';
?>
<div class="search-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
