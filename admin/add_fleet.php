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
		includeLang('admin/add_fleet');
		$mode = $_GET['mode'];

		if($mode != 'add') {
			$parse['ID']     = $lang['Id'];
			$parse['Cle']    = $lang['cle'];
			$parse['Clourd'] = $lang['clourd'];
			$parse['Pt']     = $lang['pt'];
			$parse['Gt']     = $lang['gt'];
			$parse['Cruise'] = $lang['cruise'];
			$parse['Vb']     = $lang['vb'];
			$parse['Colo']   = $lang['colo'];
			$parse['Rc']     = $lang['rc'];
			$parse['Spy']    = $lang['spy'];
			$parse['Bomb']   = $lang['bomb'];
			$parse['Solar']  = $lang['solar'];
			$parse['Des']    = $lang['des'];
			$parse['Rip']    = $lang['rip'];
			$parse['Traq']   = $lang['traq'];

		} elseif($mode == 'add') {
			$id     = $_POST['id'];
			$cle    = $_POST['cle'];
			$clourd = $_POST['clourd'];
			$pt     = $_POST['pt'];
			$gt     = $_POST['gt'];
			$cruise = $_POST['cruise'];
			$vb     = $_POST['vb'];
			$colo   = $_POST['colo'];
			$rc     = $_POST['rc'];
			$spy    = $_POST['spy'];
			$bomb   = $_POST['bomb'];
			$solar  = $_POST['solar'];
			$des    = $_POST['des'];
			$rip    = $_POST['rip'];
			$traq   = $_POST['traq'];

			$SqlAdd = "UPDATE {{table}} SET";
			$SqlAdd .= "`light_hunter` = '".$cle."+light_hunter', ";
			$SqlAdd .= "`heavy_hunter` = '".$clourd."+heavy_hunter', ";
			$SqlAdd .= "`small_ship_cargo` = '".$pt."+small_ship_cargo', ";
			$SqlAdd .= "`big_ship_cargo` = '".$gt."+big_ship_cargo', ";
			$SqlAdd .= "`crusher` = '".$cruise."+crusher', ";
			$SqlAdd .= "`battle_ship` = '".$vb."+battle_ship', ";
			$SqlAdd .= "`colonizer` = '".$colo."+colonizer', ";
			$SqlAdd .= "`recycler` = '".$rc."+recycler', ";
			$SqlAdd .= "`spy_sonde`= '".$spy."+spy_sonde', ";
			$SqlAdd .= "`bomber_ship` = '".$bomb."+bomber_ship', ";
			$SqlAdd .= "`solar_satelit` = '".$solar."+solar_satelit', ";
			$SqlAdd .= "`destructor` = '".$des."+destructor', ";
			$SqlAdd .= "`dearth_star` = '".$rip."+dearth_star', ";
			$SqlAdd .= "`battleship` = '".$traq."+battleship', ";
			$SqlAdd .= " WHERE `id` = '".$id."' LIMIT 1";
			doquery($SqlAdd, "planets");
			message('Ajout OK');
		}

		$page = parsetemplate(gettemplate('admin/add_fleet'), $parse);
		display( $page);

	} else {
		message( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}

?>