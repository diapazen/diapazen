<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/orangeSoberKit.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/diapazen.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/style.css'); ?>">
        <!-- jQuery 2.0 -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

        <title><?php if (isset($title)){ echo $title; } ?></title>
    </head>

    <body>

		<header>
			<div id="header_content">
				<a href="<?php $this->getHomeUrl(); ?>">
			    	<img id="logo" src="<?php $this->getPath('media/pictures/diapazen.png'); ?>" alt="">
				</a>

				<?php if (!$this->isUserConnected()){ ?>
					<div id="connect_box" >
				    	<form action="<?php $this->getHomeUrl(); ?>/user/login" method="post"><!-- <h3 class="small_title">Se connecter</h3> -->
				        	<input id="mail_connect" name="mailConnect" class="small_text_edit" type="mail" placeholder="E-mail">
				        	<input id="password_connect" name="passwordConnect" class="small_text_edit" type="password" placeholder="Mot de passe">
				        	<input class ="orange_small_button" type="submit" value="Connexion">
						</form>
						<a class="small_link">Mot de passe oublié ?</a>
					</div>
				<?php } else { ?>
						<div id="connected_box" ><p class="text" >Bonjour <span class="orange_text"><?php echo $this->getUserInfo('firstname').' '.$this->getUserInfo('lastname').' '; ?></span></p><a class="link" href="<?php $this->getHomeUrl(); ?>/user/logout">Se déconnecter</a></div>
				<?php } ?>
				
			</div>
		</header>