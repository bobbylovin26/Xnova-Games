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
includeLang('credit');
$parse   = $lang;

if ($user['authlevel'] >= 3) {
	if ($_POST['opt_save'] == "1") {
		// Extended copyright is activated?
		if (isset($_POST['ExtCopyFrame']) && $_POST['ExtCopyFrame'] == 'on') {
			$game_config['ExtCopyFrame'] = "1";
			$game_config['ExtCopyOwner'] = $_POST['ExtCopyOwner'];
			$game_config['ExtCopyFunct'] = $_POST['ExtCopyFunct'];
		} else {
			$game_config['ExtCopyFrame'] = "0";
			$game_config['ExtCopyOwner'] = "";
			$game_config['ExtCopyFunct'] = "";
		}

		// Update values
		doquery("UPDATE {{table}} SET `config_value` = '". $game_config['ExtCopyFrame'] ."' WHERE `config_name` = 'ExtCopyFrame';", 'config');
		doquery("UPDATE {{table}} SET `config_value` = '". $game_config['ExtCopyOwner'] ."' WHERE `config_name` = 'ExtCopyOwner';", 'config');
		doquery("UPDATE {{table}} SET `config_value` = '". $game_config['ExtCopyFunct'] ."' WHERE `config_name` = 'ExtCopyFunct';", 'config');

		AdminMessage ($lang['cred_done'], $lang['cred_ext']);

	} else {
		//View values
		$parse['ExtCopyFrame'] = ($game_config['ExtCopyFrame'] == 1) ? " checked = 'checked' ":"";
		$parse['ExtCopyOwnerVal'] = $game_config['ExtCopyOwner'];
		$parse['ExtCopyFunctVal'] = $game_config['ExtCopyFunct'];

		$BodyTPL = gettemplate('admin/credit_body');
		$page = parsetemplate($BodyTPL, $parse);
		display($page, $lang['cred_credit'], false);
	}

} else {
	message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
}

?>