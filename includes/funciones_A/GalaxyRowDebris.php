<?php

/**
 * GalaxyRowDebris.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowDebris ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowUser, $Galaxy, $System, $Planet, $PlanetType )
{
	global $dpath, $CurrentRC, $user, $pricelist;

	$Result  = "<th style=\"white-space: nowrap;\" width=30>";
	if ($GalaxyRow)
	{
		if ($GalaxyRow["metal"] != 0 || $GalaxyRow["crystal"] != 0)
		{
			$RecNeeded = ceil(($GalaxyRow["metal"] + $GalaxyRow["crystal"]) / $pricelist[209]['capacity']);

			if ($RecNeeded < $CurrentRC)
				$RecSended = $RecNeeded;
			elseif ($RecNeeded >= $CurrentRC)
				$RecSended = $CurrentRC;
			else
				$RecSended = $RecyclerCount;

			$Result  = "<th style=\"";

			if       (($GalaxyRow["metal"] + $GalaxyRow["crystal"]) >= 10000000)
				$Result .= "background-color: rgb(100, 0, 0);";
			elseif (($GalaxyRow["metal"] + $GalaxyRow["crystal"]) >= 1000000)
				$Result .= "background-color: rgb(100, 100, 0);";
			elseif (($GalaxyRow["metal"] + $GalaxyRow["crystal"]) >= 100000)
				$Result .= "background-color: rgb(0, 100, 0);";

			$Result .= "background-image: none;\" width=30>";
			$Result .= "<a style=\"cursor: pointer;\"";
			$Result .= " onmouseover='return overlib(\"";
			$Result .= "<table width=240>";
			$Result .= "<tr>";
			$Result .= "<td class=c colspan=2>";
			$Result .= "Campo de escombros [".$Galaxy.":".$System.":".$Planet."]";
			$Result .= "</td>";
			$Result .= "</tr><tr>";
			$Result .= "<th width=80>";
			$Result .= "<img src=". $dpath ."planeten/debris.jpg height=75 width=75 />";
			$Result .= "</th>";
			$Result .= "<th>";
			$Result .= "<table>";
			$Result .= "<tr>";
			$Result .= "<td class=c colspan=2>Recursos:</td>";
			$Result .= "</tr><tr>";
			$Result .= "<th>Metal: </th><th>". number_format( $GalaxyRow['metal'], 0, '', '.') ."</th>";
			$Result .= "</tr><tr>";
			$Result .= "<th>Cristal: </th><th>". number_format( $GalaxyRow['crystal'], 0, '', '.') ."</th>";
			$Result .= "</tr><tr>";
			$Result .= "<td class=c colspan=2>Acciones:</td>";
			$Result .= "</tr><tr>";
			$Result .= "<th colspan=2 align=left>";
			$Result .= "<a href= # onclick=&#039javascript:doit (8, ".$Galaxy.", ".$System.", ".$Planet.", ".$PlanetType.", ".$RecSended.");&#039 >Recolectar</a>";
			$Result .= "</tr>";
			$Result .= "</table>";
			$Result .= "</th>";
			$Result .= "</tr>";
			$Result .= "</table>\"";
			$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -40, OFFSETY, -40 );'";
			$Result .= " onmouseout='return nd();'>";
			$Result .= "<img src=". $dpath ."planeten/debris.jpg height=22 width=22></a>";
		}
	}
	$Result .= "</th>";
	return $Result;
}
?>