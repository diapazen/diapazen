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
                            echo "<div class='error_message' >Un utilisateur possède déja cette adresse e-mail.</div><br>";
                            break;

                        case 'mailError':
                            echo "<div class='error_message' >L'adresse e-mail est incorrecte.</div><br>";
                            break;
                    }
                }
            ?>


            <form onsubmit="return formCheck(this)" action="share" method="post" class="default_form" id="poll_connection_form">
                <label for="registered" class="text label_chkbox"><input id="registered" value="registered" type="radio" name="account" checked="checked" onchange="manageConnectionForm(this)">J'ai déjà un compte</label>
                <label for="not_registered" class="text label_chkbox"><input onchange="manageConnectionForm(this)" id="not_registered" value="not_registered" type="radio" name="account">C'est rapide, je m'inscris</label>
                <label for="email" class="text">E-mail</label>
                <input class="text_edit" id="email" name="email" type="mail" placeholder="" value="">
                <span id="infos_user">
                    <label for="firstname_user" class="text">Prénom</label>
                    <input class="text_edit" id="firstname_user" name="firstNameUser" type="text">
                    <label for="name_user" class="text">Nom</label>
                    <input class="text_edit" id="lastname_user" name="nameUser" type="text">
                </span>
                <label for="pwd_user" class="text">Mot de passe</label>
                <input class="text_edit" id="pwd_user" type="password" name="password" placeholder="" value="">
                <p class="orange_text info_box" id="mail_info">Un mot de passe vous sera envoyé à l'adresse e-mail renseignée.</p>
                <input class="orange_button" type="submit" value="Étape suivante"/>
            </form>
        </div>
<?php $this->getFooter(); ?>

