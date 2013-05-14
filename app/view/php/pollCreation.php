<?php $this->getHeader(); ?>

<?php
    if(!isset($poll_title)) $poll_title = "Meilleur Balisto";
    if(!isset($poll_description)) $poll_description = "Quel est le meilleur Balisto ?";
?>

        <div id="content">
            <div id="ariadne_thread"> 
                <span class="orange_ariadne" ><span></span><span>Création</span><span></span></span>
                <span class="grey_ariadne" ><span></span><span>Connexion</span><span></span></span>
                <span class="grey_ariadne" ><span></span><span>Partage</span><span></span></span>
            </div>
            <form id="poll_creation_form" class="default_form" action="connect" method="post">
                <h1 class="small_title">Votre sondage</h1>
                <input class="text_edit" id="id_title_input" name="title_input" type="text" placeholder="Titre" value="<?php echo $poll_title;?>">
                <input class="text_edit" id="id_date_input" name="date_input" type="text" placeholder="Date d'expiration">
                <textarea class="text" id="id_description_input" name="description_input" placeholder="Description"><?php echo $poll_description;?></textarea>
                <h1 class="small_title">Propositions</h1>
                <div id="choices">
                    <div class="choice">
                        <input class="text_edit" type="text" name="choices[]" placeholder="Choix 1" value="Jaune" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <input class="text_edit" type="text" name="choices[]" placeholder="Choix 2"  value="Violet" />
                        <input class="grey_button" type="button" onclick="manageChoices(this);" value="x" />
                    </div>
                    <div class="choice">
                        <input class="text_edit" type="text" name="choices[]" placeholder="Choix 3"  value="Vert" />
                        <input class="orange_button" type="button" onclick="manageChoices(this);" value="+" />
                    </div>
                </div>
                <input class="orange_button" type="submit" value="Étape suivante" />
            </form>
        </div>

        
        <script type="text/javascript" src="<?php $this->getPath('js/script.js');?>"></script>
        
<?php $this->getFooter(); ?>