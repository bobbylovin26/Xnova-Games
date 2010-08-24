<?php

/**
 * FlyingFleetHandler.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function FlyingFleetHandler (&$planet)
{
	global $resource;

	doquery("LOCK TABLE {{table}}aks WRITE, {{table}}lunas WRITE, {{table}}rw WRITE, {{table}}errors WRITE, {{table}}messages WRITE, {{table}}fleets WRITE, {{table}}planets WRITE, {{table}}galaxy WRITE ,{{table}}users WRITE", "");

	$QryFleet   = "SELECT * FROM {{table}} ";
	$QryFleet  .= "WHERE (";
	$QryFleet  .= "( ";
	$QryFleet  .= "`fleet_start_galaxy` = ". $planet['galaxy']      ." AND ";
	$QryFleet  .= "`fleet_start_system` = ". $planet['system']      ." AND ";
	$QryFleet  .= "`fleet_start_planet` = ". $planet['planet']      ." AND ";
	$QryFleet  .= "`fleet_start_type` = ".   $planet['planet_type'] ." ";
	$QryFleet  .= ") OR ( ";
	$QryFleet  .= "`fleet_end_galaxy` = ".   $planet['galaxy']      ." AND ";
	$QryFleet  .= "`fleet_end_system` = ".   $planet['system']      ." AND ";
	$QryFleet  .= "`fleet_end_planet` = ".   $planet['planet']      ." ) AND ";
	$QryFleet  .= "`fleet_end_type`= ".      $planet['planet_type'] ." ) AND ";
	$QryFleet  .= "( `fleet_start_time` < '". time() ."' OR `fleet_end_time` < '". time() ."' );";
	$fleetquery = doquery( $QryFleet, 'fleets' );

	while ($CurrentFleet = mysql_fetch_array($fleetquery))
	{
		switch ($CurrentFleet["fleet_mission"])
		{
			case 1:
				MissionCaseAttack ( $CurrentFleet );
			break;

			case 2:
				MissionCaseACS( $CurrentFleet );
			break;

			case 3:
				MissionCaseTransport ( $CurrentFleet );
			break;

			case 4:
				MissionCaseStay ( $CurrentFleet );
			break;

			case 5:
				MissionCaseStayAlly( $CurrentFleet );
			break;

			case 6:
				MissionCaseSpy ( $CurrentFleet );
			break;

			case 7:
				MissionCaseColonisation ( $CurrentFleet );
			break;

			case 8:
				MissionCaseRecycling ( $CurrentFleet );
			break;

			case 9:
				MissionCaseDestruction ( $CurrentFleet );
			break;

			case 10:
				MissionCaseMIP ( $CurrentFleet );
			break;

			case 15:
				MissionCaseExpedition ( $CurrentFleet );
			break;

			default:
				doquery("DELETE FROM {{table}} WHERE `fleet_id` = '". $CurrentFleet['fleet_id'] ."';", 'fleets');

		}
	}
	doquery("UNLOCK TABLES", "");
}
?>