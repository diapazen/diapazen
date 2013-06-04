<?php


/**
 * 
 * Cette classe fait le lien entre la base de données et les contrôleurs
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

class Model
{

	/*
	 * Instance de PDO
	 */
	protected static $mPDO;

	/**
	 * Constructeur
	 *
	 */
	public function __construct()
	{	
		try
		{
            $options[PDO::ATTR_ERRMODE]				= PDO::ERRMODE_EXCEPTION;	// Exceptions autorisées
            $options[PDO::MYSQL_ATTR_INIT_COMMAND]	= "SET NAMES utf8";			// L'encodage est en utf-8

            if (isset(Model::$mPDO))
            {
            	// La connexion est déja active
            	return true;
            }
            else
            {
            	// On se connecte à la base de données
            	// le @ désactive les warnings
            	$dbConfig = Config::getDatabaseConfig();
            	$driver = sprintf('mysql:host=%s;dbname=%s', $dbConfig['host'], $dbConfig['name']);
        		Model::$mPDO = @new PDO($driver, $dbConfig['user'], $dbConfig['pass'], $options);
        	}
        }
        catch(Exception $e) 
        {
        	die('<html><head><meta charset="utf-8" /></head><body><strong>Impossible de se connecter à la base de données.</strong><div>Vérifiez le fichier de configuration.</div></body></html>');
        }
	}

	/**
	 * Récupère l'instance de PDO
	 *
	 * @return	Instance de PDO
	 */
	public function getPDO()
	{
		return Model::$mPDO;
	}


	/**
	 * Récupère des informations d'une table ou d'une vue de la base de données.
	 *
	 * @param 	array|string 	$fields Champs de la table
	 * @param	string			$table	Table de la base de données
	 * @return	Un tableau de résultats
	 */
	public function select($fields, $table, $fetchMode = 'both')
	{
		// Accepte un tableau ou une string
		$fields = is_array($fields) ? implode(', ', $fields) : $fields;
		$query = sprintf("SELECT %s FROM %s", $fields, $table);
		$request = $this->getPDO()->prepare($query);
		$request->execute();
		switch ($fetchMode)
		{
			case 'assoc':
				$ret = $request->fetchAll(PDO::FETCH_ASSOC);
				break;

			case 'num':
				$ret = $request->fetchAll(PDO::FETCH_NUM);
				break;
			
			default:
				$ret = $request->fetchAll(PDO::FETCH_BOTH);
				break;
		}
		return $ret;
	}

	/**
	 * Récupère des informations d'une table ou d'une vue de la base de données.
	 *
	 * @param 	array|string 	$fields 	Champs de la table
	 * @param	string			$table		Table de la base de données
	 * @param	array			$conditions	Un tableau ASSOCIATIF des conditions
	 * @return	Un tableau de résultats
	 */
	public function selectWhere($fields, $table, $conditions, $fetchMode = 'both')
	{
		$fields = is_array($fields) ? implode(', ', $fields) : $fields;

		// On met en forme la partie de la requête sql
		$sqlWhere = "";
		for($i = 0; $i < count($conditions); $i++)
		{
			$sqlWhere .= array_keys($conditions)[$i]."= :".strtoupper(array_keys($conditions)[$i]);
			$sqlWhere .= $i < count($conditions) - 1 ? " AND " : ""; 
		}
		
		$query = sprintf("SELECT %s FROM %s WHERE %s", $fields, $table, $sqlWhere);
		$request = $this->getPDO()->prepare($query);

		// On binde les conditions
		foreach ($conditions as $key => $value)
			$request->bindValue(strtoupper(':'.$key), htmlspecialchars($value));

		$request->execute();
		switch ($fetchMode)
		{
			case 'assoc':
				$ret = $request->fetchAll(PDO::FETCH_ASSOC);
				break;

			case 'num':
				$ret = $request->fetchAll(PDO::FETCH_NUM);
				break;
			
			default:
				$ret = $request->fetchAll(PDO::FETCH_BOTH);
				break;
		}
		return $ret;
	}

	/**
	 * Récupère des informations d'une table ou d'une vue de la base de données.
	 *
	 * @param 	array|string 	$fields 	Champs de la table
	 * @param	string			$table		Table de la base de données
	 * @param	array			$conditions	Un tableau ASSOCIATIF des conditions
	 * @param	array			$orderby	Un tableau ex: array('nom desc', 'prenom asc')
	 * @return	Un tableau de résultats
	 */
	public function selectWhereOrderBy($fields, $table, $conditions, $orderby, $fetchMode = 'both')
	{
		$fields = is_array($fields) ? implode(', ', $fields) : $fields;

		// On met en forme la partie de la requête sql
		$sqlWhere = "";
		for($i = 0; $i < count($conditions); $i++)
		{
			$sqlWhere .= array_keys($conditions)[$i]."= :".strtoupper(array_keys($conditions)[$i]);
			$sqlWhere .= $i < count($conditions) - 1 ? " AND " : ""; 
		}
		
		$query = sprintf("SELECT %s FROM %s WHERE %s ORDER BY %s", $fields, $table, $sqlWhere, implode(', ', $orderby));
		$request = $this->getPDO()->prepare($query);

		// On binde les conditions
		foreach ($conditions as $key => $value)
			$request->bindValue(strtoupper(':'.$key), htmlspecialchars($value));

		$request->execute();
		switch ($fetchMode)
		{
			case 'assoc':
				$ret = $request->fetchAll(PDO::FETCH_ASSOC);
				break;

			case 'num':
				$ret = $request->fetchAll(PDO::FETCH_NUM);
				break;
			
			default:
				$ret = $request->fetchAll(PDO::FETCH_BOTH);
				break;
		}
		return $ret;
	}

	/**
	 * Insère des données dans la base de données
	 *
	 * @param 	array		 	$values 	Tableau ASSOCIATIF des valeurs à insérer
	 * @param	string			$table		Table de la base de données
	 * @return	Vrai si réussite sinon Faux
	 */
	public function insert($values, $table)
	{
		$sqlValues = "";
		for($i = 0; $i < count($values); $i++)
		{
			$sqlValues .= strtoupper(":".array_keys($values)[$i]);
			$sqlValues .= $i < count($values) - 1 ? ", " : ""; 
		}

		$query = sprintf("INSERT INTO %s (%s) VALUES (%s)", 
							$table,
							implode(', ', array_keys($values)),
							$sqlValues
							);

		$request = $this->getPDO()->prepare($query);
		
		// On binde les valeurs
		foreach ($values as $key => $value)
			$request->bindValue(strtoupper(':'.$key), htmlspecialchars($value));

		return $request->execute();
	}


	/**
	 * Met à jour un enregistrement de la table
	 *
	 * @param 	array		 	$values 	Un tableau ASSOCIATIF des valeurs
	 * @param	array			$conditions	Un tableau ASSOCIATIF des conditions
	 * @param	string			$table		Table de la base de données
	 * @return	Vrai si réussite sinon Faux
	 */
	public function updateWhere($values, $conditions, $table)
	{
		$sqlSet = "";
		for($i = 0; $i < count($values); $i++)
		{
			$sqlSet .= array_keys($values)[$i]."= :".strtoupper(array_keys($values)[$i]);
			$sqlSet .= $i < count($values) - 1 ? ", " : ""; 
		}

		$sqlWhere = "";
		for($i = 0; $i < count($conditions); $i++)
		{
			$sqlWhere .= array_keys($conditions)[$i]."= :".strtoupper(array_keys($conditions)[$i]);
			$sqlWhere .= $i < count($conditions) - 1 ? " AND " : ""; 
		}
		
		$query = sprintf("UPDATE %s SET %s WHERE %s", $table, $sqlSet, $sqlWhere);
		$request = $this->getPDO()->prepare($query);

		foreach ($conditions as $key => $value)
			$request->bindValue(strtoupper(':'.$key), htmlspecialchars($value));
		foreach ($values as $key => $value)
			$request->bindValue(strtoupper(':'.$key), htmlspecialchars($value));

		return $request->execute();
	}

	/**
	 * Supprime un enregistrement de la table
	 *
	 * @param	array			$conditions	Un tableau ASSOCIATIF des conditions
	 * @param	string			$table		Table de la base de données
	 * @return	Vrai si réussite sinon Faux
	 */
	public function deleteFrom($conditions, $table)
	{
		$sqlWhere = "";
		for($i = 0; $i < count($conditions); $i++)
		{
			$sqlWhere .= array_keys($conditions)[$i]."= :".strtoupper(array_keys($conditions)[$i]);
			$sqlWhere .= $i < count($conditions) - 1 ? " AND " : ""; 
		}
		
		$query = sprintf("DELETE FROM %s WHERE %s", $table, $sqlWhere);
		$request = $this->getPDO()->prepare($query);

		// On binde les conditions
		foreach ($conditions as $key => $value)
			$request->bindValue(strtoupper(':'.$key), htmlspecialchars($value));

		return $request->execute();
	}

}

?>