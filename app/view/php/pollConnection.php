<?php $this->getHeader(); ?>

        <div id="content">
            <?php $this->getAriadneThread(); ?>

            <?php 
                if(isset($err))
                {
                    switch($err)
                    {
                        case 'connectionError':
                            echo "<div class='error_message' >Erreur de connexion, le nom d'utilisateur ou le mot de passe est incorrect.</div><br>";
                            break;

                        case 'registrationError':
                            echo "<div class='error_message' >Cette adresse e-mail est déjà utilisée.</div><br>";
                            break;

                        case 'mailError':
                            echo "<div class='error_message' >L'adresse e-mail est incorrecte.</div><br>";
                            break;
                    }
                }
            ?>


            <form onsubmit="return formCheck(this)" action="<?php $this->getHomeUrl(); ?>/poll/connect" method="post" class="default_form" id="poll_connection_form">
                <label for="registered" class="text label_chkbox"><input id="registered" value="registered" type="radio" name="account" checked="checked" onchange="manageConnectionForm(this)">J'ai déjà un compte</label>
                <label for="not_registered" class="text label_chkbox"><input onchange="manageConnectionForm(this)" id="not_registered" value="not_registered" type="radio" name="account">C'est rapide, je m'inscris</label>
                <label for="email" class="text">E-mail<span class="asterisc"> *</span></label>
                <input class="text_edit" id="email" name="email" type="mail" placeholder="" value="">
                <label for="firstname_user" class="text infos_user">Prénom<span class="asterisc"> *</span></label>
                <input class="text_edit infos_user" id="firstname_user" name="firstNameUser" type="text">
                <label for="name_user" class="text infos_user">Nom<span class="asterisc"> *</span></label>
                <input class="text_edit infos_user" id="lastname_user" name="lastNameUser" type="text">
                <label for="pwd_user" class="text">Mot de passe<span class="asterisc"> *</span></label>
                <input class="text_edit" id="pwd_user" type="password" name="password" placeholder="" value="">
                <p class="orange_text info_box infos_user">Un mot de passe vous sera envoyé à l'adresse e-mail renseignée.</p>
                <input class="orange_button" type="submit" value="Étape suivante"/>
            </form>
        </div>

        
        <script src="<?php $this->getPath('js/script.js'); ?>"> </script>
<?php $this->getFooter(); ?>

