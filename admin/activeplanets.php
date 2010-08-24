<?php

/**
 * activeplanets.php
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

if ($user['authlevel'] >= 1)
{
	$AllActivPlanet = doquery("SELECT * FROM {{table}} WHERE `last_update` >= '". (time()-15 * 60) ."' ORDER BY `id` ASC", 'planets');
	$Count          = 0;

	while ($ActivPlanet = mysql_fetch_array($AllActivPlanet))
	{
		$parse['online_list'] .= "<tr>";
		$parse['online_list'] .= "<td class=b><center><b>". $ActivPlanet['name'] ."</b></center></td>";
		$parse['online_list'] .= "<td class=b><center><b>[". $ActivPlanet['galaxy'] .":". $ActivPlanet['system'] .":". $ActivPlanet['planet'] ."]</b></center></td>";
		$parse['online_list'] .= "<td class=m><center><b>". pretty_number($ActivPlanet['points'] / 1000) ."</b></center></td>";
		$parse['online_list'] .= "<td class=b><center><b>". pretty_time(time() - $ActivPlanet['last_update']) . "</b></center></td>";
		$parse['online_list'] .= "</tr>";
		$Count++;
	}

	$parse['online_list'] .= "<tr>";
	$parse['online_list'] .= "<th class=\"b\" colspan=\"4\">En este momento hay ". $Count ." planeta/s donde hay actividad.</th>";
	$parse['online_list'] .= "</tr>";
	display( parsetemplate( gettemplate('admin/activeplanets_body')	, $parse ), "Admin CP - Planetas activos", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>