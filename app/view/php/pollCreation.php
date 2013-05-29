<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form id="poll_creation_form" class="default_form" action="connect" method="post">
                <h1 class="small_title">Votre sondage</h1>
                <label for="id_title_input" class="text">Titre</label>
                <input class="text_edit" id="id_title_input" name="title_input" type="text" value="">
                <label for="dp2" class="text">Date limite <span class="small_text">(Optionnel)</span></label>
                <input class="text_edit" name="date_input" id="datepicker">
                <div class="textarea_box" >
                    <label for="id_description_input" class="text">Description</label>
                    <textarea class="text" id="id_description_input" name="description_input"></textarea>
                </div>
                <h1 class="small_title">Propositions</h1>
                <div id="choices">
                    <div class="choice">
                        <label class="text lbl_choice">Choix 1</label>
                        <input class="text_edit" type="text" name="choices[]" value="" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <label class="text lbl_choice">Choix 2</label>
                        <input class="text_edit" type="text" name="choices[]" value="" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <label class="text lbl_choice">Choix 3</label>
                        <input class="text_edit" type="text" name="choices[]" value="" />
                        <input class="orange_button" type="button" onclick="manageChoices(this);" value="+" />
                    </div>
                </div>
                <input class="orange_button" type="submit" value="Étape suivante" />
            </form>
        </div>

        <script src="<?php $this->getPath('js/jquery-ui-1.10.3.custom.js'); ?>"> </script>
        <script src="<?php $this->getPath('js/script.js'); ?>"> </script>
         
<?php $this->getFooter(); ?>