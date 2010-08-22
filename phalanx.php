<?php
/**
 * XNova Legacies
 *
 * @license http://www.xnova-ng.org/license-legacies
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *  - Neither the name of the team or any contributor may be used to endorse or
 * promote products derived from this software without specific prior written
 * permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

define('INSIDE' , true);
define('INSTALL' , false);
require_once dirname(__FILE__) .'/common.php';

	includeLang('overview');
	includeLang('phalanx');

	$PageTPL     = gettemplate('phalanx_body');
	$PhalanxMoon = doquery ("SELECT * FROM {{table}} WHERE `id` = '". $user['current_planet'] ."';", 'planets', true);

	if ( $PhalanxMoon['planet_type'] == 3) {
		$parse                     = $lang;

		$parse['phl_pl_galaxy']    = $PhalanxMoon['galaxy'];
		$parse['phl_pl_system']    = $PhalanxMoon['system'];
		$parse['phl_pl_place']     = $PhalanxMoon['planet'];
		$parse['phl_pl_name']      = $user['username'];

		if ( $PhalanxMoon['deuterium'] > 10000 ) {
			doquery ("UPDATE {{table}} SET `deuterium` = `deuterium` - '10000' WHERE `id` = '". $user['current_planet'] ."';", 'planets');
			$parse['phl_er_deuter'] = "";
			$DoScan                 = true;
		} else {
			$parse['phl_er_deuter'] = $lang['phl_no_deuter'];
			$DoScan                 = false;
		}

		if ($DoScan == true) {
			$Galaxy  = $_GET["galaxy"];
			$System  = $_GET["system"];
			$Planet  = $_GET["planet"];
			$PlType  = $_GET["planettype"];

			$TargetInfo = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '". $Galaxy ."' AND `system` = '". $System ."' AND `planet` = '". $Planet ."' AND `planet_type` = '". $PlType ."';", 'planets', true);
			$TargetName = $TargetInfo['name'];

			$QryLookFleets  = "SELECT * ";
			$QryLookFleets .= "FROM {{table}} ";
			$QryLookFleets .= "WHERE ( ( ";
			$QryLookFleets .= "`fleet_start_galaxy` = '". $Galaxy ."' AND ";
			$QryLookFleets .= "`fleet_start_system` = '". $System ."' AND ";
			$QryLookFleets .= "`fleet_start_planet` = '". $Planet ."' AND ";
			$QryLookFleets .= "`fleet_start_type` = '". $PlType ."' ";
			$QryLookFleets .= ") OR ( ";
			$QryLookFleets .= "`fleet_end_galaxy` = '". $Galaxy ."' AND ";
			$QryLookFleets .= "`fleet_end_system` = '". $System ."' AND ";
			$QryLookFleets .= "`fleet_end_planet` = '". $Planet ."' AND ";
			$QryLookFleets .= "`fleet_end_type` = '". $PlType ."' ";
			$QryLookFleets .= ") ) ";
			$QryLookFleets .= "ORDER BY `fleet_start_time`;";

			$FleetToTarget  = doquery( $QryLookFleets, 'fleets' );

			if (mysql_num_rows($FleetToTarget) <> 0 ) {
				while ($FleetRow = mysql_fetch_array($FleetToTarget)) {
					$Record++;

					// Discrimination de l'heure
					$StartTime   = $FleetRow['fleet_start_time'];
					$StayTime    = $FleetRow['fleet_end_stay'];
					$EndTime     = $FleetRow['fleet_end_time'];

					// Flotte hostile ? ou pas ??
					if ($FleetRow['fleet_owner'] == $TargetInfo['id_owner']) {
						$FleetType = true;
					} else {
						$FleetType = false;
					}

					// Masquage des ressources transportées
					$FleetRow['fleet_resource_metal']     = 0;
					$FleetRow['fleet_resource_crystal']   = 0;
					$FleetRow['fleet_resource_deuterium'] = 0;

					$Label = "fs";
					if ($StartTime > time()) {
						$fpage[$StartTime] = BuildFleetEventTable ( $FleetRow, 0, $FleetType, $Label, $Record );
					}

					if ($FleetRow['fleet_mission'] <> 4) {
						$Label = "ft";
						if ($StayTime > time()) {
							$fpage[$StayTime] = BuildFleetEventTable ( $FleetRow, 1, $FleetType, $Label, $Record );
						}

						if ($FleetType == true) {
							// On n'affiche les flottes en retour que pour les flottes du possesseur de la planete
							$Label = "fe";
							if ($EndTime > time()) {
								$fpage[$EndTime]  = BuildFleetEventTable ( $FleetRow, 2, $FleetType, $Label, $Record );
							}
						}
					}
				} // End While
			}

			if (count($fpage) > 0) {
				ksort($fpage);
				foreach ($fpage as $FleetTime => $FleetContent) {
					$Fleets .= $FleetContent ."\n";
				}
			}
		}

		$parse['phl_fleets_table'] = $Fleets;
		$page = parsetemplate( $PageTPL, $parse );
	}

	display ($page, $lang['sys_phalanx'], false, '', false);

?>
