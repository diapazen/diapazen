

<?php $this->getHeader(); ?>
        
        <div id="content">            
            <form action="retrievePwd" class="default_form" method="post">
            	<p class="orange_text info_box" >Entrez votre e-mail pour reçevoir un nouveau mot de passe.</p>
	        	<label for="mailRetrieve" class="text">E-mail</label>
	        	<input type="mail" id="mailRetrieve" name="mailRetrieve" class="text_edit" >
	        	<input class ="orange_button" type="submit" value="Envoyer">
            </form>
        </div>

<?php $this->getFooter(); ?>