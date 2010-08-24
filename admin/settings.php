<?php

/**
 * settings.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

function DisplayGameSettingsPage ( $CurrentUser ) {
global $game_config, $_POST;

	if ( $CurrentUser['authlevel'] >= 3 )
	{
		if ($_POST['opt_save'] == "1")
		{
			if (isset($_POST['closed']) && $_POST['closed'] == 'on') {
			$game_config['game_disable']         = "1";
			$game_config['close_reason']         = addslashes( $_POST['close_reason'] );
			} else {
			$game_config['game_disable']         = "0";
			$game_config['close_reason']         = "";
			}

			if (isset($_POST['stat']) && $_POST['stat'] == 'on') {
			$game_config['stat']         = "1";
			$game_config['stat_level']         = addslashes( $_POST['stat_level'] );
			} else {
			$game_config['stat']         = "0";
			$game_config['stat_level']         = "";
			}

			if (isset($_POST['newsframe']) && $_POST['newsframe'] == 'on') {
			$game_config['OverviewNewsFrame']     = "1";
			$game_config['OverviewNewsText']      = addslashes( $_POST['NewsText'] );
			} else {
			$game_config['OverviewNewsFrame']     = "0";
			$game_config['OverviewNewsText']      = "";
			}

			if (isset($_POST['debug']) && $_POST['debug'] == 'on') {
			$game_config['debug'] = "1";
			} else {
			$game_config['debug'] = "0";
			}

			if (isset($_POST['game_name']) && $_POST['game_name'] != '') {
			$game_config['game_name'] = $_POST['game_name'];
			}

			if (isset($_POST['forum_url']) && $_POST['forum_url'] != '') {
			$game_config['forum_url'] = $_POST['forum_url'];
			}

			if (isset($_POST['game_speed']) && is_numeric($_POST['game_speed'])) {
			$game_config['game_speed'] = $_POST['game_speed'];
			}

			if (isset($_POST['fleet_speed']) && is_numeric($_POST['fleet_speed'])) {
			$game_config['fleet_speed'] = $_POST['fleet_speed'];
			}

			if (isset($_POST['resource_multiplier']) && is_numeric($_POST['resource_multiplier'])) {
			$game_config['resource_multiplier'] = $_POST['resource_multiplier'];
			}

			if (isset($_POST['initial_fields']) && is_numeric($_POST['initial_fields'])) {
			$game_config['initial_fields'] = $_POST['initial_fields'];
			}

			if (isset($_POST['metal_basic_income']) && is_numeric($_POST['metal_basic_income'])) {
			$game_config['metal_basic_income'] = $_POST['metal_basic_income'];
			}

			if (isset($_POST['crystal_basic_income']) && is_numeric($_POST['crystal_basic_income'])) {
			$game_config['crystal_basic_income'] = $_POST['crystal_basic_income'];
			}

			if (isset($_POST['deuterium_basic_income']) && is_numeric($_POST['deuterium_basic_income'])) {
			$game_config['deuterium_basic_income'] = $_POST['deuterium_basic_income'];
			}

			if (isset($_POST['energy_basic_income']) && is_numeric($_POST['energy_basic_income'])) {
			$game_config['energy_basic_income'] = $_POST['energy_basic_income'];
			}

			if (isset($_POST['stat_settings']) && is_numeric($_POST['stat_settings'])) {
			$game_config['stat_settings'] = $_POST['stat_settings'];
			}

			if (isset($_POST['bbcode_field']) && is_numeric($_POST['bbcode_field'])) {
			$game_config['enable_bbcode'] = $_POST['bbcode_field'];
			}

			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['game_disable']           ."' WHERE `config_name` = 'game_disable';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['close_reason']           ."' WHERE `config_name` = 'close_reason';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['stat_settings']          ."' WHERE `config_name` = 'stat_settings';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['stat']           		  ."' WHERE `config_name` = 'stat';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['stat_level']             ."' WHERE `config_name` = 'stat_level';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['game_name']              ."' WHERE `config_name` = 'game_name';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['forum_url']              ."' WHERE `config_name` = 'forum_url';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['game_speed']             ."' WHERE `config_name` = 'game_speed';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['fleet_speed']            ."' WHERE `config_name` = 'fleet_speed';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['resource_multiplier']    ."' WHERE `config_name` = 'resource_multiplier';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['OverviewNewsFrame']      ."' WHERE `config_name` = 'OverviewNewsFrame';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['OverviewNewsText']       ."' WHERE `config_name` = 'OverviewNewsText';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['initial_fields']         ."' WHERE `config_name` = 'initial_fields';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['metal_basic_income']     ."' WHERE `config_name` = 'metal_basic_income';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['crystal_basic_income']   ."' WHERE `config_name` = 'crystal_basic_income';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['deuterium_basic_income'] ."' WHERE `config_name` = 'deuterium_basic_income';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['energy_basic_income']    ."' WHERE `config_name` = 'energy_basic_income';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '". $game_config['enable_bbcode']    ."' WHERE `config_name` = 'enable_bbcode';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '" .$game_config['debug']                  ."' WHERE `config_name` ='debug'", 'config');
			header("location:settings.php");
		}
		else
		{
			$parse                           = $lang;
			$parse['game_name']              = $game_config['game_name'];
			$parse['game_speed']             = $game_config['game_speed'];
			$parse['fleet_speed']            = $game_config['fleet_speed'];
			$parse['resource_multiplier']    = $game_config['resource_multiplier'];
			$parse['forum_url']              = $game_config['forum_url'];
			$parse['initial_fields']         = $game_config['initial_fields'];
			$parse['metal_basic_income']     = $game_config['metal_basic_income'];
			$parse['crystal_basic_income']   = $game_config['crystal_basic_income'];
			$parse['deuterium_basic_income'] = $game_config['deuterium_basic_income'];
			$parse['energy_basic_income']    = $game_config['energy_basic_income'];
			$parse['actived']                = ($game_config['stat'] == 1) ? " checked = 'checked' ":"";
			$parse['stat_level']             = $game_config['stat_level'] == 1;
			$parse['enable_bbcode']    		 = stripslashes($game_config['enable_bbcode']);
			$parse['stat_settings']    		 = stripslashes($game_config['stat_settings']);
			$parse['closed']                 = ($game_config['game_disable'] == 1) ? " checked = 'checked' ":"";
			$parse['close_reason']           = stripslashes( $game_config['close_reason'] );
			$parse['newsframe']              = ($game_config['OverviewNewsFrame'] == 1) ? " checked = 'checked' ":"";
			$parse['NewsTextVal']            = stripslashes( $game_config['OverviewNewsText'] );
			$parse['debug']                  = ($game_config['debug'] == 1)        ? " checked = 'checked' ":"";
			$Page                           .= parsetemplate(gettemplate('admin/settings_body'),  $parse );

			display ( $Page, "Configuraciones generales", false, '', true, false);
		}
	}
	else
	{
		message ( "No tienes permisos suficientes", "¡Error!");
	}
	return $Page;
}

$Page = DisplayGameSettingsPage ( $user );

?>