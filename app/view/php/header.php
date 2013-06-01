<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />

        <link rel="icon" type="image/ico" href="<?php $this->getPath('media/pictures/favicon.ico'); ?>" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php $this->getPath('media/pictures/favicon.ico'); ?>" />

        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/orangeSoberKit.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/diapazen.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/style.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/Aristo.css'); ?>">
        <!-- jQuery 1.9-->
        <script src="<?php $this->getPath('js/jquery.js'); ?>"> </script>
        
        
        <title><?php if (isset($title)){ echo $title; } ?></title>
    </head>

    <body>

		<header>
			<div id="header_content">
				<a href="<?php $this->getHomeUrl(); ?>">
			    	<img id="logo" src="<?php $this->getPath('media/pictures/diapazen_v2.png'); ?>" alt="Diapazen">
				</a>

				<?php if (!$this->isUserConnected()){ ?>
					<div id="connect_box" >
				    	<form action="<?php $this->getHomeUrl(); ?>/user/login" method="post"><!-- <h3 class="small_title">Se connecter</h3> -->
				        	<input id="mail_connect" name="mailConnect" class="small_text_edit" type="mail" placeholder="E-mail">
				        	<input id="password_connect" name="passwordConnect" class="small_text_edit" type="password" placeholder="Mot de passe">
				        	<input class ="orange_small_button" type="submit" value="Connexion">
						</form>
						<a class="small_link" href="<?php $this->getHomeUrl(); ?>/user/forgot" >Mot de passe oublié ?</a>
					</div>
				<?php } else { ?>
						<div id="connected_box" ><p class="text" >Bonjour <a class="orangelink" href="<?php $this->getHomeUrl();?>/user/profile"><span class="orange_text"><?php echo $this->getUserInfo('firstname').' '.$this->getUserInfo('lastname').' '; ?></span></a></p><a class="link" href="<?php $this->getHomeUrl(); ?>/user/logout">Se déconnecter</a></div>
				<?php } ?>
				
			</div>
		</header>

		<div class="white_bg">