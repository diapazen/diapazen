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

class ChoiceModel extends Model
{
        private $title;
        private $value;

        /**
        *Constructeur par défaut 
        */
        public function __construct()
        {
            parent::__construct();
        }

        /**
        * Ajout d'un choix
        * @param type $title titre du choix
        * @param type $pollId id du sondage
        * @return boolean true si l'ajout s'est bien exécuté sinon false
        */
        public function addChoice($title, $pollId)
        {
            try
            {
                $this->setChoiceTitle($title);
                $request = $this->mDbMySql->prepare("INSERT INTO `diapazen`.`dpz_choices`
                            (`id`, `poll_id`, `choice`) VALUES (NULL,:POLLID,:CHOICE);");
                $request->bindValue(':POLLID', $pollId);
                $request->bindValue(':CHOICE', $title);
                $check = $request->execute();

                //on renvoie true si l'ajout a été un succés sinon false
                if($check == 1) 
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $e)
            {
                throw new Exception('Erreur lors de la tentative d\'ajout d\'un choix :</br>' . $e->getMessage());
            }
        }
        
        /**
         * Mise à Jour d'un choix
         * @param type $title titre du choix
         * @param type $id id du choix
         * @return boolean true si l'ajout s'est bien exécuté sinon false
         */
        public function updateChoice($title, $id)
        {
            try
            {
               $this->setChoiceTitle($title);
               $request = $this->mDbMySql->prepare("UPDATE diapazen.dpz_choices 
                            SET`choice`=:TITLE WHERE dpz_choices.id=:ID;");
               $request->bindValue(':CHOICE', $title);
                $check = $request->execute();

                //on renvoie true si l'ajout a été un succés sinon false
                if($check == 1) 
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $e)
            {
                throw new Exception('Erreur lors de la tentative de mise à jour d\'un choix :</br>' . $e->getMessage());
            }
        }
        
        public function deleteChoice($id)
        {
            try
            {
                $this->setChoiceTitle(NULL);
                $request = $this->mDbMySql->prepare("DELETE FROM `diapazen.dpz_choices` WHERE id=:ID");
                $request->bindValue(':ID', $id);
                $check = $request->execute();
                if($check == 1) 
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            catch(Exception $e)
            {
                throw new Exception('Erreur lors de la tentative de suppression d\'un choix :</br>' . $e->getMessage());
            }
        }

        /**
        * Setteur du titre du choix
        * @param type $title titre du choix
        */
        public function setChoiceTitle($title)
        {
            $this->title = $title;
        }

        /**
        * Getteur du titre du choix
        */
        public function getChoiceTitle()
        {
            return $this->title;
        }
}

?>