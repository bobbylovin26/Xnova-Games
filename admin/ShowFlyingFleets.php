<?php

/**
 * ShowFlyingFleets.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);
include($xgp_root . 'includes/funciones_A/BuildFlyingFleetTable.' . $phpEx);


if ($user['authlevel'] >= 1)
{
	$parse['flt_table'] = BuildFlyingFleetTable ();
	display ( parsetemplate( gettemplate('admin/fleet_body'), $parse ), "Admin CP - Flotas en vuelo", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>