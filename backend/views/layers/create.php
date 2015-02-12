<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Layers */

$this->title = 'Adicionar Layer';
$this->params['breadcrumbs'][] = ['label' => 'Layers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layers-create">

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
