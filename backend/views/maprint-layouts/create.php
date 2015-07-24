<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaprintLayouts */

$this->title = 'Create Maprint Layouts';
$this->params['breadcrumbs'][] = ['label' => 'Maprint Layouts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maprint-layouts-create">


    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
