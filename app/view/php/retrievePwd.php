

<?php $this->getHeader(); ?>
        
        <div id="content">            
            <form action="<?php $this->getHomeUrl(); ?>/user/login" id="retrieve_pwd_form" method="post">
            	<p class="text" >Entrez votre e-mail pour reçevoir un nouveau mot de passe.</p>
	        	<input type="mail" placeholder="E-mail" id="mail" name="mail" class="text_edit" >
	        	<input class ="orange_button" type="submit" value="Envoyer">
            </form>
        </div>

<?php $this->getFooter(); ?>