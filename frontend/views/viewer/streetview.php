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

foreach ($_REQUEST as $key => $value) {
    $$key = $value;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Street View service</title>
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
        <script>
            function initialize() {
                var long = <?php echo $long ?>;
                var lat = <?php echo $lat ?>;
                var fenway = new google.maps.LatLng(lat, long);

                var mapOptions = {
                    center: fenway,
                    zoom: 15
                };
                var map = new google.maps.Map(
                        document.getElementById('map-canvas'), mapOptions);

                var panoramaOptions = {
                    position: fenway,
                    pov: {
                        heading: 34,
                        pitch: 10
                    }
                };
                var panorama = new google.maps.StreetViewPanorama(document.getElementById('pano'), panoramaOptions);
                map.setStreetView(panorama);
            }

            google.maps.event.addDomListener(window, 'load', initialize);

        </script>
    </head>
    <body>
        <div id="map-canvas" style="width: 30%; height: 100%;float:left"></div>
        <div id="pano" style="width: 70%; height: 100%;float:left"></div>
    </body>
</html>

