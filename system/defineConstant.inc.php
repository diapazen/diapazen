<?php
/**
 * 
 * Fichier de définitions des constantes
 * 
 * @package     Diapazen
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

// Démarrage de la session 
ini_set('session.use_trans_sid', 0);
session_start();

//Constantes pour les inclusions PHP
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", dirname(dirname(__FILE__)));
define("SYSTEM_ROOT", dirname(__FILE__));
define("APP_ROOT", ROOT.DS.'app');
define("MODEL_ROOT", APP_ROOT.DS.'model');
define("VIEW_ROOT",APP_ROOT.DS.'view');
define("CONTROLLER_ROOT", APP_ROOT.DS.'controller');
define("UTIL_ROOT", ROOT.DS.'util');
define("WRITER_ROOT", SYSTEM_ROOT.DS.'LOG');
define('LOADER', SYSTEM_ROOT.DS.'CoreLoader.class.php');


// Constantes pour les inclusions HTML/CSS
if (dirname($_SERVER['SCRIPT_NAME']) == DS)
	$sub_dir = '';
else
	$sub_dir = dirname($_SERVER['SCRIPT_NAME']);

define('BASE_URL', 'http://'.$_SERVER['HTTP_HOST'].$sub_dir);
define('VIEW_WEBROOT', '/app'.'/'.'view');
define('CONTROLLER_WEBROOT', '/app'.DS.'controller');


// Constantes pour le système de journalisation
define('EXCEPTION', 'EXCEPTION');
define('ERROR', 'ERROR');
define('DEBUG', 'DEBUG');
define('INFO', 'INFO');
define('WARNING', 'WARNING');
define('LOG_ALL', FALSE );  // permet de logger toute les exceptions etc
        
        
 // Constante permettant de dire si on affiche les erreurs notice php ou pas
define("PRODUCTION", false);
if(PRODUCTION)
{
    if (!ini_get('display_errors')) 
    {
        ini_set('display_errors', '1');
    }
    error_reporting(E_PARSE); // affiche uniquement les erreurs de syntaxe
}
    

?>