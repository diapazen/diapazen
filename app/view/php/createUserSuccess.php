

<?php $this->getHeader(); ?>

		<div id="content">

			<div class="success_message" >Votre compte a été créé.</div>

				<form action="<?php $this->getHomeUrl(); ?>/user/login" id="connect_box_fail" method="post">
				<p class="title" >Connectez vous !</p>
				<input id="mail_connect" name="mailConnect" class="text_edit" type="mail" placeholder="E-mail">
				<input id="password_connect" name="passwordConnect" class="text_edit" type="password" placeholder="Mot de passe">
				<input class ="orange_button" type="submit" value="Connexion">
			</form>
		</div>

<?php $this->getFooter(); ?>