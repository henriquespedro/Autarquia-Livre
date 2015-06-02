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

// The extent is used to determine zoom level 0. Recommended values for a
// projection's validity extent can be found at http://epsg.io/.

/**
 * 
 * @type ol.proj.Projection
 * @name EPSG:3763
 */
var projection_3763 = ol.proj.get('EPSG:3763');
projection_3763.setExtent([-121656.5849, -294200.8899, 172945.8815, 277430.8421]);

/**
 * 
 * @type ol.proj.Projection
 * @name EPSG:27493
 */
var projection_27493 = ol.proj.get('EPSG:27493');
projection_27493.setExtent([-121588.4107, -294117.6175, 173027.1548, 277526.4252]);

/**
 * 
 * @type ol.proj.Projection
 * @name EPSG:102165
 */
var projection_20790 = ol.proj.get('EPSG:20790');
projection_20790.setExtent([78230.9913, 5969.3725, 372846.5568, 577613.4152]);
/**
 * 
 * @type ol.proj.Projection
 * @name EPSG:102164
 */
var projection_20791 = ol.proj.get('EPSG:20791');
projection_20791.setExtent([-121769.0087, -294030.6275, 172846.5568, 277613.4152]);
