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
require_once 'util/TestForm.class.php';

class PollController extends Controller
{

	/**
    * Index des sondages
    *
    * Lance la méthode 'create' de PollController
    *
    * @param type $params null par défaut
    *
    */
	public function index($params = null)
	{
		$this->create($params);
	}

	/**
    * Création d'un sondage
    *
    * Gère  : 
    * - Lance le render de la vue 'pollCreation' 
    * - Met le titre de la page à 'Création d\'un sondage | Diapazen'.
    * - Récupère les renseignements donnés si on fait 'précédent'
    *
    * @param type $params null par défaut
    *
    */
	public function create($params = null)
	{
		//si l'utilisateur est deja connecter alors on affiche pas le le bouton connexion dans le fil d'arianne
		$_SESSION['show_ariadne'] = $this->isUserConnected() ? false : true;
		$_SESSION['width_ariadne'] = $this->isUserConnected() ? '525' : '788';
		$this->set('width_ariadne', $_SESSION['width_ariadne']);
		$this->set('show_ariadne', $_SESSION['show_ariadne']);

		$this->set('class_create', 'orange');
		$this->set('class_connect', 'grey');
		$this->set('class_share', 'grey');
		// on a fait précédent, on affiche les valeurs déjà renseignées
		if(isset($_SESSION['poll_title']) && isset($_SESSION['poll_description']) && isset($_SESSION['poll_choices']) && isset($_SESSION['poll_date']))
		{
			$this->set('poll_title', $_SESSION['poll_title']);
			$this->set('poll_description', $_SESSION['poll_description']);
			$this->set('poll_choices', $_SESSION['poll_choices']);
			$this->set('poll_date', $_SESSION['poll_date']);
			// modifier la vue pour qu'elle affiche les choix (le navigateur web le gère automatiquement)
		}
		
		/* temporaire, ensuite on mettra le titre de la page*/
		$this->set('title', 'Création d\'un sondage | Diapazen');
		// On fait le rendu
		$this->render('pollCreation');
	}


	/**
    * Page connec lors de la création d'un sondage
    *
    * Gère  : 
    * - Met le titre de la page à 'Création d\'un sondage | Diapazen'.
    * - Renvoi à la partie create si on y a pas été
    * - Envoi directement l'utilisateur à la partie 'partage' si il est déjà connecté
    * - Si on est déjà inscrit on tente de se connecter
    * - Si on n'est pas inscrit, on inscrit l'utilisateur et
    *	on lui envoi un mail avec son mot de passe
    * - Gère si des erreurs sont survenues
    *
    * @param type $params null par défaut
    *
    */
	public function connect($params = null)
	{

		$this->set('title', 'Création d\'un sondage | Diapazen');
		$this->set('class_create', 'grey');
		$this->set('class_connect', 'orange');
		$this->set('class_share', 'grey');

		//récupération des valeurs du fil d'arianne
		if (isset($_SESSION['show_ariadne']) && isset($_SESSION['width_ariadne']))
		{
			$this->set('show_ariadne', $_SESSION['show_ariadne']);
			$this->set('width_ariadne', $_SESSION['width_ariadne']);
		}
		else
		{
			// renvoyer a Poll create ces variable devrais etre initialisées
			header('Location: ' . BASE_URL. '/poll/create');
		}

		// test si le formulaire de creation de sondage est existant
		if (isset($_POST['title_input']) && isset($_POST['description_input']) && isset($_POST['choices']))
		{
			$_SESSION['poll_title'] = $_POST['title_input'];
			$_SESSION['poll_description'] = $_POST['description_input'];
			$_SESSION['poll_choices'] = $_POST['choices'];
			

			if(isset($_POST['date_input']) && TestForm::testRegexp('expirationDate', $_POST['date_input']))
			{
				$_SESSION['poll_date'] = $_POST['date_input'];
			}
			else
			{
				$_SESSION['poll_date'] = null;
			}

		}

		// Si l'utilisateur est déja connecté, on le redirige vers le partage
		if ($this->isUserConnected())
			header('Location: ' . BASE_URL. '/poll/share');

		try
		{
			//test si un choix a été fait entre la connection et l'inscription et qu'il y a un email
			if (isset($_POST['account']) && isset($_POST['email']))
			{
				$mail = $_POST['email'];
				$ip_addr = $_SERVER['REMOTE_ADDR'];

				//si on a choisi la connection et qu'il y a le mdp on tente de se connecter
				if($_POST['account'] == 'registered' && isset($_POST['password']))
				{
					// On teste l'adresse mail
					if (!TestForm::testRegexp('email', $mail))
						throw new Exception('error_mail');

					$pwd = $_POST['password'];

					// on vérifie les infos avec la bdd
					$this->loadModel('user');
					$connectStatus = $this->getModel()->connectionToApp($mail, $pwd, $ip_addr);

				} //si on a choisi l'inscription et qu'il y a le nom et prenom on l'inscrit
				else if($_POST['account'] == 'not_registered' && isset($_POST['firstNameUser']) && isset($_POST['lastNameUser']))
				{
					// On teste l'adresse mail
					if (!TestForm::testRegexp('email', $mail))
						throw new Exception('error_mail');

					$firstname = $_POST['firstNameUser'];
					$lastname = $_POST['lastNameUser'];
					// On crée le mot de passe
					$this->loadModel('user');
					$pwd = $this->getModel()->generatorPsw();

					// On crée l'utilisateur
					// ne pas mettre de champs vide
					$this->getModel()->registration($firstname, $lastname,$mail,$pwd);
					$connectStatus = $this->getModel()->connectionToApp($mail, $pwd, $ip_addr);

					$message = new Message();
					$message->setMessage('registration');
					$tabParamMessage = array('firstName' => $firstname, 'lastName' => $lastname, 'password' => $pwd);
					$message->setParams($tabParamMessage);
					$messageMail = $message->getMessage();
					$subjet = 'Inscription sur Diapazen';

					$mailer = new MailUtil();
					$mailer->sendMail($mail,$subjet,$messageMail);
				}
				else
					$connectStatus = false;


				if($connectStatus == false)
				{
					// La connexion a échoué
					$this->setUserDisconnected();
					throw new Exception('error_connection');
					
				}
				else
				{
					// La connexion a réussie
					$this->setUserConnected($connectStatus);
					header('Location: ' . BASE_URL. '/poll/share');
				}

			}
		}
		catch(Exception $e)
		{
			switch ($e->getMessage())
			{
				case 'email_already_in_db':
					$this->set('err', 'registrationError');
					break;

				case 'error_connection':
					$this->set('err', 'connectionError');
					break;

				case 'error_mail':
					$this->set('err', 'mailError');
					break;
				
				// Erreur de la bdd (typiquement des erreurs SQL)
				default:
					$this->render('dbError');
					break;
			}
		}

		$this->render('pollConnection');

		
	}

	/**
    * Partage d'un sondage
    *
    * Gère  : 
    * - Met le titre de la page à 'Création d\'un sondage | Diapazen'.
    * - Renvoi à la partie create si on y a pas été
    * - Ajoute le sondage dans la base de donnée
    * - Ajoute les choix dans la base de donnée
    * - Lance le render de la vue 'pollShare' 
    * - Gère si des erreurs sont survenues
    *
    * @param type $params null par défaut
    *
    */
	public function share($params = null)
	{
		if (isset($_SESSION['show_ariadne']) && isset($_SESSION['width_ariadne']))
		{
			$this->set('show_ariadne', $_SESSION['show_ariadne']);
			$this->set('width_ariadne', $_SESSION['width_ariadne']);
		}
		else
		{
			// renvoyer a Poll create ces variable devrais etre initialisées
			header('Location: ' . BASE_URL. '/poll/create');
		}

		// On choisi le rendu par default
		$this->set('title', 'Création d\'un sondage | Diapazen');
		$this->set('class_create', 'grey');
		$this->set('class_connect', 'orange');
		$this->set('class_share', 'grey');

		try
		{
			

			// Lorsque l'utilisateur est connecté
			if ($this->isUserConnected())
			{
				if (isset($_SESSION['poll_title']) && isset($_SESSION['poll_description']) && isset($_SESSION['poll_choices']))
				{
					// On créé le sondage
					$this->loadModel('poll');
					$this->getModel()->addPoll($_SESSION['user_infos']['id'], $_SESSION['poll_title'], $_SESSION['poll_description'], $_SESSION['poll_date'].' 23:59:59');
					$pollId = $this->getModel()->getPollId();

					$_SESSION['poll_url'] = $this->getModel()->getPollUrl();

					$this->set('pollUrl', $_SESSION['poll_url']);

					// Insertion des choix
					$this->loadModel('choice');
					foreach ($_SESSION['poll_choices'] as $choice) {
						if(!empty($choice))
						$this->getModel()->addChoice($choice, $pollId);
					}

					unset($_SESSION['poll_title']);
					unset($_SESSION['poll_description']);
					unset($_SESSION['poll_choices']);
					unset($_SESSION['poll_date']);
					
					// On choisit le rendu
					$this->set('class_connect', 'grey');
					$this->set('class_share', 'orange');
					$this->render('pollShare');
				}
				else
				{
					// renvoyer a Poll create avec un message disant champs inexistants
					header('Location: ' . BASE_URL. '/poll/create');
				}
			}

		}
		catch(Exception $e)
		{
			$this->render('dbError');
		}

	}

	/**
    * Partage d'un sondage
    *
    * Gère  : 
    * - Met le titre de la page à 'Création d\'un sondage | Diapazen'.
    * - Renvoi à la page d'accueil si nous ne venons pas créer un sondage
    * - Envois des mails de partage au mails spécifiés
    * - Lance le render de la vue 'shareMail' 
    * - Gère si des erreurs sont survenues
    *
    * @param type $params null par défaut
    *
    */
	public function sent($params = null)
	{

		$this->set('title', 'Partager le sondage | Diapazen');

		if (isset($_POST['mails']) && isset($_SESSION['poll_url']) && TestForm::testRegexp('pollUrl', $_SESSION['poll_url']))
		{
			try
			{
				$this->loadModel('poll');
				$lien = BASE_URL.'/p/'.$_SESSION['poll_url'];
				$from = $this->getUserInfo('firstname').' '.$this->getUserInfo('lastname');
				$mailSend = $this->getModel()->sharePoll($_POST['mails']);
				$mailSend = implode(', ', $mailSend);
				unset($_SESSION['poll_url']);
			}
			catch(Exception $e)
			{
				die($this->render('dbError'));
			}
			

			$subject = "Invitation à un sondage";
			$message = new Message();
			$message->setMessage('share');
			$tabParamMessage = array('user' => $from, 'linkPoll' => $lien);
			$message->setParams($tabParamMessage);
			$messageMail = $message->getMessage();

			$mailer = new MailUtil();
			$res = $mailer->sendMail($mailSend,$subject,$messageMail);

			$this->set('pollUrl', $lien);
			$this->set('sent', $res ? 'success' : 'fail');
			$this->render('shareMail');
			
		}
		else
		{
			// renvoyer a Poll share avec un message disant pas de mails
			header('Location: ' . BASE_URL);
		}
	}
	
	/**
    * Visualisation d'un sondage
    *
    * Gère  : 
    * - Met le titre de la page à 'Création d\'un sondage | Diapazen'.
    * - Renvoi à la page d'accueil si l'url du sondage n'est pas specifiée
    * - Renvoi un 404 si le sondage n'a pas été trouvé
    * - Empêche le revote grâce à la fonction 'rafraichir la page'
    * - L'ajout de vote dans le sondage
    * - Trie les choix en fonction des résultats pour un sondage fermé
    * - Affiche qui a voté quoi
    * - Lance le render de la vue 'pollView' 
    * - Gère si des erreurs sont survenues
    *
    * @param type $params null par défaut
    *
    */
	public function view($params = null)
	{
		
		// L'url du sondage doit être spécifiée
		if (!$params)
			header('Location: ' . BASE_URL);

		// On charge le modèle des sondages
		$this->loadModel('poll');

		// test pour empecher le revote par f5/rafraichir la page
		if (isset($_POST['choiceId']) && isset($_POST['value']) && isset($_SESSION['voteChoiceId']) && (count(array_diff($_SESSION['voteChoiceId'], $_POST['choiceId'])) == 0) && isset($_SESSION['voteName']) && ($_SESSION['voteName'] == $_POST['value']) )
		{
			header('Location: ' . BASE_URL . '/poll/view/' . $params[0]);
		}
		else
		{

			try
			{
				// Ajout d'un vote
				if (isset($_POST['value']))
				{
					if (!empty($_POST['value']) && isset($_POST['choiceId']))
					{
						foreach($_POST['choiceId'] as $choice)
						{
							if ($this->getModel()->votePoll($choice, $_POST['value']))
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
						$_SESSION['voteChoiceId'] = $_POST['choiceId'];
						$_SESSION['voteName'] = $_POST['value'];
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
					if (($int->invert == 1 || !$res['open']) && $res['expiration_date'] != '0000-00-00 00:00:00')
					{
						$res['open'] = false;
						$this->set('eventDate', ' | Le sondage est fermé.');
						try
						{
							$this->getModel()->updatePoll($res['POLL_ID']);
						}
						catch(Exception $e)
						{
							die("erreur de mise à jour");
						}
					}
					else if($res['expiration_date'] != '0000-00-00 00:00:00')
						$this->set('eventDate', $int->format(' | Expire dans: %d jour(s) et %h heure(s).'));
					else
						$this->set('eventDate', $int->format(''));


					// Si le sondage est fermé, on trie les résultats
					// du meilleur au moins bon.
					if (!$res['open'])
					{
						function cmp($a, $b)
						{
							if ($a['percent'] == $b['percent'])
								return 0;
							return ($a['percent'] > $b['percent']) ? -1 : 1;
						}
						usort($res['choices'], 'cmp');
					}

					// On transforme les liens http(s).. en vrai lien avec des balises
					$res['description'] = preg_replace("/(^|[\n ])([\w]*?)((ht|f)tp(s)?:\/\/[\w]+[^ \,\"\n\r\t<]*)/is", "$1$2<a class=\"link\" rel=\"nofollow\" href=\"$3\" >$3</a>", $res['description']);
				    $res['description'] = preg_replace("/(^|[\n ])([\w]*?)((www|ftp)\.[^ \,\"\t\n\r<]*)/is", "$1$2<a class=\"link\" rel=\"nofollow\" href=\"http://$3\" >$3</a>", $res['description']);
				    $res['description'] = preg_replace("/(^|[\n ])([a-z0-9&\-_\.]+?)@([\w\-]+\.([\w\-\.]+)+)/i", "$1<a class=\"link\" rel=\"nofollow\" href=\"mailto:$2@$3\">$2@$3</a>", $res['description']);

				    // On transforme les retours à la ligne en balise html
				    $res['description'] = str_replace("\n", "<br>", $res['description']);

				    // Tableau pour stocker les jours de la semaine
					$jour = array("lundi","mardi","mercredi","jeudi","vendredi","samedi","dimanche"); 
					$mois = array("","janvier","février","mars","avril","mai","juin","juillet","août","septembre","octobre","novembre","décembre"); 
					
					// on définit les variables à envoyer à la vue
					$this->set('openedPoll', $res['open']);
					$this->set('urlPoll', $res['url']);
					$this->set('userFName', $res['firstname']);
					$this->set('userLName', $res['lastname']);
					$this->set('eventTitle', $res['title']);
					$this->set('eventDescription', $res['description']);
					$this->set('choiceList', $res['choices']);

					// Traduction de la date
					$week	= $jour[date('w', strtotime($res['creation_date']))];
					$day	= date('d', strtotime($res['creation_date'])); 
					$month	= $mois[date('n', strtotime($res['creation_date']))];
					$year	= date('Y', strtotime($res['creation_date']));
					$dateFr	= sprintf('%s %s %s %s', $week, $day, $month, $year);
					$this->set('creationDate', $dateFr);
					

					$this->set('title', $res['title'] .' | Diapazen');
					
					// On fait le rendu
					$this->render('pollView');
				}
			}
			catch(Exception $e)
			{
				die($this->render('dbError'));
			}
		}
	}
}

?>