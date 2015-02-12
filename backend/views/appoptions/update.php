<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Appoptions */

$this->title = 'Atualizar configurações da aplicação';
//$this->params['breadcrumbs'][] = ['label' => 'Appoptions', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="appoptions-update">

    <!--
    <h1><?= Html::encode($this->title) ?></h1>
	-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
