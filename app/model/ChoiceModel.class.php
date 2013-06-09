<?php


/**
 * 
 * Class model d'un choix
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

/**
 * ChoiceModel
 *
 * Classe gérant les choix
 * 
 * @package     Diapazen
 * @subpackage  Model
 */
class ChoiceModel extends Model
{
    /** 
     * Titre du choix 
     */
    private $title;

    /** 
     * Valeur du vote 
     */
    private $value;

    /**
    * Constructeur par défaut
    */
    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Ajout d'un choix
    *
    * Insert dans la base de donnée 'dpz_choices' un nouveau choix.
    * Méthode utilisé grâce à la méthode 'inser' de Model
    *
    * @param type $title titre du choix
    * @param type $pollId id du sondage
    *
    * @return boolean true si l'ajout s'est bien exécuté sinon false
    */
    public function addChoice($title, $pollId)
    {
        return $this->insert(array('id' => 'NULL', 'poll_id' => $pollId, 'choice' => $title), 'dpz_choices');
    }
    
    /**
     * Mise à Jour d'un choix
     *
     * Met à jour dans la base de donnée 'dpz_choices' du titre et de l'id du choix.
     * Méthode utilisé grâce à la méthode 'updateWhere' de Model
     *
     * @param type $title titre du choix
     * @param type $id id du choix
     * @return boolean true si l'ajout s'est bien exécuté sinon false
     */
    public function updateChoice($title, $id)
    {
        return $this->updateWhere(array('choice' => $title), array('id' => $id), 'dpz_choices');
    }

    /**
    * Setteur du titre du choix
    *
    * @param type $title titre du choix
    */
    public function setChoiceTitle($title)
    {
        $this->title = $title;
    }

    /**
    * Getteur du titre du choix
    *
    * @return type titre du choix
    */
    public function getChoiceTitle()
    {
        return $this->title;
    }
}

?>