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
	$query 	= doquery("SELECT * FROM {{table}}", "lunas");
	$i 		= 0;

	while ($u = mysql_fetch_array($query))
	{
		$parse['moon'] .= "<tr>"
		. "<td class=b><center><b>" . $u[0] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[2] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[5] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[6] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[7] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[8] . "</center></b></td>"
		. "</tr>";
		$i++;
	}

	if ($i == "1")
		$parse['moon'] .= "<tr><th class=b colspan=6>".$lang['mt_only_one_moon']."</th></tr>";
	else
		$parse['moon'] .= "<tr><th class=b colspan=6>". $lang['mt_there_are'] . $i . $lang['mt_moons'] ."</th></tr>";

	display(parsetemplate(gettemplate('adm/moonlist_body'), $parse), false, '', true, false);
?>