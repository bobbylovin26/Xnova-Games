<?php

/**
 * add_money.php
 *
 * @version 1.1
 * @copyright 2008 By Chlorel for XNova
 * portion to e-Zobar
 */


define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xnova_root_path = './../';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);

	if ($user['authlevel'] >= 2) {
		includeLang('admin');

		$mode      = $_POST['mode'];

		$PageTpl   = gettemplate("admin/add_money");
		$parse     = $lang;

		if ($mode == 'addit') {
			$id          = $_POST['id'];
			$metal       = $_POST['metal'];
			$cristal     = $_POST['cristal'];
			$deut        = $_POST['deut'];
			$dark		 = $_POST['dark'];
			$QryUpdatePlanet  = "UPDATE {{table}} SET ";
			$QryUpdatePlanet .= "`metal` = `metal` + '". $metal ."', ";
			$QryUpdatePlanet .= "`crystal` = `crystal` + '". $cristal ."', ";
			$QryUpdatePlanet .= "`deuterium` = `deuterium` + '". $deut ."' ";
			$QryUpdatePlanet .= "WHERE ";
			$QryUpdatePlanet .= "`id` = '". $id ."' ";
			doquery( $QryUpdatePlanet, "planets");


			$QryUpdateUser  = "UPDATE {{table}} SET ";
			$QryUpdateUser .= "`darkmatter` = `darkmatter` + '". $dark ."' ";
			$QryUpdateUser .= "WHERE ";
			$QryUpdateUser .= "`id` = '". $id ."' ";
			doquery( $QryUpdateUser, "users");

			message ( $lang['adm_am_done'], $lang['adm_am_ttle'] );
		}
		$Page = parsetemplate($PageTpl, $parse);

		display ($Page, $lang['adm_am_ttle'], false, '', true);
	} else {
		message ( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}

?>