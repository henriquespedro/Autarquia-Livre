<?php

/*
 * Copyright (C) 2015 pedro
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

if (isset($connection_param)) {
    if (!isset($connection)) {
        $connection = new SQLite3(__DIR__ . '/../../data/data.db');
    }
    $load_connection_string = $connection->query('SELECT string FROM datasources WHERE id =' . $connection_param . '  LIMIT 1');
    if ($record = $load_connection_string->fetchArray(SQLITE3_ASSOC)) {
        $conn = pg_connect($record['string']);
        if (!$conn) {
            die("Erro ao ligar á base de dados | " . pg_last_error($conn));
        }
    }
} else {
    try {
        $connection = new SQLite3(__DIR__ . '/../../data/data.db');
    } catch (Exception $exception) {
        // sqlite3 throws an exception when it is unable to connect
        echo '<p>Ocorreu um erro ao conectar à Base de Dados!</p>';
    }
}

