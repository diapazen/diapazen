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
		if( !isset($_SESSION['poll_title']) && !isset($_SESSION['poll_description']))
		{


		}
		// on a fait précédent, on affiche les valeurs déjà renseignées
		else
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

		/* gérer les choix*/

		/* temporaire, ensuite on mettre le titre de la page*/
		$this->set('title', ' mStep '.$_SESSION['poll_step']);
		// On fait le rendu
		$this->render('pollConnection');
	}


	public function share($params = null)
	{
		// On charge le modèle des sondages
		$this->loadModel('poll');

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
				$mail=$_POST['email'];

				//si on a choisi la connection et qu'il y a le mdp on tente de se connecter
				if($_POST['account']=='registered' && isset($_POST['password']) && !empty($_POST['password']))
				{

					$psw=$_POST['password'];
					$ip_addr 	= $_SERVER['REMOTE_ADDR'];

					try
					{
						// on vérifie les infos avec la bdd
						$result = $this->getModel()->connectionToApp($mail, $psw, $ip_addr);
					}
					catch(Exception $e)
					{
						// IMPORTANT: ERREUR A GERER PROPREMENT !!!!!
						die('Erreur interne survenue.');
					}

					if ($result == false)
					{
						// La connexion a échoué
						$this->setUserDisconnected();

						// On choisi le rendu
						$render='pollConnection';
					}
					else
					{
						// La connexion a réussie
						$this->setUserConnected($result);

						// On choisi le rendu
						$render='pollShare';
					}
				}
				//si on a choisi l'inscription
				else if($_POST['account']=='not_registered')
				{
					// On crée le mot de passe
					$psw=$this->getModel()->generatorPsw();
					// On crée l'utilisateur
					// ne pas mettre de champs vide
					$this->getModel()->registration('anonyme','anonyme',$mail,$psw);
					
					// On choisi le rendu
					$render='pollShare';
				}
				//sinon on recharge la page précédante
				else
				{
					// On choisi le rendu
					$render='pollConnection';
				}
			}
		}
		catch(Exception $e)
		{
			//à gérer
		}
		// On fait le rendu
		$this->render($render);
	}

	public function view($params = null)
	{
		// On charge le modèle des sondages
		$this->loadModel('poll');

		try
		{
			$res = $this->getModel()->getPollView('E7DF4FED2ZD');
			echo "<pre>";
			print_r($res);
			echo "</pre>";	
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		// On fait le rendu
		$this->render('pollView');
	}
}

?>