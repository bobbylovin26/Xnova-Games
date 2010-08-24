<?php

/**
 * CheckCookies.php
 *
 * @version 2.0
 * @copyright 2008 By Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

// TheCookie[0] = `id`
// TheCookie[1] = `username`
// TheCookie[2] = Password + Hashcode
// TheCookie[3] = 1rst Connexion time + 365 Dias

function CheckCookies ( $IsUserChecked ) {
	global $game_config, $xnova_root_path, $phpEx;

	$UserRow = array();

	include($xnova_root_path . 'config.' . $phpEx);

if (isset($_COOKIE[$game_config['COOKIE_NAME']]))
{
	$TheCookie  = explode("/%/", $_COOKIE[$game_config['COOKIE_NAME']]);
	$UserResult = doquery("SELECT * FROM {{table}} WHERE `username` = '". $TheCookie[1]. "';", 'users');

	if (mysql_num_rows($UserResult) != 1)
	{
		message( "¡Error de cookies! ¡Hay varios usuarios con este nombre!<a href=$xnova_root_path>Inicio</a> Debe eliminar sus cookies. En caso de problemas contactar con el admin." );
	}

	$UserRow    = mysql_fetch_array($UserResult);

	if ($UserRow["id"] != $TheCookie[0])
	{
		message( "¡Error de cookies! ¡Su cookie no corresponde con el usuario!<a href=$xnova_root_path>Inicio</a> Debe eliminar sus cookies. En caso de problemas contactar con el admin." );
	}

	if (md5($UserRow["password"] . "--" . $dbsettings["secretword"]) !== $TheCookie[2])
	{
		message( "'¡Error de cookies! ¡Error de sesión, debe conectarse de nuevo!<a href=$xnova_root_path>Inicio</a> Debe eliminar sus cookies. En caso de problemas contactar con el admin." );
	}

	$NextCookie = implode("/%/", $TheCookie);

	if ($TheCookie[3] == 1)
	{
		$ExpireTime = time() + 31536000;
	}
	else
	{
		$ExpireTime = 0;
	}

	if ($IsUserChecked == false)
	{
		setcookie ($game_config['COOKIE_NAME'], $NextCookie, $ExpireTime, "/", "", 0);
		$QryUpdateUser  = "UPDATE {{table}} SET ";
		$QryUpdateUser .= "`onlinetime` = '". time() ."', ";
		$QryUpdateUser .= "`current_page` = '". addslashes($_SERVER['REQUEST_URI']) ."', ";
		$QryUpdateUser .= "`user_lastip` = '". $_SERVER['REMOTE_ADDR'] ."', ";
		$QryUpdateUser .= "`user_agent` = '". addslashes($_SERVER['HTTP_USER_AGENT']) ."' ";
		$QryUpdateUser .= "WHERE ";
		$QryUpdateUser .= "`id` = '". $TheCookie[0] ."' LIMIT 1;";
		doquery( $QryUpdateUser, 'users');
		$IsUserChecked = true;
	}
	else
	{
		$QryUpdateUser  = "UPDATE {{table}} SET ";
		$QryUpdateUser .= "`onlinetime` = '". time() ."', ";
		$QryUpdateUser .= "`current_page` = '". $_SERVER['REQUEST_URI'] ."', ";
		$QryUpdateUser .= "`user_lastip` = '". $_SERVER['REMOTE_ADDR'] ."', ";
		$QryUpdateUser .= "`user_agent` = '". $_SERVER['HTTP_USER_AGENT'] ."' ";
		$QryUpdateUser .= "WHERE ";
		$QryUpdateUser .= "`id` = '". $TheCookie[0] ."' LIMIT 1;";
		doquery( $QryUpdateUser, 'users');
		$IsUserChecked = true;
	}
}

unset($dbsettings);

$Return['state']  = $IsUserChecked;
$Return['record'] = $UserRow;

return $Return;
}

?>