<?php


/**
 * 
 * Class model du framework
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

require_once '../config/Config.class.php';

class Model
{

	private $mDbMySql;

	public function __construct()
	{
		
		$this->mDbMySql = $this->connectToDatabase();
		
	}

	public function connectToDatabase()
	{
		try
		{

			$dataBaseConfig = Config::getDatabaseConfig();
            $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;

        	return new PDO('mysql:host='.$dataBaseConfig['host'], $dataBaseConfig['user'], $dataBaseConfig['pass'], $options);

        }
        catch(Exception $e)
        {
            // throw new Exception('Erreur connexion base de donnée ' . $e->getMessage());
        }

	}

}

?>