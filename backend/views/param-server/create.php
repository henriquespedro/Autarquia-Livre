<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ParamServer */

$this->title = 'Novo Tipo de Servidor';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Servidores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-server-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
