<?php

/**
 * 
 * Fichier gestion du xml
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
require_once '../system/defineConstant.inc.php';

/**
 * XmlUtil
 *
 * Classe encapsulant XML
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class XmlUtil 
{
    /**
     * Fichier XML
     */
    protected $mXMLFile=null;
    /**
     * Nom du fichier
     */
    protected $mFileName;

     /**
    * Constructeur de gestionnaire xml
    * 
    * Permet de recuperer un fichier xml ou le creer selon un modele
    * pour travailler sur le fichier.
    * 
    * @param     string fileURL lien vers le fichier
    * 
    */

    public function __construct($fileURL) 
    {
        $this->mFileName=$fileURL;
        if (file_exists($fileURL) && filesize($fileURL)>0) 
        {
            $this->mXMLFile = simplexml_load_file($fileURL); //ouverture du xml
        } 
        else //creation du fichier xml selon le modele documentModel
        {
           
            $url=UTIL_ROOT.'documentModel.xml';
            $xml = new SimpleXMLElement($url, NULL, TRUE);

            if($xml->asXML($this->mFileName)) //sauvegarde du fichier xml
            {
                $this->mXMLFile=$xml;
            }
            

        }
        
        
    }
    
     /**
    * Ajout d'un noeud dans le root
    * 
    * 
    * 
    * @param     string name nom du noeud
    * @param     string value contenu du noeud (defaut vide)
    * @param     array attributes tableau dattribut (key --> value)
    * @return  simpleXMLElement noed ajouté
    */

    public function addNode($name,$value="", $attributes=null)
    {
        
        if ($value == "")
        {
            $newNode=$this->mXMLFile->addChild($name);
            
        }
        else
        {
            $newNode=$this->mXMLFile->addChild($name,$value);
        }
        //on ajoute les attributs
        if ( $attributes != null && is_array($attributes))
        {
            foreach ($attributes as $key => $value) 
            {
                $newNode->addAttribute($key, $value);
                
            }
        }
        return $newNode;
    }
    /**
    * Enregistre le xml
    *  
    */
    public function saveXml()
    {
        $this->mXMLFile->asXML($this->mFileName);
       
       
    }
   
}




?>
