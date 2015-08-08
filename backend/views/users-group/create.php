<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\UsersGroup */

$this->title = 'Create Users Group';
$this->params['breadcrumbs'][] = ['label' => 'Users Groups', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-group-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
