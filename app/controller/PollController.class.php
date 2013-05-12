<?php
/**
 * 
 * Contrôleur de la page d'un sondage
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

require_once 'system/Controller.class.php';

class PollController extends Controller
{
	// poll_step sert à savoir ou on en est dans la création du sondage, et à savoir si l'utilisateur ne tente pas d'accéder à la seconde étape avant la premiere, par exemple
	// contient les valeurs renseignées par l'utilisateur
	/*
	$_SESSION['poll_title'];
	$_SESSION['poll_description'];
	$_SESSION['poll_choices'] = array();

	$_POST['mailConnect'];*/

	public function index($params = null)
	{
		$this->create($params);
	}

	public function create($params = null)
	{

		// On charge le modèle des sondages
		$this->loadModel('poll');

		// lors de l'arrivée sur la page de création
		$_SESSION['poll_step'] = 'init';

		/*session_unregister (string name)*/
		// si c'est la premiere fois, on ne fait rien
		if(!isset($_SESSION['poll_title']) && !isset($_SESSION['poll_description']))
		{


		} 
		else // on a fait précédent, on affiche les valeurs déjà renseignées
		{
			$this->set('poll_title', $_SESSION['poll_title']);
			$this->set('poll_description', $_SESSION['poll_description']);

			/* gérer les choix*/

			$_SESSION['poll_step'] = 'précédent';
		}
		
		/* temporaire, ensuite on mettre le titre de la page*/
		$this->set('title', ' mStep '.$_SESSION['poll_step']);
		// On fait le rendu
		$this->render('pollCreation');
	}

	public function connect($params = null)
	{

		// On charge le modèle des sondages
		$this->loadModel('poll');

		$_SESSION['poll_step'] = 1;

		$_SESSION['poll_title'] = $_POST['title_input'];
		$_SESSION['poll_description'] = $_POST['description_input'];
		$_SESSION['poll_choices'] = $_POST['choices'];

		/* temporaire, ensuite on mettre le titre de la page*/
		$this->set('title', ' mStep '.$_SESSION['poll_step']);
		// On fait le rendu
		$this->render('pollConnection');
	}

	/**
	 * Création d'un sondage
	 * 
	 * url:	diapazen.com/poll/share
	 **/
	public function share($params = null)
	{
		
		/* temporaire, ensuite on mettre le titre de la page*/
		$this->set('title', ' mStep '.$_SESSION['poll_step']);

		$this->loadModel('user');

		// On choisi le rendu par default
		$render='pollConnection';

		try
		{
			//test si un choix a été fait entre la connection et l'inscription et qu'il y a un email
			if(isset($_POST['account']) && isset($_POST['email']) && !empty($_POST['email']))
			{
				$mail = $_POST['email'];
				$ip_addr = $_SERVER['REMOTE_ADDR'];

				//si on a choisi la connection et qu'il y a le mdp on tente de se connecter
				if($_POST['account'] == 'registered' && isset($_POST['password']) && !empty($_POST['password']))
				{

					// echo 'connexion';

					$pwd = $_POST['password'];

					try
					{
						// on vérifie les infos avec la bdd
						$connectStatus = $this->getModel()->connectionToApp($mail, $pwd, $ip_addr);
					}
					catch(Exception $e)
					{
						// IMPORTANT: ERREUR A GERER PROPREMENT !!!!!
						die('Erreur interne survenue.');
					}

				}
				else if($_POST['account'] == 'not_registered' && isset($_POST['firstNameUser']) && isset($_POST['nameUser']) && !empty($_POST['firstNameUser']) && !empty($_POST['nameUser'])) //si on a choisi l'inscription
				{
					// echo 'inscription';
					$firstname = $_POST['firstNameUser'];
					$lastname = $_POST['nameUser'];
					// On crée le mot de passe
					$pwd=$this->getModel()->generatorPsw();

					// On crée l'utilisateur
					// ne pas mettre de champs vide
					$this->getModel()->registration($firstname, $lastname,$mail,$pwd);
					$connectStatus = $this->getModel()->connectionToApp($mail, $pwd, $ip_addr);
				}


				if($connectStatus == false)
				{
					// La connexion a échoué
					$this->setUserDisconnected();

					// On choisi le rendu
					$render='pollConnection';
				}
				else
				{
					// La connexion a réussie
					$this->setUserConnected($connectStatus);

					// On créé le sondage
					$this->loadModel('poll');
					$this->getModel()->addPoll($_SESSION['user_infos']['id'], $_SESSION['poll_title'], $_SESSION['poll_description'], null);
					$pollId = $this->getModel()->getPollId();

					// Insertion des choix
					$this->loadModel('choice');
					foreach ($_SESSION['poll_choices'] as $choice) {
						$this->getModel()->addChoice($choice, $pollId);
					}
					
					// On choisit le rendu
					$render='pollShare';
				}

			}
		}
		catch(Exception $e)
		{
			switch ($e->getMessage()) {
				case 'Email already in db':
					$render = 'pollConnection';
					break;
				
				default:
					# code...
					break;
			}
		}
		// On fait le rendu
		$this->render($render);
	}

	/**
	 * Affichage d'un sondage
	 * 
	 * url:	diapazen.com/poll/view/.../
	 **/
	public function view($params = null)
	{
		
		// L'url du sondage doit être spécifiée
		if (!$params)
			header('Location: ' . BASE_URL);

		// On charge le modèle des sondages
		$this->loadModel('poll');

		try
		{
			// Ajout d'un vote
			if (isset($_POST['value']) && !empty($_POST['value'])
				&& isset($_POST['choiceId']) && count($_POST['choiceId']) > 0)
			{
				foreach($_POST['choiceId'] as $choice)
				{
					if ($this->getModel()->votePoll($choice,$_POST['value']))
					{
						// A afficher ici la confirmation du vote
					}
					else
					{
						// A afficher ici l'erreur du vote
					}
				}
				
			}


			// On récupère les choix et résultats
			$res = $this->getModel()->viewPoll($params[0]);

			// Si le sondage n'a pas été trouvé
			if (!$res)
				$this->e404();
			else
			{
				// Sinon on définit les variables à envoyer à la vue
				$this->set('openedPoll', $res['open']);
				$this->set('urlPoll', $res['url']);
				$this->set('userFName', $res['firstname']);
				$this->set('userLName', $res['lastname']);
				$this->set('eventTitle', $res['title']);
				$this->set('eventDescription', $res['description']);
				$this->set('eventDate', $res['expiration_date']);
				$this->set('choiceList', $res['choices']);

				// On fait le rendu
				$this->render('pollView');
			}
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		
	}
}

?>