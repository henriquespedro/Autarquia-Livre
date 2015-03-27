<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GeographicEdit */

$this->title = 'Nova layer';
//$this->params['breadcrumbs'][] = ['label' => 'Geographic Edits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geographic-edit-create">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
