<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParamCoordinates */

$this->title = 'Novo Sistema de Coordenadas';
$this->params['breadcrumbs'][] = ['label' => 'Sistemas de Coordenadas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-coordinates-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
