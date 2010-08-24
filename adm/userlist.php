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
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] < 2) die(message ($lang['not_enough_permissions']));

	function DeleteSelectedUser($UserID)
	{
		$TheUser = doquery ( "SELECT * FROM {{table}} WHERE `id` = '" . $UserID . "';", 'users', true );

		if ( $TheUser['ally_id'] != 0 )
		{
			$TheAlly = doquery ( "SELECT * FROM {{table}} WHERE `id` = '" . $TheUser['ally_id'] . "';", 'alliance', true );
			$TheAlly['ally_members'] -= 1;

			if ($TheAlly['ally_members'] > 0)
			{
				doquery ( "UPDATE {{table}} SET `ally_members` = '" . $TheAlly['ally_members'] . "' WHERE `id` = '" . $TheAlly['id'] . "';", 'alliance' );
			}
			else
			{
				doquery ( "DELETE FROM {{table}} WHERE `id` = '" . $TheAlly['id'] . "';", 'alliance' );
				doquery ( "DELETE FROM {{table}} WHERE `stat_type` = '2' AND `id_owner` = '" . $TheAlly['id'] . "';", 'statpoints' );
			}
		}

		doquery ( "DELETE FROM {{table}} WHERE `stat_type` = '1' AND `id_owner` = '" . $UserID . "';", 'statpoints' );

		$ThePlanets = doquery ( "SELECT * FROM {{table}} WHERE `id_owner` = '" . $UserID . "';", 'planets' );

		while ( $OnePlanet = mysql_fetch_assoc ( $ThePlanets ) )
		{
			if ( $OnePlanet['planet_type'] == 1 )
				doquery ( "DELETE FROM {{table}} WHERE `galaxy` = '" . $OnePlanet['galaxy'] . "' AND `system` = '" . $OnePlanet['system'] . "' AND `planet` = '" . $OnePlanet['planet'] . "';", 'galaxy' );
			elseif ( $OnePlanet['planet_type'] == 3 )
				doquery ( "DELETE FROM {{table}} WHERE `galaxy` = '" . $OnePlanet['galaxy'] . "' AND `system` = '" . $OnePlanet['system'] . "' AND `lunapos` = '" . $OnePlanet['planet'] . "';", 'lunas' );

			doquery ( "DELETE FROM {{table}} WHERE `id` = '" . $OnePlanet['id'] . "';", 'planets' );
		}

		doquery ( "DELETE FROM {{table}} WHERE `message_sender` = '" . $UserID . "';", 'messages' );
		doquery ( "DELETE FROM {{table}} WHERE `message_owner` = '" . $UserID . "';", 'messages' );
		doquery ( "DELETE FROM {{table}} WHERE `owner` = '" . $UserID . "';", 'notes' );
		doquery ( "DELETE FROM {{table}} WHERE `fleet_owner` = '" . $UserID . "';", 'fleets' );
		doquery ( "DELETE FROM {{table}} WHERE `id_owner1` = '" . $UserID . "';", 'rw' );
		doquery ( "DELETE FROM {{table}} WHERE `id_owner2` = '" . $UserID . "';", 'rw' );
		doquery ( "DELETE FROM {{table}} WHERE `sender` = '" . $UserID . "';", 'buddy' );
		doquery ( "DELETE FROM {{table}} WHERE `owner` = '" . $UserID . "';", 'buddy' );
		doquery ( "DELETE FROM {{table}} WHERE `id` = '" . $UserID . "';", 'users' );
	}

	$parse	= $lang;

	if ($_GET['cmd'] == 'dele')
		DeleteSelectedUser ($_GET['user']);
	if ($_GET['cmd'] == 'sort')
		$TypeSort = $_GET['type'];
	else
		$TypeSort = "id";

	$query   = doquery("SELECT `id`,`username`,`email`,`ip_at_reg`,`user_lastip`,`register_time`,`onlinetime`,`bana`,`banaday` FROM {{table}} ORDER BY `". $TypeSort ."` ASC", 'users');

	$parse['adm_ul_table'] = "";
	$i                     = 0;
	$Color                 = "lime";
	while ($u = mysql_fetch_assoc($query))
	{
		if ($PrevIP != "")
		{
			if ($PrevIP == $u['user_lastip'])
				$Color = "red";
			else
				$Color = "lime";
		}

		$Bloc['adm_ul_data_id']     		= $u['id'];
		$Bloc['adm_ul_data_name']   		= $u['username'];
		$Bloc['adm_ul_data_mail']   		= $u['email'];
		$Bloc['ip_adress_at_register']   	= $u['ip_at_reg'];
		$Bloc['adm_ul_data_adip']   		= "<font color=\"".$Color."\">". $u['user_lastip'] ."</font>";
		$Bloc['adm_ul_data_regd']   		= gmdate ( "d/m/Y G:i:s", $u['register_time'] );
		$Bloc['adm_ul_data_lconn']  		= gmdate ( "d/m/Y G:i:s", $u['onlinetime'] );
		$Bloc['adm_ul_data_banna']  		= ($u['bana'] == 1) ? "<a href # title=\"". gmdate ( "d/m/Y G:i:s", $u['banaday']) ."\">".$lang['ul_yes']."</a>" : $lang['ul_no'];
		$Bloc['adm_ul_data_actio']  		= ($u['id'] != $user['id'] && $user['authlevel'] >= 3) ? "<a href=\"userlist.php?cmd=dele&user=".$u['id']."\" onclick=\"return confirm('".$lang['ul_sure_you_want_dlte']."  $u[username]?');\"><img src=\"../styles/images/r1.png\"></a>" : "-";
		$PrevIP                     		= $u['user_lastip'];
		$parse['adm_ul_table']     			.= parsetemplate(gettemplate('adm/userlist_rows'), $Bloc);
		$i++;
	}
	$parse['adm_ul_count'] = $i;

	display( parsetemplate( gettemplate('adm/userlist_body'), $parse ), false, '', true, false);

?>