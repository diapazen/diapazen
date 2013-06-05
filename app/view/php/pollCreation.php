<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form onsubmit="return formCheck(this);" id="poll_creation_form" class="default_form" action="connect" method="post">
                <h1 class="small_title">Votre sondage</h1>
                <label for="id_title_input" class="text">Titre</label>
                <input class="text_edit" id="id_title_input" name="title_input" type="text" value="">
                <label for="datepicker" class="text">Date limite <span class="small_text">(Optionnel)</span></label>
                <input class="text_edit" name="date_input" readonly id="datepicker">
                <label for="id_description_input" class="text lbl_textarea">Description</label>
                <textarea class="text_edit" id="id_description_input" name="description_input"></textarea>
                <h1 class="small_title">Propositions</h1>
                <div id="choices">
                    <div class="choice">
                        <label for="choix1" class="text lbl_choice">Choix 1</label>
                        <input class="text_edit input_choice" id="choix1" type="text" name="choices[]" value="" />
                        <a class="grey_button" type="button" onclick="manageChoices(this);">x</a>
                    </div>
                    <div class="choice">
                        <label for="choix2" class="text lbl_choice">Choix 2</label>
                        <input class="text_edit input_choice" id="choix2" type="text" name="choices[]" value="" />
                        <a class="grey_button" type="button" onclick="manageChoices(this);">x</a>
                    </div>
                    <div class="choice">
                        <label for="choix3" class="text lbl_choice">Choix 3</label>
                        <input class="text_edit input_choice" id="choix3" type="text" name="choices[]" value="" />
                        <a class="grey_button" type="button" onclick="manageChoices(this);">x</a>
                    </div>
                </div>
                <input class="orange_button" type="submit" value="Étape suivante" />
                <a class="orange_button" id="add_choice_button" type="button" onclick="manageChoices(this);">+</a>
            </form>
        </div>

        <script src="<?php $this->getPath('js/jquery-ui-1.10.3.custom.js'); ?>"></script>
        <script>datepickerLoader();</script>
         
<?php $this->getFooter(); ?>