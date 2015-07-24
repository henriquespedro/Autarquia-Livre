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

//var map_resolutions = [69, 30, 17, 5, 2, 1, 0.5, 0.2];
//var view_extent = [-48857.1, -14583.2, -24876.8, 18984.3];
//var view_units = 'm';
//var view_projection = 'EPSG:3763';
//var view_center = [-37842.6789966098, 2765.38006416833];
var view_center = [0, 0];
var view_zoom = 0;
var map = new ol.Map({
    controls: ol.control.defaults({
//        attributionOptions: /** @type {olx.control.AttributionOptions} */ ({
//            collapsible: false
//        })
    }),
    layers: layers,
    target: 'map',
    view: new ol.View({
        //extent: view_extent,
        projection: view_projection,
        resolutions: map_resolutions,
        units: view_units,
        center: view_center,
        zoom: view_zoom
    })
});

var format = new ol.format.WKT();
var search_vector_result = new ol.layer.Vector({
    source: new ol.source.Vector()
});
