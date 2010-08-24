<?php

/**
 * encripter.php
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
		$parse['md5_md5'] = $_POST['md5q'];
		$parse['md5_enc'] = md5 ($_POST['md5q']);
	}
	else
	{
		$parse['md5_md5'] = "";
		$parse['md5_enc'] = md5 ("");
	}
	display(parsetemplate( gettemplate("admin/encripter"), $parse), "Admin CP - Encriptador", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>