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
session_start();
$connection = new SQLite3(__DIR__ . '/../../../data/data.db');
?>
<!--***Library***-->
<!-- ExtJS -->
<!--<script type="text/javascript" src="http://cdn.sencha.com/ext/gpl/4.2.1/examples/shared/include-ext.js?theme=neptune"></script>-->
<!--<script type="text/javascript" src="http://cdn.sencha.com/ext/gpl/4.2.1/examples/shared/options-toolbar.js"></script>-->

<!--<link rel="newest stylesheet" href="//code.jquery.com/ui/1.11.4/themes/flick/jquery-ui.css">-->

<!--JQuery v1.9.1-->
<script src="../../vendor/openlayers/resources/jquery.min.js" type="text/javascript"></script>

<!--JQuery UI v1.11.4-->
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<!--Tooltipster-->
<script src="../../vendor/tooltipster/js/jquery.tooltipster.min.js" type="text/javascript"></script>

<!--jsTree-->
<script src="../../vendor/jstree/jstree.min.js" type="text/javascript"></script>

<!--Bootstrap-->
<script src="../../vendor/bower/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>

<!--Google API-->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>google.load("visualization", "1", {packages: ["corechart"]});</script>

<!--OpenLayers 3-->
<script src="../../vendor/openlayers/build/ol.js" type="text/javascript"></script>

<!-- OpenLayers 3 Layerswitcher -->
<script src="../../vendor/openlayers/layerswitcher/ol3-layerswitcher.js" type="text/javascript"></script>

<!--GeoExt 2 -->
<!--<script type="text/javascript" src="../views/theme/default/loader.js"></script>-->
<script src="../../vendor/proj4/proj4.js" type="text/javascript"></script>
<!--<script src="http://cdnjs.cloudflare.com/ajax/libs/proj4js/2.3.6/proj4.js" type="text/javascript"></script>-->
<script src="http://epsg.io/3763.js" type="text/javascript"></script>
<script src="http://epsg.io/27493.js" type="text/javascript"></script>
<script src="http://epsg.io/20791.js" type="text/javascript"></script>
<script src="http://epsg.io/20790.js" type="text/javascript"></script>

<script src="../views/viewer/epsg.js" type="text/javascript"></script>

<script>
    $(document).ready(function () {
        $('.tooltip').tooltipster({
            contentAsHTML: true,
            theme: 'tooltipster-shadow'
        });
    });
</script>

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
            $load_permissions = $connection->query('SELECT * FROM viewer_group WHERE viewer_id ="' . $row["id"] . '"');

            if ($load_permissions->fetchArray(SQLITE3_ASSOC)) {
                if (isset($_SESSION['login_username'])) {
                    include_once __DIR__ . '/../theme/' . $row['theme'] . '/index.php';
                } else {
                    ?>
                    <script>
                        $(document).attr("title", "Login - <?php echo $row['description']; ?>");
                    </script>
                    <h1 style="text-align: center">Iniciar Sessão</h1><br><br>
                    <div style="width:300px; height:200px; margin: 0 auto; ">
                        <form action="../views/viewer/login.php" method="post">
                            <div class="form-group">
                                <label for="username">Utilizador:</label>
                                <input type="text" class="form-control" name="username" id="username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" name="password" id="password">
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" name="remember" value="1"> Lembrar-me</label>
                            </div>
                            <input style="float:right;" type="submit" class="btn btn-success" value=" Login "/>
                            <input type="hidden" class="form-control" name="viewer_id" id="viewer_id" value="<?php echo $row['id']; ?>">
                        </form>
                    </div>
                    <?php
                }
            } else {
                include_once __DIR__ . '/../theme/' . $row['theme'] . '/index.php';
            }
        }
    }
    ?>
</div>

<script>
    $('#login_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "../views/viewer/login.php",
            type: "POST",
            data: $('#login_form').serialize() + '&login_submit=',
            success: function (data) {
                if (data === "Sucesso") {
                    $('#LoginModal').modal('hide');
                    alert(data);
                } else {
                    alert(data);
                }
            },
            error: function () {
                alert('Ocorreu um erro ao validar o utilizador! Por favor, volte a tentar mais tarde!');
            }
        });
    });
</script>

