<?php

/**
 * galaxy.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);
include($xnova_root_path . 'includes/funciones_A/InsertGalaxyScripts.' . $phpEx);
include($xnova_root_path . 'includes/funciones_A/ShowGalaxyFooter.'.$phpEx);
include($xnova_root_path . 'includes/funciones_A/ShowGalaxyMISelector.'.$phpEx);
include($xnova_root_path . 'includes/funciones_A/ShowGalaxyRows.'.$phpEx);
include($xnova_root_path . 'includes/funciones_A/ShowGalaxySelector.'.$phpEx);
include($xnova_root_path . 'includes/funciones_A/ShowGalaxyTitles.'.$phpEx);

$CurrentPlanet 	= doquery("SELECT * FROM {{table}} WHERE `id` = '". $user['current_planet'] ."';", 'planets', true);
$lunarow       	= doquery("SELECT * FROM {{table}} WHERE `id` = '". $user['current_luna'] ."';", 'lunas', true);

$dpath         	= (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
$fleetmax      	= $user['computer_tech'] + 1;
$CurrentPlID   	= $CurrentPlanet['id'];
$CurrentMIP    	= $CurrentPlanet['interplanetary_misil'];
$CurrentRC     	= $CurrentPlanet['recycler'];
$CurrentSP     	= $CurrentPlanet['spy_sonde'];
$HavePhalanx   	= $CurrentPlanet['phalanx'];
$CurrentSystem 	= $CurrentPlanet['system'];
$CurrentGalaxy 	= $CurrentPlanet['galaxy'];
$CanDestroy    	= $CurrentPlanet[$resource[213]] + $CurrentPlanet[$resource[214]];
$UserDeuterium 	= $CurrentPlanet['deuterium'] - 10;

$maxfleet       = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '". $user['id'] ."';", 'fleets');
$maxfleet_count = mysql_num_rows($maxfleet);

CheckPlanetUsedFields($CurrentPlanet);


if ($UserDeuterium < 1)
	die (message("¡No hay suficiente deuterio!","Error","overview.php",2));


$QryGalaxyDeuterium   = "UPDATE {{table}} SET ";
$QryGalaxyDeuterium  .= "`deuterium` = '". $UserDeuterium ."' ";
$QryGalaxyDeuterium  .= "WHERE ";
$QryGalaxyDeuterium  .= "`id` = '". $CurrentPlanet['id'] ."' ";
$QryGalaxyDeuterium  .= "LIMIT 1;";
doquery( $QryGalaxyDeuterium, 'planets');

CheckPlanetUsedFields($lunarow);

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

$page  = InsertGalaxyScripts ( $CurrentPlanet );

$page .= "<body style=\"overflow: auto;\" onUnload=\"\"><br><br>";
$page .= ShowGalaxySelector ( $galaxy, $system );

if ($mode == 2)
{
	$CurrentPlanetID = $_GET['current'];
	$page .= ShowGalaxyMISelector ( $galaxy, $system, $planet, $CurrentPlanetID, $CurrentMIP );
}

$page .= "<table width=569><tbody>";

$page .= ShowGalaxyTitles ( $galaxy, $system );
$page .= ShowGalaxyRows   ( $galaxy, $system );
$page .= ShowGalaxyFooter ( $galaxy, $system,  $CurrentMIP, $CurrentRC, $CurrentSP);

$page .= "</tbody></table></div>";

display ($page, "Galaxia", false, '', false);
?>