<?php
/**
 * 
 * Contrôleur de la page d'accueil 
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

class IndexController extends Controller
{

	private $is404 = false;

	/**
	 * Constructeur
	 * @param	string	arg		Arguments optionnels
	 */
	public function __construct($arg = '')
	{
		if ($arg == '404')
			$this->is404 = true;
	}


	public function render()
	{
		if ($this->is404)
			include VIEW_ROOT.DS.'php'.DS.'404.php';
		else
			include VIEW_ROOT.DS.'php'.DS.'home.php';

	}


}



?>