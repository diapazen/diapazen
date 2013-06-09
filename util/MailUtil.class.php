<?php
/**
 * 
 * File using for send e-mail
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
 * MailUtil
 *
 * Classe gérant l'envoi des emails
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class MailUtil 
{

	/**
	 * Constructeur de MailUtil 
	 * 
	 */
	public function MailUtil()
	{
	}


	 /**
	 * Fonction permettant d'envoyer un mail 
	 * 
	 * Cette méthode permet d'envoyer un mail depuis $mailFrom à $mailTo
	 * 
	 * @param     string	$mailTo	mail de destination
	 * @param     string    $subject sujet du mail
	 * @param     string    $message message du mail
	 */
	 public function sendMail($mailTo,$subject,$message)
	 {
		// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/plain; charset=utf-8' . "\r\n";

		// En-têtes additionnels
		$headers .= 'From: Diapazen <no-reply@diapazen.com>' . "\r\n";
		$headers .= 'Content-Transfer-Encoding: 8bit' . "\r\n"; 

		return @mail($mailTo, utf8_decode($subject), utf8_decode($message));
	}

	 /**
	 * Fonction permettant d'envoyer un mail à plusieurs personne en copie carbone
	 * 
	 * Cette méthode permet d'envoyer un mail depuis $mailFrom à $mailTo
	 * 
	 * @param     string	$mailsTo	tableau des mails de destination
	 * @param     string    $subjet sujet du mail
	 * @param     string    $message message du mail
	 */
	 public function sendMailWithCC($mailsTo,$subjet,$message)
	{
		return sendMail($mailsTo,$subjet,$message);
	}
}

?>