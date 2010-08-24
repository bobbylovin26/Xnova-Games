<?php

/**
 * overview.php
 *
 * @version 2.1
 * @copyright 2008 By lucky for XG Proyect
 * @Copyright, XNova Proyect - Xtreme-gameZ.com.ar - XG Proyect
 */

define('INSIDE' , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);
/**
$Tiempo    = time();
$resto = $Tiempo - $game_config['Actualizacion'];
$proxactu = 30; //Son segundos 30 = 30 Segundos , es el tiempo que tarda en actualizar
if($resto > $proxactu) { include("actualiza.php");   }
*/

$lunarow = doquery("SELECT * FROM {{table}} WHERE `id_owner` = '" . $planetrow['id_owner'] . "' AND `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `lunapos` = '" . $planetrow['planet'] . "';", 'lunas', true);

CheckPlanetUsedFields ($lunarow);

$mode = $_GET['mode'];
$pl = mysql_escape_string($_GET['pl']);
$_POST['deleteid'] = intval($_POST['deleteid']);

includeLang('resources');
includeLang('overview');

if($game_config['enable_bot'] == 1){
	//robot anti multi -- debut --
$multi = $user['multi_validated'];
$ip = $user['user_lastip'];
$time = time();
$duree = $time + (stripslashes($game_config['ban_duration']) * 86400);
$op = stripslashes($game_config['bot_name']);
$mail = stripslashes($game_config['bot_adress']);
$sql = mysql_query("SELECT * FROM game_users WHERE `user_lastip`='{$ip}'");
$boucle = 0;
$username ='';
$v =',&nbsp;';
   while($m = mysql_fetch_array($sql)){
      $username .= $m['username'] . $v;
      $boucle ++;
            }
if($boucle > 1 && $multi == 0){
$ip = $user['user_lastip'];
$sql = mysql_query("SELECT * FROM game_users WHERE `user_lastip`='{$ip}'");
          while($b = mysql_fetch_array($sql)){
      $QryBanMulti = "INSERT INTO {{table}} SET ";
        $QryBanMulti .= "`who` = '" . mysql_escape_string(strip_tags($user['username'])) . "', ";
        $QryBanMulti .= "`who2` = '" . mysql_escape_string(strip_tags($user['username'])) . "', ";
        $QryBanMulti .= "`theme` = 'Multi-Compte entre " . mysql_escape_string($username) . "', ";
        $QryBanMulti .= "`time` = '" . $time . "', ";
		$QryBanMulti .= "`longer` = '" . $duree . "', ";
		$QryBanMulti .= "`author` = '" . $op . "', ";
		$QryBanMulti .= "`email`='" . $mail . "';";
        doquery($QryBanMulti, 'banned');
		doquery("UPDATE {{table}} SET bana=1 WHERE username='{$user['username']}'","users");
   doquery("UPDATE {{table}} SET banaday='{$duree}' WHERE username='{$user['username']}'","users");
         }

      }
//robot anti multi -- FIN --
} else {}
switch ($mode) {
case 'renameplanet':
         // -----------------------------------------------------------------------------------------------
         if ($_POST['action'] == $lang['namer']) {
            // Reponse au changement de nom de la planete
            $UserPlanet     = CheckInputStrings ( $_POST['newname'] );
            $newname        = mysql_escape_string(strip_tags(trim( $UserPlanet )));
               if (preg_match("/[^A-z0-9_\- ]/", $newname) == 1) {
               message('Has introducido alg&uacute;n car&aacute;cter ilegal. Solo se puede introducir caracteres alfanum&eacute;ricos.','Error', "overview.php?mode=renameplanet");
               }
            if ($newname != "") {

                $planetrow['name'] = $newname;

                doquery("UPDATE {{table}} SET `name` = '" . $newname . "' WHERE `id` = '" . $user['current_planet'] . "' LIMIT 1;", "planets");

                if ($planetrow['planet_type'] == 3) {

                    doquery("UPDATE {{table}} SET `name` = '" . $newname . "' WHERE `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `lunapos` = '" . $planetrow['planet'] . "' LIMIT 1;", "lunas");
                }
            }
        } elseif ($_POST['action'] == $lang['colony_abandon']) {

            $parse = $lang;
            $parse['planet_id'] = $planetrow['id'];
            $parse['galaxy_galaxy'] = $planetrow['galaxy'];
            $parse['galaxy_system'] = $planetrow['system'];
            $parse['galaxy_planet'] = $planetrow['planet'];
            $parse['planet_name'] = $planetrow['name'];

            $page .= parsetemplate(gettemplate('overview_deleteplanet'), $parse);

            display($page, $lang['rename_and_abandon_planet']);
        } elseif ($_POST['kolonieloeschen'] == 1 && $_POST['deleteid'] == $user['current_planet']) {

if (md5($_POST['pw']) == $user["password"] && $user['id_planet'] != $user['current_planet']) {

                    $QryUpdatePlanet  = "DELETE FROM {{table}} ";
                    $QryUpdatePlanet .= "WHERE ";
                    $QryUpdatePlanet .= "`id` = '".mysql_real_escape_string($user['current_planet'])."' LIMIT 1;";
                    doquery( $QryUpdatePlanet , 'planets');
                    
                    $QryUpdatePlanet2  = "DELETE FROM {{table}} ";
                    $QryUpdatePlanet2 .= "WHERE ";
                    $QryUpdatePlanet2 .= "`id_planet` = '".mysql_real_escape_string($user['current_planet'])."' LIMIT 1;";
                    doquery( $QryUpdatePlanet2 , 'galaxy');

					$QryUpdateUser    = "UPDATE {{table}} SET ";
					$QryUpdateUser   .= "`current_planet` = `id_planet` ";
					$QryUpdateUser   .= "WHERE ";
					$QryUpdateUser   .= "`id` = '". mysql_real_escape_string($user['id']) ."' LIMIT 1";
					doquery( $QryUpdateUser, "users");

                $QryUpdateUser = "UPDATE {{table}} SET ";
                $QryUpdateUser .= "`current_planet` = `id_planet` ";
                $QryUpdateUser .= "WHERE ";
                $QryUpdateUser .= "`id` = '" . $user['id'] . "' LIMIT 1";
                doquery($QryUpdateUser, "users");
                // Tout s'est bien passé ! La colo a été effacée !!
                message($lang['deletemessage_ok'] , $lang['colony_abandon'], 'overview.php?mode=renameplanet');
            } elseif ($user['id_planet'] == $user["current_planet"]) {
                // Et puis quoi encore ??? On ne peut pas effacer la planete mere ..
                // Uniquement les colonies crées apres coup !!!
                message($lang['deletemessage_wrong'], $lang['colony_abandon'], 'overview.php?mode=renameplanet');
            } else {
                // Erreur de saisie du mot de passe je n'efface pas !!!
                message($lang['deletemessage_fail'] , $lang['colony_abandon'], 'overview.php?mode=renameplanet');
            }
        }

        $parse = $lang;

        $parse['planet_id'] = $planetrow['id'];
        $parse['galaxy_galaxy'] = $planetrow['galaxy'];
        $parse['galaxy_system'] = $planetrow['system'];
        $parse['galaxy_planet'] = $planetrow['planet'];
        $parse['planet_name'] = $planetrow['name'];

        $page .= parsetemplate(gettemplate('overview_renameplanet'), $parse);
        // On affiche la page permettant d'abandonner OU de renomme une Colonie / Planete
        display($page, $lang['rename_and_abandon_planet']);
        break;

    default:
        if ($user['id'] != '') {
    // --- Gestion des messages ----------------------------------------------------------------------
             $mensajes= doquery ("SELECT * FROM {{table}} WHERE `message_owner`='" . $user['id'] . " ' AND `leido`='1' ", "messages",true);
    $mensajes2= doquery ("SELECT * FROM {{table}} WHERE `message_owner`='" . $user['id'] . "' AND `leido`='1'", "messages");
          // Message
          
             $Have_new_message = "";
             if ($mensajes['leido'] != 0) {
                $Have_new_message .= "<tr>";
                $Have_new_message .= "<th colspan=4><a href=messages.$phpEx>";
                $m = pretty_number(mysql_num_rows($mensajes2));
                $Have_new_message .= str_replace('%m', $m, $lang['Have_new_messages']);
                $Have_new_message .= "</a></th>";
                $Have_new_message .= "</tr>";
             }
             // -----------------------------------------------------------------------------------------------
            // --- Gestion Officiers -------------------------------------------------------------------------
            // Passage au niveau suivant, ajout du point de compétence et affichage du passage au nouveau level
            $XpMinierUp = $user['lvl_minier'] * 5000;
            $XpRaidUp = $user['lvl_raid'] * 10;
            $XpMinier = $user['xpminier'];
            $XPRaid = $user['xpraid'];

            $LvlUpMinier = $user['lvl_minier'] + 1;
            $LvlUpRaid = $user['lvl_raid'] + 1;

            if (($LvlUpMinier + $LvlUpRaid) <= 100) {
                if ($XpMinier >= $XpMinierUp) {
                    $QryUpdateUser = "UPDATE {{table}} SET ";
                    $QryUpdateUser .= "`lvl_minier` = '" . $LvlUpMinier . "'";
                    $QryUpdateUser .= "WHERE ";
                    $QryUpdateUser .= "`id` = '" . $user['id'] . "';";
                    doquery($QryUpdateUser, 'users');
                    $HaveNewLevelMineur = "<tr>";
                    $HaveNewLevelMineur .= "<th colspan=4>" . $lang['Have_new_level_mineur'] . "</th>";
                }
                if ($XPRaid >= $XpRaidUp) {
                    $QryUpdateUser = "UPDATE {{table}} SET ";
                    $QryUpdateUser .= "`lvl_raid` = '" . $LvlUpRaid . "'";
                    $QryUpdateUser .= "WHERE ";
                    $QryUpdateUser .= "`id` = '" . $user['id'] . "';";
                    doquery($QryUpdateUser, 'users');
                    $HaveNewLevelMineur = "<tr>";
                    $HaveNewLevelMineur .= "<th colspan=4>" . $lang['Have_new_level_raid'] . "</th>";
                }
            }
            // -----------------------------------------------------------------------------------------------
            // --- Gestion des flottes personnelles ---------------------------------------------------------
            // Toutes de vert vetues
            $OwnFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_owner` = '" . $user['id'] . "';", 'fleets');
            $Record = 0;
            while ($FleetRow = mysql_fetch_array($OwnFleets)) {
                $Record++;

                $StartTime = $FleetRow['fleet_start_time'];
                $StayTime = $FleetRow['fleet_end_stay'];
                $EndTime = $FleetRow['fleet_end_time'];
                // Flotte a l'aller
                $Label = "fs";
                if ($StartTime > time()) {
                    $fpage[$StartTime] = BuildFleetEventTable ($FleetRow, 0, true, $Label, $Record);
                }

                // flotas que ya llegaron a destino
                if ( ($FleetRow['fleet_mission'] <> 4) && ($FleetRow['fleet_mission'] <> 10) ) {
                    // flota estacionada
                    $Label = "ft";
                    if ($StayTime > time()) {
                        $fpage[$StayTime] = BuildFleetEventTable ($FleetRow, 1, true, $Label, $Record);
                    }
                    // flota regresando
                    $Label = "fe";
                    if ($EndTime > time()) {
                        $fpage[$EndTime] = BuildFleetEventTable ($FleetRow, 2, true, $Label, $Record);
                    }
                }
            } // End While
            // -----------------------------------------------------------------------------------------------
            // --- Gestion des flottes autres que personnelles ----------------------------------------------
            // Flotte ennemies (ou amie) mais non personnelles
            $OtherFleets = doquery("SELECT * FROM {{table}} WHERE `fleet_target_owner` = '" . $user['id'] . "';", 'fleets');

            $Record = 2000;
            while ($FleetRow = mysql_fetch_array($OtherFleets)) {
                if ($FleetRow['fleet_owner'] != $user['id']) {
                    if ($FleetRow['fleet_mission'] != 8) {
                        $Record++;
                        $StartTime = $FleetRow['fleet_start_time'];
                        $StayTime = $FleetRow['fleet_end_stay'];

                        if ($StartTime > time()) {
                            $Label = "ofs";
                            $fpage[$StartTime] = BuildFleetEventTable ($FleetRow, 0, false, $Label, $Record);
                        }
                        if ($FleetRow['fleet_mission'] == 5) {
                            // Flotte en stationnement
                            $Label = "oft";
                            if ($StayTime > time()) {
                                $fpage[$StayTime] = BuildFleetEventTable ($FleetRow, 1, false, $Label, $Record);
                            }
                        }
                    }
                }
            }
            // -----------------------------------------------------------------------------------------------
			// --- Gestion de la liste des planetes ----------------------------------------------------------
			// Planetes ...
			$planets_query = doquery("SELECT * FROM {{table}} WHERE id_owner='{$user['id']}'", "planets");
			$Colone  = 1;
			$Coloneshow = 0;
			$AllPlanets = "<tr style=\"background-color: transparent;\">";
			while ($UserPlanet = mysql_fetch_array($planets_query)) {
				if ($UserPlanet["id"] != $user["current_planet"] && $UserPlanet['planet_type'] != 3) {
					$Coloneshow++;	
 					$AllPlanets .= "<th style=\"background-color: transparent;\">". $UserPlanet['name'] ."<br>";
					$AllPlanets .= "<a href=\"?cp=". $UserPlanet['id'] ."&re=0\" title=\"". $UserPlanet['name'] ."\"><img src=\"". $dpath ."planeten/small/s_". $UserPlanet['image'] .".jpg\" height=\"50\" width=\"50\"></a><br>";
					$AllPlanets .= "<center>";

					if ($UserPlanet['b_building'] != 0) {
						UpdatePlanetBatimentQueueList ( $UserPlanet, $user );
						if ( $UserPlanet['b_building'] != 0 ) {
							$BuildQueue      = $UserPlanet['b_building_id'];
							$QueueArray      = explode ( ";", $BuildQueue );
							$CurrentBuild    = explode ( ",", $QueueArray[0] );
							$BuildElement    = $CurrentBuild[0];
							$BuildLevel      = $CurrentBuild[1];
							$BuildRestTime   = pretty_time( $CurrentBuild[3] - time() );
							$AllPlanets     .= '' . $lang['tech'][$BuildElement] . ' (' . $BuildLevel . ')';
							$AllPlanets     .= "<br><font color=\"#7f7f7f\">(". $BuildRestTime .")</font>";
						} else {
							CheckPlanetUsedFields ($UserPlanet);
							$AllPlanets     .= $lang['Free'];
						}
					} else {
						$AllPlanets    .= $lang['Free'];
					}
					$AllPlanets .= "</center></th>";
					if ($Coloneshow > 4) {
					$AllPlanets .= "</tr><tr>";
					$Coloneshow =0;
					}
				}
			}
			$AllPlanets .= "</tr>";	
			// -----------------------------------------------------------------------------------------------
            $parse = $lang;
            // -----------------------------------------------------------------------------------------------
            // News Frame ...
            // Banner ADS Google (meme si je suis contre cela)
            if ($game_config['OverviewNewsFrame'] == '1') {
                $parse['NewsFrame'] = "<tr><th>" . $lang['ov_news_title'] . "</th><th colspan=\"3\">" . stripslashes($game_config['OverviewNewsText']) . "</th></tr>";
            }
            if ($game_config['OverviewClickBanner'] != '') {
                $parse['ClickBanner'] = stripslashes($game_config['OverviewClickBanner']);
            }
            if ($game_config['ForumBannerFrame'] == '1') {

                $BannerURL = "".dirname($_SERVER["HTTP_REFERER"])."/scripts/createbanner.php?id=".$user['id']."";

                $parse['bannerframe'] = "<th colspan=\"4\"><img src=\"scripts/createbanner.php?id=".$user['id']."\"><br>".$lang['InfoBanner']."<br><input name=\"bannerlink\" type=\"text\" id=\"bannerlink\" value=\"[img]".$BannerURL."[/img]\" size=\"62\"></th></tr>";
            }
            // --- Gestion de l'affichage d'une lune ---------------------------------------------------------
            if ($lunarow['id'] <> 0) {
                if ($planetrow['planet_type'] == 1) {
                    $lune = doquery ("SELECT * FROM {{table}} WHERE `galaxy` = '" . $planetrow['galaxy'] . "' AND `system` = '" . $planetrow['system'] . "' AND `planet` = '" . $planetrow['planet'] . "' AND `planet_type` = '3'", 'planets', true);
                    $parse['moon_img'] = "<a href=\"?cp=" . $lune['id'] . "&re=0\" title=\"" . $lune['name'] . "\"><img src=\"" . $dpath . "planeten/" . $lune['image'] . ".jpg\" height=\"50\" width=\"50\"></a>";
                    $parse['moon'] = $lune['name'];
                } else {
                    $parse['moon_img'] = "";
                    $parse['moon'] = "";
                }
            } else {
                $parse['moon_img'] = "";
                $parse['moon'] = "";
            }
            // Moon END
            $parse['planet_name'] = $planetrow['name'];
            $parse['planet_diameter'] = pretty_number($planetrow['diameter']);
            $parse['planet_field_current'] = $planetrow['field_current'];
            $parse['planet_field_max'] = CalculateMaxPlanetFields($planetrow);
            $parse['planet_temp_min'] = $planetrow['temp_min'];
            $parse['planet_temp_max'] = $planetrow['temp_max'];
            $parse['galaxy_galaxy'] = $planetrow['galaxy'];
            $parse['galaxy_planet'] = $planetrow['planet'];
            $parse['galaxy_system'] = $planetrow['system'];
            $StatRecord = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $user['id'] . "';", 'statpoints', true);

            $parse['user_points'] 		   = pretty_number($StatRecord['build_points']);
            $parse['user_fleet']		   = pretty_number($StatRecord['fleet_points']);
            $parse['player_points_tech']   = pretty_number($StatRecord['tech_points']);
            $parse['user_defs']            = pretty_number( $StatRecord['defs_points'] );
            $parse['total_points'] 		   = pretty_number($StatRecord['total_points']);;

            $parse['user_rank'] = $StatRecord['total_rank'];
            $ile = $StatRecord['total_old_rank'] - $StatRecord['total_rank'];
            if ($ile >= 1) {
                $parse['ile'] = "<font color=lime>+" . $ile . "</font>";
            } elseif ($ile < 0) {
                $parse['ile'] = "<font color=red>-" . $ile . "</font>";
            } elseif ($ile == 0) {
                $parse['ile'] = "<font color=lightblue>" . $ile . "</font>";
            }
            $parse['u_user_rank'] = $StatRecord['total_rank'];
            $parse['user_username'] = $user['username'];

            if (count($fpage) > 0) {
                ksort($fpage);
                foreach ($fpage as $time => $content) {
                    $flotten .= $content . "\n";
                }
            }

            $parse['fleet_list'] = $flotten;
            $parse['energy_used'] = $planetrow["energy_max"] - $planetrow["energy_used"];

            $parse['Have_new_message'] = $Have_new_message;
            $parse['Have_new_level_mineur'] = $HaveNewLevelMineur;
            $parse['Have_new_level_raid'] = $HaveNewLevelRaid;
            $parse['time'] = "<div id=\"dateheure\"></div>";
            $parse['dpath'] = $dpath;
            $parse['planet_image'] = $planetrow['image'];
            $parse['anothers_planets'] = $AllPlanets;
            $parse['max_users'] = $game_config['users_amount'];

            $parse['metal_debris'] = pretty_number($galaxyrow['metal']);
            $parse['crystal_debris'] = pretty_number($galaxyrow['crystal']);
            if (($galaxyrow['metal'] != 0 || $galaxyrow['crystal'] != 0) && $planetrow[$resource[209]] != 0) {
                $parse['get_link'] = " (<a href=\"quickfleet.php?mode=8&g=" . $galaxyrow['galaxy'] . "&s=" . $galaxyrow['system'] . "&p=" . $galaxyrow['planet'] . "&t=2\">" . $lang['type_mission'][8] . "</a>)";
            } else {
                $parse['get_link'] = '';
            }

            if ($planetrow['b_building'] != 0) {
                UpdatePlanetBatimentQueueList ($planetrow, $user);
                if ($planetrow['b_building'] != 0) {
                    $BuildQueue = explode (";", $planetrow['b_building_id']);
                    $CurrBuild = explode (",", $BuildQueue[0]);
                    $RestTime = $planetrow['b_building'] - time();
                    $PlanetID = $planetrow['id'];
                    $Build = InsertBuildListScript ("overview");
                    $Build .= $lang['tech'][$CurrBuild[0]] . ' (' . ($CurrBuild[1]) . ')';
                    $Build .= "<br /><div id=\"blc\" class=\"z\">" . pretty_time($RestTime) . "</div>";
                    $Build .= "\n<script language=\"JavaScript\">";
                    $Build .= "\n	pp = \"" . $RestTime . "\";\n";
                    $Build .= "\n	pk = \"" . 1 . "\";\n";
                    $Build .= "\n	pm = \"cancel\";\n";
                    $Build .= "\n	pl = \"" . $PlanetID . "\";\n";
                    $Build .= "\n	t();\n";
                    $Build .= "\n</script>\n";

                    $parse['building'] = $Build;
                } else {
                    $parse['building'] = $lang['Free'];
                }
            } else {
                $parse['building'] = $lang['Free'];
            }
            $query = doquery('SELECT username FROM {{table}} ORDER BY register_time DESC', 'users', true);
            $parse['last_user'] = $query['username'];
            $query = doquery("SELECT COUNT(DISTINCT(id)) FROM {{table}} WHERE onlinetime>" . (time()-900), 'users', true);
            $parse['online_users'] = $query[0];
            // $count = doquery(","users",true);
            $parse['users_amount'] = $game_config['users_amount'];
            // Rajout d'une barre pourcentage
            // Calcul du pourcentage de remplissage
            $parse['case_pourcentage'] = floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) . $lang['o/o'];
            // Barre de remplissage
            $parse['case_barre'] = floor($planetrow["field_current"] / CalculateMaxPlanetFields($planetrow) * 100) * 4.0;
            // Couleur de la barre de remplissage
            if ($parse['case_barre'] > (100 * 4.0)) {
                $parse['case_barre'] = 400;
                $parse['case_barre_barcolor'] = '#C00000';
            } elseif ($parse['case_barre'] > (80 * 4.0)) {
                $parse['case_barre_barcolor'] = '#C0C000';
            } else {
                $parse['case_barre_barcolor'] = '#00C000';
            }
            // Mode Améliorations
            $parse['xpminier'] = $user['xpminier'];
            $parse['xpraid'] = $user['xpraid'];
            $parse['lvl_minier'] = $user['lvl_minier'];
            $parse['lvl_raid'] = $user['lvl_raid'];

            $LvlMinier = $user['lvl_minier'];
            $LvlRaid = $user['lvl_raid'];

            $parse['lvl_up_minier'] = $LvlMinier * 5000;
            $parse['lvl_up_raid'] = $LvlRaid * 10;
            // Nombre de raids, pertes, etc ...
            $parse['Raids'] = $lang['Raids'];
            $parse['NumberOfRaids'] = $lang['NumberOfRaids'];
            $parse['RaidsWin'] = $lang['RaidsWin'];
            $parse['RaidsLoose'] = $lang['RaidsLoose'];
         	$parse['RaidsDraw'] = $lang['RaidsDraw'];

            $parse['raids'] = $user['raids'];
            $parse['raidswin'] = $user['raidswin'];
            $parse['raidsloose'] = $user['raidsloose'];
         	$parse['raidsdraw'] = $user['raidsdraw'];
            // Compteur de Membres en ligne
            $OnlineUsers = doquery("SELECT COUNT(*) FROM {{table}} WHERE onlinetime>='" . (time()-15 * 60) . "'", 'users', 'true');
            $parse['NumberMembersOnline'] = $OnlineUsers[0];

            $page = parsetemplate(gettemplate('overview_body'), $parse);

            display($page, $lang['Overview']);
            break;
        }
}

?>
