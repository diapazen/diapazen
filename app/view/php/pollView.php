<?php $this->getHeader(); ?> 
        
        <div id="content">
            <div id ="poll">
                <div id="back_button_dashboard">
                    <a class="orange_button" href="<?php $this->getHomeUrl(); ?>/dashboard" >Retour</a>
                </div>
                <div id="poll_title_box" >
                    <h1 class="title" > <?php echo $eventTitle; ?> </h1>
                    <p class="small_title" >Sondage créé le <?php echo $creationDate.'.' ?> </p>
                    <p class="small_title" >Par <?php echo $userFName.' '.$userLName.'. '.$eventDate; ?> </p>
                </div>
                <p class="text" > <?php echo $eventDescription; ?> </p>
                <form method="post" action="<?php $this->getHomeUrl(); echo '/poll/view/'.$urlPoll;?>">
                    <div id="poll_choices">
                        <table>
                            <?php
                                $i = 0;
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
                                        <div class="meter" style="<?php echo 'width: '.$row['percent'].'%'; ?>"></div>
                                        <p class="small_text"><?php echo $row['percent'].'%'; ?></p>
                                    </div>
                                </td>   
                                <td class="text" >

                                <?php
                                    $nbPeople = count($row['checkList']);
                    
                                    if ($nbPeople == 1) {
                                        echo $row['checkList'][0].' a voté';
                                    }
                                    elseif ($nbPeople == 2) {
                                         echo $row['checkList'][0].' et <span id="link_'.$i.'" class="link">1 autre personne</span> ont voté';
                                    }
                                    elseif ($nbPeople > 2) {
                                         echo $row['checkList'][0].' et <span id="link_'.$i.'" class="link">'.($nbPeople-1).' autres personnes</span> ont voté'; 
                                    }
                                    else {
                                        echo 'Aucune personne n\'a encore voté.';

                                    }
                                    /*On ajoute la fenêtre pop up pour les autres personnes ayant voté*/
                                    if ($nbPeople == 2 || $nbPeople >2) {

                                ?>

                                    <div id="<?php echo 'vote_list_'.$i; ?>" class="vote_list">
                                        <ul>
                                
                                            <?php
                                                /* On remplit la liste des personnes ayant voté*/
                                                for ($j=1; $j < $nbPeople; $j++) { 
                                                   
                                            ?>

                                            <li> <?php echo $row['checkList'][$j]; ?> </li>

                                            <?php    
                                                }
                                            ?>

                                        </ul>
                                    </div>

                                    <script type="text/javascript">
                                        document.getElementById("<?php echo 'link_'.$i; ?>").addEventListener('mouseover', function(e){
    
                                            document.getElementById("<?php echo 'vote_list_'.$i; ?>").style.display = "block";
                                        }, false);
                                        document.getElementById("<?php echo 'link_'.$i; ?>").addEventListener('mouseout', function(e){
    
                                            document.getElementById("<?php echo 'vote_list_'.$i; ?>").style.display = "none";
                                        }, false);
                                    </script>

                                <?php
                                        $i = $i + 1;
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
                    <?php 

                        if(isset($data_updated)) {
                            if($data_updated) { ?>
                                <div style="float: right;" class="success_message message_personal_data">Votre vote a bien été pris en compte.</div>
                            <?php
                            } else { ?>
                                <div style="float: right;" class="error_message message_personal_data">Erreur, vérifiez les données saisies.</div>
                            <?php
                            }
                            ?>
                            <script>
                                $('.success_message').delay(4000).slideUp(300);
                            </script>
                    <?php
                         }
                    ?>
                </form>
            </div>
        </div>
        
<?php $this->getFooter(); ?>