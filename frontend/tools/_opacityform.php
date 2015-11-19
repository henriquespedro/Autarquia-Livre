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

<div id="opacity_range">

</div>

<script>
    var x = 0;
    map.getLayers().forEach(function (lyr) {
        if (lyr.get('show_layer') !== false) {
            $('#opacity_range').append('<div><label style="width: 40%;" for="layer_id_' + x + '">' + lyr.get('name') + ':</label><input style="width: 60%; position: inherit; display: inline" type="range" layer="' + lyr.get('name') + '" id="layer_id_' + x + '" step="0.1" value="' + lyr.get('opacity') + '" min="0" max="1" /></div>');
            $("#layer_id_" + x).on("change", function () {
                var layer_name = $(this).attr("layer");
                var layer_value = this.value;
                map.getLayers().forEach(function (lyr_valid) {
                    if (lyr_valid.get('name') === layer_name) {
                        lyr_valid.setOpacity(layer_value);
                    }
                });
            });
            x++;
        }
    });

</script>