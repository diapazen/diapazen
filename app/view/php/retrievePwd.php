

<?php $this->getHeader(); ?>
        
        <div id="content">            
            <form action="<?php $this->getHomeUrl(); ?>/user/login" class="default_form" method="post">
            	<p class="orange_text" >Entrez votre e-mail pour reçevoir un nouveau mot de passe.</p>
	        	<input type="mail" placeholder="E-mail" id="mail" name="mail" class="text_edit" >
	        	<input class ="orange_button" type="submit" value="Envoyer">
            </form>
        </div>

<?php $this->getFooter(); ?>