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

function ShowStatisticsPage($CurrentUser)
{
	global $game_config, $dpath, $lang;

	$parse	= $lang;
	$who   	= (isset($_POST['who']))   ? $_POST['who']   : $_GET['who'];
	if (!isset($who))
		$who   = 1;

	$type  	= (isset($_POST['type']))  ? $_POST['type']  : $_GET['type'];
	if (!isset($type))
		$type  = 1;

	$range 	= (isset($_POST['range'])) ? $_POST['range'] : $_GET['range'];
	if (!isset($range))
		$range = 1;

	$parse['who']    = "<option value=\"1\"". (($who == "1") ? " SELECTED" : "") .">".$lang['st_player']."</option>";
	$parse['who']   .= "<option value=\"2\"". (($who == "2") ? " SELECTED" : "") .">".$lang['st_alliance']."</option>";

	$parse['type']   = "<option value=\"1\"". (($type == "1") ? " SELECTED" : "") .">".$lang['st_points']."</option>";
	$parse['type']  .= "<option value=\"2\"". (($type == "2") ? " SELECTED" : "") .">".$lang['st_fleets']."</option>";
	$parse['type']  .= "<option value=\"3\"". (($type == "3") ? " SELECTED" : "") .">".$lang['st_researh']."</option>";
	$parse['type']  .= "<option value=\"4\"". (($type == "4") ? " SELECTED" : "") .">".$lang['st_buildings']."</option>";
	$parse['type']  .= "<option value=\"5\"". (($type == "5") ? " SELECTED" : "") .">".$lang['st_defenses']."</option>";

	switch ($type)
	{
		case 1:
			$Order   = "total_points";
			$Points  = "total_points";
			$Counts  = "total_count";
			$Rank    = "total_rank";
			$OldRank = "total_old_rank";
		break;
		case 2:
			$Order   = "fleet_count";
			$Points  = "fleet_points";
			$Counts  = "fleet_count";
			$Rank    = "fleet_rank";
			$OldRank = "fleet_old_rank";
		break;
		case 3:
			$Order   = "tech_count";
			$Points  = "tech_points";
			$Counts  = "tech_count";
			$Rank    = "tech_rank";
			$OldRank = "tech_old_rank";
		break;
		case 4:
			$Order   = "build_points";
			$Points  = "build_points";
			$Counts  = "build_count";
			$Rank    = "build_rank";
			$OldRank = "build_old_rank";
		break;
		case 5:
			$Order   = "defs_points";
			$Points  = "defs_points";
			$Counts  = "defs_count";
			$Rank    = "defs_rank";
			$OldRank = "defs_old_rank";
		break;
		default:
			$Order   = "total_points";
			$Points  = "total_points";
			$Counts  = "total_count";
			$Rank    = "total_rank";
			$OldRank = "total_old_rank";
		break;
	}

	if ($who == 2)
	{
		$MaxAllys = doquery ("SELECT COUNT(*) AS `count` FROM {{table}};", 'alliance', true);

		if ($MaxAllys['count'] > 100)
		{
			$LastPage = floor($MaxAllys['count'] / 100);
		}

		$parse['range'] = "";

		for ($Page = 0; $Page <= $LastPage; $Page++)
		{
			$PageValue      = ($Page * 100) + 1;
			$PageRange      = $PageValue + 99;
			$parse['range'] .= "<option value=\"". $PageValue ."\"". (($range == $PageValue) ? " SELECTED" : "") .">". $PageValue ."-". $PageRange ."</option>";
		}

		$parse['stat_header'] = parsetemplate(gettemplate('stat/stat_alliancetable_header'), $parse);
		$start = floor($range / 100 % 100) * 100;
		$query = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '2' AND `stat_code` = '1' ORDER BY `". $Order ."` DESC LIMIT ". $start .",100;", 'statpoints');
		$start++;
		$parse['stat_date']   = $game_config['stats'];
		$parse['stat_values'] = "";

		while ($StatRow = mysql_fetch_assoc($query))
		{
			$parse['ally_rank']       = $start;

			$AllyRow                  = doquery("SELECT * FROM {{table}} WHERE `id` = '". $StatRow['id_owner'] ."';", 'alliance',true);

			$rank_old                 = $StatRow[ $OldRank ];
			if ( $rank_old == 0)
			{
				$rank_old             = $start;
				$QryUpdRank           = doquery("UPDATE {{table}} SET `".$Rank."` = '".$start."', `".$OldRank."` = '".$start."' WHERE `stat_type` = '2' AND `stat_code` = '1' AND `id_owner` = '". $StatRow['id_owner'] ."';" , "statpoints");
			}
			else
			{
				$QryUpdRank           = doquery("UPDATE {{table}} SET `".$Rank."` = '".$start."' WHERE `stat_type` = '2' AND `stat_code` = '1' AND `id_owner` = '". $StatRow['id_owner'] ."';" , "statpoints");
			}

			$rank_new                 = $start;
			$ranking                  = $rank_old - $rank_new;

			if ($ranking == "0")
			{
				$parse['ally_rankplus']   = "<font color=#87CEEB>*</font>";
			}

			if ($ranking < "0")
			{
				$parse['ally_rankplus']   = "<font color=red>".$ranking."</font>";
			}

			if ($ranking > "0")
			{
				$parse['ally_rankplus']   = "<font color=green>+".$ranking."</font>";
			}

			$parse['ally_tag']        	  = $AllyRow['ally_tag'];
			$parse['ally_name']       	  = $AllyRow['ally_name'];
			$parse['ally_mes']        	  = '';
			$parse['ally_members']    	  = $AllyRow['ally_members'];
			$parse['ally_points']     	  = pretty_number( $StatRow[ $Order ] );
			$parse['ally_members_points'] =  pretty_number( floor($StatRow[ $Order ] / $AllyRow['ally_members']) );
			$parse['stat_values']    	 .= parsetemplate(gettemplate('stat/stat_alliancetable'), $parse);
			$start++;
		}
	}
	else
	{
		$MaxUsers = doquery ("SELECT COUNT(*) AS `count` FROM {{table}} WHERE `db_deaktjava` = '0';", 'users', true);
		if ($MaxUsers['count'] > 100)
		{
			$LastPage = floor($MaxUsers['count'] / 100);
		}

		$parse['range'] = "";

		for ($Page = 0; $Page <= $LastPage; $Page++)
		{
			$PageValue      = ($Page * 100) + 1;
			$PageRange      = $PageValue + 99;
			$parse['range'] .= "<option value=\"". $PageValue ."\"". (($range == $PageValue) ? " SELECTED" : "") .">". $PageValue ."-". $PageRange ."</option>";
		}

		$parse['stat_header'] = parsetemplate(gettemplate('stat/stat_playertable_header'), $parse);

		$start = floor($range / 100 % 100) * 100;
		$query = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `". $Order ."` DESC LIMIT ". $start .",100;", 'statpoints');

		$start++;
		$parse['stat_date']   = $game_config['stats'];
		$parse['stat_values'] = "";

		while ($StatRow = mysql_fetch_assoc($query))
		{
			$parse['stat_date']       = date("d M Y - H:i:s", $StatRow['stat_date']);
			$parse['player_rank']     = $start;
			$UsrRow                   = doquery("SELECT * FROM {{table}} WHERE `id` = '". $StatRow['id_owner'] ."';", 'users',true);
			$QryUpdateStats 		 .= "`stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TheRank['id_owner'] ."';";
			$rank_old                 = $StatRow[ $OldRank ];
			if ( $rank_old == 0)
			{
				$rank_old             = $start;
				$QryUpdRank           = doquery("UPDATE {{table}} SET `".$Rank."` = '".$start."', `".$OldRank."` = '".$start."' WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $StatRow['id_owner'] ."';" , "statpoints");
			}
			else
			{
				$QryUpdRank           = doquery("UPDATE {{table}} SET `".$Rank."` = '".$start."' WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $StatRow['id_owner'] ."';" , "statpoints");
			}
			$rank_new                 = $start;
			$ranking                  = $rank_old - $rank_new;

			if ($ranking == "0")
				$parse['player_rankplus'] = "<font color=#87CEEB>*</font>";

			if ($ranking < "0")
				$parse['player_rankplus'] = "<font color=red>".$ranking."</font>";

			if ($ranking > "0")
				$parse['player_rankplus'] = "<font color=green>+".$ranking."</font>";

			if ($UsrRow['id'] == $CurrentUser['id'])
				$parse['player_name']     = "<font color=\"lime\">".$UsrRow['username']."</font>";
			else
				$parse['player_name']     = $UsrRow['username'];

			$parse['player_mes']      = "<a href=\"game.php?page=messages&mode=write&id=" . $UsrRow['id'] . "\"><img src=\"" . $dpath . "img/m.gif\" border=\"0\" title=\"Escribir un mensaje\" /></a>";

			if ($UsrRow['ally_name'] == $CurrentUser['ally_name'])
				$parse['player_alliance'] = "<font color=\"#33CCFF\">".$UsrRow['ally_name']."</font>";
			else
				$parse['player_alliance'] = $UsrRow['ally_name'];

			$parse['player_points']   = pretty_number( $StatRow[ $Order ] );
			$parse['stat_values']    .= parsetemplate(gettemplate('stat/stat_playertable'), $parse);
			$start++;
		}
	}

	display(parsetemplate( gettemplate('stat/stat_body'), $parse ));
}
?>