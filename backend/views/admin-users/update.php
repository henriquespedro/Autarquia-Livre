<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AdminUsers */

$this->title = 'Atualizar: ' . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Administradores Locais', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="admin-users-update">



    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
