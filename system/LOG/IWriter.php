<?php

/**
 * 
 * Interface des writer
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

/**
 * IWriter
 *
 * Interface décrivant un writer
 * 
 * @package     Diapazen
 * @subpackage	Framework
 */
interface IWriter
{
    
    /**
    * write
    * 
    * Ajout d'un log 
    * 
    * @param	string message  Message à stocker
    * @param	string level niveau de log 
    */
    public function write($message,$level);
}

?>
