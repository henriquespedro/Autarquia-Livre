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

session_start();
include __DIR__ . '/../connections.php';

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
                $_SESSION['login_username'] = $username;
                $connection->query('UPDATE users SET last_login=CURRENT_TIMESTAMP WHERE username = "' . $username . '"');
                if ($_POST['remember']) {
                    $year = time() + 31536000;
                    setcookie('remember_me', $username, $year);
                } else {
                    if (isset($_COOKIE['remember_me'])) {
                        $past = time() - 100;
                        setcookie(remember_me, gone, $past);
                    }
                }
                header("Location: {$_SERVER['HTTP_REFERER']}");
                exit;
            } else {
                echo 'A password inserida não é valida!';
                exit;
            }
        } else {
            echo "<p>Ocorreu um erro ao validar o utilizador: $connection->lastErrorMsg()</p>";
            exit;
        }
    } else {
        echo 'O utilizador inserido não é valido!';
        exit;
    }
} else {
    echo "<p>Ocorreu um erro ao validar o utilizador: $connection->lastErrorMsg()</p>";
    exit;
}
