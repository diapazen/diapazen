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

/**
 * IndexController
 *
 * Contrôleur de la page d'accueil 
 * 
 * @package		Diapazen
 * @subpackage	Controller
 */
class IndexController extends Controller
{
	
	/**
	 * Page d'accueil
	 * 
	 * On set la variable à afficher sur dans la vue et on teste si
	 * l'utilisateur est connécter. Si tel est le cas alors on redirige vers
	 * le dashboard, sino on se rend sur la page home.
	 * 
	 * @param type $params null par défaut
	 */
	public function index($params = null)
	{
		// On set la variable Ã  afficher sur dans la vue
		$this->set('title', 'Accueil | Diapazen');


		// On charge la vue, si l'utilisateur est connectÃ© ou pas
		if ($this->isUserConnected())
		{
			// On redirige vers le dashboard
			header('Location:' . BASE_URL .'/dashboard');
		}
		else
		{
			// On fait de rendu de la vue home.php
			$this->render('home');
		}
		
	}


}

?>