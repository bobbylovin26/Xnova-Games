<?PHP

/**
 * menu.php
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
include($xgp_root . 'common.'.$phpEx);

if ($user['authlevel'] >= 1)
{
	display( parsetemplate(gettemplate('admin/menu'), $parse), "", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>
