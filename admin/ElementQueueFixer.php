<?php

/**
 * ElementQueueFixer.php
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
	$QrySelectPlanet  = "SELECT `id`, `id_owner`, `b_hangar`, `b_hangar_id` ";
	$QrySelectPlanet .= "FROM {{table}} ";
	$QrySelectPlanet .= "WHERE ";
	$QrySelectPlanet .= "`b_hangar_id` != '0';";
	$AffectedPlanets  = doquery ($QrySelectPlanet, 'planets');
	$DeletedQueues    = 0;
	while ( $ActualPlanet = mysql_fetch_assoc($AffectedPlanets) )
	{
		$HangarQueue = explode (";", $ActualPlanet['b_hangar_id']);
		$bDelQueue   = false;
		if (count($HangarQueue))
		{
			for ( $Queue = 0; $Queue < count($HangarQueue); $Queue++)
			{
				$InQueue = explode (",", $HangarQueue[$Queue]);
				if ($InQueue[1] > MAX_FLEET_OR_DEFS_PER_ROW)
				{
					$bDelQueue = true;
				}
			}
		}
		if ($bDelQueue)
		{
			$QryUpdatePlanet  = "UPDATE {{table}} ";
			$QryUpdatePlanet .= "SET ";
			$QryUpdatePlanet .= "`b_hangar` = '0', ";
			$QryUpdatePlanet .= "`b_hangar_id` = '0' ";
			$QryUpdatePlanet .= "WHERE ";
			$QryUpdatePlanet .= "`id` = '".$ActualPlanet['id']."';";
			doquery ($QryUpdatePlanet, 'planets');
			$DeletedQueues += 1;
		}
	}
	if ($DeletedQueues > 0)
	{
		$QuitMessage = "Se eliminaron " . $DeletedQueues. "colas";
	}
	else
	{
		$QuitMessage = "No se eliminaron colas";
	}

	message ($QuitMessage, "¡Listo!");

}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>