<header>
	<div id="header_content">
	    <img id="logo" src="<?php $this->getPath('media/pictures/diapazen.png'); ?>" alt="">
	    <?php 
	    	if ($connected == false){
	    ?>
		    	<form action="" id="connect_box"><!-- <h3 class="small_title">Se connecter</h3> -->
		        	<input id="mail_connect" name="mailConnect" class="small_text_edit" type="mail" placeholder="E-mail">
		        	<input id="password_connect" name="passwordConnect" class="small_text_edit" type="password" placeholder="Mot de passe">
		        	<input class ="orange_small_button" type="submit" value="Connexion">
				</form>
		<?php
			}
	    ?>
	</div>
</header>