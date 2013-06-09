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

/**
 * Message
 *
 * Classe gérant les messages des emails
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class Message
{

	/**
	 * Message d'inscription
	 */
	private static $messageRegistration	=
				"Bonjour %s %s\n\nMerci de vous être inscrit sur Diapazen.\nVotre mot de passe est: %s\nChangez le dès maintenant en accèdant à votre profil.";

	/**
	 * Messaqge de création d'un sondage
	 */
	private static $messageCreatePoll	=
				"Bonjour\n\nVous venez de créer le sondage %s";

	/**
	 * Message du mot de passe oublié
	 */
	private static $messagePswForgotten	=
				"Bonjour\n\nVoici votre nouveau mot de passe: %s\nVous pouvez vous connecter de nouveau sur http://diapazen.com afin de le modifier.";
		
	/**
	 * Message du log trop gros
	 */
	private static $messageLogTooBig	=
				"Bonjour\n\nAttention: Le fichier de logs de Diapazen est plein.";

	/**
	 * Message du partage de sondage
	 */
	private static $messagePollShare	=
				"Bonjour\n\n%s vous invite à répondre à son sondage:\n%s\n\nPour y répondre, il suffit de suivre ce lien: %s";

	/**
	 * Message
	 */
	private $message;

	/**
	 * Récupère le message à envoyer
	 *
	 * @return string message à envoyer
	 */
	public function getMessage()
	{
		return $this->message;
	}

	/**
	 * Récupère le message à envoyer
	 *
	 * On utilise un switch sur '$name' afin de savoir quel message récupérer
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
					$this->message=self::$messageRegistration;
					break;

				case 'poll':
					$this->message=self::$messageCreatePoll;
					break;

				case 'password':
					$this->message=self::$messagePswForgotten;
					break;

				case 'log':
					$this->message=self::$messageLogTooBig;
					break;

				case 'share':
					$this->message=self::$messagePollShare;
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
	 *
	 * Set les paramêtres des messages grâce à la fonction vsprintf
	 * Rajoute une ligne à la fin de tous les messages
	 *
	 * @param  params tableau des paramêtres du message
	 *
	 */
	public function setParams($params)
	{
		$this->message= vsprintf($this->message, $params);

		// A la fin de tt les messages
		$this->message .= "\n\nL'équipe de Diapazen.\n\nPS: Ceci est un message automatique, il est inutile d'y répondre.";
	}
}

?>