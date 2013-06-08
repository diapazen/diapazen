<?php
/**
 * 
 * ContrÃ´leur de la page des utilisateurs
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
	 * Action par dÃ©faut
	 * mène a la page home.
	 * url:	diapazen.com/user
	 **/
	public function index($params = null)
	{
		header('Location: ' . BASE_URL);
	}

	/**
	 * Connection Ã  l'application
	 * On charge le modèle de l'utilisateur, et si l'utlisateur est déjà
         * connecter alors on le dirige vers la page home. Sinon on vérifie le
         * mail et le mot de passe dans la base de données et on connecte
         * l'utilisateur et on l'envoie vers le dashboard. Si le mot de passe ou
         * le mail est erroné alors on créer la variable infoLogin et on
         * affiche le formulaire de connection.
	 * url:	diapazen.com/user/login
	 **/
	public function login($params = null)
	{
		// quand on se connecte
		// on charge le modÃ¨le de l'utilisateur
		$this->loadModel('user');

		// si l'utilisateur est dÃ©ja connectÃ©
		if ($this->isUserConnected())
		{
			header('Location: ' . BASE_URL. '/dashboard');
		}

		if (	isset($_POST['email'])		&& !empty($_POST['email'])
			&&	isset($_POST['password'])	&& !empty($_POST['password']))
		{

			$email	 	= $_POST['email'];
			$passwd 	= $_POST['password'];
			$ip_addr 	= $_SERVER['REMOTE_ADDR'];

			
			try
			{
				// on vÃ©rifie les infos avec la bdd
				$result = $this->getModel()->connectionToApp($email, $passwd, $ip_addr);
			}
			catch(Exception $e)
			{
				die($this->render('dbError'));
			}

			if ($result == false)
			{

				//crÃ©ation de la variable infoLogin
				$this->set('infoLogin','connectionError');

				// La connexion a Ã©chouÃ©
				$this->setUserDisconnected();

				// On affiche un formulaire de connexion
				$this->render('login');
			}
			else
			{
				// La connexion a rÃ©ussie
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
	 * on dirige l'utilisateur vers la page de profil, en affichant ses
         * données on vérifie qu'il est connecter. Si tel est le cas on charge
         * le modelUser et si l'utilisateur veut modifier ses données on le fait
         * grâce à ce model et on teste le mot de passe de confirmation. Si le
         * mot de passe est erroné on ne modifie rien par contre si c'est le bon
         * mot de passe on met alors à jour la base de données, on met à jour la 
         * session et on informe l'utilisateur de la réussite. Si l'utilisateur
         * veut modifier son mot de passe alors on teste le mot de passe de
         * confirmation. Si le mot de passe est erroné on ne modifie rien par
         * contre si c'est le bon mot de passe on met alors à jour la base de
         * données. Pour afficher les données de l'utilisateur, on récupère l'id
         * de l'utilisateur, on prend les informations de la base de données et
         * on les affiche dans la vue. Si l'utilisateur est déconnecter il est
         * dirigé vers la page home.
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
				// chargement du modÃ¨le user
				$this->loadModel('user');

				//Partie: Modifications des donnÃ©es utilisateur
				if (	isset($_POST['lastNameUser']) && !empty($_POST['lastNameUser'])
					&&	isset($_POST['firstNameUser']) && !empty($_POST['firstNameUser'])
					&&	isset($_POST['email']) && !empty($_POST['email']) )
				{
					// On teste le mot de passe de confirmation
					if (isset($_POST['password']) && !empty($_POST['password'])
						&& $this->getModel()->checkPassword($this->getUserInfo('id'), $_POST['password']))
					{
						
						// met a jour la bdd
						$res = $this->getModel()->changeUser($this->getUserInfo('id'), $_POST['firstNameUser'], $_POST['lastNameUser'], $_POST['email']);

						//met a jour la session
						$this->setUserInfo('firstname', $_POST['firstNameUser']);
						$this->setUserInfo('lastname', $_POST['lastNameUser']);
						$this->setUserInfo('email', $_POST['email']);

						// On informe l'utilisateur de la rÃ©ussite
						$this->set('data_updated', true);
						
					}
					else
					{
						// Erreur de mot de passe de confirmation
						$this->set('data_updated', false);
					}
				}

				// On modifie le mot de passe si il est renseignÃ©
				if (	isset($_POST['newPassword']) && !empty($_POST['newPassword'])
					&&	isset($_POST['passwordConfirm']) && !empty($_POST['passwordConfirm']) )
				{
					// On teste le mot de passe de confirmation
					if (isset($_POST['password']) && !empty($_POST['password'])
						&& $this->getModel()->checkPassword($this->getUserInfo('id'), $_POST['password']))
					{
						if ($_POST['newPassword'] == $_POST['passwordConfirm'])
						{
							$res = $this->getModel()->changePassword($this->getUserInfo('email'), $_POST['newPassword']);
						
							// RÃ©ussite de la modification du mot de passe
							$this->set('data_updated', true);
						}
						else
						{
							// Echec de la modification le mot de passe est diffÃ©rent
							$this->set('data_updated', false);
						}
					}
					else
					{
						// Erreur de mot de passe de confirmation
						$this->set('data_updated', false);
					}
					
				}

				// Partie: affichage des donnÃ©es
				// On rÃ©cupÃ¨re l'id de l'utilisateur (session)
				$id = $this->getUserInfo('id');

				// On rÃ©cupÃ¨re ses infos dans la bdd
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
	 * Mot de passe oubliÃ©
	 * on verifie que l'utilisateur est déconnecter, si ce n'est pas le cas
         * alors on redirige vers la page home. Si il est déconnecter on le
         * dirige vers la page du mot de passe oublié. Si l'email est présent
         * différent de vide et est présent dans la base de données, alors on
         * créer un nouveau mot de passe et on l'affecte comme nouveau mot de
         * passe de l'utilisateur. On le lui envoi par mail et on lui notifit la
         * présence de ce mail.
	 * url:	diapazen.com/user/forgot
	 **/
	public function forgot($params = null)
	{
		if ($this->isUserConnected())
		{
			header('Location: ' . BASE_URL. '/dashboard');
		}

		// Titre de la page
		$this->set('title', 'Mot de passe oubliÃ© | Diapazen');
		

		$this->loadModel('user');

		try
		{
			// l'email est prÃ©sent
			if (isset($_POST['email']))
			{
				// diffÃ©rent de vide
				if(!empty($_POST['email']))
				{
					// prÃ©sent dans la bdd
					if ($this->getModel()->isEmailRegistred($_POST['email']))
					{
						$password = $this->getModel()->generatorPsw();

						$this->getModel()->changePassword($_POST['email'], $password);

						
						$objMail = new MailUtil();
						$message = new Message();
						$message->setMessage('password');
						$message->setParams(array('password'=>$password));
						$subject = 'RÃ©initialisation de votre mot de passe';
						$messageMail = $message->getMessage();
						$result = $objMail->sendMail($_POST['email'], $subject, $messageMail);
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
	 * DÃ©connexion de l'application
	 * Deconnect l'utilisateur et le renvoi sur la page home
	 * url:	diapazen.com/user/logout
	 **/
	public function logout($params = null)
	{
		// quand on se dÃ©co.
		$this->setUserDisconnected();
		session_destroy();
		// On redirige vers l'accueil
		header('Location: ' . BASE_URL);
	}

}

?>