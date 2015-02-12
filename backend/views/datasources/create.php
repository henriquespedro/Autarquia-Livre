<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Datasources */

$this->title = 'Nova Ligação de Dados';
//$this->params['breadcrumbs'][] = ['label' => 'Datasources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="datasources-create">

    <!--
    <h1><?= Html::encode($this->title) ?></h1>
	-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
