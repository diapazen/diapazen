<?php


/**
 * 
 * Class model d'un sondage
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

class PollModel extends Model
{
        
        private $pollUrl;
        private $pollTitle;
        private $pollDescription;
        private $poll_expiration_date;


        /**
	 * Constructeur par défaut
	 */
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * Construction d'un sondage
     * @param type $pollTitle titre du sondage
     * @param type $pollDescription description du sondage
     * @param type $poll_expiration_date date d'expiration du sondage
     */
    public function getPollView($pollUrl)
    {
        try
        {
            // On récupère les informations du sondage de la bdd
            $request = $this->mDbMySql->prepare("SELECT title,description,expiration_date,CHOICE_ID,choice FROM diapazen.dpz_view_poll WHERE dpz_view_poll.url=:URL;");
            $request->bindValue(':URL', $pollUrl);
            $request->execute();
            $results=$request->fetch(PDO::FETCH_ASSOC);
/*
            // On traite le résultat
            if(!is_null($results))
            {
                $ret = array();

                $ret['title'] = $results[0]['title'];
                $ret['description'] = $results[0]['description'];
                $ret['expire'] = $results[0]['expire'];
                foreach ($results as $choice => $value)
                {
                    $ret['choices'][] = 
                }
            }

            return null;*/
        return $results;
        }
        catch(Exception $e) 
        {
            throw new Exception('Erreur lors de la tentative de connexion :</br>' . $e->getMessage());
        }
    }

        
        /**
         * Création d'une chaine de caractère aléatoire
         * @param type $number nombre de caractères
         * @return string la chaine de caractère
         */
        private function randomString($number)
        {
            $string = "";
            $chaine = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            srand((double)microtime()*1000000);
            for($i=0; $i<$number; $i++) {
            $string .= $chaine[rand()%strlen($chaine)];
            }
            return $string;
        }
        
        /**
         * Ajout d'un sondage
         * @param type $userId id de l'utilisateur
         * @param type $pollTitle titre du sondage
         * @param type $pollDescription description du sondage
         * @param type $poll_expiration_date date d'expiration du sondage
         * @return boolean true si l'ajout s'est bien exécuté sinon false
         */
        public function addPoll($userId, $pollTitle, $pollDescription, $poll_expiration_date)
        {
            try
            {
                //on set les valeurs
                $this->setPollTitle($pollTitle);
                $this->setPollDescription($pollDescription);
                $this->setPollExpirationDate($poll_expiration_date);
                $this->setPollUrl($this->randomString(11));
                while($this->compareUrlString() == FALSE)
                {
                    $this->setPollUrl($this->randomString(11));
                }
                
                //on créer la requete pour créer une ligne d'un nouveau sondage
                $request = $this->mDbMySql->prepare("INSERT INTO `diapazen`.`dpz_polls` 
                            (`id`, `user_id`, `url`, `title`, `description`, `expiration_date`, `open`) 
                            VALUES (NULL, :USERID, :URL, :TITLE, :DESCRIPTION, :EXPIRATIONDATE, 1);");
                $request->bindValue(':USERID', $userId);
                $request->bindValue(':URL', $this->getPollUrl());
                $request->bindValue(':TITLE', $pollTitle);
                $request->bindValue(':DESCRIPTION', $pollDescription);
                $request->bindValue(':EXPIRATIONDATE', $poll_expiration_date);
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
                throw new Exception('Erreur lors de la tentative d\'ajout d\'un sondage :</br>' . $e->getMessage());
            }
        }
        
        /**
         * Mise à jour de la table Sondage
         * @return boolean true si la mise à jour s'est bien exécuté sinon false
         */
        public function updatePoll()
        {
            try
            {
                $request = $this->mDbMySql->prepare("UPDATE `diapazen.dpz_polls` SET `open`=0 WHERE expiration_date < :TIME;");
                $request->bindValue(':TIME', time());
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
                throw new Exception('Erreur lors de la mise a jour de la table sondage :</br>' . $e->getMessage());
            }
        }
        
        /**
         * Modification d'un sondage
         * @param type $pollTitle titre du sondage
         * @param type $pollDescription description du sondage
         * @param type $poll_expiration_date date d'expiration du sondage
         * @return boolean true si la modification s'est bien exécuté sinon false
         */
        public function modifPoll($pollTitle, $pollDescription, $poll_expiration_date)
        {
            try
            {
                $this->setPollTitle($pollTitle);
                $this->setPollDescription($pollDescription);
                $this->setPollExpirationDate($poll_expiration_date);
                $request = $this->mDbMySql->prepare("UPDATE diapazen.dpz_polls SET
                            `title`=:TITLE,`description`=:DESCRIPTION,`expiration_date`=:EXPIRATIONDATE 
                            WHERE dpz_polls.url=:URL;");
                $request->bindValue(':URL', $this->getPollUrl());
                $request->bindValue(':TITLE', $pollTitle);
                $request->bindValue(':DESCRIPTION', $pollDescription);
                $request->bindValue(':EXPIRATIONDATE', $poll_expiration_date);
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
                throw new Exception('Erreur lors de la modification du sondage :</br>' . $e->getMessage());
            }
        }
        
        /**
         * Compare l'Url du sondage et l'url de tous les sondages existants
         * @return boolean true si l'url est unique false sinon
         */
        public function compareUrlString()
        {
            $url = $this->getPollUrl;
            $request = $this->mDbMySql->prepare("SELECT url FROM diapazen.dpz_polls");
            $request->execute();
            while($lignes = $request->fetch(PDO::FETCH_NUM))
            {
                if($lignes[0] == $url)
                {
                    return FALSE;
                }
            }
            return TRUE;
        }
        
        /**
         * Setteur du titre du sondage
         * @param type $pollTitle titre du sondage
         */
        public function setPollTitle($pollTitle)
        {
            $this->pollTitle = $pollTitle;
        }
        
        /**
         * Setteur de la description du sondage
         * @param type $pollDescription description du sondage
         */
        public function setPollDescription($pollDescription)
        {
            $this->pollDescription = $pollDescription;
        }
        
        /**
         * Setteur de la date d'expiration du sondage
         * @param type $poll_expiration_date date d'expiration du sondage
         */
        public function setPollExpirationDate($poll_expiration_date)
        {
            $this->poll_expiration_date = $poll_expiration_date;
        }
        
        /**
         * Setteur de l'url du sondage
         * @param type $pollUrl url du sondage
         */
        public function setPollUrl($pollUrl)
        {
            $this->pollUrl = $pollUrl;
        }
        
        /**
         * Getteur du titre du sondage
         */
        public function getPollTitle()
        {
            return $this->pollTitle;
        }
        
        /**
         * Getteur de la description du sondage
         */
        public function getPollDescription()
        {
            return $this->pollDescription;
        }
        
        /**
         * Getteur de la date d'expiration du sondage
         */
        public function getPollExpirationDate()
        {
            return $this->poll_expiration_date;
        }
        
        /**
         * Getteur de l'url du sondage
         */
        public function getPollUrl()
        {
            return $this->pollUrl;
        }

}

?>