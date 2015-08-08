<?php

use yii\helpers\Html;
use frontend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <meta http-equiv="content-type" charset="UTF-8" content="text/html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Autarquia Livre">
        <meta name="keywords" content="SIG,FOSS4G,OpenSource,WebSIG,Mapas,Autarquia">
        <!--<link href="img/globe.png" rel="shortcut icon" type="image/x-icon" >-->
        <meta name="author" content="Autarquia Livre">
        <!--<title>Autarquia Livre</title>-->
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no"/>

        <!--***CSS Files***-->
        <!--Bootstrap-->
        <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../../vendor/bower/bootstrap/dist/css/bootstrap-theme.min.css'); ?>
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../../vendor/bower/bootstrap/dist/css/bootstrap.css'); ?>

        <!--OpenLayers 3-->
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../../vendor/openlayers/css/ol.css'); ?>
        
        <!--Tooltipster->
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../../vendor/tooltipster/css/tooltipster.css'); ?>
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../../vendor/tooltipster/css/themes/tooltipster-shadow.css'); ?>
        
        <!--jsTree-->
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../../vendor/jstree/themes/default/style.min.css'); ?>

        <!--Default Project CSS-->
        <?php $this->registerCssFile(Yii::$app->request->baseUrl . '/../css/default.css'); ?>
        
        <!-- Jquery UI -->
        <?php $this->registerCssFile('//code.jquery.com/ui/1.11.4/themes/flick/jquery-ui.css'); ?>
        <!--<link rel="newest stylesheet" type="text/css" href="../css/default.css"/>-->
        
        <!-- IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://madrona2d.labs.ecotrust.org/media/html5shiv.js"></script>
        <![endif]-->

        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>

        <?= $content ?>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
