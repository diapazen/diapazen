<?php $this->getHeader(); ?>

    <?php
    $connected = true;
    $userName = 'Julien';
    $userFirstName = 'Bodet';
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

            <h1 class="title" id="title_dashboard" >Bienvenue <?php echo $userName.' '.$userFirstName; ?></h1>
            <a id="dashboard_form" class="orange_button" href="user/profile">Modifier ses données personnelles</a>

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

            <form id="new_poll">
                <input type="submit" class="orange_button" value="Créer un nouvel évènement">
            </form>

        </div>
        

<?php $this->getFooter(); ?>