<?php

/**
 * GalaxyRowPlanetName.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowPlanetName ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowUser, $Galaxy, $System, $Planet, $PlanetType )
{
	global $user, $HavePhalanx, $CurrentSystem, $CurrentGalaxy;

	$Result  = "<th style=\"white-space: nowrap;\" width=130>";

	if ($GalaxyRowUser['ally_id'] == $user['ally_id'] && $GalaxyRowUser['id'] != $user['id'] && $user['ally_id'] != '')
	{
		$TextColor = "<font color=\"green\">";
		$EndColor  = "</font>";
	}
	elseif ($GalaxyRowUser['id'] == $user['id'])
	{
		$TextColor = "<font color=\"red\">";
		$EndColor  = "</font>";
	}
	else
	{
		$TextColor = '';
		$EndColor  = "";
	}

	if ($GalaxyRowPlanet['last_update'] > (time()-59 * 60) && $GalaxyRowUser['id'] != $user['id'])
		$Inactivity = pretty_time_hour(time() - $GalaxyRowPlanet['last_update']);

	if ($GalaxyRow && $GalaxyRowPlanet["destruyed"] == 0)
	{
		if ($HavePhalanx <> 0)
		{
			if ($GalaxyRowPlanet["galaxy"] == $CurrentGalaxy)
			{
				$Range = GetPhalanxRange ( $HavePhalanx );
				if ($CurrentGalaxy + $Range <= $CurrentSystem && $CurrentSystem >= $CurrentGalaxy - $Range)
					$PhalanxTypeLink = "<a href=# onclick=fenster('phalanx.php?galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=".$Planet."&amp;planettype=".$PlanetType."')  title=\"Phalanx\">".$GalaxyRowPlanet['name']."</a><br />";
				else
					$PhalanxTypeLink = stripslashes($GalaxyRowPlanet['name']);
			}
			else
			{
				$PhalanxTypeLink = stripslashes($GalaxyRowPlanet['name']);
			}
		}
		else
		{
			$PhalanxTypeLink = stripslashes($GalaxyRowPlanet['name']);
		}

		$Result .= $TextColor . $PhalanxTypeLink . $EndColor;

		if ($GalaxyRowPlanet['last_update']  > (time()-59 * 60) && $GalaxyRowUser['id'] != $user['id'])
		{
			if ($GalaxyRowPlanet['last_update']  > (time()-10 * 60) && $GalaxyRowUser['id'] != $user['id'])
				$Result .= "(*)";
			else
				$Result .= " (".$Inactivity.")";
		}
	}
	elseif($GalaxyRowPlanet["destruyed"] != 0)
	{
		$Result .= "Planeta destruido";
	}

	$Result .= "</th>";

	return $Result;
}
?>