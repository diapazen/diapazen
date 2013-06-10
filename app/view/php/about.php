<?php
/**
 * Page À propos
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

<?php $this->getHeader(); ?>
        
        <div id="content" class="about">
         
            <p class="big_title">À propos de Diapazen</p>
            <br>
            <p class="title">Présentation</p>
            <br>
            <p class="text">
                Diapazen permet de planifier rapidement des événements avec ses collaborateurs.<br>
            </p>
            <p class="text">C'est un service libre et gratuit réalisé par des étudiants de l'<a class="link" target="_blank" href="http://www.isen.fr/toulon.asp">ISEN-Toulon</a>. Le code source est disponible sur <a class="link" target="_blank" href="http://github.com/diapazen/diapazen">github.com/diapazen</a>.</p>
            <br>
            <p class="text">
                Diapazen utilise les technologies suivantes:<br>
            </p>
            <br>
            <p class="text">
                <ul class="text">
                    <li>
                        - PHP 5
                    </li>
                    <li>
                        - MySQL
                    </li>
                    <li>
                        - HTML5 / CSS3
                    </li>
                    <li>
                        - jQuery 1.9.1
                    </li>
                </ul>
            </p>
            <br>
            <br>
            <p class="title">Prérequis</p>
            <br>
            <p class="text">
                Un serveur web avec PHP 5.2 Recommandé: Apache2
                Le module mod_rewrite de Apache, installé et activé
                Une base de données MySQL avec phpMyAdmin
            </p>
            <br>
            <p class="title">Installation</p>
            <br>
            <p class="text">
                Importer le fichier diapazen.sql dans MySQL. La base de données sera créé automatiquement.

                Ouvrir le fichier de configuration de Diapazen Config.class.php dans le dossier config

                Modifier les paramètres de connexion à la base de données

                Configurer le serveur SMTP pour l'envoi d'emails

                Et c'est tout ! Créez un sondage pour commencer à utiliser Diapazen.
            </p>
            <br>
            <p class="title">Documentation</p>
            <br>
            <p class="text">
                La documentation technique est incluse dans le code source. Pour générer la documentation, vous devez installer phpDocumentator.
            </p>
        
        </div>


<?php $this->getFooter(); ?>