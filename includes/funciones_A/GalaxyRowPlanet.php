<?php

/**
 * GalaxyRowPlanet.php
 *
 * @version 2.0
 * @copyright 2008 by Aleksandar Spasojevic (KGsystem) for prethOgame
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowPlanet ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowUser, $Galaxy, $System, $Planet, $PlanetType )
{
	global $dpath, $user, $CurrentMIP, $HavePhalanx, $CurrentSystem, $CurrentGalaxy, $game_config;

	$Result  = "<th width=30>";
	if ($GalaxyRow && $GalaxyRowPlanet["destruyed"] == 0 && $GalaxyRow["id_planet"] != 0)
	{
		if ($HavePhalanx <> 0)
		{
			if ($GalaxyRowUser['id'] != $user['id'])
			{
				if ($GalaxyRowPlanet["galaxy"] == $CurrentGalaxy)
				{
					$PhRange = GetPhalanxRange ( $HavePhalanx );
					$SystemLimitMin = $CurrentSystem - $PhRange;
					if ($SystemLimitMin < 1)
						$SystemLimitMin = 1;

					$SystemLimitMax = $CurrentSystem + $PhRange;
					if ($System <= $SystemLimitMax)
					{
						if ($System >= $SystemLimitMin)
							$PhalanxTypeLink = "<a href=# onclick=fenster(&#039;phalanx.php?galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=".$Planet."&amp;planettype=".$PlanetType."&#039;) >Phalanx</a><br />";
						else
							$PhalanxTypeLink = "";
					}
					else
					{
						$PhalanxTypeLink = "";
					}
				}
				else
				{
					$PhalanxTypeLink = "";
				}
			}
			else
			{
				$PhalanxTypeLink = "";
			}
		}
		else
		{
			$PhalanxTypeLink = "";
		}

		if ($CurrentMIP <> 0)
		{
			if ($GalaxyRowUser['id'] != $user['id'])
			{
				if ($GalaxyRowPlanet["galaxy"] == $CurrentGalaxy)
				{
					$MiRange = GetMissileRange();
					$SystemLimitMin = $CurrentSystem - $MiRange;
					if ($SystemLimitMin < 1)
						$SystemLimitMin = 1;

					$SystemLimitMax = $CurrentSystem + $MiRange;

					if ($System <= $SystemLimitMax)
					{
						if ($System >= $SystemLimitMin)
							$MissileBtn = true;
						else
							$MissileBtn = false;
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

		if ($GalaxyRowUser['id'] != $user['id'])
			$MissionType6Link = "<a href=# onclick=&#039javascript:doit(6, ".$Galaxy.", ".$System.", ".$Planet.", ".$PlanetType.", ".$user["spio_anz"].");&#039 >Espiar</a><br /><br />";
		elseif ($GalaxyRowUser['id'] == $user['id'])
			$MissionType6Link = "";

		if ($GalaxyRowUser['id'] != $user['id'])
			$MissionType1Link = "<a href=fleet.php?galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=".$Planet."&amp;planettype=".$PlanetType."&amp;target_mission=1>Atacar</a><br />";
		elseif ($GalaxyRowUser['id'] == $user['id'])
			$MissionType1Link = "";

		if ($GalaxyRowUser['id'] != $user['id'] AND $game_config['allow_acs'] == 1 AND $Buddy)
			$MissionType5Link = "<a href=fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=".$PlanetType."&target_mission=5>Mantener posición</a><br />";
		elseif ($GalaxyRowUser['id'] == $user['id'])
			$MissionType5Link = "";

		if ($GalaxyRowUser['id'] == $user['id'])
			$MissionType4Link = "<a href=fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=".$PlanetType."&target_mission=4>Desplegar</a><br />";
		elseif ($GalaxyRowUser['id'] != $user['id'])
			$MissionType4Link = "";

		if ($user["settings_mis"] == "1" AND $MissileBtn == true && $GalaxyRowUser['id'])
			$MissionType10Link = "<a href=galaxy.php?mode=2&galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&current=".$user['current_planet']." >Ataque con misiles</a><br />";
		elseif ($GalaxyRowUser['id'] != $user['id'])
			$MissionType10Link = "";

		$MissionType3Link = "<a href=fleet.php?galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."&planettype=".$PlanetType."&target_mission=3>Transportar</a><br />";

		$Result .= "<a style=\"cursor: pointer;\"";
		$Result .= " onmouseover='return overlib(\"";
		$Result .= "<table width=240>";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=2>";
		$Result .= "Planeta ". $GalaxyRowPlanet["name"] ." [".$Galaxy.":".$System.":".$Planet."]";
		$Result .= "</td>";
		$Result .= "</tr>";
		$Result .= "<tr>";
		$Result .= "<th width=80>";
		$Result .= "<img src=". $dpath ."planeten/small/s_". $GalaxyRowPlanet["image"] .".jpg height=75 width=75 />";
		$Result .= "</th>";
		$Result .= "<th align=left>";
		$Result .= $MissionType6Link;
		$Result .= $PhalanxTypeLink;
		$Result .= $MissionType1Link;
		$Result .= $MissionType5Link;
		$Result .= $MissionType4Link;
		$Result .= $MissionType3Link;
		$Result .= $MissionType10Link;
		$Result .= "</th>";
		$Result .= "</tr>";
		$Result .= "</table>\"";
		$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -40, OFFSETY, -40 );'";
		$Result .= " onmouseout='return nd();'>";
		$Result .= "<img src=".   $dpath ."planeten/small/s_". $GalaxyRowPlanet["image"] .".jpg height=30 width=30>";
		$Result .= "</a>";
	}
	$Result .= "</th>";

	return $Result;
}

?>