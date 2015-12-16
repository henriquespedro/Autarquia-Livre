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


var url_ = 'http://vps207957.ovh.net/geoserver';
var featureNS_ = 'sigserver.pt';
var str = 'sig:sugestoes';
var single_click = map.on('singleclick', function (evt) {
    var pixel = map.getPixelFromCoordinate(evt.coordinate);
    var size = map.getSize();

    var url = url_ + "/wms?"
            + "&LAYERS=" + str
            + "&QUERY_LAYERS=" + str
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
        $.getJSON(url, function (info_json) {
            if (info_json.features.length > 0) {
                $("#codigo_ocorrencia_view").text(info_json.features[0].properties.codigo_sugestao);
                $("#categoria_ocorrencias_view").text(info_json.features[0].properties.nome);
                $("#coordenadas_ocorrencias_view").text(info_json.features[0].properties.coordenadas);
                $("#descricao_ocorrencia_view").text(info_json.features[0].properties.descricao);
                $("#data_registo_ocorrencias_view").text(info_json.features[0].properties.data_registo);
                $("#ultima_atualizacao_ocorrencias_view").text(info_json.features[0].properties.data_atualizacao);
                $("#situacao_ocorencia_view").text(info_json.features[0].properties.situacao);
                
                $('#modal_sugestoes_info').modal('show');
            }
        })
    } else {
        console.log("Uh Oh, Algum problema ocorreu!.");
    }
});