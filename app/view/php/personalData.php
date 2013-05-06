<?php $this->getHeader(); ?>


        <?php
            $userName = "Bodet";
            $connected = true;
        ?>
        <div id="content">
            <form id="personal_data_form" action="profile" method="post">
                <p class="big_title">Données personnelles</p>
                <input type="text" class="text_edit" value="<?php if(isset($lastname)){echo $lastname;}?>" placeholder="Nom" name="lastname">
                <input type="text" class="text_edit" value="<?php if(isset($firstname)){echo $firstname;}?>" placeholder="Prénom" name="firstname">
                <input id="user_mail" type="mail" class="text_edit" value="<?php if(isset($email)){echo $email;}?>" placeholder="E-mail" name="mail">
                <input type="password" class="text_edit" value="" placeholder="Mot de passe" name="password">
                <input type="password" class="text_edit" value="" placeholder="Confirmer le mot de passe" name="passwordConfirm">
                <input class="orange_button" type="submit" value="Modifier">
            </form>    
        </div>
        

<?php $this->getFooter(); ?>