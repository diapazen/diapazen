<?php
/**
 * Page de récupération du mot de passe
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
                if(isset($err)) {
                    if($err == 'mailempty') {
                        ?>
                        <div class="error_message message_personal_data">Veuillez saisir votre adresse mail.</div>
                        <?php
                    }
                    elseif ($err == 'mailnotfound') {
                        ?>
                        <div class="error_message message_personal_data">Aucun utilisateur ne correspond à cette adresse email.</div>
                        <?php
                    }
                }
            ?>  
            <form onsubmit="return formCheck(this)" id="form_forgot" action="<?php $this->getHomeUrl(); ?>/user/forgot" class="default_form" method="post">
            	<p class="orange_text info_box" >Entrez votre e-mail pour reçevoir un nouveau mot de passe.</p>
	        	<label for="mailRetrieve" class="text">E-mail<span class="asterisc"> *</span></label>
	        	<input type="mail" id="mailRetrieve" name="email" class="text_edit" >
	        	<input class ="orange_button" type="submit" value="Envoyer">
            </form>
        </div>

<?php $this->getFooter(); ?>