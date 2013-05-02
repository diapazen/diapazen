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
class CoreException extends Exception
{

    protected $meMessage;
    protected $meCode;
    protected $meFile;
    protected $meLine;
    protected $meDate;

    // constructeur enrichie de la classe exception



     /**
     * Constructeur de la classe d exception
     * 
     * Constructeur de la classe d exception personnalisé, qui cree notre exception mais 
     * aussi utilise un systeme de log
     * 
     * @param     string  eMessage    message de l exception
     * @param     unsigned int  eCode   code de l exception
     */

    public function __construct($eMessage , $eCode = 0, $log= false) {
        parent::__construct($eMessage, $eCode);
        $this->meDate=date('d.m.Y h:i:s');
        if ($log)
        {
            $logger = CoreLogger::getInstance();
            $logger->log($emessage,EXCEPTION);
        }
        
    }

    /**
     * Formate le message
     * 
     * @return string messageFormate message de l exception formaté
     */
    public function getMessageFormate()
    {
        $messageFormate = "Une erreur s'est produite,
        merci de contacter l'administrateur";
        return $messageFormate;
    }

 
    
}






?>