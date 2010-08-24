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

$phpEx 			= "php";
$game_config   	= array();
$user          	= array();
$lang          	= array();
$link          	= "";
$IsUserChecked 	= false;

include_once($xgp_root . 'includes/constants.'.$phpEx);
include_once($xgp_root . 'includes/GeneralFunctions.'.$phpEx);
include_once($xgp_root . 'includes/classes/class.debug.'.$phpEx);
$debug 		= new debug();

if (INSTALL != true)
{
	include($xgp_root . 'includes/vars.'.$phpEx);
	include($xgp_root . 'includes/functions/CreateOneMoonRecord.'.$phpEx);
	include($xgp_root . 'includes/functions/CreateOnePlanetRecord.'.$phpEx);
	include($xgp_root . 'includes/functions/SendSimpleMessage.'.$phpEx);

	$query = doquery("SELECT * FROM {{table}}",'config');

	while ($row = mysql_fetch_assoc($query))
	{
		$game_config[$row['config_name']] = $row['config_value'];
	}

	define('DEFAULT_LANG', ($game_config['lang'] == '') ? "spanish" : $game_config['lang']);

	includeLang('INGAME');

	if ($InLogin != true)
	{
		include($xgp_root . 'includes/classes/class.CheckSession.'.$phpEx);

		$Result        = CheckSession::CheckUser($IsUserChecked);
		$IsUserChecked = $Result['state'];
		$user          = $Result['record'];

		if($game_config['game_disable'] == 0 && $user['authlevel'] == 0)
		{
			message(stripslashes($game_config['close_reason']), '', '', false, false);
		}
	}

	if(time() >= ($game_config['stat_last_update'] + (60 * $game_config['stat_update_time'])))
	{
		include($xgp_root . 'adm/statfunctions.' . $phpEx);
		$result		= MakeStats();
		update_config('stat_last_update', $result['stats_time']);
	}

	if (isset($user))
	{
		include($xgp_root . 'includes/classes/class.FlyingFleetHandler.'.$phpEx);

		$_fleets = doquery("SELECT * FROM {{table}} WHERE (`fleet_start_time` <= '".time()."') OR (`fleet_end_time` <= '".time()."');", 'fleets'); //  OR fleet_end_time <= ".time()
		while ($row =  mysql_fetch_array($_fleets))
		{
			if($row['fleet_owner'] == $user['id'] or $row['fleet_target_owner'] == $user['id'])
			{
				$array                = array();
				$array['galaxy']      = $row['fleet_start_galaxy'];
				$array['system']      = $row['fleet_start_system'];
				$array['planet']      = $row['fleet_start_planet'];

				if($row['fleet_start_time'] <= time())
					$array['planet_type'] = $row['fleet_start_type'];
				else
					$array['planet_type'] = $row['fleet_end_type'];

				new FlyingFleetHandler($array);

				unset($array);
			}
			unset($row);
		}
		unset($_fleets);

		if ( defined('IN_ADMIN') )
		{
			includeLang('ADMIN');
			$UserSkin  = $user['dpath'];
			$local     = stristr ( $UserSkin, "http:");
			if ($local === false)
			{
				if (!$user['dpath'])
				{
					$dpath     = "../". DEFAULT_SKINPATH  ;
				}
				else
				{
					$dpath     = "../". $user["dpath"];
				}
			}
			else
			{
				$dpath     = $UserSkin;
			}
		}
		else
		{
			$dpath     = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
		}

		include($xgp_root . 'includes/functions/SetSelectedPlanet.' . $phpEx);
		SetSelectedPlanet ($user);

		$planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '".$user['current_planet']."';", 'planets', true);

		include($xgp_root . 'includes/functions/CheckPlanetUsedFields.' . $phpEx);
		CheckPlanetUsedFields($planetrow);
	}
}
else
{
	$dpath     = "../" . DEFAULT_SKINPATH;
}
?>