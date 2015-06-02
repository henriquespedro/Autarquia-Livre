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

/* @var $this yii\web\View */

$connection = new SQLite3(__DIR__ . '/../../../data/data.db');
?>
<!--***Library***-->
<!-- ExtJS -->
<!--<script type="text/javascript" src="http://cdn.sencha.com/ext/gpl/4.2.1/examples/shared/include-ext.js?theme=neptune"></script>-->
<!--<script type="text/javascript" src="http://cdn.sencha.com/ext/gpl/4.2.1/examples/shared/options-toolbar.js"></script>-->

<!--JQuery v1.9.1-->
<script src="../../vendor/openlayers/resources/jquery.min.js" type="text/javascript"></script>

<!--Bootstrap-->
<script src="../../vendor/bower/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

<!--OpenLayers 3-->
<script src="../../vendor/openlayers/build/ol.js" type="text/javascript"></script>

<!--GeoExt 2 -->
<!--<script type="text/javascript" src="../views/theme/default/loader.js"></script>-->
<script src="http://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js" type="text/javascript"></script>
<script src="http://epsg.io/3763-1753.js" type="text/javascript"></script>
<script src="http://epsg.io/27493-1753.js" type="text/javascript"></script>
<script src="http://epsg.io/20791-1753.js" type="text/javascript"></script>
<script src="http://epsg.io/20790-1753.js" type="text/javascript"></script>

<script src="../views/viewer/epsg.js" type="text/javascript"></script>

<div class="site-index">
    <?php
    $url_redirect = 'index.php';
    $redirect_text = 'O visualizador que pretende aceder n&atilde;o existe, ir&aacute; ser redirecionado para a lista de visualizadores dispon&iacute;veis';
    if (!isset($_GET["page"])) {
        echo $redirect_text;
        header('Refresh: 5; url=' . $url_redirect);
        die();
    } else {
        $load_config = $connection->query('SELECT * FROM viewers WHERE name ="' . $_GET["page"] . '"');
        $row = $load_config->fetchArray(SQLITE3_ASSOC);
        if ($row == false) {
            echo $redirect_text;
            header('Refresh: 5; url=' . $url_redirect);
            die();
        } else {

            include_once __DIR__ . '/../theme/' . $row['theme'] . '/index.php';
            include_once __DIR__ . '/../theme/' . $row['theme'] . '/init.php';
        }
    }
    ?>
</div>