

<?php $this->getHeader(); ?>
        
        <div id="content">
            
            <div class="error_message" >Erreur de connexion, le nom d'utilisateur ou le mot de passe est incorrect.</div>
            
            <form action="<?php $this->getHomeUrl(); ?>/user/login" class="default_form" id="connect_box_fail" method="post">
            	<p class="title" >Réessayer de vous connecter !</p>
	        	<input id="mail_connect_fail" name="mailConnect" class="text_edit" type="mail" placeholder="E-mail">
	        	<input id="password_connect_fail" name="passwordConnect" class="text_edit" type="password" placeholder="Mot de passe">
	        	<input class ="orange_button" type="submit" value="Connexion">
            </form>
        </div>

<?php $this->getFooter(); ?>