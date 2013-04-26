<?php
/**
 * 
 * Charge le controleur demandé
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

require_once 'Request.class.php';

class Router
{
	private $mRequest;


	/**
	 * Constructeur
	 */
	public function __construct()
	{
		$mRequest = new Request();

		// Récupère le nom du controller à charger
		$ctlName = $mRequest->getController();

		// Modification du nom
		$ctlName = ucfirst($ctlName) . 'Controller';
		$ctlFileName = $ctlName . '.class.php';

		//echo 'On doit charger le fichier ' . $ctlName;
		include CONTROLLER_ROOT . DS . $ctlFileName;

		$controller = new $ctlName();
		$controller->render();

	}
}

?>