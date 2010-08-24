<?php

/**
 * officier.php
 *
 * @version 1.1
 * @copyright 2008 By Tom1991 for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);

function ShowOfficierPage ( &$CurrentUser ) {
	global $lang, $resource, $reslist, $_GET;

	includeLang('officier');

	// Aqui vemos que el jugador no tenga la materia oscura en negativa, y de ser asi, la ponemos en 0 (BY lucky Xtreme-gameZ.com.ar DarkMatter ADD-ON)
	if ($CurrentUser['darkmatter'] < 0) {
		doquery("UPDATE {{table}} SET `darkmatter` = '0' WHERE `id` = '". $CurrentUser['id'] ."';", 'users');
	}

	// Si recrutement d'un officier
	if ($_GET['mode'] == 2) {
		if ((floor($CurrentUser['darkmatter'] / 1000)) > 0) {
			$Selected    = $_GET['offi'];
			if ( in_array($Selected, $reslist['officier']) ) {
				$Result = IsOfficierAccessible ( $CurrentUser, $Selected );
				if ( $Result == 1 ) {
					$CurrentUser[$resource[$Selected]] += 1;
					$CurrentUser['darkmatter']         -= 1000;
					if       ($Selected == 610) {
						$CurrentUser['spy_tech']      += 5;
					} elseif ($Selected == 611) {
						$CurrentUser['computer_tech'] += 3;
					}

					// CAMBIE ALGUNOS VALORES Y LOS ADAPTE A LA MATERIA OSCURA (BY lucky Xtreme-gameZ.com.ar DarkMatter ADD-ON)
					$QryUpdateUser  = "UPDATE {{table}} SET ";
					$QryUpdateUser .= "`darkmatter` = '". $CurrentUser['darkmatter'] ."', ";
					$QryUpdateUser .= "`".$resource[$Selected]."` = '". $CurrentUser[$resource[$Selected]] ."' ";
					$QryUpdateUser .= "WHERE ";
					$QryUpdateUser .= "`id` = '". $CurrentUser['id'] ."';";
					doquery( $QryUpdateUser, 'users' );
					$Message = $lang['OffiRecrute'];
				} elseif ( $Result == -1 ) {
					$Message = $lang['Maxlvl'];
				} elseif ( $Result == 0 ) {
					$Message = $lang['Noob'];
				}
			}
		} else {
			$Message = $lang['NoPoints'];
		}

		message($Message,$lang['Officier'], 'officier.php', '2');

	} else {
		// Pas de recrutement d'officier
		$PageTPL = gettemplate('officier_body');
		$RowsTPL = gettemplate('officier_rows');
		$parse['off_points']   = $lang['off_points'];
		$parse['alv_points']   = floor($CurrentUser['darkmatter'] / 1000);
		$parse['disp_off_tbl'] = "";
		for ( $Officier = 601; $Officier <= 615; $Officier++ ) {
			$Result = IsOfficierAccessible ( $CurrentUser, $Officier );
			if ( $Result != 0 ) {
				$bloc['off_id']       = $Officier;
				$bloc['off_tx_lvl']   = $lang['off_tx_lvl'];
				$bloc['off_lvl']      = $CurrentUser[$resource[$Officier]];
				$bloc['off_desc']     = $lang['Desc'][$Officier];
				if ($Result == 1) {
					$bloc['off_link'] = "<a href=\"officier.php?mode=2&offi=".$Officier."\"><font color=\"#00ff00\">". $lang['link'][$Officier]."</font>";
				} else {
					$bloc['off_link'] = $lang['Maxlvl'];
				}
				$parse['disp_off_tbl'] .= parsetemplate( $RowsTPL, $bloc );
			}
		}
		$page           = parsetemplate( $PageTPL, $parse);
	}

	return $page;
}

	$page = ShowOfficierPage ( $user );
	display($page, $lang['officier']);
?>