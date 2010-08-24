<?php

/**
 * ShowGalaxyFooter.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function ShowGalaxyFooter ( $Galaxy, $System,  $CurrentMIP, $CurrentRC, $CurrentSP)
{
	global $maxfleet_count, $fleetmax, $planetcount, $xnova_root_path, $phpEx;

	include_once($xnova_root_path . "includes/funciones_A/GalaxyLegendPopup." . $phpEx);

	$Result  = "";

	$PlanetCountMessage = $planetcount ." ". "Planetas habitados";

	$LegendPopup = GalaxyLegendPopup ();
	$Recyclers   = pretty_number($CurrentRC);
	$SpyProbes   = pretty_number($CurrentSP);

	$Result .= "\n";
	$Result .= "<tr>";
	$Result .= "<th width=\"30\">16</th>";
	$Result .= "<th colspan=7>";
	$Result .= "<a href=fleet.php?galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=16;planettype=1&amp;target_mission=15>Espacio exterior</a>";
	$Result .= "</th>";
	$Result .= "</tr>";
	$Result .= "\n";
	$Result .= "<tr>";
	$Result .= "<td class=c colspan=6>( ".$PlanetCountMessage." )</td>";
	$Result .= "<td class=c colspan=2>". $LegendPopup ."</td>";
	$Result .= "</tr>";
	$Result .= "\n";
	$Result .= "<tr>";
	$Result .= "<td class=c colspan=3><span id=\"missiles\">". $CurrentMIP ."</span> Misiles disponibles</td>";
	$Result .= "<td class=c colspan=3><span id=\"slots\">". $maxfleet_count ."</span>/". $fleetmax ." flotas</td>";
	$Result .= "<td class=c colspan=2>";
	$Result .= "<span id=\"recyclers\">". $Recyclers ."</span> Recicladores disponibles<br>";
	$Result .= "<span id=\"probes\">". $SpyProbes ."</span> Sondas disponibles</td>";
	$Result .= "</tr>";
	$Result .= "\n";
	$Result .= "<tr style=\"display: none;\" id=\"fleetstatusrow\">";
	$Result .= "<th class=c colspan=8><!--<div id=\"fleetstatus\"></div>-->";
	$Result .= "<table style=\"font-weight: bold\" width=\"100%\" id=\"fleetstatustable\">";
	$Result .= "<!-- will be filled with content later on while processing ajax replys -->";
	$Result .= "</table>";
	$Result .= "</th>";
	$Result .= "\n";
	$Result .= "</tr>";
	return $Result;
}
?>