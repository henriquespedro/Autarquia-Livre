<?php
/*
 * Copyright (C) 2015 Autarquia-Livre
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

$connection = new SQLite3(__DIR__ . '/../data/data.db');
//foreach ($_GET as $key => $value) {
//    $$key = $value;
//}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="Autarquia Livre">
        <meta name="keywords" content="SIG,FOSS4G,OpenSource,WebSIG,Mapas,Autarquia">
        <!--<link href="img/globe.png" rel="shortcut icon" type="image/x-icon" >-->
        <meta name="author" content="Autarquia Livre">
        <!--<title>Autarquia Livre</title>-->
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no"/>

        <!--***CSS Files***-->
        <!--Bootstrap-->
        <link rel="stylesheet" type="text/css" href="../vendor/bower/bootstrap/dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" type="text/css" href="../vendor/bower/bootstrap/dist/css/bootstrap.css">
        <!--OpenLayers 3-->
        <link rel="stylesheet" type="text/css" href="../vendor/openlayers/css/ol.css">
        <!--Default Project CSS-->
        <link rel="stylesheet" type="text/css" href="css/default.css">


        <!--***Library***-->
        <!--JQuery v1.9.1-->
        <script src="../vendor/openlayers/resources/jquery.min.js"></script>
        <!--Bootstrap-->
        <script src="../vendor/bower/bootstrap/dist/js/bootstrap.min.js"></script>
        <!--OpenLayers 3-->
        <script src="../vendor/openlayers/build/ol.js"></script>
        <!-- IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://madrona2d.labs.ecotrust.org/media/html5shiv.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        $load_config = $connection->query('SELECT * FROM viewers WHERE name ="' . $_GET["page"] . '"');
        $row = $load_config->fetchArray(SQLITE3_ASSOC);
        if ($row == false) {
            echo 'O visualizador que pretende aceder não existe, irá ser redirecionado para a lista de visualizadores disponíveis';
            header('Refresh: 5; url=web/index.php');
            die();
        } else {

            include_once 'theme/' . $row['theme'] . '/index.php';
            ?>
            <script type="text/javascript" >
                document.title = '<?php echo $row['description']; ?>';
                document.getElementById("site_name").innerHTML = '<?php echo $row['description']; ?>';
            </script>
            <?php
            $load_tabs = $connection->query('SELECT * FROM viewer_tabs WHERE viewer_id =' . $row['id']);
            ?>
            <script>
    <?php
    while ($row_tabs = $load_tabs->fetchArray(SQLITE3_ASSOC)) {
        ?>
                    $('#top_tabs').append('<li title="<?php echo $row_tabs['name']; ?>"><a href="#<?php echo $row_tabs['code']; ?>" data-toggle="tab"><?php echo $row_tabs['name']; ?></a></li>');
                    $('#content_tabs').append('<div id="<?php echo $row_tabs['code']; ?>" class="tab-pane"></div>');
        <?php
        $load_tools = $connection->query('SELECT * FROM tools WHERE tabs_id ="' . $row_tabs['code'] . '"');
        while ($row_tools = $load_tools->fetchArray(SQLITE3_ASSOC)) {
            ?>             
                $('#<?php echo $row_tabs['code']; ?>').append('<button type="button" onclick="<?php echo $row_tools['code']; ?>()" title="<?php echo $row_tools['description']; ?>" class="btn bt_size " data-toggle="button"> <span class="glyphicon" style="background-image:url(images/<?php echo $row_tools['icon']; ?>);background-repeat:no-repeat;background-position:center;width:24px;height:24px;" aria-hidden="true"></span> <div><span class="glyphicon-class"><?php echo $row_tools['name']; ?></span></div></button>');
                
            <?php
        }
    }
    ?>
            $( '#top_tabs li').first().addClass("active");
            $( '#content_tabs div').first().addClass("active");
            </script>
            <?php
        }
        ?>
            <script src="javascript/tools.js" type="text/javascript"></script>

    </body>
</html>