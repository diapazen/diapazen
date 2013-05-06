

<?php $this->getHeader(); ?>
        
        <div id="content">
            
            <h1>Erreur de connexion</h1>
            <h2>Le nom d'utilisateur ou le mot de passe est incorrect.</h2>
            <form action="" id="connect_box">
	        <input id="mail_connect" name="mailConnect" class="small_text_edit" type="mail" placeholder="E-mail">
	        <input id="password_connect" name="passwordConnect" class="small_text_edit" type="password" placeholder="Mot de passe">
	        <input class ="orange_small_button" type="submit" value="Connexion">
            </form>
        </div>

<?php $this->getFooter(); ?>