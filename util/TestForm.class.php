<?php
/**
 * 
 * Class contenant des fonction de tests des champs des formulaires
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
 * TestForm
 *
 * Classe gérant la vérification des entrées utilisateur dans les formulaires
 * 
 * @package     Diapazen
 * @subpackage  Framework
 */
class TestForm
{

	/**
	 * RegExp
	 */
	private static $mStrRegexp = array(
		'email' 			=> 		'#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#',
		'pwd'				=> 		'#^[a-zA-Zéèôïëñ0-9]{3,}$#',
		'title'				=>		'#^[a-zA-Zéèôïëñ0-9-\s]{3,}$#',
		'expirationDate'	=> 		'#^[0-9]{4}-[0-9]{2}-[0-9]{2}$#',
		'description'		=> 		'#^.{3,}$#',
		'choice' 			=> 		'#^[a-zA-Zéèôïëñ0-9\s]{3,}$#',
		'firstname'			=>		'#^[a-zA-Zéèôïëñ-]{3,}$#',
		'lastName'			=>		'#^[a-zA-Zéèôïëñ-]{3,}$#',		
		'voteName'			=>		'#^[a-zA-Zéèôïëñ0-9\s]{3,}$#',		
		'pollUrl'			=>		'#^[a-zA-Z0-9]{10}$#');		

	/**
	 * Fonction qui test les une string par regexp
	 * @param string regexp La regexp pour tester
	 * @param string string Phrase à tester
	 * @return boolean 
	 */
	public static function testRegexp($regexp, $string)
	{
		if(preg_match(self::$mStrRegexp[$regexp], $string))
		{
			return true;
		}
		return false;
	}

}

?>