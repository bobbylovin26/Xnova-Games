<?php

/**
 * GalaxyRowAlly.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyRowAlly ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowUser, $Galaxy, $System, $Planet, $PlanetType )
{
	global $user;

	$Result  = "<th width=80>";
	if ($GalaxyRowUser['ally_id'] && $GalaxyRowUser['ally_id'] != 0)
	{
		$allyquery = doquery("SELECT * FROM {{table}} WHERE id=" . $GalaxyRowUser['ally_id'], "alliance", true);
		if ($allyquery)
		{
			$members_count = doquery("SELECT COUNT(DISTINCT(id)) FROM {{table}} WHERE ally_id=" . $allyquery['id'] . ";", "users", true);

			if ($members_count[0] > 1)
				$add = "s";
			else
				$add = "";

			$Result .= "<a style=\"cursor: pointer;\"";
			$Result .= " onmouseover='return overlib(\"";
			$Result .= "<table width=240>";
			$Result .= "<tr>";
			$Result .= "<td class=c>Alianza ". $allyquery['ally_name'] ." con ". $members_count[0] ." miembro". $add ."</td>";
			$Result .= "</tr>";
			$Result .= "<th>";
			$Result .= "<table>";
			$Result .= "<tr>";
			$Result .= "<td><a href=alliance.php?mode=ainfo&a=". $allyquery['id'] .">Ver p�gina de la alianza</a></td>";
			$Result .= "</tr><tr>";
			$Result .= "<td><a href=stat.php?start=101&who=ally>Ver en estad�sticas</a></td>";
			if ($allyquery["ally_web"] != "")
			{
				$Result .= "</tr><tr>";
				$Result .= "<td><a href=". $allyquery["ally_web"] ." target=_new>P�gina principal de la alianza</td>";
			}
			$Result .= "</tr>";
			$Result .= "</table>";
			$Result .= "</th>";
			$Result .= "</table>\"";
			$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -40, OFFSETY, -40 );'";
			$Result .= " onmouseout='return nd();'>";
			if ($user['ally_id'] == $GalaxyRowPlayer['ally_id'])
			{
				$Result .= "<span class=\"allymember\">". $allyquery['ally_tag'] ."</span></a>";
			}
			elseif ($GalaxyRowUser['ally_id'] == $user['ally_id'])
			{
				$Result .= "<font color=lime>".$allyquery['ally_tag'] ."</font></a>";
			}
			else
			{
				$Result .= $allyquery['ally_tag'] ."</a>";
			}
		}
	}
	$Result .= "</th>";
	return $Result;
}
?>