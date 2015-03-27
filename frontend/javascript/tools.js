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

var measureLayer;
var drawmeasure;
var source_measure = new ol.source.Vector();
/**
 * Currently drawn feature.
 * @type {ol.Feature}
 */
var sketch;

/**
 * The help tooltip element.
 * @type {Element}
 */
var helpTooltipElement;

/**
 * Overlay to show the help messages.
 * @type {ol.Overlay}
 */
var helpTooltip;

/**
 * The measure tooltip element.
 * @type {Element}
 */
var measureTooltipElement;

/**
 * Overlay to show the measurement.
 * @type {ol.Overlay}
 */
var measureTooltip;

/**
 * Message to show when the user is drawing a polygon.
 * @type {string}
 */
var continuePolygonMsg = 'Click para continuar a desenhar o polígono';

/**
 * Message to show when the user is drawing a line.
 * @type {string}
 */
var continueLineMsg = 'Click para continuar a desenhar a linha';

function create_measure_variable() {
    measureLayer = new ol.layer.Vector({
        source: source_measure,
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

    map.addLayer(measureLayer);
}

/**
 * Handle pointer move.
 * @param {ol.MapBrowserEvent} evt
 */
var pointerMoveHandler = function (evt) {
    if (evt.dragging) {
        return;
    }
    /** @type {string} */
    var helpMsg = 'Click para começar a desenhar';
    /** @type {ol.Coordinate|undefined} */
    var tooltipCoord = evt.coordinate;

    if (sketch) {
        var output;
        var geom = (sketch.getGeometry());
        if (geom instanceof ol.geom.Polygon) {
            output = formatArea(/** @type {ol.geom.Polygon} */ (geom));
            helpMsg = continuePolygonMsg;
            tooltipCoord = geom.getInteriorPoint().getCoordinates();
        } else if (geom instanceof ol.geom.LineString) {
            output = formatLength(/** @type {ol.geom.LineString} */ (geom));
            helpMsg = continueLineMsg;
            tooltipCoord = geom.getLastCoordinate();
        }
        measureTooltipElement.innerHTML = output;
        measureTooltip.setPosition(tooltipCoord);
    }

    helpTooltipElement.innerHTML = helpMsg;
    helpTooltip.setPosition(evt.coordinate);
};

function addInteraction(type) {
    map.on('pointermove', pointerMoveHandler);
    drawmeasure = new ol.interaction.Draw({
        source: source_measure,
        type: /** @type {ol.geom.GeometryType} */ (type),
        style: new ol.style.Style({
            fill: new ol.style.Fill({
                color: 'rgba(255, 255, 255, 0.2)'
            }),
            stroke: new ol.style.Stroke({
                color: 'rgba(0, 0, 0, 0.5)',
                lineDash: [10, 10],
                width: 2
            }),
            image: new ol.style.Circle({
                radius: 5,
                stroke: new ol.style.Stroke({
                    color: 'rgba(0, 0, 0, 0.7)'
                }),
                fill: new ol.style.Fill({
                    color: 'rgba(255, 255, 255, 0.2)'
                })
            })
        })
    });
    map.addInteraction(drawmeasure);

    createMeasureTooltip();
    createHelpTooltip();

    drawmeasure.on('drawstart',
            function (evt) {
                // set sketch
                sketch = evt.feature;
            }, this);

    drawmeasure.on('drawend',
            function (evt) {
                measureTooltipElement.className = 'tooltip tooltip-static';
                measureTooltip.setOffset([0, -7]);
                // unset sketch
                sketch = null;
                // unset tooltip so that a new one can be created
                measureTooltipElement = null;
                createMeasureTooltip();
            }, this);
}


/**
 * Creates a new help tooltip
 */
function createHelpTooltip() {
    if (helpTooltipElement) {
        helpTooltipElement.parentNode.removeChild(helpTooltipElement);
    }
    helpTooltipElement = document.createElement('div');
    helpTooltipElement.className = 'tooltip';
    helpTooltip = new ol.Overlay({
        element: helpTooltipElement,
        offset: [15, 0],
        positioning: 'center-left'
    });
    map.addOverlay(helpTooltip);
}


/**
 * Creates a new measure tooltip
 */
function createMeasureTooltip() {
    if (measureTooltipElement) {
        measureTooltipElement.parentNode.removeChild(measureTooltipElement);
    }
    measureTooltipElement = document.createElement('div');
    measureTooltipElement.className = 'tooltip tooltip-measure';
    measureTooltip = new ol.Overlay({
        element: measureTooltipElement,
        offset: [0, -15],
        positioning: 'bottom-center'
    });
    map.addOverlay(measureTooltip);
}


/**
 * format length output
 * @param {ol.geom.LineString} line
 * @return {string}
 */
var formatLength = function (line) {
    var length;
//    if (geodesicCheckbox.checked) {
//        var coordinates = line.getCoordinates();
//        length = 0;
//        var sourceProj = map.getView().getProjection();
//        for (var i = 0, ii = coordinates.length - 1; i < ii; ++i) {
//            var c1 = ol.proj.transform(coordinates[i], sourceProj, 'EPSG:4326');
//            var c2 = ol.proj.transform(coordinates[i + 1], sourceProj, 'EPSG:4326');
//            length += wgs84Sphere.haversineDistance(c1, c2);
//        }
//    } else {
    length = Math.round(line.getLength() * 100) / 100;
//    }
    var output;
    if (length > 100) {
        output = (Math.round(length / 1000 * 100) / 100) +
                ' ' + 'km';
    } else {
        output = (Math.round(length * 100) / 100) +
                ' ' + 'm';
    }
    return output;
};


/**
 * format length output
 * @param {ol.geom.Polygon} polygon
 * @return {string}
 */
var formatArea = function (polygon) {
    var area;
//    if (geodesicCheckbox.checked) {
//        var sourceProj = map.getView().getProjection();
//        var geom = /** @type {ol.geom.Polygon} */(polygon.clone().transform(
//                sourceProj, 'EPSG:4326'));
//        var coordinates = geom.getLinearRing(0).getCoordinates();
//        area = Math.abs(wgs84Sphere.geodesicArea(coordinates));
//    } else {
    area = polygon.getArea();
//    }
    var output;
    if (area > 10000) {
        output = (Math.round(area / 1000000 * 100) / 100) +
                ' ' + 'km<sup>2</sup>';
    } else {
        output = (Math.round(area * 100) / 100) +
                ' ' + 'm<sup>2</sup>';
    }
    return output;
};

function remove_drawmeasure() {
    map.removeInteraction(drawmeasure);
}

function calcular_distancias() {
    create_measure_variable()
    if (drawmeasure) {
        remove_drawmeasure();
    }
    addInteraction('LineString');
}

function calcular_areas() {
    create_measure_variable()
    if (drawmeasure) {
        remove_drawmeasure();
    }
    addInteraction('Polygon');
}

function imprimir_plantas() {

}

function exportar_mapa() {
    var download = "map.png";
    map.once('postcompose', function (event) {
        var canvas = event.context.canvas;
        window.open(canvas.toDataURL('image/png'));
        //exportPNGElement.href = ;
    });
    map.renderSync();
}

function manual_utilizacao() {

}

function report_problems() {

}

function about_app() {

}