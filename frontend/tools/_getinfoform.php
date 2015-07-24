<?php
/*
 * Copyright (C) 2015 cm0721
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

<div>
    <div id="init_identify_div">
        <label for="info_list_layers">Layers:</label>
        <select name="info_list_layers" id="info_list_layers" class="form-control">
            <!--<option value="all_layers" class="all_layers">   Todas as Layers</option>-->
        </select>
        <hr>
        <button type="button" class="btn btn-info" style="float:right" name="identificar" id="identificar" title="Obter Informações!">Obter Informações</button>
    </div>
    <div id="indentify_result_div" style="display:none">
        <Select id="result_selector" class="form-control">
        </Select>
        <div id="identify_result">

        </div>
        <hr>
        <button type="button" class="btn btn-info" onclick="obter_informacoes()" title="Voltar!">Voltar</button>
    </div>
</div>

<script>
    map.getLayers().forEach(function (lyr) {
        if (lyr.get('show_layer') !== false) {
            if (lyr instanceof ol.layer.Group) {
                lyr.getLayers().forEach(function (lyr_group) {
                    $('#info_list_layers').append('<option fields="' + lyr_group.get('fields') + '" value="' + lyr_group.get('layer') + '">' + lyr_group.get('name') + '</option>');
                });
            } else {
                $('#info_list_layers').append('<option fields="' + lyr_group.get('fields') + '" value="' + lyr.get('layer') + '">' + lyr.get('name') + '</option>');
            }
        }
    });
    var count = 0;
    var geojson_identify_Format = new ol.format.GeoJSON();
    if (vector_layer_identify) {
        vector_layer_identify.getSource().clear();
    } else {
        var vector_source_identify = new ol.source.Vector({
            projection: view_projection
        });
        var vector_layer_identify = new ol.layer.Vector(
                {
                    name: 'Resultado da Identificação',
                    title: 'Resultado da Identificação',
                    show_layer: false,
                    source: vector_source_identify,
                    style: new ol.style.Style({
                        fill: new ol.style.Fill({
                            color: 'rgba(255, 255, 255, 0.2)'
                        }),
                        stroke: new ol.style.Stroke({
                            color: '#ffcc33',
                            width: 10
                        }),
                        image: new ol.style.Circle({
                            radius: 7,
                            fill: new ol.style.Fill({
                                color: '#ffcc33'
                            })
                        })
                    })

                });
        map.addLayer(vector_layer_identify);
    }

    $('#result_selector').change(function () {
        $('.identify_results').hide();
        $('#' + $(this).val()).show();
    });

    $("#identificar").on("click", function () {
        map.on('singleclick', function (evt) {
            var coord = evt.coordinate;
            spawnPopup(coord);
        });
        function spawnPopup(coord) {
            var layer_select = $("#info_list_layers").val();

            var field_string = $('#info_list_layers option:selected').attr('fields');
            var field_array = new Array();

            var pixel = map.getPixelFromCoordinate(coord);
            var size = map.getSize();
            var info_layer_select = "";
            if (layer_select === 'all_layers') {
                $("#info_list_layers option").map(function () {
                    if ($(this).val() !== 'all_layers') {
                        info_layer_select += $(this).val() + ",";
                    }
                }).get();
                info_layer_select = info_layer_select.slice(0, -1)
            } else {
                info_layer_select = layer_select;
            }
            var url = "http://sigserver:8080/geoserver/wms?"
                    + "&LAYERS=" + info_layer_select
                    + "&QUERY_LAYERS=" + info_layer_select
                    + "&SERVICE=WMS"
                    + "&VERSION=1.3.0"
                    + "&feature_count=10"
                    + "&REQUEST=GetFeatureInfo"
                    + "&BBOX=" + map.getView().calculateExtent(map.getSize())
                    + "&WIDTH=" + size[0]
                    + "&HEIGHT=" + size[1]
                    + "&FORMAT=image/png"
                    + "&INFO_FORMAT=application/json"
                    + "&SRS=" + view_projection
                    + "&X=" + parseInt(pixel[0])
                    + "&Y=" + parseInt(pixel[1]);
            if (url) {
                $('#result_selector').html('');
                $('#identify_result').html('');
                vector_source_identify.clear();
                $.getJSON(url, function (info_json) {
                    vector_source_identify.addFeatures(geojson_identify_Format.readFeatures(info_json));
                    var features = vector_source_identify.getFeatures();
                    if (features !== null && features.length > 0) {
                        $("#init_identify_div").hide();
                        $("#indentify_result_div").show();
                        for (x in features) {
                            $('#identify_result').append('<div id="div_identify_results_' + x + '" class="identify_results" style="display:none"><table id="table_identify_result_' + x + '" style="width:100%" class="table table-condensed table-hover" data-click-to-select="true"><thead><tr><th style="text-align: center;" data-align="center">Campo</th> <th style="text-align: center;" data-align="center">Valor</th></tr></thead><tbody></tbody></table></div>');

                            field_array = field_string.split(',');

                            $('#result_selector').append('<option value="div_identify_results_' + x + '">' + features[x].get(field_array[0]) + '</option>');

                            for (value in field_array) {
                                $('#table_identify_result_' + x).append('<tr><td style="vertical-align: middle" width="30%"><b>' + field_array[value] + '</b></td> <td style="vertical-align: middle" width="70%">' + features[x].get(field_array[value]) + '</td>');
                            }

                        }
                        $('.identify_results:first').show();

//                        console.log(info_json);
                    } else {
                        $('#identify_result').html('<p class="label label-info">Não foram encontrados resultados!</p>');
                    }

                })
            } else {
                console.log("Uh Oh, Algum problema ocorreu!.");
            }

        }
    });
</script>