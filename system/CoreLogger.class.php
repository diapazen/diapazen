<?php


/**
 * 
 * Fichier permetant d'effectuer des logs
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
require_once LOADER;

/**
 * CoreLogger
 *
 * Classe gérant la journalisation des messages d'erreurs ou autres
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class CoreLogger 
{


    /**
     * Instance du logger
     */
    private static $_instance = null;
    
    /**
     * Instance du writer
     */
    private static $mwriter  =  null;
    


    /** Récuperation d'un logger
     *
     * Permet de récuperer un logger selon le design pattern
     *  singleton.
     *
     * 
     */
    public static function getInstance()
    {
 
        if(is_null(self::$_instance)) 
        {
            self::$_instance = new CoreLogger();  
        }
        
 
     return self::$_instance;
   }
 
    /** Contructeur d'un logger
     *
     * Permet d'instancier notre logger
     *
     * 
     */
    private function __construct()
    {
	if(is_null(self::$mwriter)) 
        {
            self::$mwriter= new TextWriter();
        }
       
    }

    /** 
     * Affecte un writer
     *
     * Determine quel objet writter est utiliser pour
     * ecrire notre log
     * 
     * @param type ObjWriter
     *
     * @return boolean affectation reussi
     */
    public function setWriter($ObjWriter)
    {
        if($ObjWriter instanceof IWriter )
        {
            self::$mwriter = $ObjWriter;
            return true;
        }
        else
        {
            return false;
        }
        
    }

    
    /**
    * Log
    * 
    * Long description
    * 
    * @param     String message message du log
    * @param    String level niveau du log
    *
    */
    public function log($message,$level)
    {
        
        
        self::$mwriter->write($message,$level);
    }



}







?>