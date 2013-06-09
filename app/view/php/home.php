<?php
/**
 * Page d'accueil du site
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

<?php 
    session_destroy();
    $this->getHeader();
?>
        
        <div id="content">
            
            <article class="use_description" >
                <div class="icon_article" id="img_un">
                    <!-- <img class="img_un" src="../media/pictures/sprites_140x140.png" alt="1"> -->
                </div>
                
                <div class="text_article">
                    <h2 class="big_title">Créez votre sondage</h2>
                    <p class="big_text">Un dîner entre amis à organiser ? Un avis à demander ? Créez votre sondage en un rien de temps selon vos envies.</p>
                </div>
            </article>
            <article class="use_description">
                <div class="icon_article" id="img_deux">
                    <!-- <img class="img_deux" src="../media/pictures/sprites_140x140.png" alt="2"> -->
                </div>
                <div class="text_article">
                    <h2 class="big_title">Ajoutez des propositions</h2>
                    <p class="big_text">Votre sondage peut comporter le nombre de propositions que vous souhaitez, ajoutez-en ou supprimez-en dynamiquement.</p>
                </div>
            </article>
                <a id="create_survey" class="orange_big_button" href="poll/create">C'est parti !</a>
            <article class="use_description">
                <div class="icon_article" id="img_trois">
                    <!-- <img class="img_trois" src="../media/pictures/sprites_140x140.png" alt="3"> -->
                </div>
                <div class="text_article">
                    <h2 class="big_title">Partagez-le !</h2>
                    <p class="big_text">Invitez les personnes susceptibles de venir répondre à votre sondage. Après votre inscription, un mail leur sera envoyé pour qu'ils puissent venir faire leur choix.</p>
                </div>
            </article>

            <!-- <p id="asterisk" class="bold">*Créer un sondage nécessite une inscription, celle-ci peut se faire en même temps que la création de votre sondage</p> -->
        </div>

<?php $this->getFooter(); ?>
        
