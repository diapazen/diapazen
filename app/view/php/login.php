

<?php $this->getHeader(); ?>
        
        <div id="content">
            
            <div class="error_message" >Erreur de connexion, le nom d'utilisateur ou le mot de passe est incorrect.</div>
            
            <form action="" id="connect_box_fail">
            	<p class="title" >Réessayer de vous connecter !</p>
	        	<input id="mail_connect_fail" name="mailConnect" class="small_text_edit" type="mail" placeholder="E-mail">
	        	<input id="password_connect_fail" name="passwordConnect" class="small_text_edit" type="password" placeholder="Mot de passe">
	        	<input class ="orange_small_button" type="submit" value="Connexion">
            </form>
        </div>

<?php $this->getFooter(); ?>