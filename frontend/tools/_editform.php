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

include __DIR__ . '/../views/connections.php';
$result_edit_layers = $connection->query('SELECT * FROM geographic_edit WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');
?>

<div>
    <label for="edit_layers">Layer para Edição:</label>
    <select name="edit_layers" id="edit_layers" class="form-control">
        <option value="-" class="all_layers">-</option>
        <?php
        while ($row_edit_layers = $result_edit_layers->fetchArray(SQLITE3_ASSOC)) {
            $load_server = $connection->query('SELECT url FROM param_server WHERE id =' . $row_edit_layers['serverType'] . ' LIMIT 1');
            if ($server = $load_server->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <option fns="<?php echo $row_edit_layers['featureNS'] ?>" server="<?php echo $server['url'] ?>" value="<?php echo $row_edit_layers['layer'] ?>"><?php echo $row_edit_layers['name'] ?></option>
                <?php
            }
        }
        ?>
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
    <div id="edit_layers_view">
        <div id="edit_select_info"></div>
        <hr>
        <div style="text-align: right"><div class="btn-group" role="group">
                <!--<button type="button" class="btn btn-default" data-placement="bottom" title="Ver elemento no mapa" >Ver no mapa</button>-->
                <button type="button" id="change_to_edit" class="btn btn-default" data-placement="bottom" title="Editar Informações" >Editar Informação</button>
            </div>
        </div>
    </div>
    <div id="edit_layers_update" style="display:none">
        <div id="table_info_update"></div>
        <hr>
        <button class="btn btn-success" style="float: right;" id="save_properties" type="button" title="Aplicar Alterações">Aplicar Alterações</button>
    </div>

</div>

<script>
    var extent = map.getView().calculateExtent(map.getSize());
    var geojsonFormat = new ol.format.GeoJSON();
    var selectedFeatureID;
    var url_;
    var featureNS_;
    var featureType_;
    var format_ = new ol.format.WFS();
    var serializer_ = new XMLSerializer();
    $('#change_to_edit').on('click', function () {
        $("#edit_layers_view").hide();
        $("#edit_layers_update").show();
    });

    $('#save_properties').on('click', function (event) {
        var features = vectorLayerJsonp.getSource().getFeatures();
        for (x in features) {
            if (features[x].getId() === selectedFeatureID) {
                $("#table_info_update input").each(function () {
                    var string = {};
                    string[this.id] = $("#" + this.id).val();
                    features[x].setProperties(string);
                });

                var properties = features[x].getProperties();
                // get rid of bbox which is not a real property
                delete properties.geometry;
                delete properties.bbox;
                var clone = new ol.Feature(properties);
                clone.setId(selectedFeatureID);

                var node = format_.writeTransaction(null, [clone], null, {
                    gmlOptions: {srsName: view_projection},
                    featureNS: featureNS_,
                    featureType: featureType_
                });
                $.ajax({
                    type: "POST",
                    url: url_,
                    data: serializer_.serializeToString(node),
                    contentType: 'text/xml',
                    success: function (data) {
                        var result = readResponse(data);
                        if (result) {
                            $("#edit_layers_view").show();
                            $("#edit_layers_update").hide();
                            alert('Atualizado com sucesso!');
                        }
                    },
                    context: this
                });
            }
        }
    });
    $('#btn_group_operations_edit').find('*').prop('disabled', true);


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
        url_ = $("#edit_layers option:selected").attr('server') + '/wfs';
        featureNS_ = $("#edit_layers option:selected").attr('fns');
        var str = $("#edit_layers").val();
        featureType_ = str.substring(str.indexOf(":") + 1);
        
        $.ajax(url_, {
            type: 'GET',
            data: {
                service: 'WFS',
                version: '1.1.0',
                request: 'GetFeature',
                typename: $("#edit_layers").val(),
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
                    selectedFeatureID = event.element.getId();
                });
                break;
            case "table":
                var features = vectorLayerJsonp.getSource().getFeatures();
                if (features !== null && features.length > 0) {
                    for (x in features) {
                        if (features[x].getId() === selectedFeatureID) {
                            $('#edit_select_info').html('<hr><table id="table_info_edit" style="width:100%" class="table table-condensed table-hover" data-click-to-select="true"><thead><tr><th style="text-align: center;" data-align="center">Campo</th> <th style="text-align: center;" data-align="center">Valor</th></tr></thead><tbody></tbody></table>');
                            $('#table_info_update').html('');
                            jQuery.each(features[x].getProperties(), function (index, item) {
                                if (index !== 'geometry') {
                                    $('#table_info_edit').append('<tr><td style="vertical-align: middle" width="30%"><b>' + index + '</b></td> <td style="vertical-align: middle" width="70%">' + item + '</td>');
                                    $('#table_info_update').append('<div class="form-group"><label for="' + index + '">' + index.toUpperCase() + ':</label><input type="text" class="form-control" id="' + index + '" value="' + item + '"></div>');
                                }
                            });
                        }

                    }
                }
                break;
            case "save":

                break;
            case "delete":
                var features = vectorLayerJsonp.getSource().getFeatures();
                if (features !== null && features.length > 0) {
                    for (x in features) {
                        var id = features[x].getId();
                        if (id === selectedFeatureID) {
                            var feature = features[x];
                            var delete_result = confirm("Tem a certeza que deseja apagar o elemento?");
                            if (delete_result === true)
                            {
                                var node = format_.writeTransaction(null, null, [feature], {
                                    featureNS: featureNS_,
                                    featureType: featureType_
                                });
                                $.ajax({
                                    type: "POST",
                                    url: url_,
                                    data: serializer_.serializeToString(node),
                                    contentType: 'text/xml',
                                    success: function (data) {
                                        var result = readResponse(data);
                                        if (result) {
                                            if (result.transactionSummary.totalDeleted === 1) {
                                                vectorLayerJsonp.getSource().removeFeature(features[x]);
                                            } else {
                                                alert("There was an issue deleting the feature.");
                                            }
                                        }
                                    },
                                    context: this
                                });

                            }
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
                interaction.on('drawend', function (evt) {
                    var feature = evt.feature;
                    var srsName_ = view_projection;
                    feature.set('geometry', feature.getGeometry());
                    var node = format_.writeTransaction([feature], null, null, {
                        gmlOptions: {srsName: srsName_},
                        featureNS: featureNS_,
                        featureType: featureType_
                    });

                    $.ajax({
                        type: "POST",
                        url: url_,
                        data: serializer_.serializeToString(node),
                        contentType: 'text/xml',
                        success: function (data) {
                            var result = readResponse(data);
                            if (result) {
                                var insertId = result.insertIds[0];
                                if (insertId == 'new0') {
                                    vectorLayerJsonp.getSource().clear();
                                } else {
                                    feature.setId(insertId);
                                }
                            }
                            map.removeInteraction(interaction);
                        },
                        error: function (e) {
                            map.removeInteraction(interaction);
                            var errorMsg = e ? (e.status + ' ' + e.statusText) : "";
                            alert('Error saving this feature to GeoServer.<br><br>' + errorMsg);
                        },
                        context: this
                    });

                }, this);
                break;
            case "modify":
                interaction = new ol.interaction.Modify({
                    features: new ol.Collection(vectorLayerJsonp.getSource().getFeatures())
                });
                map.addInteraction(interaction);
                vectorLayerJsonp.getSource().on("changefeature", function (evt) {
 
                    var feature = evt.feature;
                    var fid = feature.getId();
                    var srsName_ = view_projection;
                    
                    // do a WFS transaction to update the geometry
                    var properties = feature.getProperties();
                    // get rid of bbox which is not a real property
                    delete properties.geometry;
                   
                    var clone = new ol.Feature(properties);
//                    clone.setGeometry(feature.getGeometry());
                    clone.set('geom', feature.getGeometry());
//                    feature.set('geometry', feature.getGeometry());
                    clone.setId(fid);
                    
                    var node = format_.writeTransaction(null,[clone], null, {
//                        gmlOptions: {srsName: srsName_},
                        featureNS: featureNS_,
                        featureType: featureType_,
                        srsName: srsName_
                    });
                    
                    $.ajax({
                        type: "POST",
                        url: url_,
                        processData: false,
                        dataType: 'xml',
                        data: serializer_.serializeToString(node),
                        contentType: 'text/xml',
                        success: function (data) {
                            var result = readResponse(data);
                            if (result && result.transactionSummary.totalUpdated === 1) {
                            }
                            map.removeInteraction(interaction);
                        },
                        error: function (e) {
                            map.removeInteraction(interaction);
                            var errorMsg = e ? (e.status + ' ' + e.statusText) : "";
                            alert('Error saving this feature to GeoServer.<br><br>' + errorMsg);
                        },
                        context: this
                    });
                });

                break;
            default:
                break;
        }
    });

    function readResponse(data) {
        var result;
        if (window.Document && data instanceof Document && data.documentElement &&
                data.documentElement.localName == 'ExceptionReport') {
            alert(data.getElementsByTagNameNS(
                    'http://www.opengis.net/ows', 'ExceptionText').item(0).textContent);
        } else {
            var format_ = new ol.format.WFS();
            result = format_.readTransactionResponse(data);
        }
        return result;
    }
    ;

</script>