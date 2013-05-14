<?php $this->getHeader(); ?>

        <div id="content">
            <div id="ariadne_thread"> 
                <span class="grey_ariadne" ><span></span><span>Création</span><span></span></span>
                <span class="grey_ariadne" ><span></span><span>Connexion</span><span></span></span>
                <span class="orange_ariadne" ><span></span><span>Partage</span><span></span></span>
            </div>
            <form id="share_form" class="default_form" method="post" action="sharePoll">
                <h2 class="title">Votre sondage a bien été créé !</h2>
                <h3 class="small_title">Lien du sondage</h3>
                <p class="orange_text" >Copier ce lien pour le donner à qui vous souhaitez.</p>
                <input type="text" class="text_edit" onClick="this.select();" value="localhost<?php $this->getHomeUrl(); ?>/poll/view/<?php echo $pollUrl; ?>" />
                <h3 class="small_title">Partagez ce lien par e-mail</h3>
                <textarea class="text_edit" name="mails" placeholder="mail.example@mail.com"></textarea>
                <input class="orange_button" type="submit" value="Partager">
            </form>
        </div>
        
<?php $this->getFooter(); ?>