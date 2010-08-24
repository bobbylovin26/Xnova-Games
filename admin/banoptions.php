<?php

/**
 * banoptions.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] >= 1)
{
	if($_POST && $_POST['ban_name'])
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

		$QryInsertBan      = "INSERT INTO {{table}} SET ";
		$QryInsertBan     .= "`who` = \"". $name ."\", ";
		$QryInsertBan     .= "`theme` = '". $reas ."', ";
		$QryInsertBan     .= "`who2` = '". $name ."', ";
		$QryInsertBan     .= "`time` = '". $Now ."', ";
		$QryInsertBan     .= "`longer` = '". $BannedUntil ."', ";
		$QryInsertBan     .= "`author` = '". $admin ."', ";
		$QryInsertBan     .= "`email` = '". $mail ."';";
		doquery( $QryInsertBan, 'banned');

		$QryUpdateUser     = "UPDATE {{table}} SET ";
		$QryUpdateUser    .= "`bana` = '1', ";
		$QryUpdateUser    .= "`banaday` = '". $BannedUntil ."', ";
		$QryUpdateUser    .= "`urlaubs_modus` = '1'";
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

		message ("El jugador " . $name . " fue baneado correctamente.", "¡Listo!","banoptions.php",2);
	}
	elseif($_POST && $_POST['unban_name'])
	{
		$name = $_POST['unban_name'];
		doquery("DELETE FROM {{table}} WHERE who2='{$name}'", 'banned');
		doquery("UPDATE {{table}} SET bana=0, banaday=0 WHERE username='{$name}'", "users");
		message ("El jugador " . $name . " fue desbaneado correctamente.", "¡Listo!","banoptions.php",2);
	}
	else
	{
		display( parsetemplate(gettemplate("admin/banoptions"), $parse), "Admin CP - Banear usuario", false, '', true, false);
	}
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}
?>