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

class CoreLogger 
{

    private static $_instance = null;
    private static $mwriter  =  null;
    private $mpathLog;

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

    /** Affecte un writer
     *
     * Determine quel objet writter est utiliser pour
     * ecrire notre log
     *
     * 
     */
    public function setWriter($ObjWriter)
    {
        self::$mwriter = $ObjWriter;
    }

    
    /**
    * Log
    * 
    * Long description
    * 
    * @param     String message message du log
    * @param    String level niveau du log
    */
    public function log($message,$level)
    {
        
        $date = date('d.m.Y h:i:s') ." GMT " ;
        $message =$date ."\t".$level ."\t".$message."\t N";
        self::$mwriter->write($message,$this->mpathLog);
    }



}







?>