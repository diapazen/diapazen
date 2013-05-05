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

    );
    $contactList = array(
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
        'adresse.emaildetest@mailtest.com',
    );
    ?>

        <div id="content">

            <h1 class="title" id="title_dashboard" >Bienvenue <?php echo $userName.' '.$userFirstName; ?></h1>
            <a id="dashboard_form" class="orange_button" href="dashboard/profile">Modifier ses données personnelles</a>

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
                            <?php echo '<form action="'.$row['link'].'">' ?> 
                                <input class="orange_small_button" type="submit" value="Voir">
                            </form>
                        </td>
                    </tr> 

                    <?php
                        }
                    ?>
                </table>
            </div>

            <h2 class="small_title small_title_dashboard">Liste de vos contacts</h2>
            <div id="contact_list">
                <table>
                    <?php
                        foreach ($contactList as $row) {
                    ?>

                    <tr>
                        <td class="text"> <?php echo $row ?> </td>
                        <td>
                            <input class="orange_small_button" type="button" value="X">
                        </td>
                    </tr>

                    <?php
                        }
                    ?>
                </table>
            </div>
            <input class="small_text_edit">
            <input class="grey_small_button" type="button" value="+">
        </div>
        

<?php $this->getFooter(); ?>