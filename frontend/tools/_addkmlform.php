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
//if (is_uploaded_file($HTTP_POST_FILES['filename']['tmp_name'])) {
//    if (move_uploaded_file($HTTP_POST_FILES['filename']['tmp_name'], $folder . $HTTP_POST_FILES['filename']['name'])) {
//        echo 'File uploaded';
//        exit();
//    } else {
//        echo 'File not moved to destination folder. Check permissions';
//        exit();
//    };
//}
?>


<div>
    <label for="kml_name">Nome:</label><input type="text" id="kml_name" name="kml_name" class="form-control">
    <!--<label for="kml_url">KML URL:</label><input type="text" id="kml_url" name="kml_url" class="form-control">-->
    <form name="addkmlfile" id="addkmlfile" action="javascript:;" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <label for="filename">Ficheiro:</label>
        <input type="file" name="filename" id="kml_filename" />
        <hr>
        <input type="submit" class="btn btn-primary" name="submit" value="Adicionar KML" id="upload_kml"/>
    </form>

<!--<input type="submit" class="btn btn-primary" name="submit" value="Adicionar KML" id="upload_kml"/>-->
    <!--<button type="button" class="btn btn-primary" name="insert" id="upload_kml">Adicionar KML</button>-->
</div>

<script>
    $(document).ready(function () {
        $("#addkmlfile").submit(function (event) {
//        $("#kml_insert").on("click", function () {
            var file_data = $('#kml_filename').prop('files')[0];
            var form_data = new FormData();
            form_data.append('filename', file_data);
            form_data.append('submit', 'submit');


            $.ajax({
                url: '<?php echo $_SERVER["PHP_SELF"] ?>',
                type: 'POST',
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                success: function () {
//                    var kml_layer = new ol.layer.Vector();
                    var url_layer = '../uploading/' + $("#kml_filename").val();
//                    $.ajax(url_layer).then(function (response) {
//                        var kmlFormat = new ol.format.KML();
//                        var features = kmlFormat.readNetworkLinks(response);
//                        kml_layer.addFeatures(features);
//
//                    });
//                    map.addLayer(kml_layer);

                    var vectorLayer = new ol.layer.Vector({
                        title: $("#kml_name").val(),
                        name: $("#kml_name").val(),
                        source: new ol.source.KML({
//                            projection: view_projection,
                            url: url_layer
//                            url: url_layer,
//                            format: new ol.format.KML()
                        })
                    });

                    vectorLayer.setVisible(true);
                    map.addLayer(vectorLayer);
//                    alert('Ficheiro enviado com sucesso!');

                },
                error: function () {
                    alert("Aconteceu um erro ao enviar o ficheiro!");
                }
            });


            return false;
        });
    });


//    $("#kml_insert").on("click", function () {
//        var vectorLayer = new ol.layer.Vector({title: $("#kml_name").val(),
//            name: $("#kml_name").val(), source: new ol.source.KML({projection: view_projection,
//                url: '../uploading/' + $("#kml_filename").val()
////                url: './data/KML_Samples.kml'
//            })
//        });
//        map.addLayer(vectorLayer)
//    });

</script>

<?php // echo $_SERVER["PHP_SELF"] ?>
