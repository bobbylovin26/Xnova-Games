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

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);
include($xnova_root_path . 'includes/functions/InsertBuildListScript.' . $phpEx);
include($xnova_root_path . 'includes/functions/CheckPlanetBuildingQueue.' . $phpEx);
include($xnova_root_path . 'includes/functions/SetNextQueueElementOnTop.' . $phpEx);
include($xnova_root_path . 'includes/functions/BatimentBuildingPage.' . $phpEx);
include($xnova_root_path . 'includes/functions/DefensesBuildingPage.'.$phpEx);
include($xnova_root_path . 'includes/functions/FleetBuildingPage.'.$phpEx);
include($xnova_root_path . 'includes/functions/ResearchBuildingPage.'.$phpEx);
include($xnova_root_path . 'includes/functions/GetElementPrice.'.$phpEx);
include($xnova_root_path . 'includes/functions/GetBuildingPrice.'.$phpEx);
include($xnova_root_path . 'includes/functions/HandleTechnologieBuild.'.$phpEx);
include($xnova_root_path . 'includes/functions/IsElementBuyable.'.$phpEx);
include($xnova_root_path . 'includes/functions/IsTechnologieAccessible.'.$phpEx);
include($xnova_root_path . 'includes/functions/AddBuildingToQueue.'.$phpEx);
include($xnova_root_path . 'includes/functions/BuildingSavePlanetRecord.'.$phpEx);
include($xnova_root_path . 'includes/functions/BuildingSaveUserRecord.'.$phpEx);
include($xnova_root_path . 'includes/functions/CancelBuildingFromQueue.'.$phpEx);
include($xnova_root_path . 'includes/functions/RemoveBuildingFromQueue.'.$phpEx);
include($xnova_root_path . 'includes/functions/ShowBuildingQueue.'.$phpEx);
include($xnova_root_path . 'includes/functions/ElementBuildListBox.'.$phpEx);
include($xnova_root_path . 'includes/functions/GetElementRessources.'.$phpEx);
include($xnova_root_path . 'includes/functions/GetMaxConstructibleElements.'.$phpEx);
include($xnova_root_path . 'includes/functions/CheckLabSettingsInQueue.'.$phpEx);
include($xnova_root_path . 'includes/functions/GetRestPrice.'.$phpEx);

includeLang('buildings');

UpdatePlanetBatimentQueueList ( $planetrow, $user );

$IsWorking = HandleTechnologieBuild ( $planetrow, $user );

switch ($_GET['mode'])
{
	case 'fleet':
		FleetBuildingPage ( $planetrow, $user );
	break;

	case 'research':
		ResearchBuildingPage ( $planetrow, $user, $IsWorking['OnWork'], $IsWorking['WorkOn'] );
	break;

	case 'defense':
		DefensesBuildingPage ( $planetrow, $user );
	break;

	default:
		BatimentBuildingPage ( $planetrow, $user );
	break;
}

?>
