<?php

/**
 * 
 * Writer xml
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
require_once "XmlUtil.class.php";

class PXMLWriter implements IWriter
{
  

   private  $mFileName="";
   private $xml;


    /**
    * Constructeur
    * 
    * Constructeur du writer texten defini le fichier du log
    * 
    * @param     string	file	url du fichier de log text
    */ 
   public function __construct($file="") 
   {
       $this->mfileName =ROOT."log.xml";
 
      $this->xml= new XmlUtil('log.xml');
   }
   
    /**
    * write
    * 
    * Ajout d'un log implemente l'interface IWRITER
    * 
    * @param     string message  log
    */
   public function write($message,$level)
   {
      
      $a=$this->xml->addNode('log');
      $a->addChild("level",$level);
      $date = date('d.m.Y h:i:s') ." GMT " ;
      $a->addChild('date',$date);
      $a->addChild('message',$message);
      $this->xml->saveXml();
   }




}



?>
