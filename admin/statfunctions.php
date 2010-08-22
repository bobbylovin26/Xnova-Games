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

function GetTechnoPoints ( $CurrentUser ) {
	global $resource, $pricelist, $reslist;

	$TechCounts = 0;
	$TechPoints = 0;
	foreach ( $reslist['tech'] as $n => $Techno ) {
		if ( $CurrentUser[ $resource[ $Techno ] ] > 0 ) {
			for ( $Level = 1; $Level < $CurrentUser[ $resource[ $Techno ] ]; $Level++ ) {
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

function GetBuildPoints ( $CurrentPlanet ) {
	global $resource, $pricelist, $reslist;

	$BuildCounts = 0;
	$BuildPoints = 0;
	foreach($reslist['build'] as $n => $Building) {
		if ( $CurrentPlanet[ $resource[ $Building ] ] > 0 ) {
			for ( $Level = 1; $Level < $CurrentPlanet[ $resource[ $Building ] ]; $Level++ ) {
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

function GetDefensePoints ( $CurrentPlanet ) {
	global $resource, $pricelist, $reslist;

	$DefenseCounts = 0;
	$DefensePoints = 0;
	foreach($reslist['defense'] as $n => $Defense) {
		if ($CurrentPlanet[ $resource[ $Defense ] ] > 0) {
			$Units          = $pricelist[ $Defense ]['metal'] + $pricelist[ $Defense ]['crystal'] + $pricelist[ $Defense ]['deuterium'];
			$DefensePoints += ($Units * $CurrentPlanet[ $resource[ $Defense ] ]);
			$DefenseCounts += $CurrentPlanet[ $resource[ $Defense ] ];
		}
	}
	$RetValue['DefenseCount'] = $DefenseCounts;
	$RetValue['DefensePoint'] = $DefensePoints;

	return $RetValue;
}

function GetFleetPoints ( $CurrentPlanet ) {
	global $resource, $pricelist, $reslist;

	$FleetCounts = 0;
	$FleetPoints = 0;
	foreach($reslist['fleet'] as $n => $Fleet) {
		if ($CurrentPlanet[ $resource[ $Fleet ] ] > 0) {
			$Units          = $pricelist[ $Fleet ]['metal'] + $pricelist[ $Fleet ]['crystal'] + $pricelist[ $Fleet ]['deuterium'];
			$FleetPoints   += ($Units * $CurrentPlanet[ $resource[ $Fleet ] ]);
			$FleetCounts   += $CurrentPlanet[ $resource[ $Fleet ] ];
		}
	}
	$RetValue['FleetCount'] = $FleetCounts;
	$RetValue['FleetPoint'] = $FleetPoints;

	return $RetValue;
}

function GetFlyingFleetPoints ( $FlyingFleet ) {
	global $resource, $pricelist, $reslist;

	$FleetCounts = 0;
	$FleetPoints = 0;
	
	while ($Fleet = mysql_fetch_assoc ($FlyingFleet))
	{
		$FleetRec     = explode(";", $Fleet['fleet_array']);
		
		foreach ($FleetRec as $Item => $Group)
		{
			if ($Group  != '') 
			{
				$Ship    = explode(",", $Group);
				$Units         = $pricelist[ $Ship[0] ]['metal'] + $pricelist[ $Ship[0] ]['crystal'] + $pricelist[ $Ship[0] ]['deuterium'];
				$FleetPoints   += ($Units * $Ship[1]);
				$FleetCounts   += $Ship[1];
			}
		}
	}
	$RetValue['FleetCount'] = $FleetCounts;
	$RetValue['FleetPoint'] = $FleetPoints;

	return $RetValue;
}
?>