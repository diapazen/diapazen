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

/**
 * CoreException
 *
 * Classe gérant les exceptions
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class CoreException extends Exception
{

    /**
     * Message de l'exception
     */
    protected $meMessage;
    /**
     * Code de l'exception
     */
    protected $meCode;
    /**
     * Fichier dans lequel l'exception a été levée
     */
    protected $meFile;
    /**
     * Line à laquelle l'exception a été levée
     */
    protected $meLine;
    /**
     * Date et heure de l'exception
     */
    protected $meDate;

     /**
     * Constructeur de la classe d exception
     * 
     * Constructeur de la classe d exception personnalisé, qui cree notre exception mais 
     * aussi utilise un systeme de log
     * 
     * @param     string        eMessage    message de l exception
     * @param     unsigned int  eCode       code de l exception
     * @param     bool          log         Doit logguer l'exception ou non. Par défaut: oui
     */
    public function __construct($eMessage , $eCode = 0, $log= false) {
        parent::__construct($eMessage, $eCode);
        $this->meDate=date('d.m.Y h:i:s');
        if ($log || LOG_ALL)
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