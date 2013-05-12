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
     * Affichage d'un sondage
     * @param type $pollUrl url du sondage
     * @return array contenu du sondage
     */
    public function viewPoll($pollUrl)
    {
        try
        {   
            // On récupère les informations de base du sondage
            $request = $this->mDbMySql->prepare("SELECT firstname,lastname,POLL_ID,title,description,expiration_date,open,url FROM dpz_view_users_join_polls WHERE url=:URL;");
            $request->bindValue(':URL', $pollUrl);
            $request->execute();
            $pollInfo=$request->fetch(PDO::FETCH_ASSOC);
            
            // On traite le résultat
            if($pollInfo)
            {
                // On récupère les informations de chaque choix du sondage de la bdd
                $request = $this->mDbMySql->prepare("SELECT CHOICE_ID,value FROM dpz_view_choice WHERE POLL_ID=:ID;");
                $request->bindValue(':ID', $pollInfo['POLL_ID']);
                $request->execute();
                $results=$request->fetchAll(PDO::FETCH_ASSOC);

                // On récupère les informations de chaque résultat des choixdu sondage de la bdd
                $request = $this->mDbMySql->prepare("SELECT CHOICE_ID,choice FROM dpz_view_poll WHERE POLL_ID=:ID;");
                $request->bindValue(':ID', $pollInfo['POLL_ID']);
                $request->execute();
                $choices=$request->fetchAll(PDO::FETCH_ASSOC);

                $list = array();
                foreach($choices as $choice)
                {
                    $id = $choice['CHOICE_ID'];
                    $list[$id]['choiceName'] = $choice['choice'];
                    $list[$id]['checkList'] = array();
                    foreach($results as $result)
                    {
                        $rid = $result['CHOICE_ID'];
                        if ($id == $rid)
                            $list[$id]['checkList'][] = $result['value'];
                    }
                }
                
                // On prépare le tableau de retour
                $ret = $pollInfo;
                $ret['choices'] = $list;
                return $ret;
            }

            return false;
        }
        catch(Exception $e) 
        {
            throw new Exception('Erreur lors de la tentative de connexion :</br>' . $e->getMessage());
        }
    }

    /**
     * Affichage de la liste des sondages
     * @param type $pollUrl url du sondage
     * @return array contenu du sondage
     */
    public function viewAllPolls($userId)
    {
        try
        {   
            $request = $this->mDbMySql->prepare("SELECT title,description,open,url FROM dpz_view_users_join_polls WHERE USER_ID=:UID;");
            $request->bindValue(':UID', $userId);
            $request->execute();
            return $request->fetchAll(PDO::FETCH_ASSOC);
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
         * Ajout d'un sondage
         * @param int $choiceId L'id du choix
         * @param string $pollTitle valeur à insérer
         * @return boolean true si l'ajout s'est bien exécuté sinon false
         */
        public function votePoll($choiceId, $value)
        {
            try
            {
                $request = $this->mDbMySql->prepare("INSERT INTO dpz_results
                            (`id`, `choice_id`, `value`) 
                            VALUES (NULL, :CHOICEID, :VALUE);");
                $request->bindValue(':CHOICEID', $choiceId);
                $request->bindValue(':VALUE', $value);
                
                return $request->execute();
            }
            catch(Exception $e)
            {
                throw new Exception('Erreur lors de la tentative d\'ajout d\'une réponse :</br>' . $e->getMessage());
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
         * Suppression d'un sondage
         * @param type $pollId identifient du sondage
         * @return boolean true si la suppression s'est bien exécuté sinon false
         */
        public function deletePoll($pollId)
        {
            try
            {
                $this->setPollTitle(NULL);
                $this->setPollDescription(NULL);
                $this->setPollExpirationDate(NULL);
                $this->setPollUrl(NULL);
                $request = $this->mDbMySql->prepare("DELETE FROM `diapazen.dpz_polls` WHERE id=:ID");
                $request->bindValue(':ID', $pollId);
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
                throw new Exception('Erreur lors de la suppression du sondage :</br>' . $e->getMessage());
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
         * Récupère le contenu du textarea et parse les emails
         * @return boolean true si l'url est unique false sinon
         */
        public function sharePoll($texteareaContent)
        {

            $emails = preg_split("/[\r\n,;]+/", $texteareaContent, -1, PREG_SPLIT_NO_EMPTY);

            $emails = array_unique($emails);

            $regexMail = '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#';
            foreach($emails as $current)
            {
                if(!preg_match($regexMail, $current))
                {
                    unset($emails[array_search($current, $emails)]);
                }
            }


            // Envoi mail aux valeurs de $emails


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