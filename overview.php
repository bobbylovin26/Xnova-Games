<?php

/**
 * overview.php
 *
 * @version 2.0
 * @copyright 2008 By lucky for XG Proyect
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);
include($xnova_root_path . 'includes/functions/BuildFleetEventTable.' . $phpEx);
include($xnova_root_path . 'includes/functions/CheckInputStrings.' . $phpEx);
include($xnova_root_path . 'includes/functions/InsertBuildListScript.' . $phpEx);
include($xnova_root_path . 'includes/functions/InsertJavaScriptChronoApplet.' . $phpEx);
include($xnova_root_path . 'includes/functions/CheckPlanetBuildingQueue.' . $phpEx);
include($xnova_root_path . 'includes/functions/SetNextQueueElementOnTop.' . $phpEx);
include($xnova_root_path . 'includes/functions/GetElementPrice.'.$phpEx);
include($xnova_root_path . 'includes/functions/GetBuildingPrice.'.$phpEx);
include($xnova_root_path . 'includes/functions/IsElementBuyable.'.$phpEx);
include($xnova_root_path . 'includes/functions/AddBuildingToQueue.'.$phpEx);

$lunarow 			= doquery("SELECT * FROM {{table}} WHERE `id_owner` = '" . $planetrow['id_owner'] . "' AND `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `lunapos` = '" . $planetrow['planet'] . "';", 'lunas', true);
CheckPlanetUsedFields($lunarow);

$parse['planet_id'] 	= $planetrow['id'];
$parse['planet_name'] 	= $planetrow['name'];
$parse['galaxy_galaxy'] = $planetrow['galaxy'];
$parse['galaxy_system'] = $planetrow['system'];
$parse['galaxy_planet'] = $planetrow['planet'];

switch ($_GET['mode'])
{
	case 'renameplanet':

		if ($_POST['action'] == "Nombrar")
		{
			$newname        = mysql_escape_string(strip_tags(trim($_POST['newname'])));

			if (preg_match("/[^A-z0-9_\- ]/", $newname) == 1)
			{
				message('Has introducido alg&#250n caracter ilegal. S&#243;lo puedes introducir caracteres alfanum&#233;ricos.','&#161;Error!', "overview.php?mode=renameplanet",2);
			}
			if ($newname != "")
			{
				doquery("UPDATE {{table}} SET `name` = '" . $newname . "' WHERE `id` = '" . $user['current_planet'] . "' LIMIT 1;", "planets");

				if ($planetrow['planet_type'] == 3)
				{
					doquery("UPDATE {{table}} SET `name` = '" . $newname . "' WHERE `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `lunapos` = '" . $planetrow['planet'] . "' LIMIT 1;", "lunas");
				}
			}
		}
		elseif ($_POST['action'] == "Abandonar colonia")
		{
			display(parsetemplate(gettemplate('overview/overview_deleteplanet'), $parse), "Abandonar planetas");
		}
		elseif ($_POST['kolonieloeschen'] == 1 && intval($_POST['deleteid']) == $user['current_planet'])
		{
			if (md5($_POST['pw']) == $user["password"] && $user['id_planet'] != $user['current_planet'])
			{

				doquery("DELETE FROM {{table}} WHERE `id` = '".mysql_real_escape_string($user['current_planet'])."' LIMIT 1;" , 'planets');
				doquery("DELETE FROM {{table}} WHERE `id_planet` = '".mysql_real_escape_string($user['current_planet'])."' LIMIT 1;" , 'galaxy');
				doquery("UPDATE {{table}} SET `current_planet` = `id_planet` WHERE `id` = '". mysql_real_escape_string($user['id']) ."' LIMIT 1", "users");
                doquery("DELETE FROM {{table}} WHERE `galaxy` = '". $planetrow['galaxy'] ."' AND `system` = '". $planetrow['system'] ."' AND `planet` = '". $planetrow['planet'] ."' AND `planet_type` = 3;", 'planets');
                doquery("DELETE FROM {{table}} WHERE `galaxy` = '". $planetrow['galaxy'] ."' AND `system` = '". $planetrow['system'] ."' AND `lunapos` = '". $planetrow['planet'] ."';", 'lunas');

				message("Planeta abandonado con &#233;xito." , "&#161;Listo!", 'overview.php?mode=renameplanet');
			}
			elseif ($user['id_planet'] == $user["current_planet"])
			{
				message("El planeta principal no puede ser abandonado.", "¡Error!", 'overview.php?mode=renameplanet');
			}
			else
			{
				message("Contraseña incorrecta, vuelve a ingresarla." , "¡Error!", 'overview.php?mode=renameplanet');
			}
		}

		display(parsetemplate(gettemplate('overview/overview_renameplanet'), $parse), "Renombrar planetas");
	break;

	default:
		if ($user['id'] != '')
		{
			$mensajes	= doquery ("SELECT * FROM {{table}} WHERE `message_owner`='" . $user['id'] . " ' AND `leido`='1' ", "messages",true);
			$mensajes2	= doquery ("SELECT * FROM {{table}} WHERE `message_owner`='" . $user['id'] . "' AND `leido`='1'", "messages");

			$Have_new_message = "";
			if ($mensajes['leido'] != 0)
			{
				$Have_new_message .= "<tr>";
				$Have_new_message .= "<th colspan=4><a href=messages.$phpEx>";
				$m = pretty_number(mysql_num_rows($mensajes2));
				$Have_new_message .= str_replace('%m', $m, "Tienes %m nuevo/s mensaje/s");
				$Have_new_message .= "</a></th>";
				$Have_new_message .= "</tr>";
			}

			$XpMinierUp 	= $user['lvl_minier'] * 5000;
			$XpRaidUp 		= $user['lvl_raid'] * 10;
			$XpMinier 		= $user['xpminier'];
			$XPRaid 		= $user['xpraid'];
			$LvlUpMinier 	= $user['lvl_minier'] + 1;
			$LvlUpRaid 		= $user['lvl_raid'] + 1;

			if (($LvlUpMinier + $LvlUpRaid) <= 100)
			{
				if ($XpMinier >= $XpMinierUp)
				{
					$QryUpdateUser  = "UPDATE {{table}} SET ";
					$QryUpdateUser .= "`lvl_minier` = '" . $LvlUpMinier . "'";
					$QryUpdateUser .= "WHERE ";
					$QryUpdateUser .= "`id` = '" . $user['id'] . "';";
					doquery($QryUpdateUser, 'users');
					$HaveNewLevelMineur  = "<tr>";
					$HaveNewLevelMineur .= "<th colspan=\"4\">Ganaste un nuevo nivel de minero.</th></tr>";
				}
				if ($XPRaid >= $XpRaidUp)
				{
					$QryUpdateUser  = "UPDATE {{table}} SET ";
					$QryUpdateUser .= "`lvl_raid` = '" . $LvlUpRaid . "'";
					$QryUpdateUser .= "WHERE ";
					$QryUpdateUser .= "`id` = '" . $user['id'] . "';";
					doquery($QryUpdateUser, 'users');
					$HaveNewLevelMineur  = "<tr>";
					$HaveNewLevelMineur .= "<th colspan=\"4\">Ganaste un nuevo nivel de guerrero.</th></tr>";
				}
			}

			$OwnFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets');

			$Record = 0;

			while ($FleetRow = mysql_fetch_array($OwnFleets))
			{
				$Record++;

				$StartTime 	= $FleetRow['fleet_start_time'];
				$StayTime 	= $FleetRow['fleet_end_stay'];
				$EndTime 	= $FleetRow['fleet_end_time'];

				$Label = "fs";
				if ($StartTime > time())
				{
					$fpage[$StartTime] = BuildFleetEventTable ($FleetRow, 0, true, $Label, $Record);
				}

				if(($FleetRow['fleet_mission'] <> 4) && ($FleetRow['fleet_mission'] <> 10))
				{
					$Label = "ft";

					if ($StayTime > time())
					{
						$fpage[$StayTime] = BuildFleetEventTable ($FleetRow, 1, true, $Label, $Record);
					}
					$Label = "fe";

					if ($EndTime > time())
					{
						$fpage[$EndTime] = BuildFleetEventTable ($FleetRow, 2, true, $Label, $Record);
					}
				}
			}

			$OtherFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_target_owner` = '" . $user['id'] . "';", 'fleets');

			$Record = 2000;
			while ($FleetRow = mysql_fetch_array($OtherFleets))
			{
				if ($FleetRow['fleet_owner'] != $user['id'])
				{
					if ($FleetRow['fleet_mission'] != 8)
					{
						$Record++;
						$StartTime = $FleetRow['fleet_start_time'];
						$StayTime = $FleetRow['fleet_end_stay'];

						if ($StartTime > time())
						{
							$Label = "ofs";
							$fpage[$StartTime] = BuildFleetEventTable ($FleetRow, 0, false, $Label, $Record);
						}
						if ($FleetRow['fleet_mission'] == 5)
						{
							$Label = "oft";
							if ($StayTime > time())
							{
								$fpage[$StayTime] = BuildFleetEventTable ($FleetRow, 1, false, $Label, $Record);
							}
						}
					}
				}
			}

			$planets_query = doquery("SELECT * FROM {{table}} WHERE id_owner='{$user['id']}'", "planets");
			$Colone  = 1;
			$Coloneshow = 0;
			$AllPlanets = "<tr style=\"background-color: transparent;\">";
			while ($UserPlanet = mysql_fetch_array($planets_query))
			{
				if ($UserPlanet["id"] != $user["current_planet"] && $UserPlanet['planet_type'] != 3)
				{
					$Coloneshow++;
					$AllPlanets .= "<th style=\"background-color: transparent;\">". $UserPlanet['name'] ."<br>";
					$AllPlanets .= "<a href=\"?cp=". $UserPlanet['id'] ."&re=0\" title=\"". $UserPlanet['name'] ."\"><img src=\"". $dpath ."planeten/small/s_". $UserPlanet['image'] .".jpg\" height=\"50\" width=\"50\"></a><br>";
					$AllPlanets .= "<center>";

					if ($UserPlanet['b_building'] != 0)
					{
						UpdatePlanetBatimentQueueList ( $UserPlanet, $user );
						if ( $UserPlanet['b_building'] != 0 )
						{
							$BuildQueue      = $UserPlanet['b_building_id'];
							$QueueArray      = explode ( ";", $BuildQueue );
							$CurrentBuild    = explode ( ",", $QueueArray[0] );
							$BuildElement    = $CurrentBuild[0];
							$BuildLevel      = $CurrentBuild[1];
							$BuildRestTime   = pretty_time( $CurrentBuild[3] - time() );
							$AllPlanets     .= '' . $lang['tech'][$BuildElement] . ' (' . $BuildLevel . ')';
							$AllPlanets     .= "<br><font color=\"#7f7f7f\">(". $BuildRestTime .")</font>";
						}
						else
						{
						CheckPlanetUsedFields ($UserPlanet);
						$AllPlanets     .= "Libre";
						}
					}
					else
					{
						$AllPlanets    .= "Libre";
					}

					$AllPlanets .= "</center></th>";

					if ($Coloneshow > 4)
					{
						$AllPlanets .= "</tr><tr>";
						$Coloneshow =0;
					}
				}
			}

			$AllPlanets .= "</tr>";

			if ($game_config['OverviewNewsFrame'] == '1')
			{
				$parse['NewsFrame'] = "<tr><th>Noticias</th><th colspan=\"3\">" . stripslashes($game_config['OverviewNewsText']) . "</th></tr>";
			}

			if ($lunarow['id'] <> 0)
			{
				if ($planetrow['planet_type'] == 1 or $lunarow['id'] <> 0)
				{
					$lune = doquery ("SELECT * FROM {{table}} WHERE `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `planet` = '" . $planetrow['planet'] . "' AND `planet_type` = '3'", 'planets', true);
					$parse['moon_img'] = "<a href=\"?cp=" . $lune['id'] . "&re=0\" title=\"" . $lune['name'] . "\"><img src=\"" . $dpath . "planeten/" . $lune['image'] . ".jpg\" height=\"50\" width=\"50\"></a>";
					$parse['moon'] = $lune['name'];
				}
				else
				{
					$parse['moon_img'] = "";
					$parse['moon'] = "";
				}
			}
			else
			{
				$parse['moon_img'] = "";
				$parse['moon'] = "";
			}

			$parse['planet_diameter'] 		= pretty_number($planetrow['diameter']);
			$parse['planet_field_current']  = $planetrow['field_current'];
			$parse['planet_field_max'] 		= CalculateMaxPlanetFields($planetrow);
			$parse['planet_temp_min'] 		= $planetrow['temp_min'];
			$parse['planet_temp_max'] 		= $planetrow['temp_max'];

			$StatRecord = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);

			$parse['user_points'] 		   = pretty_number($StatRecord['build_points']);
			$parse['user_fleet']		   = pretty_number($StatRecord['fleet_points']);
			$parse['player_points_tech']   = pretty_number($StatRecord['tech_points']);
			$parse['user_defs']            = pretty_number($StatRecord['defs_points']);
			$parse['total_points'] 		   = pretty_number($StatRecord['total_points']);;
			$parse['user_rank'] 		   = $StatRecord['total_rank'];

			$ile = $StatRecord['total_old_rank'] - $StatRecord['total_rank'];

			if ($ile >= 1)
			{
				$parse['ile'] = "<font color=\"lime\">+" . $ile . "</font>";
			}
			elseif ($ile < 0)
			{
				$parse['ile'] = "<font color=\"red\">-" . $ile . "</font>";
			}
			elseif ($ile == 0)
			{
				$parse['ile'] = "<font color=\"lightblue\">" . $ile . "</font>";
			}

			$parse['u_user_rank'] 	= $StatRecord['total_rank'];
			$parse['user_username'] = $user['username'];

			if (count($fpage) > 0)
			{
				ksort($fpage);
				foreach ($fpage as $time => $content)
				{
					$flotten .= $content . "\n";
				}
			}

			if ($planetrow['b_building'] != 0)
			{
				UpdatePlanetBatimentQueueList ($planetrow, $user);

				$BuildQueue  		 = explode (";", $planetrow['b_building_id']);
				$CurrBuild 	 		 = explode (",", $BuildQueue[0]);
				$RestTime 	 		 = $planetrow['b_building'] - time();
				$PlanetID 	 		 = $planetrow['id'];
				$Build 		 		 = InsertBuildListScript ("overview");
				$Build 	   			.= $lang['tech'][$CurrBuild[0]] . ' (' . ($CurrBuild[1]) . ')';
				$Build 				.= "<br /><div id=\"blc\" class=\"z\">" . pretty_time($RestTime) . "</div>";
				$Build 				.= "\n<script language=\"JavaScript\">";
				$Build 				.= "\n	pp = \"" . $RestTime . "\";\n";
				$Build 				.= "\n	pk = \"" . 1 . "\";\n";
				$Build 				.= "\n	pm = \"cancel\";\n";
				$Build 				.= "\n	pl = \"" . $PlanetID . "\";\n";
				$Build 				.= "\n	t();\n";
				$Build 				.= "\n</script>\n";
				$parse['building'] 	 = $Build;
			}
			else
			{
				$parse['building'] = "Libre";
			}

			$parse['case_pourcentage'] 	= floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) . "%";
			$parse['case_barre'] 		= floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) * 4.0;

			if ($parse['case_barre'] > (100 * 4.0))
			{
				$parse['case_barre'] = 400;
				$parse['case_barre_barcolor'] = '#C00000';
			}
			elseif ($parse['case_barre'] > (80 * 4.0))
			{
				$parse['case_barre_barcolor'] = '#C0C000';
			}
			else
			{
				$parse['case_barre_barcolor'] = '#00C000';
			}

			$parse['fleet_list']  			= $flotten;
			$parse['energy_used'] 			= $planetrow["energy_max"] - $planetrow["energy_used"];
			$parse['Have_new_message'] 		= $Have_new_message;
			$parse['Have_new_level_mineur'] = $HaveNewLevelMineur;
			$parse['Have_new_level_raid'] 	= $HaveNewLevelRaid;
			$parse['planet_image'] 			= $planetrow['image'];
			$parse['anothers_planets'] 		= $AllPlanets;
			$parse["dpath"] 				= $dpath;
			if($user['authlevel'] == 0)
				$parse['max_users'] 		= " de ".$game_config['users_amount'];
			else
				$parse['max_users'] 		= "-";
			$parse['metal_debris'] 			= pretty_number($galaxyrow['metal']);
			$parse['crystal_debris'] 		= pretty_number($galaxyrow['crystal']);
			$parse['xpminier'] 				= $user['xpminier'];
			$parse['xpraid'] 				= $user['xpraid'];
			$parse['lvl_minier'] 			= $user['lvl_minier'];
			$parse['lvl_raid'] 				= $user['lvl_raid'];
			$LvlMinier 						= $user['lvl_minier'];
			$LvlRaid 						= $user['lvl_raid'];
			$parse['lvl_up_minier'] 		= $LvlMinier * 5000;
			$parse['lvl_up_raid'] 			= $LvlRaid * 10;

			display(parsetemplate(gettemplate('overview/overview_body'), $parse), "Visi&#243;n general");
		}
	break;
}
?>