<?php
/**
 * 
 * Contrôleur de la page de gestion des sondages 
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

class DashboardController extends Controller
{

	/**
    * Index du Dashboard
    *
    * Récupère le model 'poll'
    * Gère  : 
    * - Met le titre de la page à 'Tableau de bord | Diapazen'.
    * - La fermeture de sondage
    * - Met à jour les sondages expirés dans la BDD
    * - Lance le render de la vue 'dashboard' (si l'utilisateur est connecté)
    * - Retourne à la page d'accueil (si l'utilisateur n'est aps connecté)
    *
    * @param type $params null par défaut
    *
    */
	public function index($params = null)
	{

		// Titre de la page
		$this->set('title', 'Tableau de bord | Diapazen');

		// on charge le model
		$this->loadModel('poll');

		try
		{
			//si on a fermé un sondage
			if (isset($_POST['close']) && !empty($_POST['close']))
			{
				if ($this->getModel()->updatePoll($_POST['close']))
				{
					// clôture réusie
					$this->set('data_updated', true);
				}
				else
				{
					// echec de la clôture
					$this->set('data_updated', false);
				}
			}

			//test si l'utilisateur est connecté
			if ($this->isUserConnected())
			{
				//récupération de l'id du user et de ses sondages
				$uid = $this->getUserInfo('id');
				$polls = $this->getModel()->viewAllPolls($uid);
				
				// recherche des sondages expirés
				foreach ($polls as &$poll)
				{
					$exp_date = new DateTime($poll['expiration_date']);
					$now = new DateTime('now');
					$interval = $now->diff($exp_date);
					if($interval->invert && $poll['expiration_date'] != '0000-00-00 00:00:00')
					{
						$poll['open'] = false;
						// On met à jour le sondage dans la bdd
						try
						{
							$this->getModel()->updatePoll($poll['POLL_ID']);
						}
						catch (Exception $e)
						{
							die("Erreur lors de la mise à jour");
						}
					}

				}
			
				$this->set('pollList', $polls);
				$this->render('dashboard');
			}
			else
				header('Location:' . BASE_URL);
		}
		catch(Exception $e)
		{
			$this->render('dbError');
		}

			
	}

}

?>