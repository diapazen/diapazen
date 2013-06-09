<?php
/**
 * Page d'erreur de la base de données
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
        
        <div id="content">
            <img id="broken_diapason" src="<?php $this->getPath('media/pictures/diapason_broken.png'); ?>" alt="diapason broken" >
            <div id="text_404">
            	<p class="big_title" >Erreur interne du serveur</p>
            	<p class="title" >Nous sommes désolé, une erreur critique est survenue.</p>
            	<a class="link" href="<?php $this->getHomeUrl(); ?>">Aller à la page d'accueil</a>
            </div>
        </div>

<?php $this->getFooter(); ?>