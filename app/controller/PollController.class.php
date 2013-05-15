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
require_once 'util/MailUtil.class.php';

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
		// on a fait précédent, on affiche les valeurs déjà renseignées
		if(isset($_SESSION['poll_title']) && isset($_SESSION['poll_description']) && isset($_SESSION['poll_choices']))
		{
			$this->set('poll_title', $_SESSION['poll_title']);
			$this->set('poll_description', $_SESSION['poll_description']);
			$this->set('poll_choices', $_SESSION['poll_choices']);
			// modifier la vue pour qu'elle affiche les choix (le navigateur web le gère automatiquement)

			$_SESSION['poll_step'] = 'précédent';
		}
		
		/* temporaire, ensuite on mettra le titre de la page*/
		$this->set('title', ' mStep '.$_SESSION['poll_step']);
		// On fait le rendu
		$this->render('pollCreation');
	}

	public function connect($params = null)
	{
		// echo 'connect';
		// echo '<pre>';
		// print_r($_POST['choices']);
		// echo '</pre>';
		if (isset($_POST['title_input']) && isset($_POST['description_input']) && isset($_POST['choices']))
		{
			$_SESSION['poll_step'] = 1;

			$_SESSION['poll_title'] = $_POST['title_input'];
			$_SESSION['poll_description'] = $_POST['description_input'];
			$_SESSION['poll_choices'] = $_POST['choices'];
			// Test si les variables sont vides // TODO ameliorer le test pour les choix
			if (empty($_POST['title_input']) || empty($_POST['description_input']) || empty($_POST['choices']))
			{
				// renvoyer a Poll create avec un message disant champ(s) vide(s)
				header('Location: ' . BASE_URL. '/poll/create');
			}
			else
			{
				// si l'utilisateur est déja connecté
				if ($this->isUserConnected())
				{
					header('Location: ' . BASE_URL. '/poll/share');
				}
				else
				{
					/* temporaire, ensuite on mettra le titre de la page*/
					$this->set('title', ' mStep '.$_SESSION['poll_step']);
					// On fait le rendu
					$this->render('pollConnection');
				}
			}
		}
		else
		{
			// renvoyer a Poll create avec un message disant champs inexistants
			header('Location: ' . BASE_URL. '/poll/create');
		}
	}

	/**
	 * Création d'un sondage
	 * 
	 * url:	diapazen.com/poll/share
	 **/
	public function share($params = null)
	{
		// echo 'share';
		/* temporaire, ensuite on mettra le titre de la page*/
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

				} //si on a choisi l'inscription et qu'il y a le nom et prenom on l'inscrit
				else if($_POST['account'] == 'not_registered' && isset($_POST['firstNameUser']) && isset($_POST['nameUser']) && !empty($_POST['firstNameUser']) && !empty($_POST['nameUser']))
				{
					$firstname = $_POST['firstNameUser'];
					$lastname = $_POST['nameUser'];
					// On crée le mot de passe
					$pwd=$this->getModel()->generatorPsw();

					// On crée l'utilisateur
					// ne pas mettre de champs vide
					$this->getModel()->registration($firstname, $lastname,$mail,$pwd);
					$connectStatus = $this->getModel()->connectionToApp($mail, $pwd, $ip_addr);

					$subjet = 'Inscription sur Diapazen';

					$message = 'Bounjour '.$firstname.' '.$lastname.',<br />'.
								'Suite à votre inscrption sur <a href="localhost'.BASE_URL.'">Diapazen</a> Nous vous transmettons votre mot de passe.<br />
								Votre mot de passe est :'.$pwd.'<br />
								<br />
								A bientot sur Diapazen !';

					$mailer = new MailUtil();
					$mailer->sendMail($mail,$subjet,$message);

					//TODO envoyer un mail avec le mdp
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

				}

			}

			// si l'utilisateur est déja connecté
			if ($this->isUserConnected())
			{
				if (isset($_SESSION['poll_title']) && isset($_SESSION['poll_description']) && isset($_SESSION['poll_choices']))
				{
					// On créé le sondage
					$this->loadModel('poll');
					$this->getModel()->addPoll($_SESSION['user_infos']['id'], $_SESSION['poll_title'], $_SESSION['poll_description'], null);
					$pollId = $this->getModel()->getPollId();

					$_SESSION['poll_url'] = $this->getModel()->getPollUrl();

					$this->set('pollUrl', $_SESSION['poll_url']);

					// Insertion des choix
					$this->loadModel('choice');
					foreach ($_SESSION['poll_choices'] as $choice) {
						$this->getModel()->addChoice($choice, $pollId);
					}
					
					// On choisit le rendu
					$render='pollShare';
				}
				else
				{
					// renvoyer a Poll create avec un message disant champs inexistants
					header('Location: ' . BASE_URL. '/poll/create');
				}
			}
			else
			{
				// renvoyer a Poll connect avec un message disant user non connecté
				header('Location: ' . BASE_URL. '/poll/connect');
			}


		}
		catch(Exception $e)
		{
			switch ($e->getMessage()) {
				case 'Email already in db':
					$render = 'pollConnection';
					break;
				
				default:
					// code...
					break;
			}
		}
		// On fait le rendu
		$this->render($render);
	}


	public function sharePoll($params = null)
	{
		if (isset($_POST['mails']) && !empty($_POST['mails']) && isset($_SESSION['poll_url']) && !empty($_SESSION['poll_url']))
		{
			$this->loadModel('poll');
			$lien = 'localhost'.BASE_URL.'/poll/view/'.$_SESSION['poll_url'];
			$from = $this->getUserInfo('firstname').' '.$this->getUserInfo('lastname');
			$mailSend = $this->getModel()->sharePoll($_POST['mails'], $from, $_SESSION['poll_title'], $_SESSION['poll_description'], $lien);
			echo 'les mails ont été envoyé (TODO gerer les erreur mails)';
			echo "<pre>";
			print_r($mailSend);
			echo "</pre>";
		}
		else
		{
			// renvoyer a Poll share avec un message disant pas de mails
			header('Location: ' . BASE_URL. '/poll/share');
		}
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
			if (isset($_POST['value']))
			{
				if (!empty($_POST['value']) && isset($_POST['choiceId']))
				{
					foreach($_POST['choiceId'] as $choice)
					{
						if ($this->getModel()->votePoll($choice,$_POST['value']))
						{
							// vote pris en compte
							$this->set('data_updated', true);
						}
						else
						{
							// echec du vote
							$this->set('data_updated', false);
						}
					}
				}
				else
				{
					//echec du vote
					$this->set('data_updated', false);
				}	
			}

			// On récupère les choix et résultats
			$res = $this->getModel()->viewPoll($params[0]);

			// Si le sondage n'a pas été trouvé
			if (!$res)
				$this->e404();
			else
			{
				// Si le sondage est expiré
				$date = new DateTime($res['expiration_date']);
            	$now  = new DateTime('now');
            	$int = $now->diff($date);
				if ($int->invert == 1)
				{
					$res['open'] = false;
					$this->set('eventDate', 'Le sondage est fermé.');
					try
					{
						$this->getModel()->updatePoll($res['POLL_ID']);
					}
					catch(Exception $e)
					{
						die("erreur de mise à jour");
					}
				}
				else
					$this->set('eventDate', $int->format('Le sondage expire dans: %d jour(s) et %h heure(s).'));

				// on définit les variables à envoyer à la vue
				$this->set('openedPoll', $res['open']);
				$this->set('urlPoll', $res['url']);
				$this->set('userFName', $res['firstname']);
				$this->set('userLName', $res['lastname']);
				$this->set('eventTitle', $res['title']);
				$this->set('eventDescription', $res['description']);
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