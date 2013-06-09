<?php
/**
 * Page À propos
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

<?php $this->getHeader(); ?>
        
        <div id="content" class="about">
            <p class="title">À propos de Diapazen</p>
            <br>
            <p class="text">Diapazen permet de planifier rapidement des événements avec ses collaborateurs.</p>
            <br>
            <p class="text">C'est un service libre et gratuit réalisé par des étudiants de l'<a class="link" target="_blank" href="http://www.isen.fr/toulon.asp">ISEN-Toulon</a>. Le code source est disponible sur <a class="link" target="_blank" href="http://github.com/diapazen/diapazen">github.com/diapazen</a>.</p>
        </div>

<?php $this->getFooter(); ?>