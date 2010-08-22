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
define('IN_ADMIN', true);
require_once dirname(__FILE__) .'./../common.php';

	if ($user['authlevel'] >= 1) {
		includeLang('admin');

		$QrySelectPlanet  = "SELECT `id`, `id_owner`, `b_hangar`, `b_hangar_id` ";
		$QrySelectPlanet .= "FROM {{table}} ";
		$QrySelectPlanet .= "WHERE ";
		$QrySelectPlanet .= "`b_hangar_id` != '0';";
		$AffectedPlanets  = doquery ($QrySelectPlanet, 'planets');
		$DeletedQueues    = 0;
		while ( $ActualPlanet = mysql_fetch_assoc($AffectedPlanets) ) {
			$HangarQueue = explode (";", $ActualPlanet['b_hangar_id']);
			$bDelQueue   = false;
			if (count($HangarQueue)) {
				for ( $Queue = 0; $Queue < count($HangarQueue); $Queue++) {
					$InQueue = explode (",", $HangarQueue[$Queue]);
					if ($InQueue[1] > MAX_FLEET_OR_DEFS_PER_ROW) {
						$bDelQueue = true;
					}
				}
			}
			if ($bDelQueue) {
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
		if ($DeletedQueues > 0) {
			$QuitMessage = $lang['adm_cleaned']." ". $DeletedQueues;
		} else {
			$QuitMessage = $lang['adm_done'];
		}

		AdminMessage ($QuitMessage, $lang['adm_cleaner_title']);

	} else {
		message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}

?>