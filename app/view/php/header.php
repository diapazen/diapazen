<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/orangeSoberKit.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/diapazen.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php $this->getPath('css/style.css'); ?>">
        <title>Accueil</title>
    </head>

    <body>

		<header>
			<div id="header_content">
			    <img id="logo" src="<?php $this->getPath('media/pictures/diapazen.png'); ?>" alt="">
				    	<form action="" id="connect_box"><!-- <h3 class="small_title">Se connecter</h3> -->
				        	<input id="mail_connect" name="mailConnect" class="small_text_edit" type="mail" placeholder="E-mail">
				        	<input id="password_connect" name="passwordConnect" class="small_text_edit" type="password" placeholder="Mot de passe">
				        	<input class ="orange_small_button" type="submit" value="Connexion">
						</form>
			</div>
		</header>