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

//ScaleLine
map.addControl(new ol.control.ScaleLine());
//Mouse Position
//map.addControl(new ol.control.MousePosition());
//FullScreen
map.addControl(new ol.control.FullScreen());
//Overview
map.addControl(new ol.control.OverviewMap({className: 'ol-overviewmap ol-custom-overviewmap'}));

var layers_legend = '';
var url_legend = '';
var construnct_legend = jQuery.grep(map.getLayers().getArray(), function (layer) {
    if (typeof layer.get('name') != "undefined") {
        var url = "http://websig.cm-ourem.pt/geoserver/wms?TRANSPARENT=true&SERVICE=WMS&VERSION=1.1.1&REQUEST=GetLegendGraphic&EXCEPTIONS=application%2Fvnd.ogc.se_xml&FORMAT=image%2Fjpeg&LAYER=" + layer.get('name') + "&LEGEND_OPTIONS=forceLabels%3Aon%3BfontName%3DVerdana%3BfontSize%3A12";
        url_legend += '<object data="' + url + '"/><br>'
    }
});
$('#legend').append(url_legend);

function extensao_total() {
    map.getView().fitExtent(map.getView().getProjection().getExtent(), map.getSize());
}

function arrastar_mapa() {

}

function aproximar_map() {

}

function afastar_map() {

}

function vista_anterior() {

}

function vista_seguinte() {

}

function obter_informacoes() {

}

function bookmarks() {

}

function gerir_estilos() {
    alert('Gerir Estilos');
}

//global variable
var drawLayer;
var draw;

function add_drawLayer() {
    drawLayer = new ol.layer.Vector({
        source: new ol.source.Vector(),
        style: new ol.style.Style({
            fill: new ol.style.Fill({
                color: 'rgba(255, 255, 255, 0.2)'
            }),
            stroke: new ol.style.Stroke({
                color: '#ffcc33',
                width: 2
            }),
            image: new ol.style.Circle({
                radius: 7,
                fill: new ol.style.Fill({
                    color: '#ffcc33'
                })
            })
        })
    });

    map.addLayer(drawLayer);
}
function cancelDraw() {
    if (draw == null)
        return;

    map.removeInteraction(draw);
}

function start_draw(type) {
    draw = new ol.interaction.Draw({
        source: drawLayer.getSource(),
        type: type
    });
    map.addInteraction(draw);
}
function init_draw() {
    if (drawLayer == null) {
        add_drawLayer()
    }
    if (draw != null) {
        cancelDraw();
    }
}
function desenhar_ponto() {
    init_draw();
    start_draw("Point");
}

function desenhar_linha() {
    init_draw();
    start_draw("LineString");
}

function desenhar_poligono() {
    init_draw();
    start_draw("Polygon");
}

function escrever_anotacoes() {

}

function apagar_desenhos() {
    var clear_vector = confirm("Deseja apagar os desenhos no mapa?");
    if (clear_vector === true)
    {
        drawLayer.getSource().clear();
    }
}

function calcular_distancias() {

}

function calcular_areas() {

}

function calcular_perimetro() {

}

function imprimir_plantas() {

}

function exportar_mapa() {

}

function manual_utilizacao() {

}

function report_problems() {

}

function about_app() {

}