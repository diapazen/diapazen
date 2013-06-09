<?php
/**
 * Page de confirmation de partage par email
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
                <h2 class="title">Confirmation de l'envoi</h2>
                <br>
                <?php
                if(isset($sent))
            	{
            		switch($sent)
            		{
            			case 'fail':
            				echo "<div class='error_message' >Erreur lors de l'envoi de votre sondage.</div>";
            				break;

            			case 'success':
            				echo "<div class='success_message' >Votre sondage a bien été envoyé !</div>";
            				break;
            		}
            	}
                ?>
                <br>
                <div style="text-align: center;">
                    <a class="orange_button" href="<?php echo $pollUrl; ?>">Retour vers le sondage</a>
                </div>
            </form>
        </div>

<?php $this->getFooter(); ?>