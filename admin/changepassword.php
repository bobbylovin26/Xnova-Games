<?php

/**
 * changepassword.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] >= "1")
{
	if ($_POST['md5q'] != "")
	{
		doquery ("UPDATE {{table}} SET `password` = '" . md5 ($_POST['md5q']) . "' WHERE `username` = '".$_POST['user']."';", 'users');
	}

	display( parsetemplate( gettemplate("admin/changepassword"), $parse), "Admin CP - Cambiar contraseña", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}
?>