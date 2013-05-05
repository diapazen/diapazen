<?php $this->getHeader(); ?>

        <div id="content">
            <div id="ariadne_thread"> 
                <a class="orange_ariadne" href="#">Création</a>
                <a class="grey_ariadne" href="#">Connexion</a>
                <a class="grey_ariadne" href="#">Partage</a>
            </div>
            <form id="poll_creation_form" action="connect" method="post">
                <h1 class="small_title">Paramètres :</h1>
                <input class="big_text" id="title_input" type="text" placeholder="Titre">
                <textarea class="text" id="description_input" placeholder="Description"></textarea>
                <h1 class="small_title">Vos choix :</h1>
                <div class="choice">
                    <input class="text" type="text" value="Choix 1">
                    <input class="grey_small_button" type="button" value="x">
                </div>
                <div class="choice">
                    <input class="text" type="text" placeholder="Choix 2">
                    <input class="orange_small_button" type="button" value="+">
                </div>
                <input class="orange_button" type="submit" value="Etape suivante">
            </form>
        </div>
        
<?php $this->getFooter(); ?>