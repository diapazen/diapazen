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

class MailUtil 
{
	protected $mailFrom;
	protected $nameMailFrom;
	protected $pswFrom;
	protected $configSMTP;

	/**
	 * Constructeur de MailUtil 
	 * 
	 * Constructeur prenant en parametre le mail de celui qui envoie
	 * Son nom
	 * Le mot de passe
	 * Et la configuration du SMTP
	 * 
	 * @param     string	$mailFrom	mail d'envoi
	 * @param     string    $nameMailFrom nom du mail
	 * @param     string    $pswFrom mot de passe du compte
	 * @param     string    $nameSMTP nom du smtp
	 * @param     string    $portSMTP port du smtp
	 */
	public MailUtil($mailFrom,$nameMailFrom,$pswFrom,$nameSMTP,$portSMTP)
	{
		if(!empty($mailFrom) && !empty($nameMailFrom) && !empty($pswFrom) &&
			!empty($nameSMTP) && $portSMTP>0)
		{
			$This->mailFrom=$mailFrom;
			$This->nameMailFrom=$nameMailFrom;
			$This->pswFrom=$pswFrom;
			$This->configSMTP=$configSMTP.':'.$portSMTP;
		}
		else
		{
			throw new coreException("Error in MailUtil constructor");
			
		}
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
	 public function sendMail($mailTo,$subjet,$message)
	{
		//require de phpmailer et création d'une instance
		require "../phpmailer/class.phpmailer.php";
		$mail = new PHPmailer();

		//configuration du mail
		$mail->SetLanguage('fr');
		$mail->CharSet = 'utf-8';
		$mail->IsSMTP();
		$mail->Host = $configSMTP;
		$mail->Username=$mailFrom;
		$mail->Password=$pswFrom;
		$mail->From = $mailFrom;
		$mail->FromName = $nameMailFrom;
		$mail->AddAddress($mailTo);

		$mail->IsHTML(true);
		$mail->Subject = $subjet;
		$mail->Body = $message;

		//envoi du mail
		if(!$mail->Send())
		{
		 	throw new coreException($mail->ErrorInfo);
		 	return false;
		}

		$mail->SmtpClose();
		unset($mail);

		return true;
	}
}

?>