<?php $this->getHeader(); ?>

        <div id="content">
            <div id="ariadne_thread"> 
                <a class="grey_ariadne" href="#"><span></span><span>Création</span><span></span></a>
                <a class="grey_ariadne" href="#"><span></span><span>Connexion</span><span></span></a>
                <a class="orange_ariadne" href="#"><span></span><span>Partage</span><span></span></a>
            </div>
            <form id="share_form" methode="post" action="share">
                <h1 class="big_title">Félicitations !</h1>
                <h2 class="title">Votre sondage a été créé !</h2>
                <h3 class="small_title">Votre lien :</h3>
                <a class="link" id="link_output" href="pollView.php">http://www.diapazen.com/poll/454d65f4</a>
                <h3 class="small_title">Partagez :</h3>
                <p class="text" id="share_info">Le lien ci-dessus leur sera envoyé</p>
                <textarea class="small_text_edit" placeholder="mail.example@mail.com"></textarea>
                <input class="orange_button" type="submit" value="Partager">
            </form>
        </div>
        
<?php $this->getFooter(); ?>