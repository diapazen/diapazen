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

	private static $messageRegistration	=
		"<html>
			<head>
				<meta charset='utf-8'>
			</head>
			<body>
				Bonjour <span name='firstName'></span> <span name='lastName'></span><br>
				Merci de vous être inscrit sur Diapazen <br>
				Votre mot de passe est : <span name='password'></span> <br>
				Changer le dès maintenant en accèdant à votre profil.
			</body>
		</html>";

	private static $messageCreatePoll	=
		"<html>
			<head>
				<meta charset='utf-8'>
			</head>
			<body>
				Bonjour vous venez de créer le sondage <span name='sondage'></span>
			</body>
		</html>";

	private static $messagePswForgotten	=
		"<html>
			<head>
				<meta charset='utf-8'>
			</head>
			<body>
				Bonjour votre nouveau mot de passe est : <span name='password'></span>
			</body>
		</html>";
		
	private static $messageLogTooBig	=
		"<html>
			<head>
				<meta charset='utf-8'>
			</head>
			<body>
				Attention: Le fichier de logs de Diapazen est plein.
			</body>
		</html>";

	private static $messagePollShare	=
		"<html>
			<head>
				<meta charset='utf-8'>
			</head>
			<body>
				<span name='user'></span> vous invite à répondre a un sondage. <br>
				Pour y répondre veuillez suivre ce lien : <a name='linkPoll'>Sondage</a>
			</body>
		</html>";

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
	 * Ceci doivent avoir été mis dans des balises <span> ayant le même name qu'une key du tableau
	 * @param  params tableau des paramêtres du message
	 *
	 */
	public function setParams($params)
	{
		$doc = new DOMDocument();  
		$doc->loadHTML($this->message);

		foreach($params as $key=>$param)
		{
			$elements=$doc->getElementsByTagName("span");

			foreach($elements as $element)
			{
				if(strcmp($element->getAttribute("name"),$key)==0)
					$element->nodeValue=$param;
			}

			$elements=$doc->getElementsByTagName("a");

			foreach($elements as $element)
			{
				if(strcmp($element->getAttribute("name"),$key)==0)
					$element->setAttribute("href",$param);
			}
		}

		$this->message=$doc->saveHTML();
	}
}

?>