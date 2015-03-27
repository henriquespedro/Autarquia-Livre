<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bookmarks */

$this->title = 'Novo Bookmarks';
$this->params['breadcrumbs'][] = ['label' => 'Bookmarks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookmarks-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>


</div>
