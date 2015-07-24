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
    <label for="edit_layers">Layer para Edição:</label>
    <select name="edit_layers" id="edit_layers" class="form-control">
        <option value="-" class="all_layers">-</option>
        <option value="contentores">Contentores Superficiais</option>
        <!--        <option value="geoserver" class="all_layers">GeoServer</option>
                <option value="mapserver" class="all_layers">MapServer</option>
                <option value="qgis" class="all_layers">QGIS Server</option>
                <option value="arcgis" class="all_layers">ArcGIS Server</option>-->
    </select>
    <hr>
    <div style="text-align: center">
        <div class="btn-group" role="group" id="btn_group_operations_edit" >
            <button class="btn btn-default" id="pan" type="button"  data-placement="bottom" title="Mover" ><span class="glyphicon glyphicon-hand-up"></span>&nbsp;</button>
            <button class="btn btn-default" id="select" type="button" data-placement="bottom" title="Selecionar Elemento" ><span class="glyphicon glyphicon-unchecked"></span>&nbsp;</button>
            <button class="btn btn-default" id="new" type="button" data-placement="bottom" title="Novo Elemento" ><span class="glyphicon glyphicon-edit"></span>&nbsp;</button>
            <button class="btn btn-default" id="modify" type="button" data-placement="bottom" title="Editar Elemento" ><span class="glyphicon glyphicon-move"></span>&nbsp;</button>
            <button class="btn btn-default" id="delete" type="button" data-placement="bottom" title="Apagar Elemento" ><span class="glyphicon glyphicon-trash"></span>&nbsp;</button>
            <button class="btn btn-default" id="table" type="button" data-placement="bottom" title="Abrir Tabela" ><span class="glyphicon glyphicon-folder-open"></span>&nbsp;</button>
            <button class="btn btn-default" id="save" type="button" data-placement="bottom" title="Guardar Alterações" ><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;</button>
        </div>
    </div>
    <div id="edit_select_info"></div>
    <div id="table_info_update" style="display:none"></div>
</div>

<script>

    $('#btn_group_operations_edit').find('*').prop('disabled', true);

    var extent = map.getView().calculateExtent(map.getSize());
    var geojsonFormat = new ol.format.GeoJSON();
    var selectedFeatureID;
    var vectorSourceJsonp = new ol.source.Vector({
        strategy: ol.loadingstrategy.createTile(new ol.tilegrid.XYZ({
            maxZoom: 10
        })),
        projection: view_projection
    });
    var vectorLayerJsonp = new ol.layer.Vector(
            {
                name: 'Tema para edição',
                title: 'Tema para edição',
                source: vectorSourceJsonp,
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
    $("#edit_layers").change(function () {
        $.ajax('http://192.168.1.5:8080/geoserver/wfs', {
            type: 'GET',
            data: {
                service: 'WFS',
                version: '1.1.0',
                request: 'GetFeature',
                typename: 'topp:' + $("#edit_layers").val(),
                srsname: view_projection,
                outputFormat: 'text/javascript',
                bbox: extent.join(','),
            },
            dataType: 'jsonp',
            jsonpCallback: 'callback:loadFeatures',
            jsonp: 'format_options'
        });

        /**
         * JSONP WFS callback function.
         * @param {Object} response The response object.
         */
        window.loadFeatures = function (response) {
            vectorSourceJsonp.addFeatures(geojsonFormat.readFeatures(response));
        };
        map.addLayer(vectorLayerJsonp);
        $('#btn_group_operations_edit').find('*').removeProp('disabled');

    });

    var button = $('#pan').button('toggle');
    var interaction;
    $('#btn_group_operations_edit').on('click', function (event) {
        var id = event.target.id;

        // Toggle buttons
        button.button('toggle');
        button = $('#' + id).button('toggle');
        // Remove previous interaction
        map.removeInteraction(interaction);
        // Update active interaction
        switch (event.target.id) {
            case "select":
                interaction = new ol.interaction.Select();
                map.addInteraction(interaction);
                interaction.getFeatures().on('add', function (event) {
//                    var properties = event.element.getProperties();
                    selectedFeatureID = event.element.getId();
//                    properties.id;
                });
                break;
            case "table":
                var features = vectorLayerJsonp.getSource().getFeatures();
                if (features !== null && features.length > 0) {
                    for (x in features) {
                        if (features[x].getId() === selectedFeatureID) {
                            $('#edit_select_info').html('<hr><table id="table_info_edit" style="width:100%" class="table table-condensed table-hover" data-click-to-select="true"><thead><tr><th style="text-align: center;" data-align="center">Campo</th> <th style="text-align: center;" data-align="center">Valor</th></tr></thead><tbody></tbody></table>');
                            $('#edit_select_info').append('<div style="text-align: right"><div class="btn-group" role="group"><button type="button" class="btn btn-default" data-placement="bottom" title="Ver elemento no mapa" >Ver no mapa</button><button type="button" class="btn btn-default" data-placement="bottom" title="Editar Informações" >Editar Informação</button></div></div>');
                            features[x].setProperties({designacao: 'Isto dá cabo da mona mas é fixe!!'});

                            console.log(features[x].get('designacao'));
                            jQuery.each(features[x].getProperties(), function (index, item) {
                                if (index !== 'geometry') {
                                    $('#table_info_edit').append('<tr><td style="vertical-align: middle" width="30%"><b>' + index + '</b></td> <td style="vertical-align: middle" width="70%">' + item + '</td>');
                                    $('#table_info_update').append('<div class="form-group"><label for="' + index + '">' + index.toUpperCase() + ':</label><input type="text" class="form-control" id="' + index + '" value="' + item + '"></div>');
                                    
                                }
                            });
//                            for (y in properties) {
//                                console.log('Campo: ' + properties[y].keys() + ' | Valor: ' + properties[y]);
//                            }
                        }

                    }
                }
                break;
            case "delete":
                var features = vectorLayerJsonp.getSource().getFeatures();
                if (features !== null && features.length > 0) {
                    for (x in features) {
//                        var properties = features[x].getProperties();
//                        console.log(properties);
                        var id = features[x].getId();
                        if (id === selectedFeatureID) {
                            vectorLayerJsonp.getSource().removeFeature(features[x]);
                        }
                    }
                }
                break;
            case "new":
                interaction = new ol.interaction.Draw({
                    type: vectorLayerJsonp.getSource().getFeatures()[0].getGeometry().getType(),
                    source: vectorLayerJsonp.getSource()
                });
                map.addInteraction(interaction);
                break;
            case "modify":
                interaction = new ol.interaction.Modify({
                    features: new ol.Collection(vectorLayerJsonp.getSource().getFeatures())
                });
                map.addInteraction(interaction);
                break;
            default:
                break;
        }
    });
</script>