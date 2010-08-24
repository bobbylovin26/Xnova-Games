<?php

/**
 * GalaxyRowUser.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowUser ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowUser, $Galaxy, $System, $Planet, $PlanetType, $UserPoints )
{
	global $game_config, $user;

	$Result = "<th width=150>";

	if ($GalaxyRowUser && $GalaxyRowPlanet["destruyed"] == 0)
	{
		$NoobProt 		= $game_config['noobprotection'];
		$NoobTime 		= $game_config['noobprotectiontime'];
		$NoobMulti 		= $game_config['noobprotectionmulti'];
		$User2Points 	= doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $GalaxyRowUser['id'] ."';", 'statpoints', true);
		$CurrentPoints 	= $UserPoints['total_points'];
		$RowUserPoints 	= $User2Points['total_points'];
		$CurrentLevel 	= $CurrentPoints * $NoobMulti['config_value'];
		$RowUserLevel 	= $RowUserPoints * $NoobMulti['config_value'];

		if ($GalaxyRowUser['bana'] == 1 && $GalaxyRowUser['urlaubs_modus'] == 1)
		{
			$Systemtatus2 	= "v <a href=\"banned.php\"><span class=\"banned\">s</span></a>";
			$Systemtatus 	= "<span class=\"vacation\">";
		}
		elseif ($GalaxyRowUser['bana'] == 1)
		{
			$Systemtatus2 	= "<a href=\"banned.php\"><span class=\"banned\">s</span></a>";
			$Systemtatus 	= "";
		}
		elseif ($GalaxyRowUser['urlaubs_modus'] == 1)
		{
			$Systemtatus2 	= "<span class=\"vacation\">v</span>";
			$Systemtatus 	= "<span class=\"vacation\">";
		}
		elseif ($GalaxyRowUser['onlinetime'] < (time()-60 * 60 * 24 * 7) && $GalaxyRowUser['onlinetime'] > (time()-60 * 60 * 24 * 28))
		{
			$Systemtatus2 	= "<span class=\"inactive\">i</span>";
			$Systemtatus 	= "<span class=\"inactive\">";
		}
		elseif ($GalaxyRowUser['onlinetime'] < (time()-60 * 60 * 24 * 28))
		{
			$Systemtatus2 	= "<span class=\"inactive\">i</span><span class=\"longinactive\"> I</span>";
			$Systemtatus 	= "<span class=\"longinactive\">";
		}
		elseif ($RowUserLevel < $CurrentPoints && $NoobProt['config_value'] == 1 && $NoobTime['config_value'] * 1000 > $RowUserPoints)
		{
			$Systemtatus2 	= "<span class=\"noob\">d</span>";
			$Systemtatus 	= "<span class=\"noob\">";
		}
		elseif ($RowUserPoints > $CurrentLevel && $NoobProt['config_value'] == 1 && $NoobTime['config_value'] * 1000 > $CurrentPoints)
		{
			$Systemtatus2 	= "f";
			$Systemtatus 	= "<span class=\"strong\">";
		}
		else
		{
			$Systemtatus2 	= "";
			$Systemtatus 	= "";
		}
		$Systemtatus4 		= $User2Points['total_rank'];

		if ($Systemtatus2 != '')
		{
			$Systemtatus6 	= "<font color=\"white\">(</font>";
			$Systemtatus7 	= "<font color=\"white\">)</font>";
		}
		if ($Systemtatus2 == '')
		{
			$Systemtatus6 	= "";
			$Systemtatus7 	= "";
		}

		$Systemtart = $User2Points['total_rank'];

		if (strlen($Systemtart) < 3)
			$Systemtart = 1;
		else
			$Systemtart = (floor( $User2Points['total_rank'] / 100 ) * 100) + 1;

		$Result .= "<a style=\"cursor: pointer;\"";
		$Result .= " onmouseover='return overlib(\"";
		$Result .= "<table width=190>";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=2>Jugador ".$GalaxyRowUser['username']." en el ranking ".$Systemtatus4."</td>";
		$Result .= "</tr><tr>";
		if ($GalaxyRowUser['id'] != $user['id'])
		{
			$Result .= "<td><a href=messages.php?mode=write&id=".$GalaxyRowUser['id'].">Escribir un mensaje</a></td>";
			$Result .= "</tr><tr>";
			$Result .= "<td><a href=buddy.php?mode=2&u=".$GalaxyRowUser['id'].">Solicitud de compañeros</a></td>";
			$Result .= "</tr><tr>";
		}
		$Result .= "<td><a href=stat.php?who=player&start=".$Systemtart.">Estadísticas</a></td>";
		$Result .= "</tr>";
		$Result .= "</table>\"";
		$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -40, OFFSETY, -40 );'";
		$Result .= " onmouseout='return nd();'>";
		$Result .= $Systemtatus;
		$Result .= $GalaxyRowUser["username"]."</span>";
		$Result .= $Systemtatus6;
		$Result .= $Systemtatus;
		$Result .= $Systemtatus2;
		$Result .= $Systemtatus7." ".$admin;
		$Result .= "</span></a>";
	}
	$Result .= "</th>";

	return $Result;
}
?>