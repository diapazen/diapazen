<?php


/**
 * 
 * Fichier d'auto-inclusion des classes
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

class CoreLoader 
{


    private static $_instance = null;

     /**
     * Constructeur de la classe coreLoader
     * 
     * Active l'autoload.
     * 
     * 
     */
    private function __construct()
    {

        // Les dossiers à inclures
        spl_autoload_register(array($this, 'loadControllers'), false);
        spl_autoload_register(array($this, 'loadModels'), false);
        spl_autoload_register(array($this, 'loadUtils'), false);
        spl_autoload_register(array($this, 'loadWriters'), false);

        spl_autoload_register(array($this, 'checkErrors'), false);
    }

    /** Vérifie si la classe est présente et lance une exception sinon
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function checkErrors($class)
    {
        if (!class_exists($class, false))
        {
            throw new Exception(404);
        }
    }

    /** Fonction de chargement des contrôleurs
     *
     * Charge si possible la classe qu'il faut inclure
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function loadControllers($class)
    {
        set_include_path(CONTROLLER_ROOT);
        spl_autoload_extensions('.class.php');
        spl_autoload(ucfirst($class));
    }

    /** Fonction de chargement des modèles
     *
     * Charge si possible la classe qu'il faut inclure
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function loadModels($class)
    {
        set_include_path(MODEL_ROOT);
        spl_autoload_extensions('.class.php');
        spl_autoload(ucfirst($class));
    }

    /** Fonction de chargement des utilitaires
     *
     * Charge si possible la classe qu'il faut inclure
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function loadUtils($class)
    {
        set_include_path(UTIL_ROOT);
        spl_autoload_extensions('.class.php');
        spl_autoload(ucfirst($class));
    }

    /** Fonction de chargement des writers
     *
     * Charge si possible la classe qu'il faut inclure
     * 
     * @param   string  $className  Nom de la classe à inclure
     * 
     */
    private function loadWriters($class)
    {
        set_include_path(WRITER_ROOT);
        spl_autoload_extensions('.class.php');
        spl_autoload(ucfirst($class));
    }


    /** Récuperation d'un loader
     *
     * Permet de récuperer un loader selon le design pattern
     *  singleton.
     *
     * 
     */
    public static function getInstance()
    {
 
        if(is_null(self::$_instance)) 
        {
            self::$_instance = new CoreLoader();  
        }
 
     return self::$_instance;
   }
}



//on instancie notre loader.
$coreLoaderSingleton = CoreLoader::getInstance();
 


?>