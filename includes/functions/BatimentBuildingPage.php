<?php

/**
 * BatimentBuildingPage.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

function BatimentBuildingPage (&$CurrentPlanet, $CurrentUser) {
global $ProdGrid,$lang, $resource, $reslist, $phpEx, $dpath, $game_config, $_GET;

	CheckPlanetUsedFields ( $CurrentPlanet );
	// ARRAYS CON LOS EDIFICIOS POSIBLES || MISMA ESTUPIDEZ Q EN EL OGAME ORIGINAL, ALMACENES EN UNA LUNA :S
	$Allowed['1'] = array(  1,  2,  3,  4, 12, 14, 15, 21, 22, 23, 24, 31, 33, 34, 35, 44, 45);
	$Allowed['3'] = array( 12, 14, 21, 22, 23, 24, 34, 41, 42, 43);

	if (isset($_GET['cmd']))
	{
		$bDoItNow 	= false;
		$TheCommand = $_GET['cmd'];
		$Element 	= $_GET['building'];
		$ListID 	= $_GET['listid'];

		if( isset ( $Element ))
		{
			if ( !strchr ( $Element, ",") && !strchr ( $Element, " ") &&
				 !strchr ( $Element, "+") && !strchr ( $Element, "*") &&
				 !strchr ( $Element, "~") && !strchr ( $Element, "=") &&
				 !strchr ( $Element, ";") && !strchr ( $Element, "'") &&
				 !strchr ( $Element, "#") && !strchr ( $Element, "-") &&
				 !strchr ( $Element, "_") && !strchr ( $Element, "[") &&
				 !strchr ( $Element, "]") && !strchr ( $Element, ".") &&
				 !strchr ( $Element, ":"))
			{
				if (in_array( trim($Element), $Allowed[$CurrentPlanet['planet_type']]))
				{
					$bDoItNow = true;
				}
			}
			else// ESTO REEMPLAZA A TODAS LAS LINEAS QUE HACIAN UN BAN AUTOMATICO Y BLA BLA BLA...
			{
				header("location:buildings.php");
			}
		}
		elseif ( isset ( $ListID ))
		{
			$bDoItNow = true;
		}

		if ($bDoItNow == true)
		{
			switch($TheCommand)
			{
				case 'cancel':
					CancelBuildingFromQueue ( $CurrentPlanet, $CurrentUser );
				break;
				case 'remove':
					RemoveBuildingFromQueue ( $CurrentPlanet, $CurrentUser, $ListID );
				break;
				case 'insert':
					AddBuildingToQueue ( $CurrentPlanet, $CurrentUser, $Element, true );
				break;
				case 'destroy':
					AddBuildingToQueue ( $CurrentPlanet, $CurrentUser, $Element, false );
				break;
			}
		}
	}

	SetNextQueueElementOnTop($CurrentPlanet, $CurrentUser);
	$Queue = ShowBuildingQueue($CurrentPlanet, $CurrentUser);
	BuildingSavePlanetRecord($CurrentPlanet);
	BuildingSaveUserRecord($CurrentUser);

	if ($Queue['lenght'] < (MAX_BUILDING_QUEUE_SIZE))
	{
		$CanBuildElement = true;
	}
	else
	{
		$CanBuildElement = false;
	}

	$SubTemplate         = gettemplate('buildings/buildings_builds_row');
	$BuildingPage        = "";
	$zaehler         	 = 1;

	foreach($lang['tech'] as $Element => $ElementName)
	{
		if (in_array($Element, $Allowed[$CurrentPlanet['planet_type']]))
		{
			$CurrentMaxFields      = CalculateMaxPlanetFields($CurrentPlanet);
			if ($CurrentPlanet["field_current"] < ($CurrentMaxFields - $Queue['lenght']))
			{
				$RoomIsOk = true;
			}
			else
			{
				$RoomIsOk = false;
			}

			if (IsTechnologieAccessible($CurrentUser, $CurrentPlanet, $Element))
			{
				if ($zaehler == 1 || $zaehler % 3 == 1)
				{
					$parse['tropen'] = '<tr>';
				}
				else
				{
					$parse['tropen'] = '';
				}
				$HaveRessources        = IsElementBuyable ($CurrentUser, $CurrentPlanet, $Element, true, false);
				$parse                 = array();
				$parse['dpath']        = $dpath;
				$parse['i']            = $Element;
				$BuildingLevel         = $CurrentPlanet[$resource[$Element]];
				$parse['nivel']        = ($BuildingLevel == 0) ? "" : " (Nivel ". $BuildingLevel .")";
				$parse['n']            = $ElementName;
				$parse['descriptions'] = $lang['res']['descriptions'][$Element];
				$ElementBuildTime      = GetBuildingTime($CurrentUser, $CurrentPlanet, $Element);
				$parse['time']         = ShowBuildTime($ElementBuildTime);
				$parse['price']        = GetElementPrice($CurrentUser, $CurrentPlanet, $Element);
				$parse['click']        = '';
				$NextBuildLevel        = $CurrentPlanet[$resource[$Element]] + 1;

				if ($Element == 31)
				{
					if ($CurrentUser["b_tech_planet"] != 0 && $game_config['BuildLabWhileRun'] != 1)
					{
						$parse['click'] = "<font color=#FF0000>Trabajando</font>";
					}
				}
				if($parse['click'] != '')
				{
				//ESPACIO AL PEDO :S NI GANAS DE ELIMINARLO....
				}
				elseif ($RoomIsOk && $CanBuildElement)
				{
					if ($Queue['lenght'] == 0)
					{
						if ($NextBuildLevel == 1)
						{
							if ( $HaveRessources == true )
								$parse['click'] = "<a href=\"?cmd=insert&building=". $Element ."\"><font color=#00FF00>Construir</font></a>";
							else
								$parse['click'] = "<font color=#FF0000>Construir</font>";
						}
						else
						{
							if ( $HaveRessources == true )
								$parse['click'] = "<a href=\"?cmd=insert&building=". $Element ."\"><font color=#00FF00>Construir nivel ". $NextBuildLevel ."</font></a>";
							else
								$parse['click'] = "<font color=#FF0000>Construir nivel ". $NextBuildLevel ."</font>";
						}
					}
					else
					{
						$parse['click'] = "<a href=\"?cmd=insert&building=". $Element ."\"><font color=#00FF00>Agregar a la lista</font></a>";
					}
				}
				elseif ($RoomIsOk && !$CanBuildElement)
				{
					if ($NextBuildLevel == 1)
						$parse['click'] = "<font color=#FF0000>Construir</font>";
					else
						$parse['click'] = "<font color=#FF0000>Construir nivel ". $NextBuildLevel ."</font>";
				}
				else
					$parse['click'] = "<font color=#FF0000>No hay espacio en el planeta</font>";

				if ($zaehler % 5 == 0)
				{
					$parse['trclose'] = '</tr>';
					$zaehler++;
				}
				else
				{
					$parse['trclose'] = '';
					$zaehler++;
				}

				$BuildingPage .= parsetemplate($SubTemplate, $parse);
			}
		}
	}

	$parse                         = $lang;
	if ($Queue['lenght'] > 0)
	{
		$parse['BuildListScript']  = InsertBuildListScript ( "buildings" );
		$parse['BuildList']        = $Queue['buildlist'];
	}
	else
	{
		$parse['BuildListScript']  = "";
		$parse['BuildList']        = "";
	}
	$parse['planet_field_current'] = $CurrentPlanet["field_current"];
	$parse['planet_field_max']     = $CurrentPlanet['field_max'] + ($CurrentPlanet[$resource[33]] * FIELDS_BY_TERRAFORMER) + ($CurrentPlanet[$resource[45]] * FIELDS_BY_S_TERRAFORMER);
	$parse['field_libre']          = $parse['planet_field_max']  - $CurrentPlanet['field_current'];
	$parse['BuildingsList']        = $BuildingPage;

	display(parsetemplate(gettemplate('buildings/buildings_builds'), $parse), "Edificios");
}
?>