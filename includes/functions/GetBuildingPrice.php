<?php

/**
 * GetBuildingPrice.php
 *
 * @version 1.0
 * @copyright 2008 by Chlorel for XNova
 */

function GetBuildingPrice ($CurrentUser, $CurrentPlanet, $Element, $Incremental = true, $ForDestroy = false) {
	global $pricelist, $resource;

	if ($Incremental) {
		$level = ($CurrentPlanet[$resource[$Element]]) ? $CurrentPlanet[$resource[$Element]] : $CurrentUser[$resource[$Element]];
	}

	$array = array('metal', 'crystal', 'deuterium', 'energy_max');
	foreach ($array as $ResType) {
		if ($Incremental) {
			$cost[$ResType] = floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $level));
		} else {
			$cost[$ResType] = floor($pricelist[$Element][$ResType]);
		}

		if ($ForDestroy == true) {
			$cost[$ResType]  = floor($cost[$ResType]) / 2;
			$cost[$ResType] /= 2;
		}
	}

	return $cost;
}

?>