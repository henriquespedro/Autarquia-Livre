<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaprintScales */

$this->title = 'Create Maprint Scales';
$this->params['breadcrumbs'][] = ['label' => 'Maprint Scales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maprint-scales-create">

    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
