<?php
/**
 * 
 * Contrôleur principal
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

class Controller
{

	protected $mModel;
	protected $mRequest;
	protected $mVars = array();

	/**
	 * Constructeur
	 * @param	Request	request		Requête HTTP
	 */
	public function __construct($request)
	{
		$this->mRequest = $request;
	}

	/**
	 * Charge le modèle de données
	 * @param	Model	model		Modèle de données
	 */
	protected function loadModel($model)
	{
		$model = ucfirst($model).'Model';
		try
		{
			$this->mModel =  new $model();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	/**
	 * Charge le modèle de données
	 * @return	Model	model		Modèle de données
	 */
	protected function getModel()
	{
		return $this->mModel;
	}

	/**
	 * Fait le rendu de la vue
	 *
	 * @param	string	filename	chemin relatif du fichier
	 * @return	void	Rien
	 */
	public function render($view)
	{
		// On extrait les variables à afficher dans la vue
		extract($this->mVars);
		// On affiche le vue
		require(VIEW_ROOT.DS.'php'.DS.$view.'.php');
	}

	/**
	 * Affiche l'erreur 404
	 */
	public function e404()
	{
		extract($this->mVars);
		require(VIEW_ROOT.DS.'php'.DS.'404.php');
	}

	/**
	 * Ajoute une variable pour la vue
	 *
	 * @param	string	filename	chemin relatif du fichier
	 * @return	void	Rien
	 */
	protected function set($key, $value)
	{
		$this->mVars[$key] = $value;
	}

	/**
	 * Récupère le chemin d'un fichier css,js,png ...
	 * 
	 * Exemple d'utilisation: $this->getPath('css/style.css');
	 * Donne le chemin du fichier style.css
	 *
	 * @param	string	filename	chemin relatif du fichier
	 * @return	string	chemin complet du fichier
	 */
	public function getPath($filename)
	{
		echo BASE_URL.VIEW_WEBROOT.DS.$filename;
	}

	/**
	 * Inclut le fichier d'entête. A utiliser dans les fichiers de vue
	 *
	 * @return	void	Rien
	 */
	public function getHeader()
	{
		extract($this->mVars);
		include VIEW_ROOT.DS.'php'.DS.'header.php';
	}

	/**
	 * Inclut le fichier de pied de page. A utiliser dans les fichiers de vue
	 *
	 * @return	void	Rien
	 */
	public function getFooter()
	{
		extract($this->mVars);
		include VIEW_ROOT.DS.'php'.DS.'footer.php';
	}

	/**
	 * Récupère l'url de la page d'accueil
	 *
	 * @return	void	Rien
	 */
	public function getHomeUrl()
	{
		echo BASE_URL;
	}

	/**
	 * Connecte l'utilisateur
	 *
	 * @return	void	Rien
	 */
	public function setUserConnected($userInfos)
	{
		$_SESSION['connected'] = true;
		$_SESSION['user_infos'] = $userInfos;
	}

	/**
	 * Déconnecte l'utilisateur
	 *
	 * @return	void	Rien
	 */
	public function setUserDisconnected()
	{
		$_SESSION['connected'] = false;
		$_SESSION['user_infos'] = array();
	}

	/**
	 * L'utilisateur est-il connecté ?
	 *
	 * @return	bool	Vrai si il est connecté, Faux sinon
	 */
	public function isUserConnected()
	{
		return (isset($_SESSION['connected']) && $_SESSION['connected'] == true) ? true : false;
	}

	/**
	 * Récupère les informations de l'utilisateur (stocké en session)
	 *
	 * @return	string	Information voulue
	 */
	public function getUserInfo($key)
	{
		return (isset($_SESSION['user_infos']) == true ? $_SESSION['user_infos'][$key] : null);
	}

}


?>