<?php $this->getHeader(); ?>
        <?php
            $openedPoll = true;
            $userLName = 'Disch';
            $userFName = 'Anthony';
            $eventTitle = 'Soirée chez moi !';
            $eventDate = "2013-05-20 14:45:09";
            $eventDescription = 'Bon voila, j\'organise une soirée ce samedi, qui voudrai quoi à manger ?';
            $choiceList = array(
                array('choiceName' => 'Couscous','choicePercent' => 50, 'checkList' => array('Guillaume Bauduin','Adrien Fourel')),
                array('choiceName' => 'Paella','choicePercent' => 25, 'checkList' => array('Timothée Nicolas')),
                array('choiceName' => 'Couscous','choicePercent' => 0, 'checkList' => array()),
                array('choiceName' => 'Saucisses','choicePercent' => 25, 'checkList' => array('Julien Bodet')),
            );

        ?>        

        <div id="content">
            <div id ="poll">
                <h1 class="title" > <?php echo $eventTitle; ?> </h1>
                <p class="small_title" >Par <?php echo $userLName.' '.$userFName.' le '.$eventDate; ?> </p>
                <p class="text" > <?php echo $eventDescription; ?> </p>
                <?php echo uniqid(); ?>
                <form>
                    <div id="poll_choices">
                        <table>
                            <?php
                                foreach ($choiceList as $row) {
                            ?>

                            <tr>

                                <?php 
                                    if ($openedPoll == true) {       
                                ?>

                                <td><input type="checkbox"></td>

                                <?php
                                    }
                                    else {
                                ?>

                                <td><input type="checkbox" disabled="disabled"></td>

                                <?php
                                    }
                                ?>

                                <td class="text" ><?php echo $row['choiceName'] ?> </td>
                                <td class="text" >

                                <?php
                                    $nbPeople = count($row['checkList']);
                                    if ($nbPeople == 0 || is_null($nbPeople)) {

                                    }
                                    elseif ($nbPeople == 1) {
                                        echo $row['checkList'][0].' a voté';
                                    }
                                    elseif ($nbPeople == 2) {
                                         echo $row['checkList'][0].' et <span class="link">1 autre personne</span> ont voté';
                                    }
                                    elseif ($nbPeople > 2) {
                                         echo $row['checkList'][0].' et <span class="link">'.($nbPeople-1).' autres personnes</span> ont voté';
                                    }
                                ?>

                                </td>
                            </tr>

                            <?php
                                }
                            ?>
                        </table>
                    </div>
                    <input type="text" class="small_text_edit" placeholder="Prénom Nom" >
                    <input type="button" class="orange_small_button" value="Voter" >
                </form>
            </div>
        </div>
        
<?php $this->getFooter(); ?>