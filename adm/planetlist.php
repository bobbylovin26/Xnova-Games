<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] < 2) die(message ($lang['not_enough_permissions']));

	$parse	= $lang;
	$query 	= doquery("SELECT * FROM {{table}} WHERE planet_type='1'", "planets");
	$i 		= 0;

	while ($u = mysql_fetch_array($query))
	{
		$parse['lista_planetas'] .= "<tr>"
		. "<th>" . $u[0] . "</th>"
		. "<th>" . $u[1] . "</th>"
		. "<th>" . $u[4] . "</th>"
		. "<th>" . $u[5] . "</th>"
		. "<th>" . $u[6] . "</th>"
		. "</tr>";
		$i++;
	}

	if ($i == 1)
		$parse['lista_planetas'] .= "<tr><th class=b colspan=5>".$lang['pl_only_one_planet']."</th></tr>";
	else
		$parse['lista_planetas'] .= "<tr><th class=b colspan=5>". $lang['pl_there_are'] . $i . $lang['pl_planets'] ."</th></tr>";

	display(parsetemplate(gettemplate('adm/planetlist_body'), $parse), false, '', true, false);

?>