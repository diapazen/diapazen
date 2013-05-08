<?php $this->getHeader(); ?>

    <?php
    $pollList = array(
        array('title' => 'Sondage Test','description' => 'Bla bla Bla bla Bla bla Bla bla Bla bla Bla bla Bla Bla bla Bla bla Bla bla Bla bla Bla bla Bla bla Bla Bla bla Bla bla Bla bla Bla bla Bla bla Bla bla Bla Bla bla Bla bla Bla Bla bla Bla bla Bla Bla bla Bla bla Bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => false),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => false),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => false),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => false),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),
        array('title' => 'Sondage Test','description' => 'Bla bla', 'link' => 'http//diapazen/12AB34CD', 'open' => true),

    );
    
    ?>

        <div id="content">
            
                <a href="<?php $this->getHomeUrl(); ?>/poll/create" id="new_poll" class="orange_button">Créer un nouvel évènement</a>
            <div id="float_button_dashboard">
                <a id="dashboard_form" class="orange_button" href="user/profile">Modifier ses données personnelles</a>
            </div>
            <h2 class="small_title small_title_dashboard">Liste de vos sondages</h2>
            <div id="poll_list">
                <table>
                    <?php
                        foreach ($pollList as $row) {
                            if ($row['open'] == true) {
                            //Sondage encore ouvert    
                    ?>

                    <tr class="opened_poll">
                        <td class="text">Ouvert</td>

                    <?php
                            }
                            else {
                            //Sondage fermé
                    ?>

                    <tr class="closed_poll">
                        <td class="text">Fermé</td>

                    <?php
                            }
                    ?>

                        <td class="text"> <?php echo $row['title']; ?> </td>
                        <td class="text"> <?php echo $row['description']; ?> </td>
                        <td> 
                            <?php echo '<a class="orange_small_button" href="'.$row['link'].'">Voir</a>' ?> 
                        </td>
                    </tr> 

                    <?php
                        }
                    ?>
                </table>
            </div>
        </div>
        

<?php $this->getFooter(); ?>