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

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
/*
  if (isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
  echo "File is an image - " . $check["mime"] . ".";
  $uploadOk = 1;
  } else {
  echo "File is not an image.";
  $uploadOk = 0;
  }
  }
 */
// Check if file already exists
if (file_exists($target_file)) {
    echo "Erro ao importar a shapefile!";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Pedimos desculpa, mas o ficheiro é muito grande!";
    $uploadOk = 0;
}
// Allow certain file formats
if ($imageFileType != "zip") {
    echo "Pedimos desculpa, mas apenas apenas é permitido importar ficheiros de extensão '.zip'!";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Não foi possível importar o ficheiro.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } else {
        echo "Acenteceu um erro ao importar o ficheiro.";
    }
}
?> 