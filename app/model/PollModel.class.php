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
        
        private $pollId;
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
     * Affichage d'un sondage en
     * récupèrant les informations stockées dans la base de données au moyen
     * d’une requête sql Select sur la vue dpz_view_users_join_polls. On traite
     * le résultat obtenu en récupérant les informations de chaque choix du
     * sondage ainsi que les informations de chaque résultat des choix du
     * sondage. Les résultats obtenus sont ensuite transférés dans un tableau
     * et on calcule le pourcentage de chaque choix du sondage. Le tableau est
     * donc complété avec ces mêmes pourcentages.
     * @param type $pollUrl url du sondage
     * @return array contenu du sondage
     */
    public function viewPoll($pollUrl)
    {
        try
        {   
            // On récupère les informations de base du sondage
            $fields = 'firstname, lastname, POLL_ID, title, description, creation_date, expiration_date, open, url';
            $conditions = array('url' => $pollUrl);
            $pollInfo = $this->selectWhere($fields, 'dpz_view_users_join_polls', $conditions, 'assoc');
            
            // On traite le résultat
            if(!empty($pollInfo))
            {
                $pollInfo = $pollInfo[0];

                // On récupère les informations de chaque choix du sondage de la bdd
                $results = $this->selectWhere('CHOICE_ID,value', 'dpz_view_choice', array('POLL_ID' => $pollInfo['POLL_ID']), 'assoc');

                // On récupère les informations de chaque résultat des choix du sondage de la bdd
                $choices = $this->selectWhere('CHOICE_ID,choice', 'dpz_view_poll', array('POLL_ID' => $pollInfo['POLL_ID']), 'assoc');

                // Traitements des résultats
                $list = array();
                $nbTotalVotes = 0;
                foreach($choices as $choice)
                {
                    $id = $choice['CHOICE_ID'];
                    $list[$id]['choiceName'] = htmlspecialchars($choice['choice']);
                    $list[$id]['checkList'] = array();
                    foreach($results as $result)
                    {
                        $rid = $result['CHOICE_ID'];
                        if ($id == $rid)
                        {
                            $list[$id]['checkList'][] = htmlspecialchars($result['value']);
                            $nbTotalVotes++;
                        }
                    }
                }

                // calcul du pourcentage
                foreach($list as &$elem)
                {
                    if (count($elem['checkList']) != 0)
                        $elem['percent'] = (int) round((count($elem['checkList']) / $nbTotalVotes) * 100);
                    else
                        $elem['percent'] = 0;
                }
                
                // On prépare le tableau de retour
                $ret = $pollInfo;
                $ret['nbVotes'] = $nbTotalVotes;
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
     * créé par l’utilisateur en prenant en paramètre l’Id de l’utilisateur avec
     * une requête select sur la vue dpz_view_users_join_polls.
     * @param type $pollUrl url du sondage
     * @return array contenu du sondage
     */
    public function viewAllPolls($userId)
    {

        $fields = array('title', 'description', 'open', 'url', 'POLL_ID', 'expiration_date', 'creation_date');
        $view   = 'dpz_view_users_join_polls';
        $where  = array('USER_ID' => $userId);
        $orderBy = array('open desc', 'creation_date desc');
        
        return $this->selectWhereOrderBy($fields, $view, $where, $orderBy, 'assoc');
    }
    
    /**
     * Ajout d'un sondage
     * On commence par affecter les valeurs des propriétés de l’objet et on
     * ajoute la ligne correspondante à la base de données.
     * @param type $userId id de l'utilisateur
     * @param type $pollTitle titre du sondage
     * @param type $pollDescription description du sondage
     * @param type $poll_expiration_date date d'expiration du sondage
     * @return boolean true si l'ajout s'est bien exécuté sinon false
     */
    public function addPoll($userId, $pollTitle, $pollDescription, $poll_expiration_date)
    {

        //on set les valeurs
        $this->setPollTitle($pollTitle);
        $this->setPollDescription($pollDescription);
        $this->setPollExpirationDate($poll_expiration_date);

        // Url unique du sondage. ex: h8ddf2e561
        $this->setPollUrl(substr(md5(uniqid()),5,10));

        $values = array('id'                => 'NULL',
                        'user_id'           => $userId,
                        'url'               => $this->getPollUrl(),
                        'title'             => $this->getPollTitle(),
                        'description'       => $this->getPollDescription(),
                        'expiration_date'   => $this->getPollExpirationDate(),
                        'open'              => '1'
                        );
        // Insertion dans la base de données
        if ($this->insert($values, 'dpz_polls'))
        {
            $this->setPollId($this->getPDO()->lastInsertId());
            return true;
        }

        return false;
    }

    /**
     * Vote d'un sondage
     * pour le choix du sondage grâce à l’Id du choix et la valeur du votant.
     * On insère cette ligne dans la base de données, dans la table dpz_results.
     * @param int $choiceId L'id du choix
     * @param string $pollTitle valeur à insérer
     * @return boolean true si l'ajout s'est bien exécuté sinon false
     */
    public function votePoll($choiceId, $value)
    {
        return $this->insert(array('id' => 'NULL', 'choice_id' => $choiceId, 'value' => $value), 'dpz_results');
    }
    
    /**
     * Mise à jour de la table Sondage
     * clos le sondage en mettant à 0 dans la colonne open de la table du sondage.
     * @return boolean true si la mise à jour s'est bien exécuté sinon false
     */
    public function updatePoll($pollId)
    {
        return $this->updateWhere(array('open' => '0'), array('id' => $pollId), 'dpz_polls');
    }

    /**
     * Récupère le contenu du textarea et parse les emails au moyen d'une
     * regexp. Elle retourne un tableau avec les email si le parsage est réussi
     * et null sinon.
     * @param $texteareaContent
     * @return Tableau avec les emails valides auquels les mails ont été envoyé
     */
    public function sharePoll($texteareaContent)
    {

        $emails = preg_split("/[\r\n\t,; ]+/", $texteareaContent, -1, PREG_SPLIT_NO_EMPTY);

        $emails = array_unique($emails);

        $regexMail = '#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#';
        foreach($emails as $current)
        {
            // Evite les failles XSS
            $current = htmlspecialchars($current);
            
            if(!preg_match($regexMail, $current))
            {
                unset($emails[array_search($current, $emails)]);
            }
        }

        if (!isset($emails))
        {
            return null;
        }

        return $emails;
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
     * Setteur de l'id du sondage
     * @param type $pollId Id du sondage
     */
    public function setPollId($pollId)
    {
        $this->pollId = $pollId;
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
    public function getPollId()
    {
        return $this->pollId;
    }
    /**
     * Getteur de l'id du sondage
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