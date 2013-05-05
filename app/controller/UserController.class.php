<?php
/**
 * 
 * Contrôleur de la page des utilisateurs
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

class UserController extends Controller
{


	public function index($params = null)
	{
		// a gérer
	}


	public function login($params = null)
	{
		// quand on se connecte
		// on charge le modèle de l'utilisateur
		$this->loadModel('user');

		if (	isset($_POST['mailConnect'])		&& !empty($_POST['mailConnect'])
			&&	isset($_POST['passwordConnect'])	&& !empty($_POST['passwordConnect']))
		{

			$email	 	= $_POST['mailConnect'];
			$passwd 	= $_POST['passwordConnect'];
			$ip_addr 	= $_SERVER['REMOTE_ADDR'];

			
			try
			{
				// on vérifie les infos avec la bdd
				$result = $this->getModel()->connectionToApp($email, $passwd, $ip_addr);
			}
			catch(Exception $e)
			{
				// IMPORTANT: ERREUR A GERER PROPREMENT !!!!!
				die('Erreur interne survenue.');
			}

			if ($result == true)
			{
				// La connexion a réussie
				$this->setUserConnected();

				// On redirige vers la dashboard
				header('Location: ' . BASE_URL. '/dashboard');
			}
			else
			{
				// La connexion a échoué
				$this->setUserDisconnected();


			}
		}

	}


	public function logout($params = null)
	{
		// quand on se déco.
		$this->setUserDisconnected();
		session_destroy();
		// On redirige vers l'accueil
		header('Location: ' . BASE_URL);
	}
}

?>