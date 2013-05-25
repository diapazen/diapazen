<?php
/**
 * 
 * Fait le chargement du contrôleur selon la requête HTTP
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

		try
		{
			// Instanciation du contrôleur
			$controller = new $ctlName($this->mRequest);
			
			// On appelle la méthode selon l'action de la requête
			if (method_exists($controller, $mRequest->getAction()))
				call_user_func_array(array($controller, $mRequest->getAction()), array($mRequest->getParams()));
			else
				throw new Exception(404);
		}
		catch(Exception $e)
		{

			// On teste si c'est une page 404
			if ($e->getMessage = '404')
			{
				// Le contrôleur est introuvable: 404
				$controller = new Controller($this->mRequest);
				header('HTTP/1.0 404 Not Found');
				die($controller->e404());
			}
			else // Sinon on la relance
				throw $e;
		}

	}
}

?>