<?php
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
?>

<div class="modal fade"  id="add_registo" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" >
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Registar Sugestão</h4>
            </div>
            <div class="modal-body" id="new_registo_info">
                <div class="form-horizontal" id="myform" role="form"  action="" method="post">
                    <div class="form-group form-group-sm">
                        <label for="ocorrencias_requerente" class="col-sm-3  control-label">Nome</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ocorrencias_nome" id="nome" placeholder="Nome">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ocorrencias_email" class="col-sm-3  control-label">E-mail</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="ocorrencias_email" id="ocorrencias_email" placeholder="E-mail">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ocorrencias_contacto" class="col-sm-3 control-label">Contacto</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="ocorrencias_contacto" id="ocorrencias_contacto" placeholder="Contacto">
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ocorrencias_categoria" class="col-sm-3 control-label">Categoria</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="ocorrencias_categoria" >
                                <option value="-"></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-group-sm">
                        <label for="ocorrencias_descricao" class="col-sm-3 control-label">Descrição</label>
                        <div class="col-sm-9">
                            <textarea class="form-control span5" style="height: 100px; max-width: 425px; width: 425px;" id="ocorrencias_descricao" placeholder="Descrição"></textarea>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="ocorrencias_coordinates" id="coordinates">
                    <input type="hidden" class="form-control" name="ocorrencias_email_destino" id="email_destino">
                    <input type="hidden" class="form-control" name="ocorrencias_db_layer" id="db_layer">
                    <button name="bt_registar" id="bt_registar" onclick="registar_ocorrencia()" class="btn btn-success">Registar</button>
                </div> 
            </div>
        </div>
    </div>
</div>


<script>
    
    var featureType_ = str.substring(str.indexOf(":") + 1);
    var srsName_ = 'EPSG:3763';
    var format_ = new ol.format.WFS();
    var serializer_ = new XMLSerializer();

    var featureOverlay_sugestoes = new ol.layer.Vector(
            {
                name: 'Tema para edição',
                title: 'Tema para edição',
                source: new ol.source.Vector(),
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
    map.addLayer(featureOverlay_sugestoes);
    var feature_geom;
    var interaction = new ol.interaction.Draw({
        type: /** @type {ol.geom.GeometryType} */ 'Point',
        source: featureOverlay_sugestoes.getSource()
    });
    map.addInteraction(interaction);

    interaction.on('drawend', function (evt) {
        feature_geom = evt.feature;
        feature_geom.set('geom', feature_geom.getGeometry());
        feature_geom.setGeometryName('geom');
        map.removeInteraction(interaction);
    });


    function registar_ocorrencia() {

        feature_geom.set('nome', $("#ocorrencias_nome").val());
        feature_geom.set('email', $("#ocorrencias_email").val());
        feature_geom.set('contato', $("#ocorrencias_contacto").val());
        feature_geom.set('categoria', $("#ocorrencias_categoria").val());
        feature_geom.set('descricao', $("#ocorrencias_descricao").val());
        feature_geom.set('situacao', 'Em Análise');
//        feature_geom.set('data_registo', 'Em Análise');

        var node = format_.writeTransaction([feature_geom], null, null, {
            gmlOptions: {srsName: srsName_},
            featureNS: featureNS_,
            featureType: featureType_
        });

        $.ajax({
            type: "POST",
            url: url_ + "/wfs",
            data: serializer_.serializeToString(node),
            contentType: 'text/xml',
            success: function (data) {

                var result = readResponse(data);
                if (result) {
                    alert('Sugestão registada com sucesso!');
                    map.removeInteraction(interaction);
                    featureOverlay_sugestoes.getSource().clear();
                    $('#add_registo').modal('hide');
                    map.unByKey(key);
                }

            },
            error: function (e) {
                map.removeInteraction(interaction);
                var errorMsg = e ? (e.status + ' ' + e.statusText) : "";
                alert('Error saving this feature to GeoServer.<br><br>' + errorMsg);
            },
            context: this
        });
    }



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
</script>
