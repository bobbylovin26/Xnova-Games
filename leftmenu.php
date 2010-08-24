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

function ShowLeftMenu ( $Level , $Template = 'left_menu') {
	global $game_config;

	$parse['version']   	= VERSION;
	$parse['servername']	= $game_config['game_name'];
	$parse['lm_tx_serv']	= $game_config['resource_multiplier'];
	$parse['lm_tx_game']    = $game_config['game_speed'] / 2500;
	$parse['lm_tx_fleet']   = $game_config['fleet_speed'] / 2500;
	$parse['lm_tx_queue']   = MAX_FLEET_OR_DEFS_PER_ROW;
	$parse['forum_url']     = $game_config['forum_url'];
	$parse['servername']   	= $game_config['game_name'];

	if ($Level > 0) {
		$parse['admin_link']  = "
<tr>
	<td colspan=\"2\"><div><a href=\"javascript:top.location.href='admin/index.php'\" <font color=\"lime\">Administración</font></a></div></td>
</tr>";
	} else {
		$parse['admin_link']  = "";
	}

	$Menu                  = parsetemplate(gettemplate($Template), $parse);

	return $Menu;
}
	$Menu = ShowLeftMenu ( $user['authlevel'] );
	display ( $Menu, "Menu Izquierdo", '', false );
?>