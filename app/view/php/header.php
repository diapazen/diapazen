<?php
/**
 * Header du site
 * 
 * @package     Diapazen
 * @subpackage	View
 * @copyright   Copyright (c) 2013, ISEN-Toulon
 * @license     http://www.gnu.org/licenses/gpl.html GNU GPL v3
 * 
 * This file is part of Diapazen.
 * 
 * Diapazen is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License 3 as published by
 * the Free Software Foundation.
 * 
 * Diapazen is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Diapazen.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

	// fixe un bug de la documentation
	namespace ns;
	// fixe un bug de la documentation
?>

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
        <script src="<?php $this->getPath('js/formCheck.js'); ?>"> </script>

        
        
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
				    	<form action="<?php $this->getHomeUrl(); ?>/user/login" method="post">
				        	<input id="mail_connect" name="email" class="small_text_edit" type="mail" placeholder="E-mail">
				        	<input id="password_connect" name="password" class="small_text_edit" type="password" placeholder="Mot de passe">
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