<?php

/**
* buildings.php
*
* @version 2.0
* @copyright 2008 by Chlorel for XNova
* Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
*
*/

define('INSIDE'  , true);
define('INSTALL' , false);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);
include($xgp_root . 'includes/funciones_A/HandleTechnologieBuild.' . $phpEx);

includeLang('buildings');

UpdatePlanetBatimentQueueList ( $planetrow, $user );

$IsWorking = HandleTechnologieBuild ( $planetrow, $user );

switch ($_GET['mode'])
{
	case 'fleet':
		include($xgp_root . 'includes/funciones_A/FleetBuildingPage.' . $phpEx);
		FleetBuildingPage ( $planetrow, $user );
	break;

	case 'research':
		include($xgp_root . 'includes/funciones_A/ResearchBuildingPage.' . $phpEx);
		ResearchBuildingPage ( $planetrow, $user, $IsWorking['OnWork'], $IsWorking['WorkOn'] );
	break;

	case 'defense':
		include($xgp_root . 'includes/funciones_A/DefensesBuildingPage.' . $phpEx);
		DefensesBuildingPage ( $planetrow, $user );
	break;

	default:
		include($xgp_root . 'includes/funciones_A/BatimentBuildingPage.' . $phpEx);
		BatimentBuildingPage ( $planetrow, $user );
	break;
}

?>
