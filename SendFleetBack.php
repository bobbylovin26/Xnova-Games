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

define('INSIDE'  , true);
define('INSTALL' , false);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ( is_numeric($_POST['fleetid']) )
{
	$fleetid  = intval($_POST['fleetid']);
	$FleetRow = doquery("SELECT * FROM {{table}} WHERE `fleet_id` = '". $fleetid ."';", 'fleets', true);
	$i = 0;

	if ($FleetRow['fleet_owner'] == $user['id'])
	{
		if ($FleetRow['fleet_mess'] == 0)
		{
			if ($FleetRow['fleet_end_stay'] != 0)
			{
				if ($FleetRow['fleet_start_time'] < time())
					$CurrentFlyingTime = time() - $FleetRow['start_time'];
				else
					$CurrentFlyingTime = $FleetRow['fleet_start_time'] - $FleetRow['start_time'];
			}
			else
				$CurrentFlyingTime = time() - $FleetRow['start_time'];

			$ReturnFlyingTime  = $CurrentFlyingTime + time();

			$QryUpdateFleet  = "UPDATE {{table}} SET ";
			$QryUpdateFleet .= "`fleet_start_time` = '". (time() - 1) ."', ";
			$QryUpdateFleet .= "`fleet_end_stay` = '0', ";
			$QryUpdateFleet .= "`fleet_end_time` = '". ($ReturnFlyingTime + 1) ."', ";
			$QryUpdateFleet .= "`fleet_target_owner` = '". $user['id'] ."', ";
			$QryUpdateFleet .= "`fleet_mess` = '1' ";
			$QryUpdateFleet .= "WHERE ";
			$QryUpdateFleet .= "`fleet_id` = '" . $fleetid . "';";
			doquery( $QryUpdateFleet, 'fleets');
		}
		elseif ($FleetRow['fleet_mess'] == 1)
		{
			header("location:game.php?page=fleet");
		}
	}
	else
	{
		header("location:game.php?page=fleet");
	}
}
header("location:game.php?page=fleet");
?>