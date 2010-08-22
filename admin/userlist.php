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
	if ($user['authlevel'] >= 2) {
		includeLang('admin');
		if ($_GET['cmd'] == 'dele') {
			DeleteSelectedUser ( $_GET['user'] );
		}
		if ($_GET['cmd'] == 'sort') {
			$TypeSort = $_GET['type'];
		} else {
			$TypeSort = "id";
		}

		$PageTPL = gettemplate('admin/userlist_body');
		$RowsTPL = gettemplate('admin/userlist_rows');

		$query   = doquery("SELECT * FROM {{table}} ORDER BY `". $TypeSort ."` ASC", 'users');

		$parse                 = $lang;
		$parse['adm_ul_table'] = "";
		$i                     = 0;
		$Color                 = "lime";
		while ($u = mysql_fetch_assoc ($query) ) {
			if ($PrevIP != "") {
				if ($PrevIP == $u['user_lastip']) {
					$Color = "red";
				} else {
					$Color = "lime";
				}
			}

			
			
			
			
			$Bloc['adm_ul_data_id']     = $u['id'];
			$Bloc['adm_ul_data_name']   = $u['username'];
			$Bloc['adm_ul_data_mail']   = $u['email'];
			$Bloc['ip_adress_at_register']   = $u['ip_at_reg'];
			$Bloc['adm_ul_data_adip']   = "<font color=\"".$Color."\">". $u['user_lastip'] ."</font>";
			$Bloc['adm_ul_data_regd']   = gmdate ( "d/m/Y G:i:s", $u['register_time'] );
			$Bloc['adm_ul_data_lconn']  = gmdate ( "d/m/Y G:i:s", $u['onlinetime'] );
			$Bloc['adm_ul_data_banna']  = ( $u['bana'] == 1 ) ? "<a href # title=\"". gmdate ( "d/m/Y G:i:s", $u['banaday']) ."\">". $lang['adm_ul_yes'] ."</a>" : $lang['adm_ul_no'];
			$Bloc['adm_ul_data_detai']  = ""; // Lien vers une page de details genre Empire
			$Bloc['adm_ul_data_actio']  = "<a href=\"userlist.php?cmd=dele&user=".$u['id']."\"><img src=\"../images/r1.png\"></a>"; // Lien vers actions 'effacer'


			$PrevIP                     = $u['user_lastip'];
			$parse['adm_ul_table']     .= parsetemplate( $RowsTPL, $Bloc );
			$i++;
		}
		$parse['adm_ul_count'] = $i;

		$page = parsetemplate( $PageTPL, $parse );
		display( $page, $lang['adm_ul_title'], false, '', true);
	} else {
		message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}

?>