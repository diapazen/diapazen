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

require_once 'Config.class.php';

class Model
{

	protected $mDbMySql;

	/**
	 * Constructeur
	 *
	 */
	public function __construct()
	{
		
		$this->mDbMySql = $this->connectToDatabase();
	}

	/**
	 * Connexion de la classe à la database
	 *
	 * @return	le PDO
	 */
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
            throw new Exception('Erreur connexion base de donnée ' . $e->getMessage());
        }

	}

	/**
	 * Lecture
	 *
	 * @return	tableau
	 */
	public function read()
	{
		echo'4';
	}

	/**
	 * Lecture
	 *
	 * @return	tableau
	 */
	public function find($data=array())
	{
		try
		{
			$conditions= "1=1";
			$fields= "*";
			$limit= "";
			$order= "id DESC";

			if(isset($data['conditions'])) $conditions=$data['conditions'];
			if(isset($data['fields'])) $fields=$data['fields'];
			if(isset($data['limit'])) $limit=$data['limit'];
			if(isset($data['order'])) $order=$data['order'];

			// selon les paramètres, on récupère les champs, avec conditions, avec un ordre, avec une limite
			$request = $this->mDbMySql->prepare("SELECT $fields FROM diapazen.dpz_view_users WHERE $conditions ORDER BY $order $limit");
			//$request->bindValue(':FIELDS', $fields);
			//$request->bindValue(':CONDITIONS', $conditions);
			//$request->bindValue(':ORDER', $order);
			//$request->bindValue(':LIMITATION', $limit);
			$request->execute();

			$result=array();
			while($data = $request->fetch()){
				$result[]= $data;
			}

			return $result;
		}
		catch(Exception $e) 
        {
            throw new Exception('Erreur connexion base de donnée ' . $e->getMessage());
        }
	}

}

?>