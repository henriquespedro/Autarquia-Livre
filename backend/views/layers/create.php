<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Layers */

$this->title = 'Adicionar Layer';
$this->params['breadcrumbs'][] = ['label' => 'Layers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layers-create">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
