<?php


foreach ($_GET as $key => $value) {
    $$key = $value;
}
include __DIR__ .'/../connections.php';

$queryResult = pg_query($conn, $query);
$resultQuery = array();
$resultQuery = '';
while ($row = pg_fetch_array($queryResult)) {
    $resultQuery[] = $row;
}
echo json_encode($resultQuery);

pg_close($conn);
?>