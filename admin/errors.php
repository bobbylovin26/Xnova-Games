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

includeLang('admin');
$parse = $lang;

	if ($user['authlevel'] >= 3) {

		// Supprimer les erreurs
		extract($_GET);
		if (isset($delete)) {
			doquery("DELETE FROM {{table}} WHERE `error_id`=$delete", 'errors');
		} elseif ($deleteall == 'yes') {
			doquery("TRUNCATE TABLE {{table}}", 'errors');
		}

		// Afficher les erreurs
		$query = doquery("SELECT * FROM {{table}}", 'errors');
		$i = 0;
		while ($u = mysql_fetch_array($query)) {
			$i++;
			$parse['errors_list'] .= "
			<tr><td width=\"25\" class=n>". $u['error_id'] ."</td>
			<td width=\"170\" class=n>". $u['error_type'] ."</td>
			<td width=\"230\" class=n>". date('d/m/Y h:i:s', $u['error_time']) ."</td>
			<td width=\"95\" class=n><a href=\"?delete=". $u['error_id'] ."\"><img src=\"../images/r1.png\"></a></td></tr>
			<tr><td colspan=\"4\" class=b>".  nl2br($u['error_text'])."</td></tr>";
		}
		$parse['errors_list'] .= "<tr>
			<th class=b colspan=5>". $i ." ". $lang['adm_er_nbs'] ."</th>
		</tr>";

		display(parsetemplate(gettemplate('admin/errors_body'), $parse), "Bledy", false, '', true);
	} else {
		message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}

?>
