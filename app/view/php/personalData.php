<?php
/**
 * Page de modification des données personnelles
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
            //$data_updated = false;

            if(isset($data_updated)) {
                if($data_updated) {
                    ?>
                    <div class="success_message message_personal_data">Vos données personelles ont été mises à jour avec succés.</div>
                    <?php
                } else {
                    ?>
                    <div class="error_message message_personal_data">Erreur, vérifiez les données saisies.</div>
                    <?php  
                }
            }
        ?>
        <form onsubmit="return formCheck(this)" id="personal_data_form" class="default_form" action="profile" method="post">
            <p class="big_title" id="title_personnal_data">Données personnelles</p>
            <label class="text" for="user_lastname">Nom<span class="asterisc"> *</span></label>
            <input type="text" id="user_lastname" class="text_edit" value="<?php if(isset($lastname)){echo $lastname;}?>" name="lastNameUser">
            <label class="text" for="user_firstname">Prénom<span class="asterisc"> *</span></label>
            <input type="text" id="user_firstname" class="text_edit" value="<?php if(isset($firstname)){echo $firstname;}?>" name="firstNameUser">
            <label class="text" for="user_mail">E-mail<span class="asterisc"> *</span></label>
            <input id="user_mail" type="mail" class="text_edit" value="<?php if(isset($email)){echo $email;}?>" name="email">
            <label class="text" for="new_pwd">Nouveau mot de passe</label>
            <input type="password" id="new_pwd" class="text_edit" placeholder="3 carac. minimum" name="newPassword">
            <label class="text" for="new_pwd_confirm">Confirmation</label>
            <input type="password" id="new_pwd_confirm" class="text_edit" value="" name="passwordConfirm">
            <br/>
            <p class="orange_text info_box">Pour confirmer les modifications, entrez votre mot de passe actuel.</p>
            <label class="text" for="pwd_user">Mot de passe<span class="asterisc"> *</span></label>
            <input type="password" id="pwd_user" class="text_edit" value="" name="password">
            <a class="grey_button" href="<?php $this->getHomeUrl(); ?>/dashboard" >Annuler</a>
            <input class="orange_button" type="submit" value="Modifier">
        </form>    
    </div>

<?php $this->getFooter(); ?>