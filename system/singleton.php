<?php

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