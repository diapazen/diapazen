<?php
/**
 * 
 * Class contenant les messages principaux des mails
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

class Message
{

	private static $messageRegistration	='';
	private static $messageCreatePoll	='';
	private static $messagePswForgotten	='';
	private static $messageLogTooBig	='';
	private $message;

	/**
	 * Récupère le message à envoyer
	 *
	 * @return string message à envoyer
	 */
	public function getMessage()
	{

	}

	/**
	 * Récupère le message à envoyer
	 *
	 * @param name nom permettant de savoir quel message choisir
	 */
	public function setMessage($name)
	{
		if(!empty($name))
		{
			//switch sur name pour choisir le bon message
			switch ($name) 
			{
				case 'registration':
					$message=self::$messageRegistration;
					break;

				case 'poll':
					$message=self::$messageCreatePoll;
					break;

				case 'password':
					$message=self::$messagePswForgotten;
					break;

				case 'log':
					$message=self::$messageLogTooBig;
					break;

				default :
					new coreException("nom du message non valide");
					break;
			}
		}
		else
		{
			new coreException("nom du message non valide");
		}
	}

	/**
	 * Set les paramêtres des messages (ex : mot de passe)
	 * @param  params liste des paramêtres du message
	 *
	 */
	public function setParams($params)
	{

	}
}

?>