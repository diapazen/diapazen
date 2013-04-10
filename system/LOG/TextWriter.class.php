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
require_once "IWrite.php";
require_once "../defineConstant.inc.php";
class TextWriter implements IWrite
{
   private const $logSizeMax=5242880; //5Mo
   private const $logSizeAlert=5138020; // environs 98% de 5Mo
   private $path =WRITER_ROOT."log.txt";


   public function write($message,$level,$date)
   {

   }

   private function openFile()
   {

   }
   private function closeFile()
   {

   }
   private function testSize()
   {

   }
   private function addLine($text)
   {

   }


}

?>
