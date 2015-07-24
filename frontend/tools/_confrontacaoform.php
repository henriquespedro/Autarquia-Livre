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
include __DIR__ .'/../views/connections.php';
$result_layers = $connection->query('SELECT * FROM layers_confrontation ORDER BY rowid ASC');
//$resultprint = $connection->query('SELECT * FROM maprint WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');
?>
<div id="init_confrontacao">
    <br><label>Confrontação Espacial</label><br><br>
    <div id="result_notes">
        <p align="justify">
            Para realizar a confrontação, o utilizador deve desenhar no mapa um polígono que represente a área/prédio, sobre o qual deseja realizar a confrontação espacial. Para isso, basta carregar na opção <b>Desenhar Polígono</b>, após concluir o desenho carregar em <b>Seguinte</b>.
        </p>
    </div>
    <hr>
    <div id="draw_options">
        <label>Ferramentas de Desenho:</label>
        <div style="text-align: center">
            <button type="button" onclick="create_polygon()" title="Desenhar Polígono" class="btn btn-default bt_size"> <span class="glyphicon" style="background-image:url(../images/appbar.edit.box.svg);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p>Desenhar Polígono</p></button>
            <button type="button" onclick="delete_polygon()" title="Apagar Polígono" class="btn btn-default bt_size"> <span class="glyphicon" style="background-image:url(../images/appbar.close.svg);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p>Apagar Polígono</p></button>
        </div>

    </div>

    <hr>
    <div class="alert alert-warning" role="alert"><strong>Nota:</strong> Independentemente do número de polígonos que desenhe, somente o último será utilizador para realizar a confrontação!</div>
    <div id="no_polygon"></div>
    <button type="button" style="float: right;" class="btn btn-primary" id="next_results_print" onclick='next_layers()'>Seguinte</button>
</div>


<div id="list_layers" style="display:none">
    <table style="width:100%" class="table table-condensed table-hover" data-click-to-select="true">

        <thead>
            <tr>
                <th data-field="select" data-checkbox="true">#</th>
                <th data-field="layer" data-align="right">Camada</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result_layers->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <tr>
                    <td style="vertical-align: middle"><input type="checkbox" class="checkbox" checked="true"/></td>
                    <td style="vertical-align: middle" width="90%"><?php echo $row['name'] ?></td>
                    <td style="display:none;"><?php echo $row['layer'] ?></td>
                    <td style="display:none;"><?php echo $row['description_field'] ?></td>
                    <td style="display:none;"><?php echo $row['regulement_field'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <div id="error_select_layers"></div>
    <div>
        <button type="button" class="btn btn-primary"  style="float: left;" onclick="previous_confrontation()">Voltar</button>
        <button type="button" class="btn btn-primary"  style="float: right;" onclick="next_confrontation()">Seguinte</button>
    </div>

</div>


<div id="results_confrontacao" style="display:none">

    <div id="result">
        <div id="result_table">

        </div>
        <div id="result_char"></div>


    </div>
    <hr>
    <button type="button" class="btn btn-primary" onclick='confrontacao_espacial()'>Voltar</button>
</div>

<script>
    var draw_polygon;
    var geometry;
    var coordenadas_finais = "";
    if (layer_polygon) {
        layer_polygon.getSource().clear();
    } else {
        var layer_polygon = new ol.layer.Vector({
            source: new ol.source.Vector({format: new ol.format.WKT}),
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
        map.addLayer(layer_polygon);
    }

    function create_polygon() {
        draw_polygon = new ol.interaction.Draw({
            source: layer_polygon.getSource(),
            type: "Polygon"
        });
        
        draw_polygon.on('drawend', function (event) {
            map.removeInteraction(draw_polygon);
        });
map.addInteraction(draw_polygon);
    }
    function delete_polygon() {
        var clear_vector = confirm("Deseja apagar o Polígono desenhado no mapa?");
        if (clear_vector === true)
        {
            layer_polygon.getSource().clear();
        }
        map.removeInteraction(draw_polygon);
    }

    function next_layers() {
        var count = layer_polygon.getSource().getFeatures().length;
        if (count < 1) {
            $("#no_polygon").html('<div class="alert alert-info" role="alert"><strong>Aviso: </strong>Ainda não foi desenhado nenhum polígono!</div>');
        } else {
            $('#init_confrontacao').hide();
            $('#list_layers').show();
            var source = layer_polygon.getSource();
            var features = source.getFeatures();
            var feature = features[0];
            geometry = feature.getGeometry().getCoordinates()[0];

            for (i = 0; i < geometry.length; i++) {
                coordenadas_finais += geometry[i][0] + ' ' + geometry[i][1] + ',';
            }
//            console.log('Nº de vértices: ' + feature.getGeometry().getType() + ' | Coordinates: ' + coordenadas_finais);
        }
    }


    var list_layers = [];
    function next_confrontation() {
        $('table input:checked').each(function () {
            var row = $(this).parents('tr');
            list_layers.push({name: row.find('td:nth-child(2)').text(), layer: row.find('td:nth-child(3)').text(), description_text: row.find('td:nth-child(4)').text(), regulement_field: row.find('td:nth-child(5)').text()});
        });
        if (list_layers.length === 0) {
            $("#error_select_layers").html('<div class="alert alert-info" role="alert">É obrigatónio escolher pelo menos uma camada para realizar a confrontação!!</div>');
        } else {
            var data_google = new google.visualization.DataTable();
            data_google.addColumn('string', 'Uso');
            data_google.addColumn('number', 'Percentagem');
            for (i = 0; i < list_layers.length; i++) {
                $.ajax({
                    type: 'POST',
                    url: '../views/viewer/query.php',
                    dataType: 'json',
                    data: "layer=" + list_layers[i].layer + "&name=" + list_layers[i].name + "&description_field=" + list_layers[i].description_text + "&regulement_field=" + list_layers[i].regulement_field + "&coordinates=" + coordenadas_finais.slice(0, -1) + "&confrontation_draw=&connection_param=1",
                    success: function (data) {
                        if (data.length > 0) {
                            var id = Math.floor((Math.random() * 800) + 1); ;
                            $('#result_table').append('<label>' + data[0]["layer"]+ '</label><table id="table_' + id + '" style="width:100%" class="table table-condensed table-hover" data-click-to-select="true"><thead><tr><th style="text-align: center;" data-field="percentagem" data-align="center">%</th><th style="text-align: center;" data-field="area" data-align="center">Área (m2)</th><th style="text-align: center;" data-field="uso" data-align="right">Uso</th><th style="text-align: center;" data-field="regulamento" data-align="">Regulamento</th> </tr></thead><tbody></tbody></table><hr>');
                            for (i = 0; i < data.length; i++) {
                                $('#table_' + id).append('<tr><td style="vertical-align: middle" width="10%">' + data[i]["percentagem"] + '</td><td style="vertical-align: middle" width="20%">' + data[i]["area"] + '</td><td style="vertical-align: middle" width="50%">' + data[i]["uso"] + '</td><td style="vertical-align: middle" width="20%"><a href="http://www.w3schools.com/' + data[i]["regulamento"] + '.pdf" target="_blank">Abrir</a></td>');
                                data_google.addRow([data[i]["uso"], parseFloat(data[i]["percentagem"].slice(0, -1)) ]);     // Same as previous.
                            }
                            var options = {
                                width: 400,
                                height: 240,
                                is3D: true
                            };
                            var chart = new google.visualization.PieChart(document.getElementById('result_char'));
                            chart.draw(data_google, options);
                            $('#list_layers').hide();
                            $('#results_confrontacao').show();
                        } else {
                            alert('A pesquisa não devolveu resultados!!');
                        }
                    },
                    error: function () {
                        alert('Ocorreu um erro a realizar a Confrontação!!!');
                    }
                });
            }

        }
    }

    function previous_confrontation() {
        list_layouts = [];
        $('#init_confrontacao').show();
        $('#list_layers').hide();
    }

</script>
