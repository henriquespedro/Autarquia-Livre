<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AdminUsers */

$this->title = 'Novo Administrador Local';
$this->params['breadcrumbs'][] = ['label' => 'Administradores Locais', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
