<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeographicEdit */

$this->title = 'Atualizar Editar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Edições', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="geographic-edit-update">

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
