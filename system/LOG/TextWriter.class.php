<?php

/**
 * 
 * Writer text
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
require_once "IWriter.php";
require_once "../defineConstant.inc.php";
class TextWriter implements IWriter
{
   private $logSizeMax=5242880; //5Mo
   private  $logSizeAlert=5138020; // environs 98% de 5Mo

   private  $file = "log.txt";
   

    
   public function __construct($file="") 
   {
      if ($file != "")
      {
          $this->file = $file;   
      }
     
   }
   public function write($message,$level)
   {
      $logSize = $this->testSize();
      if ($logSize <= $this->logSizeMax)
      {
         $message =date("Y-m-d H:i:s") ."\t".$level ."\t".$message;
         file_put_contents($this->file, array(PHP_EOL, $message),
            FILE_APPEND | LOCK_EX );
         $logSize = $this->testSize(); 
         if ($logSize >=  $this->logSizeAlert) 
         {
            //envoi d'un mail d'alerte
         }
      }
      
   }

 
   private function testSize()
   {
      return (file_exists($this->file)) ? filesize($this->file) :0;
   }



}
$a = new TextWriter();
$a->write("test de message",5);
?>
