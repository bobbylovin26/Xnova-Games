<?php

/**
 * GalaxyRowPos.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowPos ( $GalaxyRow, $Galaxy, $System, $Planet )
{
	$Result  = "<th width=30>";
    $Result .= "<a href=\"fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=0&target_mission=7\"";
	if ($GalaxyRow)
		$Result .= " tabindex=\"". ($Planet + 1) ."\"";
	$Result .= ">". $Planet ."</a>";
	$Result .= "</th>";

	return $Result;
}
?>