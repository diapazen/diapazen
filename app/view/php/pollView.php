<?php $this->getHeader(); 
    $percent = 50;
?> 
        
        <div id="content">
            <div id ="poll">
                <div id="back_button_dashboard">
                    <a class="orange_button" href="<?php $this->getHomeUrl(); ?>/dashboard" >Retourner au dashboard</a>
                </div>
                <div id="poll_title_box" >
                    <h1 class="title" > <?php echo $eventTitle; ?> </h1>
                    <p class="small_title" >Par <?php echo $userFName.' '.$userLName.'. '.$eventDate; ?> </p>
                </div>
                <p class="text" > <?php echo $eventDescription; ?> </p>
                <form method="post" action="<?php $this->getHomeUrl(); echo '/poll/view/'.$urlPoll;?>">
                    <div id="poll_choices">
                        <table>
                            <?php
                                foreach ($choiceList as $key => $row) {
                            ?>

                            <tr>

                                <?php 
                                    if ($openedPoll == true) {       
                                ?>

                                <td><input type="checkbox" name="choiceId[]" value="<?php echo $key; ?>"></td>

                                <?php
                                    }
                                    else {
                                ?>

                                <td><input type="checkbox" disabled="disabled"></td>

                                <?php
                                    }
                                ?>

                                <td class="text"><?php echo $row['choiceName'] ?> </td> 
                                <td class="progression_bar">
                                    <div class="container">
                                        <div class="meter" style="<?php echo 'width: '.$percent.'%' ?>"></div>
                                        <p class="text"><?php echo $percent.'%'; ?></p>
                                    </div>
                                </td>   
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
                    <?php if ($openedPoll) {?>
                    <input type="text" class="small_text_edit" placeholder="Prénom Nom" name="value" >
                    <input type="submit" class="orange_small_button" value="Voter" >
                    <?php } ?>
                </form>
            </div>
        </div>
        
<?php $this->getFooter(); ?>