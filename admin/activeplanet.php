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

		$parse          = $lang;
		$parse['dpath'] = $dpath;
		$parse['mf']    = $mf;

		$PageTPL        = gettemplate('admin/activeplanet_body');
		$AllActivPlanet = doquery("SELECT * FROM {{table}} WHERE `last_update` >= '". (time()-15 * 60) ."' ORDER BY `id` ASC", 'planets');
		$Count          = 0;

		while ($ActivPlanet = mysql_fetch_array($AllActivPlanet)) {
			$parse['online_list'] .= "<tr>";
			$parse['online_list'] .= "<td class=b><center><b>". $ActivPlanet['name'] ."</b></center></td>";
			$parse['online_list'] .= "<td class=b><center><b>[". $ActivPlanet['galaxy'] .":". $ActivPlanet['system'] .":". $ActivPlanet['planet'] ."]</b></center></td>";
			$parse['online_list'] .= "<td class=m><center><b>". pretty_number($ActivPlanet['points'] / 1000) ."</b></center></td>";
			$parse['online_list'] .= "<td class=b><center><b>". pretty_time(time() - $ActivPlanet['last_update']) . "</b></center></td>";
			$parse['online_list'] .= "</tr>";
			$Count++;
		}
		$parse['online_list'] .= "<tr>";
		$parse['online_list'] .= "<th class=\"b\" colspan=\"4\">". $lang['adm_pl_they'] ." ". $Count ." ". $lang['adm_pl_apla'] ."</th>";
		$parse['online_list'] .= "</tr>";

		$page = parsetemplate( $PageTPL	, $parse );
		display( $page, $lang['adm_pl_title'], false, '', true );
	} else {
		message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}

?>