<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FormsParameters */

$this->title = 'Create Forms Parameters';
$this->params['breadcrumbs'][] = ['label' => 'Forms Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-parameters-create">


    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
