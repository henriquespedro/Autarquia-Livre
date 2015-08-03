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

if (isset($_POST["submit"])) {
    $allowed_filetypes = array('.kml');

    $upload_path = '../uploading/';

    if (file_exists($upload_path)) {
        $filename = $_FILES["filename"]["name"];
        $ext = substr($filename, strpos($filename, '.'), strlen($filename) - 1);
        if (!in_array($ext, $allowed_filetypes))
            die('Apenas ficheiros .kml podem ser adicionados.');

        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $upload_path . $filename))
            echo 'Your file upload was successful!!';
        else
            echo 'Ocorreu um erro a realizar o upload, por favor volte a tentar!';
        exit();
    } else {
        die('A directoria onde pretende guardar o ficheiro não existe!');
    }
}
?>

<div>
    <label for="shape_name">Nome:</label><input type="text" id="shape_name" name="shape_name" class="form-control">
    <form name="addshpfile" id="addshpfile" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <label for="filename">Selecionar Shapefile:</label>
        <input type="file" name="filename" id="upload_shape" />
        <hr>
        <input type="submit" class="btn btn-primary" name="submit" value="Adicionar Shapefile" id="upload_kml"/>
    </form>
</div>


<script>
    var client = new XMLHttpRequest();

    $(document).ready(function () {
        $("#addshpfile").submit(function (event) {
            var file_data = $('#upload_shape').prop('files')[0];
            var form_data = new FormData();
            form_data.append('filename', file_data);
            form_data.append('sourceSrs', 'EPSG:3763');
            form_data.append('targetSrs', 'EPSG:3763');


            client.open("PATCH", "http://ogre.adc4gis.com/convert", false);
            client.setRequestHeader("Content-Type", "multipart/form-data");
            client.send(form_data);

            /* Check the response status */
            client.onreadystatechange = function ()
            {
                if (client.readyState == 4 && client.status == 200)
                {
                    alert(client.statusText);
                }
            }
            
//            $.ajax({
//                url: 'http://ogre.adc4gis.com/convert',
//                type: 'POST',
//                dataType: 'text',
//                cache: false,
//                contentType: false,
//                processData: false,
//                data: form_data,
//                success: function (data) {
//                    //var url_layer = '../uploading/' + $("#upload_shape").val();
//                    var vectorSource = new ol.source.GeoJSON({
//                        format: new ol.format.GeoJSON(),
//                        projection: 'EPSG:3763',
//                        strategy: ol.loadingstrategy.bbox
//                    });
//
//                    var vectorLayer = new ol.layer.Vector({
//                        title: $("#shape_name").val(),
//                        name: $("#shape_name").val(),
//                        source: vectorSource
//                    });
//                    vectorSource.readFeatures(data);
////                    vectorLayer.setVisible(true);
//                    map.addLayer(vectorLayer);
//                },
//                error: function () {
//                    alert("Aconteceu um erro ao enviar o ficheiro!");
//                }
//            });


            return false;
        });
    });


</script>