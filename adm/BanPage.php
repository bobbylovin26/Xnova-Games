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
include('AdminFunctions/Autorization.' . $phpEx);

if ($EditUsers != 1) die();

$parse = $lang;

$UserList		=	doquery("SELECT `username` FROM {{table}}", "users");
while ($a	=	mysql_fetch_array($UserList))
{
	$parse['List']	.=	'<option value="'.$a['username'].'">'.$a['username'].'</option>';
}

$UserListBan	=	doquery("SELECT `username` FROM {{table}} WHERE `bana` = '1'", "users");
while ($b	=	mysql_fetch_array($UserListBan))
{
	$parse['ListBan']	.=	'<option value="'.$b['username'].'">'.$b['username'].'</option>';
}

if($_POST && $_POST['ban_name'])
{
	$QueryUserExist	=	doquery("SELECT * FROM {{table}} WHERE `username` LIKE '%{$_POST['ban_name']}%'", "users");
	if (mysql_num_rows($QueryUserExist) != 0)
	{
		$name              = $_POST['ban_name'];
		$reas              = $_POST['why'];
		$days              = $_POST['days'];
		$hour              = $_POST['hour'];
		$mins              = $_POST['mins'];
		$secs              = $_POST['secs'];
		$admin             = $user['username'];
		$mail              = $user['email'];
		$Now               = time();
		$BanTime           = $days * 86400;
		$BanTime          += $hour * 3600;
		$BanTime          += $mins * 60;
		$BanTime          += $secs;
		$BannedUntil       = $Now + $BanTime;

		$QueryUserBan	=	doquery("SELECT * FROM {{table}} WHERE `who` LIKE '%{$name}%'", "banned");
		if (mysql_num_rows($QueryUserBan) != 0)
		{
			$QryInsertBan      = "UPDATE {{table}} SET ";
			$QryInsertBan     .= "`who` = \"". $name ."\", ";
			$QryInsertBan     .= "`theme` = '". $reas ."', ";
			$QryInsertBan     .= "`who2` = '". $name ."', ";
			$QryInsertBan     .= "`time` = '". $Now ."', ";
			$QryInsertBan     .= "`longer` = '". $BannedUntil ."', ";
			$QryInsertBan     .= "`author` = '". $admin ."', ";
			$QryInsertBan     .= "`email` = '". $mail ."' ";
			$QryInsertBan     .= "WHERE `who2` = '{$name}';";
			doquery( $QryInsertBan, 'banned');
		}
		else
		{
			$QryInsertBan      = "INSERT INTO {{table}} SET ";
			$QryInsertBan     .= "`who` = \"". $name ."\", ";
			$QryInsertBan     .= "`theme` = '". $reas ."', ";
			$QryInsertBan     .= "`who2` = '". $name ."', ";
			$QryInsertBan     .= "`time` = '". $Now ."', ";
			$QryInsertBan     .= "`longer` = '". $BannedUntil ."', ";
			$QryInsertBan     .= "`author` = '". $admin ."', ";
			$QryInsertBan     .= "`email` = '". $mail ."';";
			doquery( $QryInsertBan, 'banned');
		}

		$QryUpdateUser     = "UPDATE {{table}} SET ";
		$QryUpdateUser    .= "`bana` = '1', ";
		$QryUpdateUser    .= "`banaday` = '". $BannedUntil ."', ";

		if(isset($_POST['vacat']))
		{
			$QryUpdateUser    .= "`urlaubs_modus` = '1'";
		}
		else
		{
			$QryUpdateUser    .= "`urlaubs_modus` = '0'";
		}

		$QryUpdateUser    .= "WHERE ";
		$QryUpdateUser    .= "`username` = \"". $name ."\";";
		doquery( $QryUpdateUser, 'users');

		$PunishThePlanets     = "UPDATE {{table}} SET ";
		$PunishThePlanets    .= "`metal_mine_porcent` = '0', ";
		$PunishThePlanets    .= "`crystal_mine_porcent` = '0', ";
		$PunishThePlanets    .= "`deuterium_sintetizer_porcent` = '0'";
		$PunishThePlanets    .= "WHERE ";
		$PunishThePlanets    .= "`id_owner` = \"". $GetUserData['id'] ."\";";
		doquery( $PunishThePlanets, 'planets');

		$parse['display']	=	"<tr><th colspan=\"2\"><font color=lime>". $lang['bo_the_player'] . $name . $lang['bo_banned'] ."</font></th></tr>";
		}
		else
	{
		$parse['display']	=	"<tr><th colspan=\"2\"><font color=red>".$lang['bo_user_doesnt_exist']."</font></th></tr>";
	}
}
elseif($_POST && $_POST['unban_name'])
{
	$name = $_POST['unban_name'];
	doquery("DELETE FROM {{table}} WHERE who2='{$name}'", 'banned');
	doquery("UPDATE {{table}} SET bana=0, banaday=0 WHERE username='{$name}'", "users");
	
	$parse['display2']	=	"<tr><th colspan=\"2\"><font color=lime>". $lang['bo_the_player2'] . $name . $lang['bo_unbanned'] ."</font></th></tr>";
}



display( parsetemplate(gettemplate("adm/BanOptions"), $parse), false, '', true, false);
?>