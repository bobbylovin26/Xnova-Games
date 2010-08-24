<?php

/**
 * GetElementRessources.php
 *
 * @version 1.0
 * @copyright 2008 By Chlorel for XNova
 */

function GetElementRessources ( $Element, $Count ) {
	global $pricelist;

	$ResType['metal']     = ($pricelist[$Element]['metal']     * $Count);
	$ResType['crystal']   = ($pricelist[$Element]['crystal']   * $Count);
	$ResType['deuterium'] = ($pricelist[$Element]['deuterium'] * $Count);

	return $ResType;
}

?>