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
	includeLang('fleet');

	$BoxTitle   = $lang['fl_error'];
	$TxtColor   = "red";
	$BoxMessage = $lang['fl_notback'];
	if ( is_numeric($_POST['fleetid']) ) {
		$fleetid  = intval($_POST['fleetid']);

		$FleetRow = doquery("SELECT * FROM {{table}} WHERE `fleet_id` = '". $fleetid ."';", 'fleets', true);
		$i = 0;

		if ($FleetRow['fleet_owner'] == $user['id']) {
			if ($FleetRow['fleet_mess'] == 0) {
				if ($FleetRow['fleet_end_stay'] != 0) {
					// Faut calculer le temps reel de retour
					if ($FleetRow['fleet_start_time'] < time()) {
						// On a pas encore entamé le stationnement
						// Il faut calculer la parcelle de temps ecoulée depuis le lancement de la flotte
						$CurrentFlyingTime = time() - $FleetRow['start_time'];
					} else {
						// On est deja en stationnement
						// Il faut donc directement calculer la durée d'un vol aller ou retour
						$CurrentFlyingTime = $FleetRow['fleet_start_time'] - $FleetRow['start_time'];
					}
				} else {
					// C'est quoi le stationnement ??
					// On calcule sagement la parcelle de temps ecoulée depuis le depart
					$CurrentFlyingTime = time() - $FleetRow['start_time'];
				}
				// Allez houste au bout du compte y a la maison !! (E.T. phone home.............)
				$ReturnFlyingTime  = $CurrentFlyingTime + time();

				$QryUpdateFleet  = "UPDATE {{table}} SET ";
				$QryUpdateFleet .= "`fleet_start_time` = '". (time() - 1) ."', ";
				$QryUpdateFleet .= "`fleet_end_stay` = '0', ";
				$QryUpdateFleet .= "`fleet_end_time` = '". ($ReturnFlyingTime + 1) ."', ";
				$QryUpdateFleet .= "`fleet_target_owner` = '". $user['id'] ."', ";
				$QryUpdateFleet .= "`fleet_mess` = '1' ";
				$QryUpdateFleet .= "WHERE ";
				$QryUpdateFleet .= "`fleet_id` = '" . $fleetid . "';";
				doquery( $QryUpdateFleet, 'fleets');

				$BoxTitle   = $lang['fl_sback'];
				$TxtColor   = "lime";
				$BoxMessage = $lang['fl_isback'];
			} elseif ($FleetRow['fleet_mess'] == 1) {
				$BoxMessage = $lang['fl_notback'];
			}
		} else {
			$BoxMessage = $lang['fl_onlyyours'];
		}
	}

	message ("<font color=\"".$TxtColor."\">". $BoxMessage ."</font>", $BoxTitle, "fleet.". PHPEXT, 2);

// -----------------------------------------------------------------------------------------------------------
// History version
// Updated by Chlorel. 22 Jan 2008 (String extraction, bug corrections, code uniformisation
// Created by DxPpLmOs. All rights reversed (C) 2007
// Updated by -= MoF =- for Deutsches Ugamela Forum
// 06.12.2007 - 08:41
// Open Source
// (c) by MoF
?>
