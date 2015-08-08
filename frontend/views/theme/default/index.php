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
?>

<script>
    $(document).ready(function () {
        $("#map").height($(window).height() - 130);
        $("#layer_tree").height($(window).height() - 200);
        $("#legend").height($(window).height() - 200);
        $("#options").height($(window).height() - 200);
        $(window).on('resize', function () {
            if ($(window).width() >= 1024) {

                $("#map").height($(window).height() - 130);
                $("#layer_tree").height($(window).height() - 200);
                $("#legend").height($(window).height() - 200);
                $("#options").height($(window).height() - 200);
                show_slider();
            } else {
                $("#map").height($(window).height() - 130);
                
                $("#layer_tree").height($(window).height() - 200);
                $("#legend").height($(window).height() - 200);
                $("#options").height($(window).height() - 200);
                
                $("#sidebar-hide-btn").click();
            }
        }).trigger('resize');
    });</script>
<div>
    <nav class="navbar navbar-default top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!--                <div>
                            <a class="navbar-brand" id="site_name" href="#"></a>
                        </div>-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_options">
                <span class="sr-only">Ferramentas</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="site_name" href="#"></a>

        </div>
        <div class="collapse navbar-collapse" id="top_options">
            <ul class="nav navbar-nav">
                <div class="container" style="width:auto;">
                    <ul id="top_tabs" class="nav nav-tabs" data-tabs="tabs">

                    </ul>
                    <div id="content_tabs" class="tab-content">

                    </div>
                </div>
            </ul>
        </div>
    </nav>
</div>
<!--<div class="container-fluid fill">-->
<div class="container-fluid fill">
    <div class="row">
        <div id="panel" class="col-md-3" >
            <div style="width:auto;">
                <ul id="options_list" class="nav nav-tabs">
                    <li class="active" title="Lista de Temas" id="tree_list"><a href="#layer_tree" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span></a></li>
                    <li title="Legenda" id="legend_list" ><a href="#legend" data-toggle="tab"><span class="glyphicon glyphicon-bookmark"></span> </a></li>
                    <li  title="Opções" id="option_list"><a href="#options" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span></a></li>
                    <button type="button" class="btn btn-xs btn-default pull-right" title="Esconder painel" id="sidebar-hide-btn"><span class="glyphicon glyphicon-chevron-left"></span></button>
                </ul>
                <div id="content_spinner" class="tab-content">
                    <div id="layer_tree" style="overflow-y: auto;" class="tab-pane active tree"></div>
                    <div id="legend" style="overflow-y: auto;" class="tab-pane"></div>
                    <div id="options" style="overflow-y: auto;" class="tab-pane"></div>
                </div>
            </div>


        </div>
        <div class="col-md-9"  id="map_panel">
            <div id="map" class="map content_border" contextmenu="menu_options">
                <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/../javascript/map.js'); ?>
                <!--<script src="javascript/map.js" type="text/javascript"></script>-->
                <!-- create the menu -->
                <menu type="context" id="menu_options">
                    <menuitem label="Refresh" onclick="window.location.reload();" icon="ico_reload.png"></menuitem>
                    <!--<menuitem label="Export Map" onclick="exportar_mapa()" icon="ico_export_map.png"></menuitem>-->
                    <menuitem label="Print" onclick="imprimir_plantas()" icon="ico_print.png"></menuitem>
                    <menuitem label="Open StreetView" onclick="" icon="ico_streetview.png"></menuitem>
                    <menuitem label="Get Informations" onclick="obter_informacoes()" icon="ico_info.png"></menuitem>
                    <menu label="Share on...">
                        <menuitem label="Twitter" icon="ico_twitter.png" onclick="window.open('//twitter.com/intent/tweet?text=' + window.location.href);"></menuitem>
                        <menuitem label="Facebook" icon="ico_facebook.png" onclick="window.open('//facebook.com/sharer/sharer.php?u=' + window.location.href);"></menuitem>
                        <menuitem label="Email This Page" icon="ico_email.png" onclick="window.location = 'mailto:?body=' + window.location.href;"></menuitem>
                    </menu>

                </menu>

            </div>
            <div class="btn-toolbar" style="position:absolute; left: 60px; top:10px" role="toolbar" aria-label="...">
                <div class="btn-group" role="group"><!--data-toggle="button" --> 
                    <button class="btn btn-default" id="btn_vista_inicial" type="button" data-placement="bottom" title="Vista Inicial" onclick="extensao_total()"><span class="glyphicon glyphicon-globe"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Mover Mapa" onclick="arrastar_mapa()"><span class="glyphicon glyphicon-hand-up"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Aproximar Mapa" onclick="aproximar_map()"><span class="glyphicon glyphicon-zoom-in"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Afastar Mapa" onclick="afastar_map()"><span class="glyphicon glyphicon-zoom-out"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Obter Informações" onclick="obter_informacoes()"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Imprimir Planta de Localização" onclick="imprimir_plantas()"><span class="glyphicon glyphicon-print"></span>&nbsp;</button>
                    <select class="btn btn-default form-control" data-placement="bottom" id="select_scales" style="width: 110px">
                    </select>
                    <div><span class="label label-default">Ação corrente: <span id="corrent_action"></span> </span></div>
                </div>
            </div>
            <div id="mouse_coordinates_text" class="mouse_coordinates_text">
                <p style="margin: -2px 0px 2px"><font size="1"><b>&nbsp;ETRS89 / Portugal TM06 </b></font><span id="mouse3763" class="label label-info">0 / 0</span><font size="1"><b> WGS84 </b></font><span id="mouse4326" class="label label-info">0 / 0</span><font size="1"><b> WGS84 Degrees Minutes Seconds (DMS) </b></font><span id="mouse4326_hdms" class="label label-info">0 / 0</span></p>
            </div>

        </div>
    </div>
    <div class="row" id="button">

    </div>
</div><!-- /.container-fluid -->
<div id="search_div" hidden></div>
<div id="streetview_div" title="Google StreetView"></div>
<div id="formularios_div" title=""></div>
