<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bookmarks */

$this->title = 'Novo Bookmarks';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Bookmarks', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Novo';
?>
<div class="bookmarks-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>


</div>
