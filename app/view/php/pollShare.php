<?php
/**
 * Page de partage d'un sondage
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
    // namespace ns;
    // fixe un bug de la documentation
?>

<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form onsubmit="return formCheck(this)" id="share_form" class="default_form" method="post" action="<?php $this->getHomeUrl(); ?>/poll/sent">
                <h2 class="title">Votre sondage a bien été créé !</h2>
                <h3 class="small_title">Lien du sondage</h3>
                <label class="text" for="poll_link" >Lien</label>
                <input name="poll_link" type="text" id="poll_link" class="text_edit" readonly onClick="this.select();" value="<?php echo $this->getHomeUrl().'/p/'.$pollUrl; ?>" />
                <h3 class="small_title">Partagez ce lien par e-mail</h3>
                <label class="text lbl_textarea" for="mails">E-mails</label>
                <textarea class="small_text_edit" id="mails" name="mails" placeholder="mail.example@mail.com                                             Séparer les adresses par ; ou , ou retour à la ligne"></textarea>
                <input class="orange_button" type="submit" value="Partager">
                <a class="orange_button" href="<?php echo $this->getHomeUrl().'/p/'.$pollUrl; ?>">Voir le sondage</a>
            </form>
        </div>
<?php $this->getFooter(); ?>