<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Appoptions */

$this->title = 'Create Appoptions';
$this->params['breadcrumbs'][] = ['label' => 'Appoptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appoptions-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
