<?php $this->getHeader(); ?>

        <div id="content">
            <div id="ariadne_thread"> 
                <a class="grey_ariadne" href="#"><span></span><span>Création</span><span></span></a>
                <a class="grey_ariadne" href="#"><span></span><span>Connexion</span><span></span></a>
                <a class="orange_ariadne" href="#"><span></span><span>Partage</span><span></span></a>
            </div>
            <form id="share_form" class="default_form" method="post" action="share">
                <h2 class="title">Votre sondage a bien été créé !</h2>
                <h3 class="small_title">Lien du sondage</h3>
                <p class="orange_text" >Copier ce lien pour le donner à qui vous souhaitez.</p>
                <input type="text" class="text_edit" onClick="this.select();" value="http://www.diapazen.com/poll/454d65f4" />
                <h3 class="small_title">Partagez ce lien par e-mail</h3>
                <textarea class="text_edit" placeholder="mail.example@mail.com"></textarea>
                <input class="orange_button" type="submit" value="Partager">
            </form>
        </div>
        
<?php $this->getFooter(); ?>