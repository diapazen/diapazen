<?php
/**
 * Footer des pages du site
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

		</div>
		<footer>
		    <ul>
		        <li><a class="link" href="<?php $this->getHomeUrl(); ?>">Accueil</a></li>
		        <li><a class="link" href="<?php $this->getHomeUrl(); ?>/about">À propos</a></li>
		        <!-- <li><a class="link" href="#">Contact</a></li> -->
		    </ul>
		    <p class="text">© <?php echo date('Y'); ?> Diapazen</p>
		    <img id="logo_isen" src="<?php $this->getPath('media/pictures/logo_isen.png'); ?>" alt="ISEN Toulon">
		</footer>

    </body>

</html>