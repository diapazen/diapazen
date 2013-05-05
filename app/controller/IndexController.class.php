<?php
/**
 * 
 * Contrôleur de la page d'accueil 
 * 
 * @package     Diapazen
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

require_once 'system/Controller.class.php';

class IndexController extends Controller
{

	public function index($params = null)
	{
		// On set la variable à afficher sur dans la vue
		$this->set('title', 'Accueil | Diapazen');


		// On charge la vue, si l'utilisateur est connecté ou pas
		if ($this->isUserConnected())
		{
			// On fait de rendu de la vue dashboard.php
			$this->render('dashboard');
		}
		else
		{
			// On fait de rendu de la vue home.php
			$this->render('home');
		}
		
	}


}



?>