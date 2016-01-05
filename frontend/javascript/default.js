/* 
 * Copyright (C) 2015 pedro
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
var data_tree = [];
function load_layers(id_layer, label, wms_layer, fields, wms_visible, srs, opacity, show_toc, server_url, type) {
    map.addLayer(
            new ol.layer.Image({
                id: id_layer,
                title: label,
                name: label,
                layer: wms_layer,
                fields: fields,
                shwo_toc: show_toc,
                opacity: opacity,
                visible: wms_visible,
                source: new ol.source.ImageWMS({
                    url: server_url + '/wms',
                    crs: srs,
                    params: {'LAYERS': wms_layer},
                    serverType: type

                })

            })
            );
}

function load_baselayers(type, id, name, layer, visible, show_toc, opacity, server_url, crs) {
    if (type === 'Mapproxy') {
        var NESource = new ol.source.XYZ({
            projection: 'EPSG:3763',
            url: server_url + '/tms/' + layer + '/{z}/{x}/{-y}.png',
        });
        map.addLayer(
                new ol.layer.Tile({
                    id: id,
                    title: name,
                    layer: layer,
                    visible: visible,
                    show_toc: show_toc,
                    opacity: opacity,
                    type: 'base',
                    source: NESource,
                    isBaseLayer: true
                })
                );
    } else {
        map.addLayer(
                new ol.layer.Image({
                    id: id,
                    title: name,
                    layer: layer,
                    shwo_toc: show_toc,
                    opacity: opacity,
                    tiled: 'yes',
                    visible: visible,
                    source: new ol.source.ImageWMS({
                        url: server_url + '/wms',
                        crs: crs,
                        params: {'LAYERS': layer},
                    })
                })
                );
    }
}


function tree_data(id, parent, text, icon, visible, server_url, layer, name) {
    if (server_url !== '') {
        data_tree.push({
            "id": id,
            "parent": parent,
            "icon": icon,
            "text": text,
            "state": {"checked": visible, "selected": visible},
            "li_attr": {"legend_url": server_url, "layer": layer, "title": name}
        });
    } else {
        data_tree.push({
            "id": id,
            "parent": parent,
            "icon": icon,
            "text": text,
            "state": {"checked": visible}
        });
    }

}

function load_tabs_default(name, code) {
    $('#top_tabs').append('<li title="' + name + '"><a href="#' + code + '" data-toggle="tab">' + name + '</a></li>');
    $('#content_tabs').append('<div id="' + code + '" class="tab-pane btn-group"></div>');
}

function load_tools_default(tab_code, code, description, icon, name) {
    $('#' + tab_code).append('<button type="button" onclick="' + code + '()" title="' + description + '" class="btn btn-default btn-default-menu bt_size"> <span class="glyphicon" style="background-image:url(../images/' + icon + ');background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p >' + name + '</p></button>');
}

function session_default(username) {
    $('#top_tabs').append('<li title="Ferramentas de Login/Gestão do Utilizador"><a href="#utilizador_tools" data-toggle="tab" id="tab_user">Utilizador: ' + username + '</a></li>');
    $('#content_tabs').append('<div id="utilizador_tools" class="tab-pane btn-group"></div>');
    $('#utilizador_tools').html('<button type="button" title="Alterar password"  data-toggle="modal" onclick="change_password()" class="btn btn-default bt_size"> <span class="glyphicon glyphicon-user"/><p>Alterar Password</p></button>');
    $('#utilizador_tools').append('<button type="button" title="Terminar sessão" onclick="document.location.href=&#39;../views/viewer/logout.php&#39;" class="btn btn-default bt_size"> <span class="glyphicon glyphicon-user"/><p>Terminar Sessão</p></button>');
}


function load_tabs_mobile(name, code) {
    if (name === 'Pesquisas') {
        $("#top_tabs").append('<li id="top_tab_' + code + '"  class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">' + name + '<span class="caret"></span></a><ul id="search_ul" class="dropdown-menu" ><li id="divider_search" role="presentation" class="divider"></li><li role="presentation"><a style="font-size: 12px" role="menuitem" tabindex="-1" href="javascript:clear_results_search()" >Apagar Resultados</a></li></ul></li>');
    } else {
        $('#top_tabs').append('<li id="top_tab_' + code + '" class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">' + name + '<span class="caret"></span></a><ul id="tab_' + code + '" class="dropdown-menu"></ul></li>');
    }
}

function load_tools_mobile(layout_id, funcao, description, icon, name) {
    if (name === 'Pesquisas') {
        $("#tab_" + layout_id).append('<div style="display:inline;" class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" id="pesquisas"  title="' + description + '" data-toggle="dropdown"><span class="glyphicon" style="background-image:url(imagens/' + icon + ');background-repeat:no-repeat;background-position:center;width:20px;height:20px;"aria-hidden="true"></span><span class="caret"></span></button><ul id="search_ul" class="dropdown-menu" role="menu" aria-labelledby="menu1"></ul></div>');
    } else {
        $("#tab_" + layout_id).append("<li><a href='javascript:" + funcao + "'  tabindex='-1' style='font-size: 12px;'><span class='glyphicon' style='background-image:url(imagens/simple/" + icon + ");background-repeat:no-repeat;background-position:center;width:12px;height:12px;'aria-hidden='true'></span>  " + description + "</a></li>");
    }
}

function session_mobile(username) {
    $('#top_tabs').append('<li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button">Utilizador: ' + username + '<span class="caret"></span></a> <ul id="utilizador_tools" class="dropdown-menu"></ul></li>');
    $('#utilizador_tools').append("<li><a href='javascript:change_password()'  tabindex='-1' style='font-size: 12px;'>Alterar Password</a></li>");
    $('#utilizador_tools').append("<li><a href='javascript:document.location.href = &#39; ../views/viewer/logout.php &#39;'  tabindex='-1' style='font-size: 12px;'>Terminar sessão</a></li>");
}