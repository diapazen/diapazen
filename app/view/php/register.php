

<?php $this->getHeader(); ?>

		<div id="content">

			<form action="<?php $this->getHomeUrl(); ?>/user/registerAction" id="connect_box_fail" method="post">
				<p class="title" >Inscription</p>
				<input id="firstname_register" name="firstnameRegister" class="text_edit" type="text" placeholder="Prénom">
				<input id="lastname_register" name="lastnameRegister" class="text_edit" type="text" placeholder="Nom">
				<input id="mail_register" name="mailRegister" class="text_edit" type="mail" placeholder="E-mail">
				<input id="password_register" name="passwordRegister" class="text_edit" type="password" placeholder="Mot de passe">
				<input id="passwordConfirm_register" name="passwordConfirmRegister" class="text_edit" type="password" placeholder="Confirmer le mot de passe">
				<input class ="orange_button" type="submit" value="Je m'inscris !">
			</form>
		</div>

<?php $this->getFooter(); ?>