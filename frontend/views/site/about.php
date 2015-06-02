<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page. You may modify the following file to customize its content:</p>
    <?php

//the function
//Param 1 has to be an Array
//Param 2 has to be a String
    function multiexplode($delimiters, $string) {
        $ary = explode($delimiters[0], $string);
        array_shift($delimiters);
        if ($delimiters != NULL) {
            foreach ($ary as $key => $val) {
                $ary[$key] = multiexplode($delimiters, $val);
            }
        }
        return $ary;
    }

// Example of use
    $string = "Enquadramento-Rede Viária-Ferroviária";
    $string_planos = "PLanos-PDM";
    $delimiters = Array("-");
//    ",", ":", "|", 
    $res = array();
    array_push($res, multiexplode($delimiters, $string));
    array_push($res, multiexplode($delimiters, $string_planos));
//    echo count($res[0][0][0][2]);
//    echo $res[0][0][0][2];
    echo '<pre>';
    print_r($res);
    echo '</pre>';
    ?>
    <?
    <code><?= __FILE__ ?></code>
    </div>
