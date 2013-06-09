<?php
/**
 * Page du dashboard
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
            
                <a href="<?php $this->getHomeUrl(); ?>/poll/create" id="new_poll" class="orange_button">Créer un nouvel évènement</a>
            <div id="float_button_dashboard">
                <a id="dashboard_form" class="orange_button" href="user/profile">Modifier mes données personnelles</a>
            </div>
            <h2 class="small_title small_title_dashboard">Vos sondages</h2>

            <?php
                if(isset($data_updated)) {

                     if($data_updated) {
                        ?>
                        <div class="success_message message_dashboard">Le sondage a été clôturé avec succés.</div>
                        <?php
                    } else {
                        ?>
                        <div class="error_message message_dashboard">Erreur lors de la clôture du sondage.</div>
                        <?php  
                    }
                ?>

                <script>
                    $('.message_dashboard').delay(4000).slideUp(300);
                </script>

            <?php
                }
            ?>
        
            <div class="text" id="poll_list">
                <table>
                    <tr cols="3" class="head_dash">
                        <td>Statut</td><td>Ouvert le</td><td>Titre</td><td>Description</td><td></td>
                    </tr>
                    <?php
                        foreach($pollList as $row)
                        {

                            if ($row['open'] == true)
                            {
                            //Sondage encore ouvert    
                    ?>

                    <tr class="opened_poll">
                        
                        <td>Ouvert</td>
                        <td><?php echo date("d/m/Y", strtotime($row['creation_date'])); ?></td>
                        <td> <?php echo $row['title']; ?> </td>
                        <td> <?php echo $row['description']; ?> </td>
                        <td> 
                            <a class="orange_small_button" href="<?php $this->getHomeUrl(); echo '/poll/view/'.$row['url']; ?>">Voir</a>
                            <form action="<?php $this->getHomeUrl(); ?>/dashboard" onsubmit="return confirm('Clôturer le sondage ?');" method="post">
                                <input type="hidden" name="close" value="<?php echo $row['POLL_ID']; ?>"> 
                                <input type="submit" class="grey_small_button" value="Clôturer">
                            </form>
                        </td>
                    <?php
                            } 
                            else {
                            //Sondage fermé
                    ?>

                    <tr class="closed_poll">
                        <td>Fermé</td>
                        <td><?php echo date("d/m/Y", strtotime($row['creation_date'])); ?></td>
                        <td> <?php echo $row['title']; ?> </td>
                        <td> <?php echo $row['description']; ?> </td>
                        <td> 
                            <a class="orange_small_button" href="<?php $this->getHomeUrl(); echo '/poll/view/'.$row['url']; ?>">Voir</a> 
                        </td>
                    <?php
                            }

                    ?>


                    </tr> 

                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        

<?php $this->getFooter(); ?>