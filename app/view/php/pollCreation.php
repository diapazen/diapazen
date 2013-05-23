<?php $this->getHeader(); ?>

<?php
    if(!isset($poll_title)) $poll_title = "Meilleur Balisto";
    if(!isset($poll_description)) $poll_description = "Quel est le meilleur Balisto ?";
?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form id="poll_creation_form" class="default_form" action="connect" method="post">
                <h1 class="small_title">Votre sondage</h1>
                <label for="id_title_input" class="text">Titre</label>
                <input class="text_edit" id="id_title_input" name="title_input" type="text" value="<?php echo $poll_title;?>">
                <label for="id_date_input" class="text">Date limite</label>
                <input class="text_edit" id="id_date_input" name="date_input" type="text" >
                <div class="textarea_box" >
                    <label for="id_description_input" class="text">Description</label>
                    <textarea class="text" id="id_description_input" name="description_input" ><?php echo $poll_description;?></textarea>
                </div>
                <h1 class="small_title">Propositions</h1>
                <div id="choices">
                    <div class="choice">
                        <label class="text lbl_choice">Choix 1</label>
                        <input class="text_edit" type="text" name="choices[]" value="Jaune" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <label class="text lbl_choice">Choix 2</label>
                        <input class="text_edit" type="text" name="choices[]" value="Violet" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <label class="text lbl_choice">Choix 3</label>
                        <input class="text_edit" type="text" name="choices[]" value="Vert" />
                        <input class="orange_button" type="button" onclick="manageChoices(this);" value="+" />
                    </div>
                </div>
                <input class="orange_button" type="submit" value="Étape suivante" />
            </form>
        </div>

        
        <script type="text/javascript" src="<?php $this->getPath('js/script.js');?>"></script>
        
<?php $this->getFooter(); ?>