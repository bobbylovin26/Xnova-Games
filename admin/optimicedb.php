<?php

/**
 * optimicedb.php
 *
 * @version 2.0
 * @copyright 2009 by SainT  for OgameRC.com
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = '../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);


if ($user['authlevel'] >= 2)
{
	if(!$_POST['Optimizar'])
	{
		$Tablas = doquery("SHOW TABLES","todas");
		while ($row = mysql_fetch_assoc($Tablas))
		{
			foreach ($row as $opcion => $tabla)
			{
				$parse['tabla'] .= "<tr>";
				$parse['tabla'] .= "<th colspan=\"2\">".$tabla."</th>";
				$parse['tabla'] .= "</tr>";
			}
		}
	}
	else
	{
		$Tablas = doquery("SHOW TABLES",'todas');
		while ($row = mysql_fetch_assoc($Tablas))
		{
			foreach ($row as $opcion => $tabla)
			{
				doquery("OPTIMIZE TABLE {$tabla}", "$tabla");
				if (mysql_errno())
				{
					$parse['tabla'] .= "<tr>";
					$parse['tabla'] .= "<th>".$tabla."</th>";
					$parse['tabla'] .= "<th colspan=\"2\" style=\"color:red\">NO OPTIMIZADA</th>";
					$parse['tabla'] .= "</tr>";
				}
				else
					{
					$parse['tabla'] .= "<tr>";
					$parse['tabla'] .= "<th>".$tabla."</th>";
					$parse['tabla'] .= "<th style=\"color:green\">OPTIMIZADA</th>";
					$parse['tabla'] .= "</tr>";
				}
			}
		}
	}

	display(parsetemplate(gettemplate('admin/optimicedb'), $parse), 'Admin CP - Optimizar base de datos', false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}
?>