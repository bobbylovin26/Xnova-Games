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
define('IN_ADMIN', true);
require_once dirname(__FILE__) .'./../common.php';

	if ($user['authlevel'] >= 1) {
		if ($_POST && $mode == "change") {
			if (isset($_POST["tresc"]) && $_POST["tresc"] != '') {
				$game_config['tresc'] = $_POST['tresc'];
			}
			if (isset($_POST["temat"]) && $_POST["temat"] != '') {
				$game_config['temat'] = $_POST['temat'];
			}
			if ($user['authlevel'] == 3) {
				$kolor = 'red';
				$ranga = 'Administrator';
			} elseif ($user['authlevel'] == 4) {
				$kolor = 'skyblue';
				$ranga = 'GameOperator';
			} elseif ($user['authlevel'] == 5) {
				$kolor = 'yellow';
				$ranga = 'SuperGameOperator';
			}
			if ($game_config['tresc'] != '' and $game_config['temat']) {
				$sq      = doquery("SELECT `id` FROM {{table}}", "users");
				$Time    = time();
				$From    = "<font color=\"". $kolor ."\">". $ranga ." ".$user['username']."</font>";
				$Subject = "<font color=\"". $kolor ."\">". $game_config['temat'] ."</font>";
				$Message = "<font color=\"". $kolor ."\"><b>". $game_config['tresc'] ."</b></font>";
				while ($u = mysql_fetch_array($sq)) {
					SendSimpleMessage ( $u['id'], $user['id'], $Time, 97, $From, $Subject, $Message);
				}
				message("<font color=\"lime\">Wys�a�e� wiadomo�� do wszystkich graczy</font>", "Complete", "../overview." . PHPEXT, 3);
			}
		} else {
			$parse = $game_config;
			$parse['dpath'] = $dpath;
			$parse['debug'] = ($game_config['debug'] == 1) ? " checked='checked'/":'';
			$page .= parsetemplate(gettemplate('admin/messall_body'), $parse);
			display($page, '', false,'', true);
		}
	} else {
		message($lang['sys_noalloaw'], $lang['sys_noaccess']);
	}
?>