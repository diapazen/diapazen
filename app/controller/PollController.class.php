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

		//test si un choix a été fait entre la connection et l'inscription
		if(isset($_POST['account']))
		{
			$mail=$_POST['email'];

			//si on a choisi la connection
			if($_POST['account']=='registered')
			{

			}
			else
			{

			}
		}

		// On fait le rendu
		$this->render('pollShare');
	}

	public function view($params = null)
	{
		// On charge le modèle des sondages
		$this->loadModel('poll');

		
		// On fait le rendu
		$this->render('pollView');
	}
}

?>