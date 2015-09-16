<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tools */

$this->title = 'Ferramentas: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ferramentas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tools-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
