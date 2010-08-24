<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

if(!defined('INSIDE')){ die(header("location:../../"));}

function ShowGalaxyPage($CurrentUser, $CurrentPlanet)
{
	global $xgp_root, $phpEx, $dpath, $resource, $lang;

	include_once($xgp_root . 'includes/classes/class.ShowGalaxy.' . $phpEx);
	$ClassShowGalaxy = new ShowGalaxy();

	$lunarow       	= doquery("SELECT * FROM {{table}} WHERE `id` = '". $CurrentUser['current_luna'] ."';", 'lunas', true);

	$fleetmax      	= ($CurrentUser['computer_tech'] + 1) + ($CurrentUser['rpg_commandant'] * 3);
	$CurrentPlID   	= $CurrentPlanet['id'];
	$CurrentMIP    	= $CurrentPlanet['interplanetary_misil'];
	$CurrentRC     	= $CurrentPlanet['recycler'];
	$CurrentSP     	= $CurrentPlanet['spy_sonde'];
	$HavePhalanx   	= $CurrentPlanet['phalanx'];
	$CurrentSystem 	= $CurrentPlanet['system'];
	$CurrentGalaxy 	= $CurrentPlanet['galaxy'];
	$CanDestroy    	= $CurrentPlanet[$resource[213]] + $CurrentPlanet[$resource[214]];
	$UserDeuterium 	= $CurrentPlanet['deuterium'] - 10;

	$maxfleet       = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '". $CurrentUser['id'] ."';", 'fleets');
	$maxfleet_count = mysql_num_rows($maxfleet);

	if ($UserDeuterium < 10)
		die (message($lang['gl_no_deuterium_to_view_galaxy'], "game.php?page=overview", 2));

	$QryGalaxyDeuterium   = "UPDATE {{table}} SET ";
	$QryGalaxyDeuterium  .= "`deuterium` = '". $UserDeuterium ."' ";
	$QryGalaxyDeuterium  .= "WHERE ";
	$QryGalaxyDeuterium  .= "`id` = '". $CurrentPlanet['id'] ."' ";
	$QryGalaxyDeuterium  .= "LIMIT 1;";
	doquery($QryGalaxyDeuterium, 'planets');

	if (!isset($mode))
	{
		if (isset($_GET['mode']))
		{
			$mode = intval($_GET['mode']);
		}
		else
		{
			$mode = 0;
		}
	}

	if ($mode == 0)
	{
		$galaxy        = $CurrentPlanet['galaxy'];
		$system        = $CurrentPlanet['system'];
		$planet        = $CurrentPlanet['planet'];
	}
	elseif ($mode == 1)
	{
		if (is_numeric($_POST["galaxy"]))
			$_POST["galaxy"] = abs($_POST["galaxy"]);
		else
			$_POST["galaxy"] = 1;
		if (is_numeric($_POST["system"]))
			$_POST["system"] = abs($_POST["system"]);
		else
			$_POST["system"] = 1;

		if ($_POST["galaxy"] > MAX_GALAXY_IN_WORLD)
			$_POST["galaxy"] = MAX_GALAXY_IN_WORLD;

		if ($_POST["system"] > MAX_SYSTEM_IN_GALAXY)
			$_POST["system"] = MAX_SYSTEM_IN_GALAXY;

		if ($_POST["galaxyLeft"])
		{
			if ($_POST["galaxy"] < 1)
			{
				$_POST["galaxy"] = 1;
				$galaxy          = 1;
			}
			elseif ($_POST["galaxy"] == 1)
			{
				$_POST["galaxy"] = 1;
				$galaxy          = 1;
			}
			else
			{
				$galaxy = $_POST["galaxy"] - 1;
			}
		}
		elseif ($_POST["galaxyRight"])
		{
			if ($_POST["galaxy"] > MAX_GALAXY_IN_WORLD OR $_POST["galaxyRight"] > MAX_GALAXY_IN_WORLD)
			{
				$_POST["galaxy"]      = MAX_GALAXY_IN_WORLD;
				$_POST["galaxyRight"] = MAX_GALAXY_IN_WORLD;
				$galaxy               = MAX_GALAXY_IN_WORLD;
			}
			elseif ($_POST["galaxy"] == MAX_GALAXY_IN_WORLD)
			{
				$_POST["galaxy"]      = MAX_GALAXY_IN_WORLD;
				$galaxy               = MAX_GALAXY_IN_WORLD;
			}
			else
			{
			$galaxy = $_POST["galaxy"] + 1;
			}
		}
		else
		{
			$galaxy = $_POST["galaxy"];
		}

		if ($_POST["systemLeft"])
		{
			if ($_POST["system"] < 1)
			{
				$_POST["system"] = 1;
				$system          = 1;
			}
			elseif ($_POST["system"] == 1)
			{
				$_POST["system"] = 1;
				$system          = 1;
			}
			else
			{
				$system = $_POST["system"] - 1;
			}
		}
		elseif ($_POST["systemRight"])
		{
			if ($_POST["system"]      > MAX_SYSTEM_IN_GALAXY OR $_POST["systemRight"] > MAX_SYSTEM_IN_GALAXY)
			{
				$_POST["system"]      = MAX_SYSTEM_IN_GALAXY;
				$system               = MAX_SYSTEM_IN_GALAXY;
			}
			elseif ($_POST["system"] == MAX_SYSTEM_IN_GALAXY)
			{
				$_POST["system"]      = MAX_SYSTEM_IN_GALAXY;
				$system               = MAX_SYSTEM_IN_GALAXY;
			}
			else
			{
				$system = $_POST["system"] + 1;
			}
		}
		else
		{
			$system = $_POST["system"];
		}
	}
	elseif ($mode == 2)
	{
		$galaxy        = $_GET['galaxy'];
		$system        = $_GET['system'];
		$planet        = $_GET['planet'];
	}
	elseif ($mode == 3)
	{
		$galaxy        = $_GET['galaxy'];
		$system        = $_GET['system'];
	}
	else
	{
		$galaxy        = 1;
		$system        = 1;
	}

	$planetcount = 0;
	$lunacount   = 0;

	$page  = $ClassShowGalaxy->InsertGalaxyScripts ($CurrentPlanet);
	$page .= "<body onUnload=\"\"><div id=\"content\">";
	$page .= $ClassShowGalaxy->ShowGalaxySelector ($galaxy, $system);

	if ($mode == 2)
		$page .= $ClassShowGalaxy->ShowGalaxyMISelector ($galaxy, $system, $planet, $_GET['current'], $CurrentMIP);

	$page .= "<table width=569>";
	$page .= $ClassShowGalaxy->ShowGalaxyTitles ($galaxy, $system);
	$page .= $ClassShowGalaxy->ShowGalaxyRows   ($galaxy, $system, $HavePhalanx, $CurrentGalaxy, $CurrentSystem, $CurrentRC, $CurrentMIP);
	$page .= $ClassShowGalaxy->ShowGalaxyFooter ($galaxy, $system,  $CurrentMIP, $CurrentRC, $CurrentSP, $maxfleet_count, $fleetmax);
	$page .= "</table></div>";

	return display($page, false);
}
?>