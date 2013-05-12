<?php
/**
 * 
 * Contrôleur de la page de gestion des sondages 
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

class DashboardController extends Controller
{

	public function index($params = null)
	{

		// Titre de la page
		$this->set('title', 'Tableau de bord | Diapazen');
		
		if ($this->isUserConnected())
		{
			$this->loadModel('poll');

			$uid = $this->getUserInfo('id');
			$polls = $this->getModel()->viewAllPolls($uid);
			$this->set('pollList', $polls);
			
			$this->render('dashboard');
		}
		else
			header('Location:' . BASE_URL);
	}

}

?>