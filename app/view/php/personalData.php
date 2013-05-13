<?php $this->getHeader(); ?>

        <div id="content">
            <form id="personal_data_form" class="default_form" action="profile" method="post">
                <p class="big_title">Données personnelles</p>
                <input type="text" class="text_edit" value="<?php if(isset($lastname)){echo $lastname;}?>" placeholder="Nom" name="lastname">
                <input type="text" class="text_edit" value="<?php if(isset($firstname)){echo $firstname;}?>" placeholder="Prénom" name="firstname">
                <input id="user_mail" type="mail" class="text_edit" value="<?php if(isset($email)){echo $email;}?>" placeholder="E-mail" name="mail">
                <input type="password" class="text_edit" value="" placeholder="Nouveau mot de passe" name="password">
                <input type="password" class="text_edit" value="" placeholder="Confirmer le mot de passe" name="passwordConfirm">
                <br/>
                <p class="orange_text">Pour confirmer les modifications, entrez votre mot de passe actuel.</p>
                <input type="password" class="text_edit" value="" placeholder="Mot de passe" name="passwordSecurity">
                <a class="grey_button" href="<?php $this->getHomeUrl(); ?>/dashboard" >Annuler</a>
                <input class="orange_button" type="submit" value="Modifier">
            </form>    
        </div>
        

<?php $this->getFooter(); ?>