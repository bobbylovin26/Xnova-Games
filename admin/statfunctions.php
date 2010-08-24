<?php

/**
 * StatFunctions.php
 *
 * @version 1
 * @copyright 2008 by Chlorel for XNova
 */

function GetFlyingFleetPoints($CurUser) {
   global $resource, $pricelist, $reslist;

   // PADA FUNCTION
   // USE AT YOUR OWN RISK :3

   $OwnFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '". $CurUser['id'] ."';", 'fleets');
   $Record = 0;
   while ($FleetRow = mysql_fetch_array($OwnFleets)) {

      $FleetRec     = explode(";", $FleetRow['fleet_array']);
      if(is_array($FleetRec)){
         foreach($FleetRec as $Item => $Group) {
            if ($Group  != '') {
               $Ship    = explode(",", $Group);

               $Units         = $pricelist[ $Ship[0] ]['metal'] + $pricelist[ $Ship[0] ]['crystal'] + $pricelist[ $Ship[0] ]['deuterium'];
               $FleetPoints   += ($Units * $Ship[1]);
               $FleetCounts   += $Ship[1];
            }
         }
      }
   }

   $RetValue['FleetCount'] = $FleetCounts;
   $RetValue['FleetPoint'] = $FleetPoints;

   return $RetValue;

}

function GetTechnoPoints ( $CurUser ) {
	global $resource, $pricelist, $reslist;

	$TechCounts = 0;
	$TechPoints = 0;
	foreach ( $reslist['tech'] as $n => $Techno ) {
		if ( $CurUser[ $resource[ $Techno ] ] > 0 ) {
			for ( $Level = 1; $Level < $CurUser[ $resource[ $Techno ] ]; $Level++ ) {
				$Units       = $pricelist[ $Techno ]['metal'] + $pricelist[ $Techno ]['crystal'] + $pricelist[ $Techno ]['deuterium'];
				$LevelMul    = pow( $pricelist[ $Techno ]['factor'], $Level );
				$TechPoints += ($Units * $LevelMul);
				$TechCounts += 1;
			}
		}
	}
	$RetValue['TechCount'] = $TechCounts;
	$RetValue['TechPoint'] = $TechPoints;

	return $RetValue;
}

function GetBuildPoints ( $CurPlanet ) {
	global $resource, $pricelist, $reslist;

	$BuildCounts = 0;
	$BuildPoints = 0;
	foreach($reslist['build'] as $n => $Building) {
		if ( $CurPlanet[ $resource[ $Building ] ] > 0 ) {
			for ( $Level = 1; $Level < $CurPlanet[ $resource[ $Building ] ]; $Level++ ) {
				$Units        = $pricelist[ $Building ]['metal'] + $pricelist[ $Building ]['crystal'] + $pricelist[ $Building ]['deuterium'];
				$LevelMul     = pow( $pricelist[ $Building ]['factor'], $Level );
				$BuildPoints += ($Units * $LevelMul);
				$BuildCounts += 1;
			}
		}
	}
	$RetValue['BuildCount'] = $BuildCounts;
	$RetValue['BuildPoint'] = $BuildPoints;

	return $RetValue;
}

function GetDefensePoints ( $CurPlanet ) {
	global $resource, $pricelist, $reslist;

	$DefenseCounts = 0;
	$DefensePoints = 0;
	foreach($reslist['defense'] as $n => $Defense) {
		if ($CurPlanet[ $resource[ $Defense ] ] > 0) {
			$Units          = $pricelist[ $Defense ]['metal'] + $pricelist[ $Defense ]['crystal'] + $pricelist[ $Defense ]['deuterium'];
			$DefensePoints += ($Units * $CurPlanet[ $resource[ $Defense ] ]);
			$DefenseCounts += $CurPlanet[ $resource[ $Defense ] ];
		}
	}
	$RetValue['DefenseCount'] = $DefenseCounts;
	$RetValue['DefensePoint'] = $DefensePoints;

	return $RetValue;
}

function GetFleetPoints ( $CurPlanet ) {
	global $resource, $pricelist, $reslist;

	$FleetCounts = 0;
	$FleetPoints = 0;
	foreach($reslist['fleet'] as $n => $Fleet) {
		if ($CurPlanet[ $resource[ $Fleet ] ] > 0) {
			$Units          = $pricelist[ $Fleet ]['metal'] + $pricelist[ $Fleet ]['crystal'] + $pricelist[ $Fleet ]['deuterium'];
			$FleetPoints   += ($Units * $CurPlanet[ $resource[ $Fleet ] ]);
			$FleetCounts   += $CurPlanet[ $resource[ $Fleet ] ];
		}
	}
	$RetValue['FleetCount'] = $FleetCounts;
	$RetValue['FleetPoint'] = $FleetPoints;

	return $RetValue;
}
?>