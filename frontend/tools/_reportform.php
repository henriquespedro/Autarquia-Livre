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
?>

<form>
    <label for="type">Tipo:</label>
    <select name="type" id="type" class="form-control">
        <option value="problema">Problemas</option>
        <option value="sugestao">Sugestões</option>
    </select>
    <label for="name">Nome: </label>
    <input type="text" name="name" id="name" class="form-control"><br>
    <label for="mensagem">Mensagem: </label>
    <textarea name="mensagem" id="mensagem" cols="5" rows="10" class="form-control"></textarea><br>
    <hr>
    <button type="submit" class="btn btn-primary" name="submit" id="submit">Enviar!</button>
</form>
