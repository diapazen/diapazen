<?php
/**
 * Page de création d'un sondage
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
            <?php $this->getAriadneThread(); ?>
            <form onsubmit="return formCheck(this);" id="poll_creation_form" class="default_form" action="connect" method="post">
                <h1 class="small_title">Votre sondage</h1>
                <label for="id_title_input" class="text">Titre<span class="asterisc"> *</span></label>
                <input class="text_edit" id="id_title_input" name="title_input" type="text" value="">
                <label for="datepicker" class="text">Date limite</label>
                <input class="text_edit" name="date_input" readonly id="datepicker">
                <label for="id_description_input" class="text lbl_textarea">Description<span class="asterisc"> *</span></label>
                <textarea class="small_text_edit" id="id_description_input" maxlength="1000" placeholder="1000 carac. maximum." name="description_input"></textarea>
                <h1 class="small_title">Propositions</h1>
                <div id="choices">
                    <div class="choice">
                        <label for="choix1" class="text lbl_choice">Choix 1<span class="asterisc"> *</span></label>
                        <input class="text_edit input_choice" id="choix1" type="text" name="choices[]" value="" />
                        <a class="grey_button" title="Supprimer" type="button" onclick="manageChoices(this);">x</a>
                    </div>
                    <div class="choice">
                        <label for="choix2" class="text lbl_choice">Choix 2<span class="asterisc"> *</span></label>
                        <input class="text_edit input_choice" id="choix2" type="text" name="choices[]" value="" />
                        <a class="grey_button" title="Supprimer" type="button" onclick="manageChoices(this);">x</a>
                    </div>
                    <div class="choice">
                        <label for="choix3" class="text lbl_choice">Choix 3<span class="asterisc"> *</span></label>
                        <input class="text_edit input_choice" id="choix3" type="text" name="choices[]" value="" />
                        <a class="grey_button" title="Supprimer" type="button" onclick="manageChoices(this);">x</a>
                    </div>
                </div>
                <input class="orange_button" type="submit" value="Étape suivante" />
                <a class="orange_button" title="Ajouter un champ" id="add_choice_button" type="button" onclick="manageChoices(this);">+</a>
            </form>
        </div>
   
        <script src="<?php $this->getPath('js/script.js'); ?>"> </script>
        <script src="<?php $this->getPath('js/jquery-ui-1.10.3.custom.js'); ?>"></script>
        <script>datepickerLoader();</script>
         
<?php $this->getFooter(); ?>

