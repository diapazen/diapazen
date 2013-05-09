<?php $this->getHeader(); ?>

        <div id="content">
            <div id="ariadne_thread"> 
                <a class="grey_ariadne" href="#"><span></span><span>Création</span><span></span></a>
                <a class="orange_ariadne" href="#"><span></span><span>Connexion</span><span></span></a>
                <a class="grey_ariadne" href="#"><span></span><span>Partage</span><span></span></a>
            </div>
            <form action="share" method="post" id="poll_connection_form">
                <input id="mail_user" class="small_text_edit" name="email" type="email" placeholder="E-mail">
                <label class="text"><input value="registered" type="radio" name="account">Déjà un compte</label>
                <label class="text"><input value="not_registered" type="radio" name="account">C'est rapide, je m'inscris</label>
                <input class="small_text_edit" id="name_user" name="nameUser" type="text" placeholder="Nom">
                <input class="small_text_edit" id="first_name_user" name="firstNameUser" type="text" placeholder="Prénom">
                <input class="small_text_edit" type="password" name="password" placeholder="Mot de passe" value="passe">
                <p id="mail_info" class="text">Un mail sera envoyé sur l'adresse e-mail entrée ci-dessus avec votre mot de passe généré aléatoirement</p>
                <input class="orange_button" type="submit" value="Etape suivante"/>
            </form>
        </div>
       
<?php $this->getFooter(); ?>