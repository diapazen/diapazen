

<?php $this->getHeader(); ?>
        
        <div id="content">
            <?php
                if(isset($err)) {
                    if($err == 'mailempty') {
                        ?>
                        <div class="error_message message_personal_data">Veuillez saisir votre adresse mail.</div>
                        <?php
                    }
                    elseif ($err == 'mailnotfound') {
                        ?>
                        <div class="error_message message_personal_data">Aucun utilisateur ne correspond à cette adresse email.</div>
                        <?php
                    }
                }
            ?>  
            <form onsubmit="return formCheck(this)" id="form_forgot" action="<?php $this->getHomeUrl(); ?>/user/forgot" class="default_form" method="post">
            	<p class="orange_text info_box" >Entrez votre e-mail pour reçevoir un nouveau mot de passe.</p>
	        	<label for="mailRetrieve" class="text">E-mail<span class="asterisc"> *</span></label>
	        	<input type="mail" id="mailRetrieve" name="email" class="text_edit" >
	        	<input class ="orange_button" type="submit" value="Envoyer">
            </form>
        </div>

<?php $this->getFooter(); ?>