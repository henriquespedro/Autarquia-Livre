<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Datasources */

$this->title = 'Editar Ligação de Dados: ' . ' ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Datasources', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="datasources-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
