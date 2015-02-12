<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\FormsChield */

$this->title = 'Create Forms Chield';
$this->params['breadcrumbs'][] = ['label' => 'Forms Chields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-chield-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
