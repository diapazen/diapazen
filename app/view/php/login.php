<?php
/**
 * Page de connexion
 * 
 * @package     Diapazen
 * @subpackage  View
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

    // fixe un bug de la documentation
    namespace ns;
    // fixe un bug de la documentation
?>

<?php $this->getHeader(); ?>
        
        <div id="content">
            
            <?php 
            	if(isset($infoLogin))
            	{
            		switch($infoLogin)
            		{
            			case 'connectionError':
            				echo "<div class='error_message' >Erreur de connexion, le nom d'utilisateur ou le mot de passe est incorrect.</div>";
            				break;

            			case 'sendPassword':
            				echo "<div class='success_message' >Votre mot de passe vous a été envoyé, tentez de vous connecter.</div>";
            				break;

                        case 'sendFailPassword':
                            echo "<div class='error_message' >Erreur lors de l'envoi de l'email. Nous allons corriger le problème le plus rapidement possible.</div>";
                            break;
            		}
            	}
            ?>
            
            <form onsubmit="return formCheck(this)" action="<?php $this->getHomeUrl(); ?>/user/login" class="default_form" id="connect_box_fail" method="post">
            	<p class="title" >Réessayer de vous connecter !</p>
                <label for="mail_connect_fail" class="text" >E-mail</label>
	        	<input id="mail_connect_fail" name="email" class="text_edit" type="mail" >
	        	<label for="password_connect_fail" class="text" >Mot de passe</label>
                <input id="password_connect_fail" name="password" class="text_edit" type="password" >
	        	<input class ="orange_button" type="submit" value="Connexion">
            </form>
        </div>

<?php $this->getFooter(); ?>