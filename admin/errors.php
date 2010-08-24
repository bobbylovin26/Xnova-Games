<?php

/**
 * errors.php
 *
 * @version 2.0
 * @copyright 2008 by e-Zobar for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = '../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] >= 3)
{
	extract($_GET);

	if (isset($delete))
		doquery("DELETE FROM {{table}} WHERE `error_id`=$delete", 'errors');
	elseif ($deleteall == 'yes')
		doquery("TRUNCATE TABLE {{table}}", 'errors');

	$query = doquery("SELECT * FROM {{table}}", 'errors');

	$i = 0;

	while ($u = mysql_fetch_array($query))
	{
		$i++;

		$parse['errors_list'] .= "

		<tr><td width=\"25\" class=n>". $u['error_id'] ."</td>
		<td width=\"170\" class=n>". $u['error_type'] ."</td>
		<td width=\"230\" class=n>". date('d/m/Y h:i:s', $u['error_time']) ."</td>
		<td width=\"95\" class=n><a href=\"?delete=". $u['error_id'] ."\"><img src=\"../images/r1.png\"></a></td></tr>
		<tr><td colspan=\"4\" class=b>".  nl2br($u['error_text'])."</td></tr>";
	}

	$parse['errors_list'] .= "<tr><th class=b colspan=5>". $i ." error/es</th></tr>";

	display(parsetemplate(gettemplate('admin/errors_body'), $parse), "Admin CP - Lista de errores", false, '', true, false);
}
else
{
	message ("No tienes permisos suficientes", "¡Error!");
}

?>