<?php $this->getHeader(); ?>

        <div id="content">
            
                <a href="<?php $this->getHomeUrl(); ?>/poll/create" id="new_poll" class="orange_button">Créer un nouvel évènement</a>
            <div id="float_button_dashboard">
                <a id="dashboard_form" class="orange_button" href="user/profile">Modifier ses données personnelles</a>
            </div>
            <h2 class="small_title small_title_dashboard">Vos sondages</h2>
            <div class="text" id="poll_list">
                <table>
                    <tr cols="3" class="head_dash">
                        <td>Statut</td><td>Titre</td><td>Description</td><td></td>
                    </tr>
                    <?php
                        foreach ($pollList as $row)
                        {

                            if ($row['open'] == true)
                            {
                            //Sondage encore ouvert    
                    ?>

                    <tr class="opened_poll">
                        <td>Ouvert</td>
                        <td> <?php echo $row['title']; ?> </td>
                        <td> <?php echo $row['description']; ?> </td>
                        <td> 
                            <a class="orange_small_button" href="<?php $this->getHomeUrl(); echo '/poll/view/'.$row['url']; ?>">Voir</a> 
                            <input class="grey_small_button" value="Clôturer">
                        </td>

                    <?php
                            } 
                            else {
                            //Sondage fermé
                    ?>

                    <tr class="closed_poll">
                        <td>Fermé</td>
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