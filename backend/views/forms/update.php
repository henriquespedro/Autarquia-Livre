<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */

$this->title = 'Atualizar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Formulários', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-update">

	<div class="row">
	    <div class="col-lg-3">
	    	<?= $this->render('/menus') ?>
	    </div>
	    <div class="col-lg-9">
		    <?= $this->render('_form', [
		        'model' => $model,
		    ]) ?>
		</div>
	</div>

</div>
