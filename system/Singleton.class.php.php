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

class coreSingleton {
    protected static $_instances; //tableau des instance singleton
    public static $namespace = __NAMESPACE__;
   
    public static function __callStatic($name, array $arguments = array()) 
    {    
        $name = ltrim(static::$namespace, '\\') . '\\' . ltrim($name, '\\'); //on trouve le nom de la classe 
        if(empty(static::$_instances[$name]) || !empty($arguments))  // si on a pas instancie ou si il y a des arguments
        {
            if(method_exists($name, '__construct'))  //si le constructeur existe
            {
                $class = new \ReflectionClass($name);  //on recupere un objet donnant des info sur la classe
                static::$_instances[$name] = $class->newInstanceArgs($arguments); //on instancie la classe
            } else 
            {
                static::$_instances[$name] = new $name; //on instancie de maniere classe
            }
        }
        return static::$_instances[$name]; //on retourne l'instance voulu
    }
}
?>