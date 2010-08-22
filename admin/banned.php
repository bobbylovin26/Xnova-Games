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
		includeLang('admin');

		$mode      = $_POST['mode'];

		$PageTpl   = gettemplate("admin/banned");

		$parse     = $lang;
		if ($mode == 'banit') {
			$name              = $_POST['name'];
			$reas              = $_POST['why'];
			$days              = $_POST['days'];
			$hour              = $_POST['hour'];
			$mins              = $_POST['mins'];
			$secs              = $_POST['secs'];

			$admin             = $user['username'];
			$mail              = $user['email'];

			$Now               = time();
			$BanTime           = $days * 86400;
			$BanTime          += $hour * 3600;
			$BanTime          += $mins * 60;
			$BanTime          += $secs;
			$BannedUntil       = $Now + $BanTime;

			$QryInsertBan      = "INSERT INTO {{table}} SET ";
			$QryInsertBan     .= "`who` = \"". $name ."\", ";
			$QryInsertBan     .= "`theme` = '". $reas ."', ";
			$QryInsertBan     .= "`who2` = '". $name ."', ";
			$QryInsertBan     .= "`time` = '". $Now ."', ";
			$QryInsertBan     .= "`longer` = '". $BannedUntil ."', ";
			$QryInsertBan     .= "`author` = '". $admin ."', ";
			$QryInsertBan     .= "`email` = '". $mail ."';";
			doquery( $QryInsertBan, 'banned');

			$QryUpdateUser     = "UPDATE {{table}} SET ";
			$QryUpdateUser    .= "`bana` = '1', ";
			$QryUpdateUser    .= "`banaday` = '". $BannedUntil ."' ";
			$QryUpdateUser    .= "WHERE ";
			$QryUpdateUser    .= "`username` = \"". $name ."\";";
			doquery( $QryUpdateUser, 'users');

			$DoneMessage       = $lang['adm_bn_thpl'] ." ". $name ." ". $lang['adm_bn_isbn'];
			AdminMessage ($DoneMessage, $lang['adm_bn_ttle']);
		}

		$Page = parsetemplate($PageTpl, $parse);
		display( $Page, $lang['adm_bn_ttle'], false, '', true);
	} else {
		AdminMessage ($lang['sys_noalloaw'], $lang['sys_noaccess']);
	}

?>