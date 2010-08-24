<?PHP

/**
 * leftmenu.php (ADMIN)
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xnova_root_path = './../';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.'.$phpEx);

if ($user['authlevel'] >= "1")
{
	display( parsetemplate(gettemplate('admin/left_menu'), $parse), "", false, '', true);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>
