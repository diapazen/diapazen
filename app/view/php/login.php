

<?php $this->getHeader(); ?>
        
        <div id="content">
            
            <?php 
            	if(isset($infoLogin))
            	{
            		switch($infoLogin)
            		{
            			case 'connectionError':
            				echo "<div class='error_message' >Erreur de connexion, le nom d'utilisateur ou le mot de passe est incorrect.</div>";
            				break;

            			case 'sendPassword':
            				echo "<div class='success_message' >Votre message vous a été envoyé, tentez de vous connecter.</div>";
            				break;
            		}
            	}
            ?>
            
            <form action="<?php $this->getHomeUrl(); ?>/user/login" class="default_form" id="connect_box_fail" method="post">
            	<p class="title" >Réessayer de vous connecter !</p>
                <label for="mail_connect_fail" class="text" >E-mail</label>
	        	<input id="mail_connect_fail" name="mailConnect" class="text_edit" type="mail" placeholder="E-mail">
	        	<label for="password_connect_fail" class="text" >Mot de passe</label>
                <input id="password_connect_fail" name="passwordConnect" class="text_edit" type="password" placeholder="Mot de passe">
	        	<input class ="orange_button" type="submit" value="Connexion">
            </form>
        </div>

<?php $this->getFooter(); ?>