<?php
include __DIR__ .'/../connections.php';

$username = $_POST["username"];
// create a query to get salt and validate user
$usernameResult = $connection->query('SELECT salt FROM users WHERE username = "' . $username . '" LIMIT 1');

if ($usernameResult) {
    if ($record = $usernameResult->fetchArray(SQLITE3_ASSOC)) {
        // we have a record so now we can use it
        $password = $_POST["password"];
        $salt = $record['salt'];
        $password_hash = sha1($password . $salt);
        $validate_login = $connection->query('SELECT name FROM users WHERE username = "' . $username . '" and password = "' . $password_hash . '" LIMIT 1');
        if ($validate_login) {
            if ($valid = $validate_login->fetchArray(SQLITE3_ASSOC)) {
                echo 'Sucesso';
                $connection->query('UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE username = "' . $username . '"');
                exit();
            } else {
                echo 'A password inserida não é valida!';
                exit();
            }
        } else {
            echo "<p>Ocorreu um erro ao validar o utilizador: $connection->lastErrorMsg()</p>";
        }
    } else {
        echo 'O utilizador inserido não é valido!';
    }
} else {
    echo "<p>Ocorreu um erro ao validar o utilizador: $connection->lastErrorMsg()</p>";
}
