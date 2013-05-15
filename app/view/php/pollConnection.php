<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>
            <form action="share" method="post" class="default_form" id="poll_connection_form">
                <label for="registered" class="text"><input id="registered" value="registered" type="radio" name="account" checked="checked">J'ai déjà un compte</label>
                <label for="not_registered" class="text"><input id="not_registered" value="not_registered" type="radio" name="account">C'est rapide, je m'inscris</label>
                <input class="text_edit" name="email" type="mail" placeholder="E-mail" value="adrien.fourel@isen.fr">
                <input class="text_edit" id="first_name_user" name="firstNameUser" type="text" placeholder="Prénom">
                <input class="text_edit" id="name_user" name="nameUser" type="text" placeholder="Nom">
                <input class="text_edit" id="pwd_user" type="password" name="password" placeholder="Mot de passe" value="passe">
                <p class="orange_text" id="mail_info">Un mot de passe vous sera envoyé à l'adresse e-mail renseignée.</p>
                <input class="orange_button" type="submit" value="Étape suivante"/>
            </form>
        </div>
        <script type="text/javascript" src="<?php $this->getPath('js/pollConnection.js'); ?>"></script>
<?php $this->getFooter(); ?>

