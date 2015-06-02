<?php
foreach ($_REQUEST as $key => $value) {
    $$key = $value;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Google StreetView</title>
        <style>
            html, body, #map-canvas {
                height: 100%;
                margin: 0px;
                padding: 0px
            }
        </style>
        <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
        <script>
            function initialize() {
                var long = <?php echo $long ?>;
                var lat = <?php echo $lat ?>;
                var locationpoint = new google.maps.LatLng(lat,long);
                var panoramaOptions = {
                    position: locationpoint,
                    pov: {
                        heading: 165,
                        pitch: 0
                    },
                    zoom: 0
                };
                var myPano = new google.maps.StreetViewPanorama(
                        document.getElementById('map-canvas'),
                        panoramaOptions);
                myPano.setVisible(true);
            }

            google.maps.event.addDomListener(window, 'load', initialize);

        </script>
    </head>
    <body>
        <div id="map-canvas"></div>
    </body>
</html>
