<?php

/**
 * 
 * Classe utilitaire concernant les nombres
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
 * NumberUtil
 *
 * Classe gérant le calcul des pourcentages
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class NumberUtil
{
     /**
     * Donne le pourcentage de valeur avec arrondi
     * 
     * @param	int	$number	nombre d'element
     * @param	int	$total	nombre d'element total
     * @return	int	le pourcentage
     */
    public static function getPourcentage($number, $total) 
    {
        return round($nombre * 100 / $total);
    }
    /**
     * Donne le nombre apres application d'un pourcentage
     * 
     * @param	int	$number	nombre d'element de base
     * @param	int	$percent le pourcentage a appliquer
     * @return	int	le nouveau nombre
     */
    public static function getNumberWithPercentage($number,$percent)
    {
        return round (($numer * $percent)/100);
    }
	
}
?>