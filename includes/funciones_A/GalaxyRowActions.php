<?php

/**
 * GalaxyRowActions.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowActions ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, $PlanetType )
{
	global $user, $dpath, $CurrentMIP, $CurrentSystem, $CurrentGalaxy;

	$Result = "<th style=\"white-space: nowrap;\" width=125>";

	if ($GalaxyRowPlayer['id'] != $user['id'])
	{
		if ($CurrentMIP <> 0)
		{
			if ($GalaxyRowUser['id'] != $user['id'])
			{
				if ($GalaxyRowPlanet["galaxy"] == $CurrentGalaxy)
				{
					$Range = GetMissileRange();
					$SystemLimitMin = $CurrentSystem - $Range;
					if ($SystemLimitMin < 1)
					{
						$SystemLimitMin = 1;
					}
					$SystemLimitMax = $CurrentSystem + $Range;

					if ($System <= $SystemLimitMax)
					{
						if ($System >= $SystemLimitMin)
						{
							$MissileBtn = true;
						}
						else
						{
							$MissileBtn = false;
						}
					}
					else
					{
						$MissileBtn = false;
					}
				}
				else
				{
				$MissileBtn = false;
				}
			}
			else
			{
				$MissileBtn = false;
			}
		}
		else
		{
			$MissileBtn = false;
		}

		if ($GalaxyRowPlayer && $GalaxyRowPlanet["destruyed"] == 0)
		{
			if ($user["settings_esp"] == "1" && $GalaxyRowPlayer['id'])
			{
				$Result .= "<a href=# onclick=\"javascript:doit(6, ".$Galaxy.", ".$System.", ".$Planet.", 1, ".$user["spio_anz"].");\" >";
				$Result .= "<img src=". $dpath ."img/e.gif alt=\"Espiar\" title=\"Espiar\" border=0></a>";
				$Result .= "&nbsp;";
			}
			if ($user["settings_wri"] == "1" && $GalaxyRowPlayer['id'])
			{
				$Result .= "<a href=messages.php?mode=write&id=".$GalaxyRowPlayer["id"].">";
				$Result .= "<img src=". $dpath ."img/m.gif alt=\"Escribir mensaje\" title=\"Escribir mensaje\" border=0></a>";
				$Result .= "&nbsp;";
			}
			if ($user["settings_bud"] == "1" && $GalaxyRowPlayer['id'])
			{
				$Result .= "<a href=buddy.php?mode=2&u=".$GalaxyRowPlayer['id']." >";
				$Result .= "<img src=". $dpath ."img/b.gif alt=\"Solicitud de compañeros\" title=\"Solicitud de compañeros\" border=0></a>";
				$Result .= "&nbsp;";
			}
			if ($user["settings_mis"] == "1" && $MissileBtn == true && $GalaxyRowPlayer['id'])
			{
				$Result .= "<a href=galaxy.php?mode=2&galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&current=".$user['current_planet']." >";
				$Result .= "<img src=". $dpath ."img/r.gif alt=\"Ataque con misiles\" title=\"Ataque con misiles\" border=0></a>";
			}
		}
	}
	$Result .= "</th>";

	return $Result;
}
?>