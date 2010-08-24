<?php

/**
 * moonlist.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] >= "2")
{
	$query = doquery("SELECT * FROM {{table}}", "lunas");
	$i = 0;
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
		$parse['moon'] .= "<tr><th class=b colspan=6>Sólo hay una luna</th></tr>";
	else
		$parse['moon'] .= "<tr><th class=b colspan=6>Hay {$i} lunas</th></tr>";

	display(parsetemplate(gettemplate('admin/moonlist_body'), $parse), 'Admin CP - Lista de lunas' , false, '', true, false);
}
else
{
	message ("No tienes permisos suficientes", "¡Error!");
}
?>