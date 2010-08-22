<?php
/**
 * XNova Legacies
 *
 * @license http://www.xnova-ng.org/license-legacies
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *  - Neither the name of the team or any contributor may be used to endorse or
 * promote products derived from this software without specific prior written
 * permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

define('INSIDE' , true);
define('INSTALL' , false);
require_once dirname(__FILE__) .'/common.php';

function ShowLeftMenu ( $Level , $Template = 'left_menu') {
	global $lang, $dpath, $game_config;

	includeLang('leftmenu');

	$MenuTPL                  = gettemplate( $Template );
	$InfoTPL                  = gettemplate( 'serv_infos' );
	$parse                    = $lang;
	$parse['lm_tx_serv']      = $game_config['resource_multiplier'];
	$parse['lm_tx_game']      = $game_config['game_speed'] / 2500;
	$parse['lm_tx_fleet']     = $game_config['fleet_speed'] / 2500;
	$parse['lm_tx_queue']     = MAX_FLEET_OR_DEFS_PER_ROW;
	$SubFrame                 = parsetemplate( $InfoTPL, $parse );
	$parse['server_info']     = $SubFrame;
	$parse['XNovaRelease']    = VERSION;
	$parse['dpath']           = $dpath;
	$parse['forum_url']       = $game_config['forum_url'];
	$parse['mf']              = "Hauptframe";
	$rank                     = doquery("SELECT `total_rank` FROM {{table}} WHERE `stat_code` = '1' AND `stat_type` = '1' AND `id_owner` = '". $user['id'] ."';",'statpoints',true);
	$parse['user_rank']       = $rank['total_rank'];
	if ($Level > 0) {
		$parse['ADMIN_LINK']  = "
		<tr>
			<td colspan=\"2\"><div><a href=\"admin/leftmenu.php\"><font color=\"lime\">".$lang['user_level'][$Level]."</font></a></div></td>
		</tr>";
	} else {
		$parse['ADMIN_LINK']  = "";
	}
	//Lien supplémentaire déterminé dans le panel admin
	if ($game_config['link_enable'] == 1) {
		$parse['added_link']  = "
		<tr>
			<td colspan=\"2\"><div><a href=\"".$game_config['link_url']."\" target=\"_blank\">".stripslashes($game_config['link_name'])."</a></div></td>
		</tr>";
	} else {
		$parse['added_link']  = "";
	}
	
	//Maintenant on vérifie si les annonces sont activées ou non
	if ($game_config['enable_announces'] == 1) {
		$parse['announce_link']  = "
		<tr>
			<td colspan=\"2\"><div><a href=\"annonce.php\" target=\"Hauptframe\">Annonces</a></div></td>
		</tr>";
	} else {
		$parse['announce_link']  = "";
	}
	
		//Maintenant le marchand
	if ($game_config['enable_marchand'] == 1) {
		$parse['marchand_link']  = "
			<td colspan=\"2\"><div><a href=\"marchand.php\" target=\"Hauptframe\">Marchand</a></div></td>";
	} else {
		$parse['marchand_link']  = "";
	}
			//Maintenant les notes
	if ($game_config['enable_notes'] == 1) {
		$parse['notes_link']  = "
		<tr>
			<td colspan=\"2\"><div><a href=\"#\" onClick=\"f(\'notes.php\', \'Report\');\" accesskey=\"n\">Notes</a></div></td>
		</tr>";
	} else {
		$parse['notes_link']  = "";
	}
	$parse['servername']   = $game_config['game_name'];
	$Menu                  = parsetemplate( $MenuTPL, $parse);

	return $Menu;
}
	$Menu = ShowLeftMenu ( $user['authlevel'] );
	display ( $Menu, "Menu", '', false );

// -----------------------------------------------------------------------------------------------------------
// History version
// 1.0 - Passage en fonction pour XNova version future
// 1.1 - Modification pour gestion Admin / Game OP / Modo
?>
