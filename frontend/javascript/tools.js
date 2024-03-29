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
//var style_draw = [new ol.style.Style({
//        fill: new ol.style.Fill({
//            color: $("#color").val()
//        }),
//        stroke: new ol.style.Stroke({
//            color: $("#outline_color").val(),
//            width: $("#outline_size").val()
//        })
//    })];

//
//map.addLayer(
//        new ol.layer.Tile({
//            title: 'OpenStreetMap',
//            name: 'OpenStreetMap',
//            layer: 'osm',
//            visible: 1,
//            show_toc: 1,
//            opacity: 1,
//            source: new ol.source.WMTS({
//                url: 'http://vps207957.ovh.net/mapproxy',
//                layer: 'osm',
//                matrixSet: 'EPSG:3763',
//                format: 'image/png',
//                projection: 'EPSG:3763',
//            })
//        })
//        );

var layerSwitcher = new ol.control.LayerSwitcher({
    tipLabel: 'Temas Base'
});
map.addControl(layerSwitcher);

$("#select_scales").change(function () {
    map.getView().setResolution(getResolutionFromScale($("#select_scales").val(), 'm'));
});
map.getView().on('propertychange', function (e) {
    switch (e.key) {
        case 'resolution':
            var escala_int = Math.round(getScaleFromResolution(map.getView().getResolution(), 'm'));
            $("#select_scales").val(escala_int);

            break;
    }
});
map.on("Zoom", function () {
    console.log('Zooming...');
});
$("#sidebar-hide-btn").click(function () {
    $('#panel').hide();
    $("#map_panel").removeClass();
    $("#map_panel").addClass("col-md-12");
    if (!$('#sidebar-show-btn').length)
    {
        $("<button class='btn btn-info' type='button' data-placement='bottom' title='Mostrar painel' onclick='show_slider()' id='sidebar-show-btn'><span class='glyphicon glyphicon-chevron-right'></span></button>").insertBefore("#btn_vista_inicial");
    }
    map.updateSize();
});
function show_slider() {
    $('#panel').show();
    $("#map_panel").removeClass();
    $("#map_panel").addClass("col-md-9");
    $("#sidebar-show-btn").remove();
    map.updateSize();
}
;
/**
 * 
 * @param {type} $
 * @returns {undefined}
 */

$("#corrent_action").text("Mover Mapa");
(function ($) {
    $.QueryString = (function (a) {
        if (a == "")
            return {};
        var b = {};
        for (var i = 0; i < a.length; ++i)
        {
            var p = a[i].split('=');
            if (p.length != 2)
                continue;
            b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
        }
        return b;
    })(window.location.search.substr(1).split('&'))
})(jQuery);
/**
 * 
 * @description Adicionar Control ScaleLine
 */
map.addControl(new ol.control.ScaleLine({className: 'ol-scale-line'}));
/**
 * 
 * @description Adicionar Control FullScreen
 */
//map.addControl(new ol.control.FullScreen());
/**
 * 
 * @description Adicionar Control Overview
 */
map.addControl(new ol.control.OverviewMap({className: 'ol-overviewmap ol-custom-overviewmap'}));
/**
 * 
 * @description Adicionar Control Rotate
 */
map.addControl(new ol.control.Rotate());
/**
 * 
 * @description Adicionar control ZoomSlider
 */
//map.addControl(new ol.control.ZoomSlider());
/**
 * 
 * @description Adicionar Control MousePosition
 */
map.on('pointermove', function (event) {
    var coord3763 = event.coordinate;
    var coord4326 = ol.proj.transform(coord3763, 'EPSG:3763', 'EPSG:4326');
    $('#mouse3763').text(ol.coordinate.toStringXY(coord3763, 4));
    $('#mouse4326').text(ol.coordinate.toStringXY(coord4326, 4));
    $('#mouse4326_hdms').text(ol.coordinate.toStringHDMS(ol.proj.transform(coord3763, 'EPSG:3763', 'EPSG:4326')));
});

/**
 * 
 * @type ol.interaction.DragBox
 */


function change_active_option() {
    show_slider();
    if (!$('options').hasClass('active')) {
        $('#options_list li').removeClass('active');
        $('#content_spinner div').removeClass('active');
        $("#option_list").addClass("active");
        $("#options").addClass("active");
    }
}

function extensao_total() {
    map.getView().fitExtent(view_extent, map.getSize());
}

function arrastar_mapa() {
    map.removeInteraction(boundingBox_in);
    map.removeInteraction(boundingBox_out);
    map.removeInteraction(draw);
    map.removeInteraction(drawmeasure);
    //map.addInteraction(new ol.interaction.DragPan());
//    map.addInteraction(new ol.interaction.DragPan({
//        kinetic: new ol.Kinetic(-0.01, 0.1, 200)
//    }));
    $("#corrent_action").text("Mover Mapa");
}
//Make sure your bounding box interaction variable is global
var boundingBox_in;
var boundingBox_out;
//Place this after your map is instantiated
boundingBox_in = new ol.interaction.DragBox({
    condition: ol.events.condition.always,
    style: new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: [0, 0, 255, 1]
        })
    })
});
//Place this after your map is instantiated
boundingBox_out = new ol.interaction.DragBox({
    condition: ol.events.condition.always,
    style: new ol.style.Style({
        stroke: new ol.style.Stroke({
            color: [0, 0, 255, 1]
        })
    })
});
function aproximar_map() {
    map.addInteraction(boundingBox_in);
    boundingBox_in.on('boxend', function ()
    {
        var extent = boundingBox_in.getGeometry().getExtent();
        map.getView().fitExtent(extent, map.getSize());
    });
    $("#corrent_action").text("Aproximar Mapa");
}

function afastar_map() {
    map.addInteraction(boundingBox_out);
    boundingBox_out.on('boxend', function ()
    {
        //map.getView().setResolution(map.getView().getResolution() * 3);

        var extent = boundingBox_out.getGeometry().getExtent();
        map.getView().setCenter(extent);
        var zoom_state = map.getView().getZoom();
        map.getView().setZoom(zoom_state - 2)

    });
    $("#corrent_action").text("Afastar Mapa");
}

function vista_anterior() {
    var resolution = map.getView().getResolution();
    var scale = getScaleFromResolution(resolution, 'm');
    alert('Escala: ' + scale);
    var resolution_receive = getResolutionFromScale(scale, 'm');
    alert('Resolução: ' + resolution_receive);
    $("#corrent_action").text("Vista Anterior");
}

function vista_seguinte() {

    $("#corrent_action").text("Vista Seguinte");
}

function obter_informacoes() {
    $("#options").load("../tools/_getinfoform.php");
    change_active_option();
    $("#corrent_action").text("Obter Informações");
}

function change_password() {
    $("#options").load("../tools/_changepasswordform.php");
    change_active_option();
}

function formulario(id) {
    $("#formularios_div").attr("title", "Formulários");
    $("#formularios_div").load('../views/forms/formularios.php?form=' + id + '');
//    $("#formularios_div").html('<iframe src="../views/forms/formularios.php?form=' + id + '" style="width:100%; height:100%; position:relative; border:none"></iframe>');
    $("#formularios_div").dialog({width: 800, height: 500});

}
function bookmarks() {
    $("#options").load("../tools/_bookmarkform.php", {"page": $.QueryString["page"]});
    change_active_option();
}

function gerir_estilos() {
    $("#options").load("../tools/_stylesform.php");
    change_active_option();
}

//global variable
var drawLayer;
var draw;
function add_drawLayer() {
    drawLayer = new ol.layer.Vector({
        source: new ol.source.Vector(),
        style: new ol.style.Style({
            fill: new ol.style.Fill({
                color: $("#color").val()
            }),
            stroke: new ol.style.Stroke({
                color: $("#outline_color").val(),
                width: $("#outline_size").val()
            }),
            image: new ol.style.Circle({
                radius: 7,
                fill: new ol.style.Fill({
                    color: $("#color").val()
                })
            })
        })
//        style: new ol.style.Style({
//            fill: new ol.style.Fill({
//                color: 'rgba(255, 255, 255, 0.2)'
//            }),
//            stroke: new ol.style.Stroke({
//                color: '#ffcc33',
//                width: 2
//            }),
//            image: new ol.style.Circle({
//                radius: 7,
//                fill: new ol.style.Fill({
//                    color: '#ffcc33'
//                })
//            })
//        })
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
    if ($("#color").val() === '' || $("#color").length === 0) {
        $("#options").load("../tools/_stylesform.php");
        change_active_option();
    }

    if (drawLayer == null) {
        add_drawLayer()
    }
    if (draw != null) {
        cancelDraw();
    }
    if (drawmeasure) {
        map.removeInteraction(drawmeasure);
    }

}
function desenhar_ponto() {
    init_draw();
    start_draw("Point");
    $("#corrent_action").text("Desenhar Ponto");
}

function desenhar_linha() {
    init_draw();
    start_draw("LineString");
    $("#corrent_action").text("Desenhar Linha");
}

function desenhar_poligono() {
    init_draw();
    start_draw("Polygon");
    $("#corrent_action").text("Desenhar Polígono");
}

function desenhar_circulo() {
    init_draw();
    start_draw("Circle");
    $("#corrent_action").text("Desenhar Círculo");
}

function escrever_anotacoes() {
    $("#options").load("../tools/_anotationsform.php");
    change_active_option();
    $("#corrent_action").text("Escrever Anotações");
}

function apagar_desenhos() {
    var clear_vector = confirm("Deseja apagar os desenhos no mapa?");
    if (clear_vector === true)
    {
        drawLayer.getSource().clear();
    }
    map.removeInteraction(draw);
}

function clear_results_search() {
    var clear_vector = confirm("Deseja apagar do mapa o(s) resultado(s) da pesquisa?");
    if (clear_vector === true)
    {
        search_vector_result.getSource().clear();
    }
}
function user_layers() {
    $("#options").load("../tools/_userlayersform.php");
    change_active_option();
}
function add_shp() {
    $("#options").load("../tools/_addshapefileform.php");
    change_active_option();
}

function add_wms() {
    $("#options").load("../tools/_addwmsform.php");
    change_active_option();
}

function add_wfs() {
    $("#options").load("../tools/_addwfsform.php");
    change_active_option();
}

function add_kml() {
    $("#options").load("../tools/_addkmlform.php");
    change_active_option();
}

function confrontacao_espacial() {
    $("#options").load("../tools/_confrontacaoform.php", {"page": $.QueryString["page"]});
    change_active_option();
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

function start_measure() {
    if (draw) {
        map.removeInteraction(draw);
    }
    if (drawmeasure) {
        map.removeInteraction(drawmeasure);
    }
}
function calcular_distancias() {
    create_measure_variable()
    start_measure();
    addInteraction('LineString');
    $("#corrent_action").text("Calcular Distâncias");
}

function calcular_areas() {
    create_measure_variable()
    start_measure();
    addInteraction('Polygon');
    $("#corrent_action").text("Calcular Áreas");
}

function imprimir_plantas() {
    $("#options").load("../tools/_printform.php", {"page": $.QueryString["page"]});
    change_active_option();
}

function obter_coordenadas() {
    $("#options").load("../tools/_getcoordinatesfom.php");
    change_active_option();
}

function locate_coordinates() {
    $("#options").load("../tools/_locatecoordinatesform.php");
    change_active_option();
}

function edit_geo() {
    $("#options").load("../tools/_editform.php", {"page": $.QueryString["page"]});
    change_active_option();
}

function streetview() {

    var click_street_view = map.on('click', function (evt) {
        var lonlat = ol.proj.transform([evt.coordinate[0], evt.coordinate[1]], 'EPSG:3763', 'EPSG:4326');
        $("#streetview_div").html('<iframe src="../views/viewer/streetview.php?long=' + lonlat[0] + '&lat=' + lonlat[1] + '" style="width:100%; height:100%; position:relative; border:none"></iframe>');
        $("#streetview_div").dialog({width: 800, height: 500});
        map.unByKey(click_street_view);
    });

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
    window.open("../manuais/utilizador");
}

function report_problems() {
    $("#options").load("../tools/_reportform.php");
    change_active_option();
}

function about_app() {
    $("#options").load("../tools/_aboutform.php");
    change_active_option();
}

function opacity_form() {
    $("#options").load("../tools/_opacityform.php");
    change_active_option();
}

INCHES_PER_UNIT = {
    'inches': 1.0,
    'ft': 12.0,
    'mi': 63360.0,
    'm': 39.37,
    'km': 39370,
    'dd': 4374754,
    'yd': 36
};
var DOTS_PER_INCH = 72;
function getScaleFromResolution(resolution, units) {
    if (units == null) {
        units = "m";
    }
    var scale = resolution * INCHES_PER_UNIT[units] * DOTS_PER_INCH;
    return scale;
}

function getResolutionFromScale(scale, units) {
    var normScale = (scale > 1.0) ? (1.0 / scale) : scale;
    if (units == null) {
        units = "m";
    }
    var resolution = 1 / (normScale * INCHES_PER_UNIT[units] * DOTS_PER_INCH);
    return resolution;
}

var construnct_legend = jQuery.grep(map.getLayers().getArray(), function (single_layers) {
//    if (layer.getLayers) {
//        var layers = jQuery.grep(layer.getLayers().getArray(), function (single_layers) {
    if (typeof single_layers.get('name') !== "undefined") {
        var url = single_layers.getSource().getUrl() + "?TRANSPARENT=true&SERVICE=WMS&VERSION=1.1.1&REQUEST=GetLegendGraphic&EXCEPTIONS=application%2Fvnd.ogc.se_xml&FORMAT=image%2Fjpeg&LAYER=" + single_layers.get('layer') + "&LEGEND_OPTIONS=forceLabels%3Aon%3BfontName%3DVerdana%3BfontSize%3A12";
        $("#legend").append('<b>' + single_layers.get('name') + '</b><p><img src="' + url + '" title="' + single_layers.get('name') + '"/></p>');
    }
//        });
//    }
});


/**
 * Registar Ocorrência
 */
function add_sugestao() {
    $("#modal_sugestoes").load("../tools/_sugestionsform.php");
//    change_active_option();
//    map.unByKey(single_click);
    var mapVectorSource = new ol.source.Vector({
        features: []
    });

    var mapVectorLayer = new ol.layer.Vector({
        source: mapVectorSource
    });
    map.addLayer(mapVectorLayer);

    var key = map.on('click', function (evt) {
        var coordinate = evt.coordinate;

        mapVectorLayer.getSource().clear();
        var iconStyle = new ol.style.Style({
            image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                anchor: [0.5, 1],
                anchorXUnits: 'fraction',
                anchorYUnits: 'fraction',
                src: 'http://localhost/websig/imagens/icon.png',
            }))
        });
        var iconFeature = new ol.Feature({
            geometry: new ol.geom.Point(coordinate)
        });

        iconFeature.setStyle(iconStyle);
        mapVectorSource.addFeature(iconFeature);
        var hdms = 'POINT(' + coordinate[0] + ' ' + coordinate[1] + ')';
        $("#ocorrencias_coordinates").val(hdms);

        $('#add_registo').modal('show');
    });
}

var arr = [], data_tree_collection = [];
$.each(data_tree, function (index, value) {
    if ($.inArray(value.id, arr) == -1) {
        arr.push(value.id);
        data_tree_collection.push(value);
    }
});

$('#layer_tree').jstree({
    "checkbox": {
        "tie_selection": false,
        "keep_selected_style": false
    },
    "plugins": ["search", "dnd", "wholerow", "checkbox"], 'core': {
        "check_callback": false,
        "multiple": true,
        "themes": {
            "icons": true
        },
        'data': data_tree_collection
    }});

var to = false;
$('#tree_search').keyup(function () {
    if (to) {
        clearTimeout(to);
    }
    to = setTimeout(function () {
        var v = $('#tree_search').val();
        $('#layer_tree').jstree(true).search(v);
    }, 250);
});

$('#layer_tree').bind("check_node.jstree", function (e, data) {
    var array = data.instance.get_bottom_checked(data);
    for (k = 0; k < array.length; k++) {
        var id_layer = array[k].li_attr.layer;
        map.getLayers().forEach(function (lyr) {
            if (id_layer === lyr.get('layer')) {
                lyr.setVisible(true);
            }
        });
    }
});

$('#layer_tree').bind("uncheck_node.jstree", function (e, data) {
    var layer_unchecked = data.node.li_attr.layer;
    map.getLayers().forEach(function (lyr) {
        if (layer_unchecked === lyr.get('layer')) {
            lyr.setVisible(false);
        }
    });

});

$("#layer_tree").bind("hover_node.jstree", function (e, data)
{
    if (data.node.li_attr.layer) {
        var text = data.node.li_attr.layer;
        var lagend_url = data.node.li_attr.legend_url;
        var image = lagend_url + "/wms?TRANSPARENT=true&SERVICE=WMS&VERSION=1.1.1&REQUEST=GetLegendGraphic&EXCEPTIONS=application%2Fvnd.ogc.se_xml&FORMAT=image%2Fjpeg&LAYER=" + text + "&LEGEND_OPTIONS=forceLabels%3Aon%3BfontName%3DVerdana%3BfontSize%3A12";
        $("#" + data.node.li_attr.id).tooltipster({
            theme: 'tooltipster-shadow',
            content: $('<img src="' + image + '">')
        });
    }
});