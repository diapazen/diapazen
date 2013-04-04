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
		// Parse l'url et stocke dans les variables
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