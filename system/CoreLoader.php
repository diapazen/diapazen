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
        
        $regexp='/[a-z]+Controller$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'controller'.DIRECTORY_SEPARATOR.ucfirst($className).'.class.php';
        }
        $regexp='/[a-z]+Model$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'model'.DIRECTORY_SEPARATOR.ucfirst($className).'.class.php';
        }
        $regexp='/[a-z]+View$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'view'.DIRECTORY_SEPARATOR.ucfirst($className).'.class.php';
        }
        $regexp='/[a-z]+Util$/';
        if(preg_match( $regexp, $className))
        {
            $classPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'util'.DIRECTORY_SEPARATOR.ucfirst($className).'.class.php';
        }
        if(is_file($classPath)) 
        {
            require_once($classPath);
        } else 
        {
            throw new Exception('Cant load class '.$className.' :  file "'.$classPath.'" not found');
        }
    }
}


$coreLoader = new coreLoader;

?>