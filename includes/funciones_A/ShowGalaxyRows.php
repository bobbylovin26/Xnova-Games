<?php

/**
 * ShowGalaxyRows.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function ShowGalaxyRows ($Galaxy, $System)
{
	global $planetcount, $CurrentRC, $dpath, $user, $xgp_root, $phpEx;

	include($xgp_root . "includes/funciones_A/GalaxyCheckFunctions." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowActions." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowAlly." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowDebris." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowMoon." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowPlanet." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowPlanetName." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowPos." . $phpEx);
	include($xgp_root . "includes/funciones_A/GalaxyRowUser." . $phpEx);
	include($xgp_root . "includes/funciones_A/GetMissileRange." . $phpEx);
	include($xgp_root . "includes/funciones_A/GetPhalanxRange." . $phpEx);

	$UserPoints    = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $user['id'] ."';", 'statpoints', true);

	$Result = "";
	for ($Planet = 1; $Planet < 1+(MAX_PLANET_IN_SYSTEM); $Planet++)
	{
		unset($GalaxyRowPlanet);
		unset($GalaxyRowMoon);
		unset($GalaxyRowPlayer);
		unset($GalaxyRowAlly);

		$GalaxyRow = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '".$Galaxy."' AND `system` = '".$System."' AND `planet` = '".$Planet."';", 'galaxy', true);

		$Result .= "\n";
		$Result .= "<tr>";

		if ($GalaxyRow)
		{
			if ($GalaxyRow["id_planet"] != 0)
			{
				$GalaxyRowPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRow["id_planet"] ."';", 'planets', true);

				if ($GalaxyRowPlanet['destruyed'] != 0 && $GalaxyRowPlanet['id_owner'] != '' && $GalaxyRow["id_planet"] != '')
				{
					CheckAbandonPlanetState ($GalaxyRowPlanet);
				}
				else
				{
					$planetcount++;
					$GalaxyRowPlayer = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRowPlanet["id_owner"] ."';", 'users', true);
				}

				if ($GalaxyRow["id_luna"] != 0)
				{
					$GalaxyRowMoon   = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRow["id_luna"] ."';", 'lunas', true);

					if ($GalaxyRowMoon["destruyed"] != 0)
					{
						CheckAbandonMoonState ($GalaxyRowMoon);
					}
				}

				if ($GalaxyRowPlanet['id_owner'] <> 0)
					$GalaxyRowUser     = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRowPlanet['id_owner'] ."';", 'users', true);
				else
					$GalaxyRowUser     = array();

			}
		}

		$Result .= "\n";
		$Result .= GalaxyRowPos        ( $GalaxyRow, $Galaxy, $System, $Planet, 1 );
		$Result .= "\n";
		$Result .= GalaxyRowPlanet     ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 1 );
		$Result .= "\n";
		$Result .= GalaxyRowPlanetName ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 1 );
		$Result .= "\n";
		$Result .= GalaxyRowMoon       ( $GalaxyRow, $GalaxyRowMoon  , $GalaxyRowPlayer, $Galaxy, $System, $Planet, 3 );
		$Result .= "\n";
		$Result .= GalaxyRowDebris     ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 2 );
		$Result .= "\n";
		$Result .= GalaxyRowUser       ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0, $UserPoints );
		$Result .= "\n";
		$Result .= GalaxyRowAlly       ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0 );
		$Result .= "\n";
		$Result .= GalaxyRowActions    ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0 );
		$Result .= "\n";
		$Result .= "</tr>";
	}
	return $Result;
}
?>