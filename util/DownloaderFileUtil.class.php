<?php

/**
 * 
 * Fichier de telechargement forcé d'un fichier
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

class DownloaderFileUtil 
{


    private $mfilename;
    private $mnewfilename;  
    private $mfilepath;
    private $mfilesize;
    private $mfilemd5;
    private $mdateformat;
    

    /**
    * Constructeur du downloader
    * 
    * Permet de choisir les informations utile pour le telechargement           
    * 
    * @param    Sting filename nom du fichier a télécharger
    * @param    Sting filepath lien vers le fichier
    * @param    Sting newfilename nom du fichier pour l'utilisateur
    */

    public function __construct($filename, $filepath = '', $newfilename = '')
    {
    
        $this->mfilename = $filename;
        $this->mfilepath = self::cleanPath($filepath);
        $this->mdateformat = 'D, d M Y H:i:s';
        $this->mfilesize = filesize($this->mfilepath.$this->mfilename);
        $this->mfilemd5 = md5_file($this->mfilepath.$this->mfilename);
        
        if($newfilename == '')
        {    
            $this->mnewfilename = $this->mfilename;
        }
        else
        {
            $this->mnewfilename = $newfilename;
        }
            
    }
    
    /**
    * cleanPath
    * 
    * Rend le chemin vers le fichier correct 
    * 
    * @param     string path chemin
    * @return     string path chemin
    */

    public static function cleanPath($path)
    {
        
        $path = $path;
        
        if(substr($path, -1, 1) != '/')
        {
            
            $path .= '/';
            
        }
        
        return $path;
        
    }
    
    /**
    * Renvoie l'extension du fichier
    * 
    * Long description
    * 
    * @param     String nom fichier
    * @return    string extension
    */

    public static function getExtension($file)
    {
        
        return substr($file, -3);
        
    }
    
    /**
    * Lance le telechargement
    * 
    * Il est forcé, cad qu'un fichier pdf ne s'ouvrira pas mais devra etre telecharge
    * 
    * 
    *@return boolean resultat du telechargement
    */

    public function forceDownload(){
    
        //
        // Quelques éléments nécessaires (pas d'erreur visible,
        //  compression des pages)
        //
        error_reporting(0); 
        ini_set('zlib.output_compression', 0);
        
        
       
        //
        // Gestion du cache
        //
        header('Pragma: public');
        header('Last-Modified: '.gmdate($this->mdateformat).' GMT');
        header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');
        
        //
        // Informations sur le contenu a envoyer
        //
        header('Content-Tranfer-Encoding: none');
        header('Content-Length: '.$this->mfilesize);
        header('Content-MD5: '.base64_encode($this->mfilemd5));
        header('Content-Type: application/octetstream; name="'.$this->mfilename.'"');
        header('Content-Disposition: attachment; filename="'.$this->mnewfilename.'.'
                .self::getExtension($this->mfilename).'"');
        
        //
        // Informations sur la réponse HTTP elle-meme
        //
        header('Date: '.gmdate($this->mdateformat, time()).' GMT');
        header('Expires: '.gmdate($this->mdateformat, time()+1).' GMT');
        header('Last-Modified: '.gmdate($this->mdateformat, time()).' GMT');
        
        
        /*
        * Envoi du fichier
        */
        
        if(readfile($this->mfilepath.$this->mfilename))
        {
            return true;
        }
            
        
    }


}

?>
