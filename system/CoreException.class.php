<?php


/**
 * 
 * Fichier de gestion des exception
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
class CoreException extend Exception{

    protected $eMessage;
    protected $eCode;
    protected $eFile;
    protected $eLine;
    protected $timestamp;

    // constructeur enrichie de la classe exception
    public function __construct($eMessage , $eCode = 0) {
        parent::__construct($eMessage, $eCode);
        $this->timestamp=time();


        //to do --> systeme de log
        // utilisation de syslog ou une classe de log ?
        
    }

    // Retourne un message en forme de l'exception
    public getMessageFormate()
    {
        $messageFormate = "Mon message mis en forme";
        return $messageFormate;
    }

    public static gestionExceptionOrpheline()
    {
        set_exception_handler('Nom de la fonction de gestion');  // to do
    } 
    
}






?>