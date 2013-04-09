<?php
/**
 * 
 * Classe parsant l'url du site
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

class Request
{
	private $mUrl;
	private $mController;
	private $mAction;
	private $mParams = array();


	/**
	 * Constructeur
	 */
	public function __construct()
	{
		// URL de base
		$baseUrl = explode('/',trim(BASE_URL,'/'));
		
		// Partie ré-ecrite de l'URL
		$dynUrl = explode('/', trim($_SERVER['REQUEST_URI'], '/'));

		// On fait la différence entre les deux
		$url(array_values(array_diff($dynUrl, $baseUrl)));

		$mController = isset($url[0]) ? $url[0] : "index";
		$mAction = isset($url[1]) ? $url[1] : "index";
		$mParams = array_slice($url, 2);
	}

	/**
	 * Récupère le nom du controller
	 *
	 * @return	string	Nom du controller
	 */
	public function getController()
	{
		return $mController;
	}

	/**
	 * Récupère l'action
	 *
	 * @return	string	Nom de l'action
	 */
	public function getAction()
	{
		return $mAction;
	}

	/**
	 * Récupère les paramètres
	 *
	 * @return	string	Nom des paramètres
	 */
	public function getParams()
	{
		return $mParams;
	}
}

?>