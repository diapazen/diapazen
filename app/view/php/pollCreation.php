<?php $this->getHeader(); ?>

<?php
    if(!isset($poll_title)) $poll_title="Titre";
    if(!isset($poll_description)) $poll_description="Description";

?>

        <div id="content">
            <div id="ariadne_thread"> 
                <a class="orange_ariadne" href="#"><span></span><span>Création</span><span></span></a>
                <a class="grey_ariadne" href="#"><span></span><span>Connexion</span><span></span></a>
                <a class="grey_ariadne" href="#"><span></span><span>Partage</span><span></span></a>
            </div>
            <form id="poll_creation_form" class="default_form" action="connect" method="post">
                <h1 class="small_title">Votre sondage</h1>
                <input class="text_edit" id="id_title_input" name="title_input" type="text" placeholder="Titre" value=<?php echo $poll_title;?>>
                <textarea class="text" id="id_description_input" name="description_input" placeholder="Description" value=<?php echo $poll_description;?>></textarea>
                <h1 class="small_title">Propositions</h1>
                <div id="choices">
                    <div class="choice">
                        <input class="text_edit" type="text" name="choix[]" placeholder="Choix 1" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <input class="text_edit" type="text" name="choix[]" placeholder="Choix 2" />
                        <input class="orange_button" type="button" onclick="manageChoices(this);" value="+" />
                    </div>
                </div>
                <input class="orange_button" type="submit" value="Étape suivante" />
            </form>
        </div>

        
        <script type="text/javascript" src="<?php $this->getPath('js/script.js');?>"></script>
        
<?php $this->getFooter(); ?>