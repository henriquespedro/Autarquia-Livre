<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Viewers */

$this->title = 'Novo Visualizador';
//$this->params['breadcrumbs'][] = ['label' => 'Viewers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewers-create">

    <!--
    <h1><?= Html::encode($this->title) ?></h1>
    -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
