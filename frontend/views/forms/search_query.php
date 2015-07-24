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
$arrayParametros = array();
foreach ($_REQUEST as $key => $value) {
    $$key = $value;
    array_push($arrayParametros, $key);
}
include __DIR__ .'/../connections.php';


if (isset($_POST['forms_search'])) {


    $resultGet = $connection->query('SELECT * FROM forms WHERE id = "' . $form . '"');

    while ($row = $resultGet->fetchArray(SQLITE3_ASSOC)) {

        $sqlGetQuery = $row['sql_select'];
    }

    $j = 0;
    $$j = $sqlGetQuery;
    for ($j; $j < count($arrayParametros); $j++) {
        $changereplace = $j + 1;
        $$changereplace = str_replace("$" . $arrayParametros[$j], $$arrayParametros[$j], $$j);

        $sqlQuery = $$changereplace;
    }

    $resultSelect = pg_query($conn, $sqlQuery);
    $lengthRow = pg_num_rows($resultSelect);
    $length = pg_num_fields($resultSelect);
    $resultQuery = array();
    $resultQuery = '';
    while ($row = pg_fetch_array($resultSelect)) {
        $resultQuery[] = $row;
    }
    echo json_encode($resultQuery);
} elseif (isset($_POST['forms_delete'])) {

    $resultGet = $connection->query('SELECT * FROM forms WHERE id = "' . $form . '"');

    while ($row = $resultGet->fetchArray(SQLITE3_ASSOC)) {
        $sqlGetQuery = $row['sql_delete'];
    }

    $j = 0;
    $$j = $sqlGetQuery;

    for ($j; $j < count($arrayParametros); $j++) {
        $changereplace = $j + 1;
        $$changereplace = str_replace("$" . $arrayParametros[$j], $$arrayParametros[$j], $$j);

        $sqlQuery = $$changereplace;
    }
    $resultDelete = pg_query($conn, $sqlQuery);
    echo json_encode('Apagou');
} elseif (isset($_POST['forms_save'])) {
    $resultGet = $connection->query('SELECT * FROM forms WHERE id = "' . $form . '"');

    while ($row = $resultGet->fetchArray(SQLITE3_ASSOC)) {
        if ($ValorFunction === "Editar") {
            $sqlGetQuery = $row['sql_update'];
        } elseif ($ValorFunction === "Novo") {
            $sqlGetQuery = $row['sql_insert'];
        }
    }

    $j = 0;
    $$j = $sqlGetQuery;

    for ($j; $j < count($arrayParametros); $j++) {
        $changereplace = $j + 1;
        $$changereplace = str_replace("$" . $arrayParametros[$j], $$arrayParametros[$j], $$j);

        $sqlQuery = $$changereplace;
    }
    $resultupdate = pg_query($conn, $sqlQuery);
    echo json_encode('Guardou');
}

