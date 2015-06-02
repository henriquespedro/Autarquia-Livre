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

var layers = [
//    new ol.layer.Image({
//        title: 'Plantas Topo-Cadastrais',
//        name: 'Plantas Topo-Cadastrais',
//        source: new ol.source.ImageWMS({
//            url: 'http://websig.cm-ourem.pt/geoserver/wms',
//            crs: "EPSG:3763",
//            params: {'LAYERS': 'sig:Topocadastrais'},
//            serverType: 'geoserver'
//        })
//    }),
//    new ol.layer.Tile({
//        id: 'bing_maps',
//        title: 'BING Maps',
//        name: 'BING Maps',
//        visible: false,
//        source: new ol.source.BingMaps({
//            key: 'Ak-dzM4wZjSqTlzveKz5u0d4IQ4bRzVI309GxmkgSVr1ewS6iPSrOvOKhA-CJlm3',
//            imagerySet: 'Road',
//            culture: 'pt-pt'
//        })
//    }),
    new ol.layer.Image({
        id: 'edificado',
        title: 'Edificado',
        name: 'Edificado',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            crs: "EPSG:3763",
            params: {'LAYERS': 'sig:fc_edificado'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Image({
        id: 'numeros_policia',
        title: 'Números de Polícia',
        name: 'Números de Polícia',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            crs: "EPSG:3763",
            params: {'LAYERS': 'sig:numeros_policia'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Image({
        id: 'rede_viaria',
        title: 'Rede Viária',
        name: 'Rede Viária',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            crs: "EPSG:3763",
            params: {'LAYERS': 'sig:fc_rede_viaria'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Image({
        id: 'toponimos',
        title: 'Topónimos',
        name: 'Topónimos',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            crs: "EPSG:3763",
            params: {'LAYERS': 'sig:fc_toponimos'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Image({
        title: 'Rede Viária Principal',
        name: 'Rede Viária Principal',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            crs: "EPSG:3763",
            params: {'LAYERS': 'sig:Rede_Viaria_Inicial'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Image({
        id: 'municipios_vizinhos',
        title: 'Municípios Vizinhos',
        name: 'Municípios Vizinhos',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            crs: "EPSG:3763",
            params: {'LAYERS': 'sig:municipios_vizinhos'},
            serverType: 'geoserver'
        })
    }),
    new ol.layer.Image({
        id: 'limite_municipio',
        title: 'Limite de Município',
        name: 'Limite de Município',
        source: new ol.source.ImageWMS({
            url: 'http://websig.cm-ourem.pt/geoserver/wms',
            //crs: "EPSG:3763",
            params: {'LAYERS': 'sig:limite_municipio'},
            serverType: 'geoserver'
        })
    })
];
//var map_resolutions = [69, 30, 17, 5, 2, 1, 0.5, 0.2];
//var view_extent = [-48857.1, -14583.2, -24876.8, 18984.3];
//var view_units = 'm';
//var view_projection = 'EPSG:3763';
var view_center = [-37842.6789966098, 2765.38006416833];
var view_zoom = 0;
var map = new ol.Map({
    controls: ol.control.defaults({
        attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
            collapsible: false
        })
    }),
    layers: layers,
    target: 'map',
    view: new ol.View({
        extent: view_extent,
        projection: view_projection,
        resolutions: map_resolutions,
        units: view_units,
        center: view_center,
        zoom: view_zoom
    })
});