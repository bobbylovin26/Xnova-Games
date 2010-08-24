<?PHP

/**
 * rightmenu.php
 *
 * @version 2.0
 * @copyright 2008 By Dr.Isaacs for XNova-Germany
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.'.$phpEx);

	// AQUI LO UNICO QUE MOSTRAMOS ES LA PLANTILLA, NOMBRE DEL SERVIDOR Y LA VERSION
	$parse['version']   	= VERSION;
	$parse['servername']	= $game_config['game_name'];

	display (parsetemplate(gettemplate('left_menu'), $parse), "Menu izquierdo", '', false );
?>
