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
class coreLoader{

    public function __construct()
    {
		spl_autoload_register(array($this,'load'),false);
    }

    /**
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


        if( isset($classPath) && is_file($classPath)) 
        {
            require_once($classPath);
        } else 
        {
            throw new Exception('Cant load class '.$className.' :  file not found');
        }
    }
}


$coreLoader = new coreLoader;





?>