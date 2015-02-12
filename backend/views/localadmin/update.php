<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Localadmin */

$this->title = 'Atualizar: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Administradores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title) ;
?>
<div class="localadmin-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
