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
		spl_autoload_register(array($this,'load'),false);
    }

    /** Fonction de chargement des classe
     *
     * Charge si possible la classe qu'il faut inclure
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function load($className)
    {
        
        //la classe est un controller
        $regexp='/[a-z]+Controller$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = CONTROLLER_ROOT.ucfirst($className)
                .'.class.php';
        }
        //la classe est un model
        $regexp='/[a-z]+Model$/'; 
        if(preg_match( $regexp, $className))
        {
            $classPath = MODEL_ROOT.ucfirst($className)
                .'.class.php';
        }

        // Tim: En fait il n'y aura pas de classes view
        //la classe est une vue
        $regexp='/[a-z]+View$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = VIEW_ROOT.ucfirst($className)
                .'.class.php';
        }

        //la classe est utilitaire
        $regexp='/[a-z]+Util$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = UTIL_ROOT.ucfirst($className).'.class.php';
        }
        //la classe est de type Writer
        $regexp='/[a-z]+Writer$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = WRITER_ROOT.ucfirst($className).'.class.php';
        }

        if( isset($classPath) && is_file($classPath)) 
        {
            require_once($classPath);
        } else 
        {
            throw new Exception('Cant load class '.$className.' in '.$classPath.':  file not found');
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