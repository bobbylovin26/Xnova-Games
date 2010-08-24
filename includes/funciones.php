<?php

/**
 * functions.php
 *
 * @version 1
 * @copyright 2008 By Chlorel for XNova
 */

function is_email($email) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i", $email));
}

function message ($mes, $title = 'Error', $dest = "", $time = "3") {
	$parse['color'] = $color;
	$parse['title'] = $title;
	$parse['mes']   = $mes;

	$page .= parsetemplate(gettemplate('message_body'), $parse);

	display ($page, $title, false, (($dest != "") ? "<meta http-equiv=\"refresh\" content=\"$time;URL=$dest\">" : ""), false);
}

function display ($page, $title = '', $topnav = true, $metatags = '', $AdminPage = false) {
   global $link, $game_config, $debug, $user, $planetrow;

   if (!$AdminPage) {
      $DisplayPage  = StdUserHeader ($title, $metatags);
   } else {
      $DisplayPage  = AdminUserHeader ($title, $metatags);
   }

   if ($topnav) {
   	  include('includes/funciones_A/ShowTopNavigationBar.php');
      $DisplayPage .= ShowTopNavigationBar( $user, $planetrow );
   }
   $DisplayPage .= "<center>\n". $page ."\n</center>\n";

   if ($link) {
      mysql_close($link);
   }

   echo $DisplayPage;

   if ($user['authlevel'] == 1 || $user['authlevel'] == 3) {
      if ($game_config['debug'] == 1) $debug->echo_log();
   }

   die();
}

function StdUserHeader ($title = '', $metatags = '') {
	global $user, $dpath, $langInfos;

	$parse             = $langInfos;
	$parse['title']    = $title;
	if ( defined('LOGIN') ) {
		$parse['dpath']    = "skins/xnova/";
		$parse['-style-']  = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/styles.css\">\n";
	} else {
		$parse['dpath']    = $dpath;
		$parse['-style-']  = "<link rel=\"stylesheet\" type=\"text/css\" href=\"". $dpath ."default.css\" />";
		$parse['-style-'] .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"". $dpath ."formate.css\" />";
	}

	$parse['-meta-']  = ($metatags) ? $metatags : "";
	$parse['-body-']  = "<body>";
	return parsetemplate(gettemplate('simple_header'), $parse);
}

function AdminUserHeader ($title = '', $metatags = '') {
	global $user, $dpath, $langInfos;

	$parse           = $langInfos;
	$parse['dpath']  = $dpath;
	$parse['title']  = $title;
	$parse['-meta-'] = ($metatags) ? $metatags : "";
	$parse['-body-'] = "<body>";
	return parsetemplate(gettemplate('admin/simple_header'), $parse);
}

function CalculateMaxPlanetFields (&$planet) {
	global $resource;

	return $planet["field_max"] + ($planet[ $resource[33] ] * FIELDS_BY_TERRAFORMER);
}

function GetTargetDistance ($OrigGalaxy, $DestGalaxy, $OrigSystem, $DestSystem, $OrigPlanet, $DestPlanet) {
	$distance = 0;

	if (($OrigGalaxy - $DestGalaxy) != 0) {
		$distance = abs($OrigGalaxy - $DestGalaxy) * 20000;
	} elseif (($OrigSystem - $DestSystem) != 0) {
		$distance = abs($OrigSystem - $DestSystem) * 5 * 19 + 2700;
	} elseif (($OrigPlanet - $DestPlanet) != 0) {
		$distance = abs($OrigPlanet - $DestPlanet) * 5 + 1000;
	} else {
		$distance = 5;
	}

	return $distance;
}

function GetMissionDuration ($GameSpeed, $MaxFleetSpeed, $Distance, $SpeedFactor) {
	$Duration = 0;
	$Duration = round(((35000 / $GameSpeed * sqrt($Distance * 10 / $MaxFleetSpeed) + 10) / $SpeedFactor));

	return $Duration;
}

function GetGameSpeedFactor () {
	global $game_config;

	return $game_config['fleet_speed'] / 2500;
}

function GetFleetMaxSpeed ($FleetArray, $Fleet, $Player) {
	global $reslist, $pricelist;

	if ($Fleet != 0) {
		$FleetArray[$Fleet] =  1;
	}
	foreach ($FleetArray as $Ship => $Count) {
		if ($Ship == 202) {
			if ($Player['impulse_motor_tech'] >= 5) {
				$speedalls[$Ship] = $pricelist[$Ship]['speed2'] + (($pricelist[$Ship]['speed'] * $Player['impulse_motor_tech']) * 0.2);
			} else {
				$speedalls[$Ship] = $pricelist[$Ship]['speed']  + (($pricelist[$Ship]['speed'] * $Player['combustion_tech']) * 0.1);
			}
		}
		if ($Ship == 203 or $Ship == 204 or $Ship == 209 or $Ship == 210) {
			$speedalls[$Ship] = $pricelist[$Ship]['speed'] + (($pricelist[$Ship]['speed'] * $Player['combustion_tech']) * 0.1);
		}
		if ($Ship == 205 or $Ship == 206 or $Ship == 208 or $Ship == 221 or $Ship == 222 or $Ship == 224) {
			$speedalls[$Ship] = $pricelist[$Ship]['speed'] + (($pricelist[$Ship]['speed'] * $Player['impulse_motor_tech']) * 0.2);
		}
		if ($Ship == 211) {
			if ($Player['hyperspace_motor_tech'] >= 8) {
				$speedalls[$Ship] = $pricelist[$Ship]['speed2'] + (($pricelist[$Ship]['speed'] * $Player['hyperspace_motor_tech']) * 0.3);
			} else {
				$speedalls[$Ship] = $pricelist[$Ship]['speed']  + (($pricelist[$Ship]['speed'] * $Player['impulse_motor_tech']) * 0.2);
			}
		}
		if ($Ship == 207 or $Ship == 213 or $Ship == 214 or $Ship == 215 or $Ship == 216 or $Ship == 217 or $Ship == 218 or $Ship == 219 or $Ship == 220 or $Ship == 223) {
			$speedalls[$Ship] = $pricelist[$Ship]['speed'] + (($pricelist[$Ship]['speed'] * $Player['hyperspace_motor_tech']) * 0.3);
		}
	}
	if ($Fleet != 0) {
		$ShipSpeed = $speedalls[$Ship];
		$speedalls = $ShipSpeed;
	}

	return $speedalls;
}

function GetShipConsumption ( $Ship, $Player ) {
	global $pricelist;
	if ($Player['impulse_motor_tech'] >= 5) {
		$Consumption  = $pricelist[$Ship]['consumption2'];
	} else {
		$Consumption  = $pricelist[$Ship]['consumption'];
	}

	return $Consumption;
}

function GetFleetConsumption ($FleetArray, $SpeedFactor, $MissionDuration, $MissionDistance, $FleetMaxSpeed, $Player) {

	$consumption = 0;
	$basicConsumption = 0;

	foreach ($FleetArray as $Ship => $Count) {
		if ($Ship > 0) {
			$ShipSpeed         = GetFleetMaxSpeed ( "", $Ship, $Player );
			$ShipConsumption   = GetShipConsumption ( $Ship, $Player );
			$spd               = 35000 / ($MissionDuration * $SpeedFactor - 10) * sqrt( $MissionDistance * 10 / $ShipSpeed );
			$basicConsumption  = $ShipConsumption * $Count;
			$consumption      += $basicConsumption * $MissionDistance / 35000 * (($spd / 10) + 1) * (($spd / 10) + 1);
		}
	}

	$consumption = round($consumption) + 1;

	return $consumption;
}

function pretty_time ($seconds) {
	$day = floor($seconds / (24 * 3600));
	$hs = floor($seconds / 3600 % 24);
	$ms = floor($seconds / 60 % 60);
	$sr = floor($seconds / 1 % 60);

	if ($hs < 10) { $hh = "0" . $hs; } else { $hh = $hs; }
	if ($ms < 10) { $mm = "0" . $ms; } else { $mm = $ms; }
	if ($sr < 10) { $ss = "0" . $sr; } else { $ss = $sr; }

	$time = '';
	if ($day != 0) { $time .= $day . 'd '; }
	if ($hs  != 0) { $time .= $hh . 'h ';  } else { $time .= '00h '; }
	if ($ms  != 0) { $time .= $mm . 'm ';  } else { $time .= '00m '; }
	$time .= $ss . 's';

	return $time;
}

function pretty_time_hour ($seconds) {
	$min = floor($seconds / 60 % 60);

	$time = '';
	if ($min != 0) { $time .= $min . 'min '; }

	return $time;
}

function ShowBuildTime ($time) {
	global $lang;

	return "<br>". $lang['ConstructionTime'] .": " . pretty_time($time);
}


function ReadFromFile($filename) {
	$content = @file_get_contents ($filename);
	return $content;
}


function parsetemplate ($template, $array) {
	return preg_replace('#\{([a-z0-9\-_]*?)\}#Ssie', '( ( isset($array[\'\1\']) ) ? $array[\'\1\'] : \'\' );', $template);
}

function gettemplate ($templatename) {
	global $xnova_root_path;

	$filename = $xnova_root_path . TEMPLATE_DIR . '/' . $templatename . ".tpl";

	return ReadFromFile($filename);
}

function includeLang ($filename, $ext = '.mo') {
	global $xnova_root_path, $lang, $user;

	if ($user['lang'] != '') {
		$SelLanguage = $user['lang'];
	} else {
		$SelLanguage = DEFAULT_LANG;
	}
	include ($xnova_root_path . "language/". $SelLanguage ."/". $filename.$ext);
}

function GetStartAdressLink ( $FleetRow, $FleetType ) {
	$Link  = "<a href=\"galaxy.php?mode=3&galaxy=".$FleetRow['fleet_start_galaxy']."&system=".$FleetRow['fleet_start_system']."\" ". $FleetType ." >";
	$Link .= "[".$FleetRow['fleet_start_galaxy'].":".$FleetRow['fleet_start_system'].":".$FleetRow['fleet_start_planet']."]</a>";
	return $Link;
}


function GetTargetAdressLink ( $FleetRow, $FleetType ) {
	$Link  = "<a href=\"galaxy.php?mode=3&galaxy=".$FleetRow['fleet_end_galaxy']."&system=".$FleetRow['fleet_end_system']."\" ". $FleetType ." >";
	$Link .= "[".$FleetRow['fleet_end_galaxy'].":".$FleetRow['fleet_end_system'].":".$FleetRow['fleet_end_planet']."]</a>";
	return $Link;
}

function BuildPlanetAdressLink ( $CurrentPlanet ) {
	$Link  = "<a href=\"galaxy.php?mode=3&galaxy=".$CurrentPlanet['galaxy']."&system=".$CurrentPlanet['system']."\">";
	$Link .= "[".$CurrentPlanet['galaxy'].":".$CurrentPlanet['system'].":".$CurrentPlanet['planet']."]</a>";
	return $Link;
}

function BuildHostileFleetPlayerLink ( $FleetRow ) {
	global $lang, $dpath;

	$PlayerName = doquery ("SELECT `username` FROM {{table}} WHERE `id` = '". $FleetRow['fleet_owner']."';", 'users', true);
	$Link  = $PlayerName['username']. " ";
	$Link .= "<a href=\"messages.php?mode=write&id=".$FleetRow['fleet_owner']."\">";
	$Link .= "<img src=\"".$dpath."/img/m.gif\" alt=\"". $lang['ov_message']."\" title=\"". $lang['ov_message']."\" border=\"0\"></a>";
	return $Link;
}

function GetNextJumpWaitTime ( $CurMoon ) {
	global $resource;

	$JumpGateLevel  = $CurMoon[$resource[43]];
	$LastJumpTime   = $CurMoon['last_jump_time'];
	if ($JumpGateLevel > 0) {
		$WaitBetweenJmp = (60 * 60) * (1 / $JumpGateLevel);
		$NextJumpTime   = $LastJumpTime + $WaitBetweenJmp;
		if ($NextJumpTime >= time()) {
			$RestWait   = $NextJumpTime - time();
			$RestString = " ". pretty_time($RestWait);
		} else {
			$RestWait   = 0;
			$RestString = "";
		}
	} else {
		$RestWait   = 0;
		$RestString = "";
	}
	$RetValue['string'] = $RestString;
	$RetValue['value']  = $RestWait;

	return $RetValue;
}

function CreateFleetPopupedFleetLink ( $FleetRow, $Texte, $FleetType ) {
	global $lang;

	$FleetRec     = explode(";", $FleetRow['fleet_array']);
	$FleetPopup   = "<a href='#' onmouseover=\"return overlib('";
	$FleetPopup  .= "<table width=200>";
	foreach($FleetRec as $Item => $Group) {
		if ($Group  != '') {
			$Ship    = explode(",", $Group);
			$FleetPopup .= "<tr><td width=50% align=left><font color=white>". $lang['tech'][$Ship[0]] .":<font></td><td width=50% align=right><font color=white>". pretty_number($Ship[1]) ."<font></td></tr>";
		}
	}
	$FleetPopup  .= "</table>";
	$FleetPopup  .= "');\" onmouseout=\"return nd();\" class=\"". $FleetType ."\">". $Texte ."</a>";

	return $FleetPopup;

}

function CreateFleetPopupedMissionLink ( $FleetRow, $Texte, $FleetType ) {
	global $lang;

	$FleetTotalC  = $FleetRow['fleet_resource_metal'] + $FleetRow['fleet_resource_crystal'] + $FleetRow['fleet_resource_deuterium'] + $FleetRow['fleet_resource_darkmatter'];
	if ($FleetTotalC <> 0) {
		$FRessource   = "<table width=200>";
		$FRessource  .= "<tr><td width=50% align=left><font color=white>". $lang['Metal'] ."<font></td><td width=50% align=right><font color=white>". pretty_number($FleetRow['fleet_resource_metal']) ."<font></td></tr>";
		$FRessource  .= "<tr><td width=50% align=left><font color=white>". $lang['Crystal'] ."<font></td><td width=50% align=right><font color=white>". pretty_number($FleetRow['fleet_resource_crystal']) ."<font></td></tr>";
		$FRessource  .= "<tr><td width=50% align=left><font color=white>". $lang['Deuterium'] ."<font></td><td width=50% align=right><font color=white>". pretty_number($FleetRow['fleet_resource_deuterium']) ."<font></td></tr>";
		$FRessource  .= "<tr><td width=50% align=left><font color=white>". $lang['Dark'] ."<font></td><td width=50% align=right><font color=white>". pretty_number($FleetRow['fleet_resource_darkmatter']) ."<font></td></tr>";
		$FRessource  .= "</table>";
	} else {
		$FRessource   = "";
	}

	if ($FRessource <> "") {
		$MissionPopup  = "<a href='#' onmouseover=\"return overlib('". $FRessource ."');";
		$MissionPopup .= "\" onmouseout=\"return nd();\" class=\"". $FleetType ."\">" . $Texte ."</a>";
	} else {
		$MissionPopup  = $Texte ."";
	}

	return $MissionPopup;
}

function doquery($query, $table, $fetch = false){
	global $link, $debug, $xnova_root_path;

	require($xnova_root_path.'config.php');

	if(!$link)
	{
		$link = mysql_connect($dbsettings["server"], $dbsettings["user"],
		$dbsettings["pass"]) or
		$debug->error(mysql_error()."<br />$query","SQL Error");


		mysql_select_db($dbsettings["name"]) or $debug->error(mysql_error()."<br />$query","SQL Error");
		echo mysql_error();
	}

	$sql = str_replace("{{table}}", $dbsettings["prefix"].$table, $query);


	$sqlquery = mysql_query($sql) or
	$debug->error(mysql_error()."<br />$sql<br />","SQL Error");

	unset($dbsettings);

	global $numqueries,$debug;
	$numqueries++;

	$debug->add("<tr><th>Query $numqueries: </th><th>$query</th><th>$table</th><th>$fetch</th></tr>");

	if($fetch)
	{
		$sqlrow = mysql_fetch_array($sqlquery);
		return $sqlrow;
	}
	else
	{
		return $sqlquery;
	}
}
?>
