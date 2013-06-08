<?php


/**
 * 
 * Fichier d'auto-inclusion des classes
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

require_once "defineConstant.inc.php";

class CoreLoader 
{


    private static $_instance = null;

     /**
     * Constructeur de la classe coreLoader
     * 
     * Active l'autoload.
     * 
     * 
     */
    private function __construct()
    {

        set_include_path(get_include_path() . PATH_SEPARATOR . CONTROLLER_ROOT);
        set_include_path(get_include_path() . PATH_SEPARATOR . MODEL_ROOT);
        set_include_path(get_include_path() . PATH_SEPARATOR . UTIL_ROOT);
        set_include_path(get_include_path() . PATH_SEPARATOR . WRITER_ROOT);
        
        spl_autoload_extensions('.class.php, .php, .inc.php');

        spl_autoload_register(array($this, 'loadClasses'), false);
        
    }

    /** 
     * Vérifie si la classe est présente et lance une exception sinon
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function loadClasses($class)
    {
        if (file_exists(CONTROLLER_ROOT .'/' .$class.'.class.php'))
            require_once $class.'.class.php';
        elseif (file_exists(MODEL_ROOT .'/' .$class.'.class.php'))
            require_once $class.'.class.php';
        elseif (file_exists(UTIL_ROOT .'/' .$class.'.class.php'))
            require_once $class.'.class.php';
        elseif (file_exists(WRITER_ROOT .'/' .$class.'.class.php'))
            require_once $class.'.class.php';
        else
            throw new Exception(404);
        
        spl_autoload(ucfirst($class));

        if (!class_exists($class, false))
        {
            throw new Exception(404);
        }
    }

    /** Récuperation d'un loader
     *
     * Permet de récuperer un loader selon le design pattern
     *  singleton.
     *
     * 
     */
    public static function getInstance()
    {
 
        if(is_null(self::$_instance)) 
        {
            self::$_instance = new CoreLoader();  
        }
 
     return self::$_instance;
   }
}



//on instancie notre loader.
$coreLoaderSingleton = CoreLoader::getInstance();
 


?>