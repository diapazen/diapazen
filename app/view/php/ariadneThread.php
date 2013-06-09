<?php
/**
 * Fil d'arianne
 * 
 * @package     Diapazen
 * @subpackage	View
 * @copyright   Copyright (c) 2013, ISEN-Toulon
 * @license     http://www.gnu.org/licenses/gpl.html GNU GPL v3
 * 
 * This file is part of Diapazen.
 * 
 * Diapazen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License 3 as published by
 * the Free Software Foundation.
 * 
 * Diapazen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Diapazen.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

	// fixe un bug de la documentation
	namespace ns;
	// fixe un bug de la documentation
?>

			<div style="width: <?php echo $width_ariadne; ?>px;" id="ariadne_thread"> 
				<span class="<?php echo $class_create; ?>_ariadne" ><span></span><span>Création</span><span></span></span>
				<?php
				if (isset($show_ariadne) && $show_ariadne == true)
				{
				?>
				<span class="<?php echo $class_connect; ?>_ariadne" ><span></span><span>Connexion</span><span></span></span>
				<?php
				}
				?>
				<span class="<?php echo $class_share; ?>_ariadne" ><span></span><span>Partage</span><span></span></span>
			</div>