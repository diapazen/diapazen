<?php


/**
 * 
 * Class model d'utilisateur
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

require_once 'system/Model.class.php';

class UserModel extends Model
{

	
	/**
	 * Constructeur
	 */
	public function __construct()
	{
		
	}

	/**
	 * Connexion de l'utilisateur à l'application
	 *
	 * @return	bool true si la connexion s'est bien passé
	 */
	public function connectionToApp()
	{

	}


	/**
	 * Déconnexion de l'utilisateur à l'application
	 *
	 * @return	bool true si la déconnexion s'est bien passé
	 */
	public function disconnectionFromApp()
	{

	}

}

?>