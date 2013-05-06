<?php


/**
 * 
 * Class model d'utilisateur
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

class UserModel extends Model
{
	private $mId;
	private $mFirstname;
	private $mLastname;
	private $mEmail;
	private $mRegistration_date;
	private $mLast_login_date;
	private $mLast_login_ip;
	
	/**
	 * Constructeur
	 */
	public function __construct()
	{
		parent::__construct();
/*
		//si le premier paramêtre est true on inscrit l'utilisateur
		//liste des paramêtres : 
		//func_get_arg(1) : prénom
		//func_get_arg(2) : nom
		//func_get_arg(3) : email
		if(func_get_arg(0))
		{
			if(testParamConstruct(func_get_arg()))
			{
				$this->registration(func_get_arg(1),func_get_arg(2),func_get_arg(3),$password);
				$this->connectionToApp(func_get_arg(3),$password);
			}
			else
				throw new coreException('Erreur dans le constructeur du user</br>');
		}
		//sinon on le connecte
		//liste des paramêtres : 
		//func_get_arg(1) : email
		//func_get_arg(2) : password
		//func_get_arg(3) : id
		else
		{
			if(testParamConstruct(func_get_arg()))
				connectionToApp(func_get_arg(1),func_get_arg(2),func_get_arg(3));
			else
				throw new coreException('Erreur dans le constructeur du user</br>');
		}*/
	}

	/**
	 * Test des paramêtres du constructeur
	 * @param  params liste des paramêtres du constructeur
	 *
	 * @return bool true si les paramêtres sont bons
	 */
	private function testParamConstruct($params)
	{
		$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 

		//si le premier paramêtre est true
		//test du nom, prénom, email
		if($params[0] && count($params)==4)
		{
			if(!empty($params[1]) && !empty($params[2]) && preg_match($regex, ($params[3])))
				return true;
			else
				return false;
		}
		//test de l'id, email, password
		else if(!$params[0] && count($params)==4)
		{
			if(!empty($params[1]) && preg_match($regex, ($params[2])) && !empty($params[3]))
				return true;
			else
				return false;
		}
		else
		{
			return false;
		}
	}


	/**
	 * Déconnexion de l'utilisateur à l'application
	 *
	 * @return	bool true si la déconnexion s'est bien passé
	 */
	public function disconnectionFromApp()
	{

	}

	/**
	 * Connexion de l'utilisateur
	 *
	 * @param email email renseigné par l'utilisateur
	 * @param password mot de passe renseigné par l'utilisateur
	 * @param login_ip ip de l'utilisateur
	 *
	 * @return	bool true si la connexion s'est bien passé
	 */
	public function connectionToApp($email,$password,$login_ip=null)
	{
		try
		{
			// si les parametres sont corrects
			if(isset($email) && isset($password))
			{
				if($email != null && $password != null)
				{
					// on récupère l'identifiant, le mail et le password avec une clause WHERE sur l'email
					$request = $this->mDbMySql->prepare("SELECT id,lastname,firstname,email,password FROM diapazen.dpz_view_connexion WHERE dpz_view_connexion.email=:EMAIL;");
					$request->bindValue(':EMAIL', $email);
					$request->execute();
					$infos=$request->fetch();

					// si on a un résultat, c'est que ce mail est dans la bdd
					// maintenant, on doit vérifier le password
					if(!is_null($infos))
					{
						///$infos['id'] $infos['email'] $infos['password']

						// on hash le mot de passe avec du blowfish: le salt est le sha1 de l'email
						$password = crypt($password, '$2a$07$'.sha1($infos['email']).'$');
						
						$password_encrypted = $infos['password'];
						if( $password_encrypted == $password) 
						{
							$this->mId = $infos['id'];

							$this->updateConnectionData($infos['id'],$login_ip);

							return array(		'id' 		=> $infos['id'],
												'firstname' => $infos['firstname'],
												'lastname'	=> $infos['lastname'],
												'email' 	=> $infos['email']
											);
						}
					}
				}
			}
			return false;
		}
		catch(Exception $e) 
        {
            throw new Exception('Erreur lors de la tentative de connexion :</br>' . $e->getMessage());
        }
	}


	/**
	 * Mise à jour des données de connexion de l'utilisateur (adresse ip et date de derniere connexion)
	 *
	 * @param login_ip ip de l'utilisateur
	 *
	 * @return	bool true si la mise à jour s'est bien passé
	 */
	public function updateConnectionData($id,$login_ip=null)
	{
		try
		{
			// si le parametre est correct
			if(isset($id))
			{
				if( $id != null)
				{
					// on modifie les données de connexion grace à une clause where sur l'id
					// ici la date
					$request = $this->mDbMySql->prepare("UPDATE diapazen.dpz_users SET dpz_users.last_login_date=CURRENT_TIMESTAMP WHERE dpz_users.id=:ID;");
					$request->bindValue(':ID', $id);
					$request->execute();

					// ici l'ip
					$request = $this->mDbMySql->prepare("UPDATE diapazen.dpz_users SET dpz_users.last_login_ip=:LAST_LOGIN_IP WHERE dpz_users.id=:ID;");
					$request->bindValue(':ID', $id);
					$request->bindValue(':LAST_LOGIN_IP', $login_ip);
					$request->execute();
					

					return true;
				}				
			}
			return false;
		}
		catch(Exception $e) 
        {
            throw new Exception('Erreur lors de la tentative de mise à jour des données de connexion :</br>' . $e->getMessage());
        }
	}


	/**
	 * Récupération des données de l'utilisateur (sauf mot de passe)
	 *
	 * @param id id de l'utilisateur
	 *
	 * @return	bool true si on a bien récupéré les données de l'utilisateur
	 */
	public function dataProvider($id)
	{
		try
		{
			// si les parametres sont corrects
			if(isset($id))
			{
				if($id != null)
				{
					// on récupère toutes les données de l'utilisateur sauf le password avec une clause WHERE sur l'identifiant
					$request = $this->mDbMySql->prepare("SELECT firstname,lastname,email,registration_date,last_login_date,last_login_ip FROM diapazen.dpz_view_users WHERE dpz_view_users.id=:ID;");
					$request->bindValue(':ID', $id);
					$request->execute();
					$infos=$request->fetch();

					// si on a un résultat, c'est qu'il n'y a pas d'erreur sur l'identifiant
					if(!is_null($infos))
					{
						$this->mFirstname = $infos['firstname'];
						$this->mLastname = $infos['lastname'];
						$this->mEmail = $infos['email'];
						$this->mRegistration_date = $infos['registration_date'];
						$this->mLast_login_date = $infos['last_login_date'];
						$this->mLast_login_ip = $infos['last_login_ip'];
						return array(	
										'firstname' 		=> $infos['firstname'],
										'lastname'			=> $infos['lastname'],
										'email' 			=> $infos['email'],
										'registration_date' => $infos['registration_date'],
										'last_login_date'	=> $infos['last_login_date'],
										'last_login_ip' 	=> $infos['last_login_ip']
									);
					}
				}
			}
			return false;
		}
		catch(Exception $e) 
        {
            throw new Exception('Erreur lors de la tentative de récupération des données :</br>' . $e->getMessage());
        }
	}




	/**
	 * Enregistrement d'un nouvel utilisateur
	 *
	 * @param firstname prénom renseigné par l'utilisateur
	 * @param lastname nom de famille renseigné par l'utilisateur
	 * @param email email renseigné par l'utilisateur
	 * @param password mot de passe renseigné par l'utilisateur
	 *
	 * @return	bool true si l'enregistrement s'est bien passé
	 */
	public function registration($firstname,$lastname,$email,$password)
	{
		try
		{
			// si les parametres sont corrects
			if(isset($firstname) && isset($lastname) && isset($email) && isset($password))
			{
				if($firstname != null && $lastname != null && $email != null && $password != null)
				{
					// on enregistre les données fournies par l'utilisateur
					$request = $this->mDbMySql->prepare("INSERT INTO `diapazen`.`dpz_users` 
						(`id`, `firstname`, `lastname`, `email`, `password`, `registration_date`, `last_login_date`, `last_login_ip`) 
                                                VALUES (NULL, :FIRSTNAME, :LASTNAME, :EMAIL, :PASSWORD, CURRENT_TIMESTAMP, '', NULL);");

					$request->bindValue(':FIRSTNAME', $firstname);
					$request->bindValue(':LASTNAME', $lastname);
					$request->bindValue(':EMAIL', $email);

					$password = crypt($password, '$2a$07$'.sha1($email).'$');

					$request->bindValue(':PASSWORD', $password);
					$check = $request->execute();

					// si on a un résultat, c'est qu'on a bien ajouté cet utilisateur dans la bdd
					if($check == 1) return true; 
				}
			}
			return false;
		}
		catch(Exception $e) 
        {
            throw new Exception('Erreur lors de la tentative d\'enregistrement :</br>' . $e->getMessage());
        }
	}
        
        /**
         * Modification du profil de l'utilisateur
         * @param type $id id de l'utilisateur
         * @param firstname prénom renseigné par l'utilisateur
	 * @param lastname nom de famille renseigné par l'utilisateur
	 * @param email email renseigné par l'utilisateur
         * @return boolean true si la modification s'est bien passé
         */
        public function changeUser($id, $firstName, $lastName, $email)
        {
            $request = $this->mDbMySql->prepare("UPDATE `diapazen`.`dpz_users` SET `firstname` = :FIRSTNAME,`lastname` = :LASTNAME,`email` = :EMAIL WHERE `id` = :ID");
            $request->bindValue(':FIRSTNAME', $firstName);
            $request->bindValue(':LASTNAME', $lastName);
            $request->bindValue(':EMAIL', $email);
            $request->bindValue(':ID', $id);
            $check = $request->execute();
            if($check == 1)
            {
                return true;
            }
            return false;
        }
        
        /**
         * Modification du mot de passe de l'utilisateur
         * @param type $id id de l'utilisateur
         * @param type $email email de l'utilisateur
         * @param type $password mot de passe renseigné par l'utilisateur
         * @return boolean si la modification s'est bien passé
         */
        public function changePassword($id, $email, $password)
        {
            $request = $this->mDbMySql->prepare("UPDATE `diapazen`.`dpz_users` SET `password` = :PASSWORD WHERE `id` = :ID");
            $password = crypt($password, '$2a$07$'.sha1($email).'$');
            $request->bindValue(':PASSWORD', $password);
            $request->bindValue(':ID', $id);
            $check = $request->execute();
            if($check == 1)
            {
                return true;
            }
            return false;
        }

        /**
		 * Fonction qui génère un mot de passe aléatoire
		 * 
		 * Cette méthode génère un mot de passe aléatoire
		 * 
		 * @param     int	$size	taille du mot de passe
		 * @return retourne le mot de passe
		 */
        public function generatorPsw($size=8)
        {
        	$list = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	
			mt_srand((double)microtime()*1000000);

			$psw="";

			while( strlen( $psw )< 9 ) 
			{
				$psw .= $list[mt_rand(0, strlen($list)-1)];
			}

			return $psw;
        }
        
	/**
	 * Getter
	 *
	 */
	public function getId()
	{
		return $this->mId;
	}
	public function getFirstname()
	{
		return $this->mFirstname;
	}
	public function getLastname()
	{
		return $this->mLastname;
	}
	public function getEmail()
	{
		return $this->mEmail;
	}
	public function getRegistration_date()
	{
		return $this->mRegistration_date;
	}
	public function getLast_login_date()
	{
		return $this->mLast_login_date;
	}
	public function getLast_login_ip()
	{
		return $this->mLast_login_ip;
	}


	/**
	 * Setter
	 *
	 */
	public function setId($id)
	{
		$this->mId=$id;
	}
	public function setFirstname($firstname)
	{
		$this->mFirstname=$firstname;
	}
	public function setLastname($lastname)
	{
		$this->mLastname=$lastname;
	}
	public function setEmail($email)
	{
		$this->mEmail=$email;
	}
	public function setRegistration_date($registration_date)
	{
		$this->mRegistration_date=$registration_date;
	}
	public function setLast_login_date($last_login_date)
	{
		$this->mLast_login_date=$last_login_date;
	}
	public function setLast_login_ip($last_login_ip)
	{
		$this->mLast_login_ip=$last_login_ip;
	}

}

?>