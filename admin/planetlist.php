<?php

/**
 * planetlist.php
 *
 * @version 2.0
 * @copyright 2008 by e-Zobar for XNova
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
	$query = doquery("SELECT * FROM {{table}} WHERE planet_type='1'", "planets");
	$i = 0;
	while ($u = mysql_fetch_array($query))
	{
		$parse['lista_planetas'] .= "<tr>"
		. "<td class=b><center><b>" . $u[0] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[1] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[4] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[5] . "</center></b></td>"
		. "<td class=b><center><b>" . $u[6] . "</center></b></td>"
		. "</tr>";
		$i++;
	}

	if ($i == "1")
		$parse['lista_planetas'] .= "<tr><th class=b colspan=5>Sólo hay un planeta</th></tr>";
	else
		$parse['lista_planetas'] .= "<tr><th class=b colspan=5>Hay {$i} planetas</th></tr>";

	display(parsetemplate(gettemplate('admin/planetlist_body'), $parse), 'Admin CP - Lista de planetas', false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>