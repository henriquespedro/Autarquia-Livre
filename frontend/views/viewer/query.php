<?php

$arrayParametros = array();
foreach ($_REQUEST as $key => $value) {
    $$key = $value;
    array_push($arrayParametros, $key);
}

include __DIR__ . '/../connections.php';

if (isset($confrontation_draw)) {
    /* Vai buscar as layers a que se quer fazer a confrontação */
//    $layersconfrontacao = $connection->query('SELECT * FROM layers_confrontation');
    $resultQuery = '';
//    $geometriadraw = array();
    /* Faz o intersect com cada layer */
//    while ($row = $layersconfrontacao->fetchArray(SQLITE3_ASSOC)) {
//    
//    , 
    if ($regulement_field === '') {
        $sqlwithin = "SELECT IGT." . $description_field . " as uso, cast(sum(ST_area(ST_Intersection(IGT.geom, ST_GeomFromText('POLYGON((" . $coordinates . "))',3763)))) as decimal(20, 3)) As area, cast(st_area(ST_GeomFromText('POLYGON((" . $coordinates . "))',3763))as decimal(20, 3)) As areatotal, ST_AsText(ST_Union(ST_GeomFromEWKT(ST_Intersection(IGT.geom, ST_GeomFromText('POLYGON((" . $coordinates . "))',3763))))) As geometria from " . $layer . " IGT WHERE st_intersects(ST_GeomFromText('POLYGON((" . $coordinates . "))',3763), IGT.geom) GROUP BY " . $description_field . " ORDER BY " . $description_field . " ASC;";
    } else {
        $sqlwithin = "SELECT IGT." . $description_field . " as uso, " . $regulement_field . " as regulamento, cast(sum(ST_area(ST_Intersection(IGT.geom, ST_GeomFromText('POLYGON((" . $coordinates . "))',3763)))) as decimal(20, 3)) As area, cast(st_area(ST_GeomFromText('POLYGON((" . $coordinates . "))',3763))as decimal(20, 3)) As areatotal, ST_AsText(ST_Union(ST_GeomFromEWKT(ST_Intersection(IGT.geom, ST_GeomFromText('POLYGON((" . $coordinates . "))',3763))))) As geometria from " . $layer . " IGT WHERE st_intersects(ST_GeomFromText('POLYGON((" . $coordinates . "))',3763), IGT.geom) GROUP BY " . $description_field . ", " . $regulement_field . " ORDER BY " . $description_field . " ASC;";
    }
//     echo json_encode($sqlwithin);
    $querywithin = pg_query($conn, $sqlwithin);
    /* Verifica se existem resultados para o intersect, se sim, mostra */
    if (pg_num_rows($querywithin) !== 0) {
        while ($rowIntersect = pg_fetch_assoc($querywithin)) {
            $rowIntersect['percentagem'] = number_format(($rowIntersect['area'] / $rowIntersect['areatotal']) * 100, 2, '.', '') . "%";
            if ($regulement_field === '') {
                $rowIntersect['regulamento'] = '#';
            }
            $rowIntersect['layer'] = $name;
            $resultQuery[] = $rowIntersect;
        }
    }
//    }
    echo json_encode($resultQuery);
} else if (isset($search_result)) {
    $resultGet = $connection->query('SELECT * FROM search WHERE id = "' . $search_id . '"');
    while ($row = $resultGet->fetchArray(SQLITE3_ASSOC)) {
        $sqlGetQuery = $row['sql_search'];
    }
    $j = 0;
    $$j = $sqlGetQuery;
    for ($j; $j < count($arrayParametros); $j++) {
        $changereplace = $j + 1;
        $$changereplace = str_replace("$" . str_replace('search_parameter_', '', $arrayParametros[$j]), $$arrayParametros[$j], $$j);

        $sqlQuery_temp = $$changereplace;
    }
    $insertstr = ',ST_AsText(geom) AS wkt, (ST_XMin(geom), ST_YMin(geom), ST_XMax(geom), ST_YMax(geom)) as st_x_y';
    $sqlQuery = substr($sqlQuery_temp, 0, stripos($sqlQuery_temp, 'from', 0) - 1) . $insertstr . substr($sqlQuery_temp, strpos($sqlQuery_temp, 'from', 0) - 1);


    $resultSelect = pg_query($conn, $sqlQuery);
    $lengthRow = pg_num_rows($resultSelect);
    $length = pg_num_fields($resultSelect);

    $resultQuery = '';
    while ($row = pg_fetch_array($resultSelect, NULL, PGSQL_ASSOC)) {
        $resultQuery[] = $row;
    }
    echo json_encode($resultQuery);
} else {
    $queryResult = pg_query($conn, $query);

    $resultQuery = '';
    while ($row = pg_fetch_array($queryResult)) {
        $resultQuery[] = $row;
    }
    echo json_encode($resultQuery);
}

pg_close($conn);
$connection->close();
?>