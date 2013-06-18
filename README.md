Diapazen
========

## Présentation


Diapazen est un projet Open Source réalisé par des étudiants de l'[ISEN-Toulon](http://www.isen.fr/toulon.asp).

Diapazen permet de planifier rapidement des événements avec ses collaborateurs.

Diapazen utilise les technologies suivantes:

* PHP 5
* MySQL
* HTML5 / CSS3
* jQuery 1.9.1

## License

Diapazen est libre et gratuit. Il est distribué dans les termes de la license [GNU GPL v3](http://www.gnu.org/licenses/gpl.html). Pour plus d'information, lisez le fichier LICENSE.

## Prérequis

* Un serveur web avec PHP 5.2 Recommandé: Apache2
* Le module `mod_rewrite` de Apache, installé et activé
* Une base de données MySQL avec phpMyAdmin

## Installation

1. Importer le fichier `diapazen.sql` dans MySQL. La base de données sera créé automatiquement.

2. Ouvrir le fichier de configuration de Diapazen `Config.class.php` dans le dossier *config*

3. Modifier les paramètres de connexion à la base de données

4. Et c'est tout ! Créez un sondage pour commencer à utiliser Diapazen
    
## Documentation

La documentation technique est incluse dans le code source. Pour générer la documentation, vous devez installer [phpDocumentor2](http://www.phpdoc.org).
