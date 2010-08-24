<?php

/**
 * FlyingFleetHandler.php
 *
 * @version 1.0
 * @copyright 2008 By Chlorel for XNova
 */

function FlyingFleetHandler (&$planet) {
	global $resource, $xnova_root_path;

	doquery("LOCK TABLE {{table}}lunas WRITE, {{table}}rw WRITE, {{table}}errors WRITE, {{table}}messages WRITE, {{table}}fleets WRITE, {{table}}planets WRITE, {{table}}galaxy WRITE ,{{table}}users WRITE", "");

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

	while ($CurrentFleet = mysql_fetch_array($fleetquery)) {
		switch ($CurrentFleet["fleet_mission"]) {
			case 1:
				include($xnova_root_path. "includes/functions/MissionCaseAttack.php");
				MissionCaseAttack ( $CurrentFleet );
				break;

			case 2:
				//ATAQUE EN GRUPO
				doquery ("DELETE FROM {{table}} WHERE `fleet_id` = '". $CurrentFleet['fleet_id'] ."';", 'fleets');
				break;

			case 3:
				include($xnova_root_path. "includes/functions/MissionCaseTransport.php");
				MissionCaseTransport ( $CurrentFleet );
				break;

			case 4:
				include($xnova_root_path. "includes/functions/MissionCaseStay.php");
				MissionCaseStay ( $CurrentFleet );
				break;

			case 5:
				include($xnova_root_path. "includes/functions/MissionCaseStayAlly.php");
				MissionCaseStayAlly ( $CurrentFleet );
				break;

			case 6:
				include($xnova_root_path. "includes/functions/MissionCaseSpy.php");
				MissionCaseSpy ( $CurrentFleet );
				break;

			case 7:
				include($xnova_root_path. "includes/functions/MissionCaseColonisation.php");
				MissionCaseColonisation ( $CurrentFleet );
				break;

			case 8:
				include($xnova_root_path. "includes/functions/MissionCaseRecycling.php");
				MissionCaseRecycling ( $CurrentFleet );
				break;

			case 9:
				include($xnova_root_path. "includes/functions/MissionCaseDestruction.php");
				MissionCaseDestruction ( $CurrentFleet );
				break;

			case 10:
				include($xnova_root_path. "includes/functions/MissionCaseMIP.php");
				MissionCaseMIP ( $CurrentFleet );
				break;

			case 15:
				include($xnova_root_path. "includes/functions/MissionCaseExpedition.php");
				MissionCaseExpedition ( $CurrentFleet );
				break;

			default: {
				doquery("DELETE FROM {{table}} WHERE `fleet_id` = '". $CurrentFleet['fleet_id'] ."';", 'fleets');
			}
		}
	}

	doquery("UNLOCK TABLES", "");
}

?>