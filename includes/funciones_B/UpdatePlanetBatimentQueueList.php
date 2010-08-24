<?php

/**
 * UpdatePlanetBatimentQueueList.php
 *
 * @version 1.1
 * @copyright 2008 By Chlorel for XNova
 */

function UpdatePlanetBatimentQueueList ( &$CurrentPlanet, &$CurrentUser ) {

	$RetValue = false;
	if ( $CurrentPlanet['b_building_id'] != 0 ) {
		while ( $CurrentPlanet['b_building_id'] != 0 ) {
			if ( $CurrentPlanet['b_building'] <= time() ) {
				PlanetResourceUpdate ( $CurrentUser, $CurrentPlanet, $CurrentPlanet['b_building'], false );
				$IsDone = CheckPlanetBuildingQueue( $CurrentPlanet, $CurrentUser );
				if ( $IsDone == true ) {
					SetNextQueueElementOnTop ( $CurrentPlanet, $CurrentUser );
				}
			} else {
				$RetValue = true;
				break;
			}
		}
	}
	return $RetValue;
}

?>