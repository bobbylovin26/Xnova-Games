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

function ShowTopNavigationBar ($CurrentUser, $CurrentPlanet)
{
	global $lang, $game_config, $dpath;

	$parse				 = $lang;

	if ($CurrentUser)
	{
		if (!$CurrentPlanet)
			$CurrentPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '". $CurrentUser['current_planet'] ."';", 'planets', true);

		if($CurrentUser['urlaubs_modus'] == 0)
			PlanetResourceUpdate($CurrentUser, $CurrentPlanet, time());
		else
			doquery("UPDATE {{table}} SET `deuterium_sintetizer_porcent` = 0, `metal_mine_porcent` = 0, `crystal_mine_porcent` = 0 WHERE id_owner = ".$CurrentUser['id'],"planets");

		$parse['dpath']      		= $dpath;
		$parse['image']      		= $CurrentPlanet['image'];
		$parse['show_umod_notice']  = $CurrentUser['urlaubs_modus'] ? '<table width="100%" style="border: 3px solid red; text-align:center;"><tr><td>' . $lang['tn_vacation_mode'] . date('d.m.Y h:i:s',$CurrentUser['urlaubs_until']).'</td></tr></table>' : '';
		$parse['planetlist'] 		= '';
		$ThisUsersPlanets    		= SortUserPlanets ( $CurrentUser );

		while ($CurPlanet = mysql_fetch_array($ThisUsersPlanets))
		{
			if ($CurPlanet["destruyed"] == 0)
			{
				$parse['planetlist'] .= "\n<option ";
				if ($CurPlanet['id'] == $CurrentUser['current_planet'])
					$parse['planetlist'] .= "selected=\"selected\" ";
				$parse['planetlist'] .= "value=\"game.php?page=$_GET[page]&gid=$_GET[gid]&cp=".$CurPlanet['id']."";
				$parse['planetlist'] .= "&amp;mode=".$_GET['mode'];
				$parse['planetlist'] .= "&amp;re=0\">";
				$parse['planetlist'] .= "".$CurPlanet['name'];
				$parse['planetlist'] .= "&nbsp;[".$CurPlanet['galaxy'].":";
				$parse['planetlist'] .= "".$CurPlanet['system'].":";
				$parse['planetlist'] .= "".$CurPlanet['planet'];
				$parse['planetlist'] .= "]&nbsp;&nbsp;</option>";
			}
		}

		$energy = pretty_number($CurrentPlanet["energy_max"] + $CurrentPlanet["energy_used"]) . "/" . pretty_number($CurrentPlanet["energy_max"]);
		if (($CurrentPlanet["energy_max"] + $CurrentPlanet["energy_used"]) < 0)
			$parse['energy'] = colorRed($energy);
		else
			$parse['energy'] = colorGreen($energy);

		$parse['energy_total'] = colorNumber(pretty_number(floor(($CurrentPlanet['energy_max'] + $CurrentPlanet["energy_used"]))) - $parse['energy_basic_income']);

		if (($CurrentPlanet["energy_max"] * MAX_OVERFLOW) < $CurrentPlanet["energy"])
			$parse['energy_max'] = '<font color="#ff0000">';
		else
			$parse['energy_max'] = '<font color="#00ff00">';

		$parse['energy_max'] .= pretty_number($CurrentPlanet["energy_max"] / 1) . "</font>";

		if (($CurrentPlanet["metal_max"] * MAX_OVERFLOW) <= $CurrentPlanet["metal"])
			$parse['metal_max'] = '<font color="#ff0000">';
		else
			$parse['metal_max'] = '<font color="#00ff00">';

		$parse['metal_max'] .= pretty_number($CurrentPlanet["metal_max"] / 1) . "</font>";

		if (($CurrentPlanet["crystal_max"] * MAX_OVERFLOW) <= $CurrentPlanet["crystal"])
			$parse['crystal_max'] = '<font color="#ff0000">';
		else
			$parse['crystal_max'] = '<font color="#00ff00">';

		$parse['crystal_max'] .= pretty_number($CurrentPlanet["crystal_max"] / 1);

		if (($CurrentPlanet["deuterium_max"] * MAX_OVERFLOW) <= $CurrentPlanet["deuterium"])
			$parse['deuterium_max'] = '<font color="#ff0000">';
		else
			$parse['deuterium_max'] = '<font color="#00ff00">';

		$parse['deuterium_max'] 	.= pretty_number($CurrentPlanet["deuterium_max"] / 1);
		$parse['metal_perhour'] 	.= $CurrentPlanet["metal_perhour"] + ($game_config['metal_basic_income'] * $game_config['resource_multiplier']);
		$parse['crystal_perhour'] 	.= $CurrentPlanet["crystal_perhour"] + ($game_config['crystal_basic_income'] * $game_config['resource_multiplier']);
		$parse['deuterium_perhour'] .= $CurrentPlanet["deuterium_perhour"] + ($game_config['deuterium_basic_income'] * $game_config['resource_multiplier']);
		$parse['metalh'] 			.= round($CurrentPlanet["metal"]);
		$parse['crystalh'] 			.= round($CurrentPlanet["crystal"]);
		$parse['deuteriumh'] 		.= round($CurrentPlanet["deuterium"]);
		$parse['metal_mmax'] 		.= $CurrentPlanet["metal_max"] * MAX_OVERFLOW;
		$parse['crystal_mmax'] 		.= $CurrentPlanet["crystal_max"] * MAX_OVERFLOW;
		$parse['deuterium_mmax'] 	.= $CurrentPlanet["deuterium_max"] * MAX_OVERFLOW;

		if ($CurrentUser['new_message'] > 0)
			$parse['message'] = "<a href=\"game.php?page=messages\">[ ". $CurrentUser['new_message'] ." ]</a>";
		else
			$parse['message'] = "0";


		$darkmatter 		 = pretty_number($CurrentUser["darkmatter"]);
		$parse['darkmatter'] = $darkmatter;
		$TopBar 			 = parsetemplate(gettemplate('topnav'), $parse);
	}
	else
		$TopBar = "";

	return $TopBar;
}
?>