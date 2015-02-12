<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SearchParameters */

$this->title = 'Create Search Parameters';
$this->params['breadcrumbs'][] = ['label' => 'Search Parameters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-parameters-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
