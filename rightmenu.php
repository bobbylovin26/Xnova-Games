<?php

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

function ShowLeftMenu ( $Level , $Template = 'right_menu') {
	global $game_config;

	$parse['lm_tx_serv']      = $game_config['resource_multiplier'];
	$parse['lm_tx_game']      = $game_config['game_speed'] / 2500;
	$parse['lm_tx_fleet']     = $game_config['fleet_speed'] / 2500;
	$parse['lm_tx_queue']     = MAX_FLEET_OR_DEFS_PER_ROW;
	$parse['forum_url']       = $game_config['forum_url'];
	$parse['servername']   	  = $game_config['game_name'];

	if ($Level > 0) {
		$parse['admin_link']  = "
		<tr>
			<th colspan=\"2\"><div><a href=\"javascript:top.location.href='admin/index.php'\"><font color=\"lime\">Administrador</font></a></div></th>
		</tr>";
	} else {
		$parse['admin_link']  = "";
	}

	$Menu                  = parsetemplate(gettemplate($Template), $parse);

	return $Menu;
}
	$Menu = ShowLeftMenu ( $user['authlevel'] );
	display ( $Menu, "Menu Derecho", '', false );
?>
