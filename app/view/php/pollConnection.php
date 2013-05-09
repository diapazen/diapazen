<?php $this->getHeader(); ?>

        <div id="content">
            <div id="ariadne_thread"> 
                <a class="grey_ariadne" href="#"><span></span><span>Création</span><span></span></a>
                <a class="orange_ariadne" href="#"><span></span><span>Connexion</span><span></span></a>
                <a class="grey_ariadne" href="#"><span></span><span>Partage</span><span></span></a>
            </div>
            <form action="share" method="post" id="poll_connection_form">

                <input id="mail_user" class="small_text_edit" name="email" type="email" placeholder="E-mail">

                <label class="text"><input id="registered" type="radio" name="account">Déjà un compte</label>

                <label class="text"><input id="not_registered" type="radio" name="account">C'est rapide, je m'inscris</label>

                <input class="small_text_edit" id="name_user" name="nameUser" type="text" placeholder="Nom">

                <input class="small_text_edit" id="first_name_user" name="firstNameUser" type="text" placeholder="Prénom">

                <input id="pwd_user" class="small_text_edit" type="password" name="password" placeholder="Mot de passe" value="">

                <p id="mail_info" class="text">Votre mot de passe vous sera envoyé à l'adresse e-mail renseignée.</p>

                <input class="orange_button" type="submit" value="Etape suivante"/>
            </form>
        </div>
        <script type="text/javascript" src="<?php $this->getPath('js/pollConnection.js'); ?>"></script>
<?php $this->getFooter(); ?>

