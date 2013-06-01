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

	/**
	 * Action par défaut
	 * 
	 * url:	diapazen.com/user
	 **/
	public function index($params = null)
	{
		header('Location: ' . BASE_URL);
	}

	/**
	 * Connection à l'application
	 * 
	 * url:	diapazen.com/user/login
	 **/
	public function login($params = null)
	{
		// quand on se connecte
		// on charge le modèle de l'utilisateur
		$this->loadModel('user');

		// si l'utilisateur est déja connecté
		if ($this->isUserConnected())
		{
			header('Location: ' . BASE_URL. '/dashboard');
		}

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
				die($this->render('dbError'));
			}

			if ($result == false)
			{

				//création de la variable infoLogin
				$this->set('infoLogin','connectionError');

				// La connexion a échoué
				$this->setUserDisconnected();

				// On affiche un formulaire de connexion
				$this->render('login');
			}
			else
			{
				// La connexion a réussie
				$this->setUserConnected($result);

				// On redirige vers la dashboard
				header('Location: ' . BASE_URL. '/dashboard');

			}
		}
		else
		{
			// On affiche un formulaire de connexion
			$this->set('title', 'Connexion | Diapazen');
			$this->render('login');
		}

	}

	/**
	 * Modification des information personnelles
	 * 
	 * url:	diapazen.com/user/profile
	 **/
	public function profile($params = null)
	{
		// Titre de la page
		$this->set('title', 'Mon profil | Diapazen');
		
		if ($this->isUserConnected())
		{
			try
			{
				// chargement du modèle user
				$this->loadModel('user');

				//Partie: Modifications des données utilisateur
				if (	isset($_POST['lastname']) && !empty($_POST['lastname'])
					&&	isset($_POST['firstname']) && !empty($_POST['firstname'])
					&&	isset($_POST['mail']) && !empty($_POST['mail']) )
				{
					// On teste le mot de passe de confirmation
					if (isset($_POST['passwordSecurity']) && !empty($_POST['passwordSecurity'])
						&& $this->getModel()->checkPassword($this->getUserInfo('id'), $_POST['passwordSecurity']))
					{
						
						// met a jour la bdd
						$res = $this->getModel()->changeUser($this->getUserInfo('id'), $_POST['firstname'], $_POST['lastname'], $_POST['mail']);

						//met a jour la session
						$this->setUserInfo('firstname', $_POST['firstname']);
						$this->setUserInfo('lastname', $_POST['lastname']);
						$this->setUserInfo('email', $_POST['mail']);

						// On informe l'utilisateur de la réussite
						$this->set('data_updated', true);
						
					}
					else
					{
						// Erreur de mot de passe de confirmation
						$this->set('data_updated', false);
					}
				}

				// On modifie le mot de passe si il est renseigné
				if (	isset($_POST['password']) && !empty($_POST['password'])
					&&	isset($_POST['passwordConfirm']) && !empty($_POST['passwordConfirm']) )
				{
					// On teste le mot de passe de confirmation
					if (isset($_POST['passwordSecurity']) && !empty($_POST['passwordSecurity'])
						&& $this->getModel()->checkPassword($this->getUserInfo('id'), $_POST['passwordSecurity']))
					{
						if ($_POST['password'] == $_POST['passwordConfirm'])
						{
							$res = $this->getModel()->changePassword($this->getUserInfo('email'), $_POST['password']);
						
							// Réussite de la modification du mot de passe
							$this->set('data_updated', true);
						}
						else
						{
							// Echec de la modification le mot de passe est différent
							$this->set('data_updated', false);
						}
					}
					else
					{
						// Erreur de mot de passe de confirmation
						$this->set('data_updated', false);
					}
					
				}

				// Partie: affichage des données
				// On récupère l'id de l'utilisateur (session)
				$id = $this->getUserInfo('id');

				// On récupère ses infos dans la bdd
				$user = $this->getModel()->dataProvider($id);
				

				// Envoie des variables vers la vue
				if ($user)
				{
					$this->set('firstname', $user['firstname']);
					$this->set('lastname', $user['lastname']);
					$this->set('email', $user['email']);
				}

				//  Rendu de la page
				$this->render('personalData');
			}
			catch(Exception $e)
			{
				die($this->render('dbError'));
			}
		}
		else
			header('Location:' . BASE_URL);
	}

	/**
	 * Mot de passe oublié
	 * 
	 * url:	diapazen.com/user/forgot
	 **/
	public function forgot($params = null)
	{
		if ($this->isUserConnected())
		{
			header('Location: ' . BASE_URL. '/dashboard');
		}

		// Titre de la page
		$this->set('title', 'Mot de passe oublié | Diapazen');
		

		$this->loadModel('user');

		try
		{
			// l'email est présent
			if (isset($_POST['mailRetrieve']))
			{
				// différent de vide
				if(!empty($_POST['mailRetrieve']))
				{
					// présent dans la bdd
					if ($this->getModel()->isEmailRegistred($_POST['mailRetrieve']))
					{
						$password = $this->getModel()->generatorPsw();

						$this->getModel()->changePassword($_POST['mailRetrieve'], $password);

						
						$objMail = new MailUtil();
						$message = new Message();
						$message->setMessage('password');
						$message->setParams(array('password'=>$password));
						$subject = 'Réinitialisation de votre mot de passe';
						$messageMail = $message->getMessage();
						$result = $objMail->sendMail($_POST['mailRetrieve'], $subject, $messageMail);
						$this->set('infoLogin',$result ? 'sendPassword' : 'sendFailPassword');
						$this->render('login');
						
					}
					else
					{
						$this->set('err', 'mailnotfound');
						$this->render('forgot');
					}
		        }
				else
				{
					$this->set('err', 'mailempty');
					$this->render('forgot');
		 		}
		 	}
		 	else
		 		$this->render('forgot');
		}
		catch(Exception $e)
		{
			die($this->render('dbError'));
		}
	}


	/**
	 * Déconnexion de l'application
	 * 
	 * url:	diapazen.com/user/logout
	 **/
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