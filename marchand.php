<?php

/**
 * marchand.php
 *
 * @version 1.3 (re-agregado) test
 * @copyright 2008 by Chlorel for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);

// blocking non-users
if ($IsUserChecked == false) {
	includeLang('login');
	message($lang['Login_Ok'], $lang['log_numbreg']);
}

includeLang('marchand');

$parse = $lang;

if (isset($_POST['ress']) && $_POST['ress'] != '')
{
	$template = gettemplate('message_body');



	
	switch ($_POST['ress']) {
		
		case 'metal': {
			
			if (preg_match("/[0-9]/", $_POST['cristal']) <> 1) {




				message($lang['mod_ma_only_nbre'], $lang['mod_ma_error']);
			}



			
			if (preg_match("/[0-9]/", $_POST['deut']) <> 1) {
				message($lang['mod_ma_only_nbre'], $lang['mod_ma_error']);
			}



			
			if ($_POST['cristal'] < 0 || $_POST['deut'] < 0) {
				message($lang['mod_ma_fail'], $lang['mod_ma_error']);
			} else {
				$necessaire   = (($_POST['cristal'] * 2) + ($_POST['deut'] * 4));
				
				if ($planetrow['metal'] > $necessaire) {
					
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`metal` = `metal` - ".round($necessaire).", ";
					$QryUpdatePlanet .= "`crystal` = `crystal` + ".round($_POST['cristal']).", ";
					$QryUpdatePlanet .= "`deuterium` = `deuterium` + ".round($_POST['deut'])." ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".$planetrow['id']."';";
					
					doquery($QryUpdatePlanet , 'planets');
					
					$planetrow['metal']     -= $necessaire;
					$planetrow['cristal']   += $_POST['cristal'];
					$planetrow['deuterium'] += $_POST['deut'];
					
				} else {
					message($lang['mod_ma_noten'] ." ". $lang['Metal'] ."! ", $lang['mod_ma_error']);
				}








			}

			
		break; }
		
		case 'cristal': {





			
			if (preg_match("/[0-9]/", $_POST['metal'])<> 1) {
				message($lang['mod_ma_only_nbre'], $lang['mod_ma_error']);
			}

			






			if (preg_match("/[0-9]/", $_POST['deut'])<> 1) {
				message($lang['mod_ma_only_nbre'], $lang['mod_ma_error']);
			}

			
			if ($_POST['metal'] < 0 || $_POST['deut'] < 0) {
				message($lang['mod_ma_fail'], $lang['mod_ma_error']);
			} else {
				$necessaire   = ((abs($_POST['metal']) * 0.5) + (abs($_POST['deut']) * 2));
				
				if ($planetrow['crystal'] > $necessaire) {
					
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`metal` = `metal` + ".round($_POST['metal']).", ";
					$QryUpdatePlanet .= "`crystal` = `crystal` - ".round($necessaire).", ";
					$QryUpdatePlanet .= "`deuterium` = `deuterium` + ".round($_POST['deut'])." ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".$planetrow['id']."';";
					
					doquery($QryUpdatePlanet , 'planets');
					
					$planetrow['metal']     += $_POST['metal'];
					$planetrow['cristal']   -= $necessaire;
					$planetrow['deuterium'] += $_POST['deut'];
					
				} else {
					message($lang['mod_ma_noten'] ." ". $lang['Crystal'] ."! ", $lang['mod_ma_error']);
				}
			}









			
		break; }
		
		case 'deuterium': {
			
			if (preg_match("/[0-9]/", $_POST['metal']) <> 1) {
				message($lang['mod_ma_only_nbre'], $lang['mod_ma_error']);
			}
			
			if (preg_match("/[0-9]/", $_POST['cristal']) <> 1) {
				message($lang['mod_ma_only_nbre'], $lang['mod_ma_error']);
			}
			
			if ($_POST['cristal'] < 0 || $_POST['metal'] < 0) {
				message($lang['mod_ma_fail'], $lang['mod_ma_error']);
			} else {
				$necessaire   = ((abs($_POST['metal']) * 0.25) + (abs($_POST['cristal']) * 0.5));
				
				if ($planetrow['deuterium'] > $necessaire) {
					
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`metal` = `metal` + ".round($_POST['metal']).", ";
					$QryUpdatePlanet .= "`crystal` = `crystal` + ".round($_POST['cristal']).", ";
					$QryUpdatePlanet .= "`deuterium` = `deuterium` - ".round($necessaire)." ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".$planetrow['id']."';";
					
					doquery($QryUpdatePlanet , 'planets');




					
					$planetrow['metal']     += $_POST['metal'];
					$planetrow['cristal']   += $_POST['cristal'];
					$planetrow['deuterium'] -= $necessaire;
					
				} else {
					message($lang['mod_ma_noten'] ." ". $lang['Deuterium'] ."! ", $lang['mod_ma_error']);
				}


			}
			
		break; }
	}
	
	message($lang['mod_ma_done'], $lang['mod_ma_donet']);
}
else
{
	
	if ($_POST['action'] != 2) {
		$template = gettemplate('marchand_main');
	} else {
		$parse['mod_ma_res'] = '1';
		
		switch ($_POST['choix']) {
			case 'metal':
				$template = gettemplate('marchand_metal');
				$parse['mod_ma_res_a'] = '2';
				$parse['mod_ma_res_b'] = '4';
			break;
			case 'cristal':
				$template = gettemplate('marchand_cristal');
				$parse['mod_ma_res_a'] = '0.5';
				$parse['mod_ma_res_b'] = '2';
			break;
			case 'deut':
				$template = gettemplate('marchand_deuterium');
				$parse['mod_ma_res_a'] = '0.25';
				$parse['mod_ma_res_b'] = '0.5';
			break;
		}
	}
}

$page = parsetemplate ( $template, $parse );




display($page, $lang['mod_marchand'], true, '', false);
?>