<?php

/**
 * 
 * Fichier du systeme de singleton generique
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

class coreSingleton 
{
    protected static $_instances; //tableau des instance singleton
    public static $namespace = __NAMESPACE__;
   
    public static function __callStatic($name, array $arguments = array()) 
    {   
        //on trouve le nom de la classe 
        $name = ltrim(static::$namespace, '\\') . '\\' . ltrim($name, '\\'); 
        // si on a pas instancie ou si il y a des arguments
        if(empty(static::$_instances[$name]) || !empty($arguments))  
        {
            if(method_exists($name, '__construct'))  //si le constructeur existe
            {
                //on recupere un objet donnant des info sur la classe
                $class = new \ReflectionClass($name);  
                //on instancie la classe
                static::$_instances[$name] = $class->newInstanceArgs($arguments); 
            } 
            else 
            {
                //on instancie de maniere classe
                static::$_instances[$name] = new $name; 
            }
        }
        return static::$_instances[$name]; //on retourne l'instance voulu
    }
}
?>