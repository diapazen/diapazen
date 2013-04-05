<?php
/**
 * 
 * Fichier de configuration de Diapazen
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

class Config
{

	// Configurations possibles de la base de données
	private static $mDb = array(
						'default'	=>	array(
												'host'	=>	'localhost',
												'user'	=>	'root',
												'pass'	=>	'',
												'name'	=>	'diapazen'
																	)
						);

	 /**
	 * Récupère la configuration de la base de donnée voulue.
	 * 
	 * @param	string	$configName	Nom de la configuration à utiliser
	 * @return	array	La configuration voulue
	 */
	public static function getDatabaseConfig($configName = '')
	{
		return (empty($configName) || !array_key_exists($configName, self::$mDb))  ? self::$mDb['default'] : self::$mDb[$configName];
	}

}


?>