<?php $this->getHeader(); ?>


        <?php
            $userName = "Bodet";
            $connected = true;
        ?>
        <div id="content">
            <form id="personal_data_form" action="">
                <p class="big_title">Données personnelles</p>
                <input type="text" class="text_edit" value="" placeholder="Nom">
                <input type="text" class="text_edit" value="" placeholder="Prénom">
                <input id="user_mail" type="mail" class="text_edit" value="" placeholder="E-mail">
                <input type="password" class="text_edit" value="" placeholder="Mot de passe">
                <input type="password" class="text_edit" value="" placeholder="Confirmer le mot de passe">
                <input class="orange_button" type="submit" value="Modifier">
            </form>    
        </div>
        

<?php $this->getFooter(); ?>