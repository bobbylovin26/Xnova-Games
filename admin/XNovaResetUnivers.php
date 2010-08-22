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

function XNovaResetUnivers ( $CurrentUser ) {
	global $lang;

	if ($CurrentUser['authlevel'] >= 3) {

		// Copier la table users et planets vers des tables de replis !
		doquery( "RENAME TABLE {{table}} TO {{table}}_s", 'planets' );
		doquery( "RENAME TABLE {{table}} TO {{table}}_s", 'users' );

		// Recreer la structure des tables renommées
		doquery( "CREATE  TABLE IF NOT EXISTS {{table}} ( LIKE {{table}}_s );", 'planets');
		doquery( "CREATE  TABLE IF NOT EXISTS {{table}} ( LIKE {{table}}_s );", 'users');

		// Vider toutes les tables !
		doquery( "TRUNCATE TABLE {{table}}", 'aks');
		doquery( "TRUNCATE TABLE {{table}}", 'alliance');
		doquery( "TRUNCATE TABLE {{table}}", 'annonce');
		doquery( "TRUNCATE TABLE {{table}}", 'banned');
		doquery( "TRUNCATE TABLE {{table}}", 'buddy');
		doquery( "TRUNCATE TABLE {{table}}", 'chat');
		doquery( "TRUNCATE TABLE {{table}}", 'galaxy');
		doquery( "TRUNCATE TABLE {{table}}", 'errors');
		doquery( "TRUNCATE TABLE {{table}}", 'fleets');
		doquery( "TRUNCATE TABLE {{table}}", 'iraks');
		doquery( "TRUNCATE TABLE {{table}}", 'lunas');
		doquery( "TRUNCATE TABLE {{table}}", 'messages');
		doquery( "TRUNCATE TABLE {{table}}", 'notes');
		doquery( "TRUNCATE TABLE {{table}}", 'rw');
		doquery( "TRUNCATE TABLE {{table}}", 'statpoints');

		$AllUsers  = doquery ("SELECT `username`,`password`,`email`, `email_2`,`authlevel`,`galaxy`,`system`,`planet`, `sex`, `dpath`, `onlinetime`, `register_time`, `id_planet` FROM {{table}} WHERE 1;", 'users_s');
		$LimitTime = time() - (15 * (24 * (60 * 60)));
		$TransUser = 0;
		while ( $TheUser = mysql_fetch_assoc($AllUsers) ) {
			if ( $TheUser['onlinetime'] > $LimitTime ) {
				$UserPlanet     = doquery ("SELECT `name` FROM {{table}} WHERE `id` = '". $TheUser['id_planet']."';", 'planets_s', true);
				if ($UserPlanet['name'] != "") {
					// Creation de l'utilisateur
					$QryInsertUser  = "INSERT INTO {{table}} SET ";
					$QryInsertUser .= "`username` = '".      $TheUser['username']      ."', ";
					$QryInsertUser .= "`email` = '".         $TheUser['email']         ."', ";
					$QryInsertUser .= "`email_2` = '".       $TheUser['email_2']       ."', ";
					$QryInsertUser .= "`sex` = '".           $TheUser['sex']           ."', ";
					$QryInsertUser .= "`id_planet` = '0', ";
					$QryInsertUser .= "`authlevel` = '".     $TheUser['authlevel']     ."', ";
					$QryInsertUser .= "`dpath` = '".         $TheUser['dpath']         ."', ";
					$QryInsertUser .= "`galaxy` = '".        $TheUser['galaxy']        ."', ";
					$QryInsertUser .= "`system` = '".        $TheUser['system']        ."', ";
					$QryInsertUser .= "`planet` = '".        $TheUser['planet']        ."', ";
					$QryInsertUser .= "`register_time` = '". $TheUser['register_time'] ."', ";
					$QryInsertUser .= "`password` = '".      $TheUser['password']      ."';";
					doquery( $QryInsertUser, 'users');

					// On cherche le numero d'enregistrement de l'utilisateur fraichement cr��
					$NewUser        = doquery("SELECT `id` FROM {{table}} WHERE `username` = '". $TheUser['username'] ."' LIMIT 1;", 'users', true);

					CreateOnePlanetRecord ($TheUser['galaxy'], $TheUser['system'], $TheUser['planet'], $NewUser['id'], $UserPlanet['name'], true);
					// Recherche de la reference de la nouvelle planete (qui est unique normalement !
					$PlanetID       = doquery("SELECT `id` FROM {{table}} WHERE `id_owner` = '". $NewUser['id'] ."' LIMIT 1;", 'planets', true);

					// Mise a jour de l'enregistrement utilisateur avec les infos de sa planete mere
					$QryUpdateUser  = "UPDATE {{table}} SET ";
					$QryUpdateUser .= "`id_planet` = '".      $PlanetID['id'] ."', ";
					$QryUpdateUser .= "`current_planet` = '". $PlanetID['id'] ."' ";
					$QryUpdateUser .= "WHERE ";
					$QryUpdateUser .= "`id` = '".             $NewUser['id']  ."';";
					doquery( $QryUpdateUser, 'users');
					$TransUser++;
				}
			}
		} // while
		// Mise a jour du nombre de joueurs inscripts
		doquery("UPDATE {{table}} SET `config_value` = '". $TransUser ."' WHERE `config_name` = 'users_amount' LIMIT 1;", 'config');

		// Menage on vire les tables transitoires
		doquery("DROP TABLE {{table}}", 'planets_s');
		doquery("DROP TABLE {{table}}", 'users_s');

		AdminMessage ( $TransUser . $lang['adm_rz_done'], $lang['adm_rz_ttle'] );
	} else {
		AdminMessage ( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}
	return $Page;
}

	$mode      = $_POST['mode'];
	$PageTpl   = gettemplate("admin/reset_body");
	$parse     = $lang;

	if ($mode == 'reset') {
		XNovaResetUnivers ( $user );
	} else {
		$Page = parsetemplate($PageTpl, $parse);
		display ($Page, $lang['Reset'], false, '', true);
	}

?>