<?php

/**
 * overview.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] >= 1)
{
	if ($_GET['cmd'] == 'sort')
		$TypeSort = $_GET['type'];
	else
		$TypeSort = "id";

	$Last15Mins = doquery("SELECT * FROM {{table}} WHERE `onlinetime` >= '". (time() - 15 * 60) ."' ORDER BY `". $TypeSort ."` ASC;", 'users');
	$Count      = 0;
	$Color      = "lime";

	while ( $TheUser = mysql_fetch_array($Last15Mins) )
	{
		if ($PrevIP != "")
			if ($PrevIP == $TheUser['user_lastip'])
				$Color = "red";
			else
				$Color = "lime";


		$UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $TheUser['id'] . "';", 'statpoints', true);
		$Bloc['dpath']              = $dpath;
		$Bloc['adm_ov_data_id']     = $TheUser['id'];
		$Bloc['adm_ov_data_name']   = $TheUser['username'];
		$Bloc['adm_ov_data_agen']   = $TheUser['user_agent'];
		$Bloc['current_page']    	= $TheUser['current_page'];
		$Bloc['usr_s_id']    		= $TheUser['id'];
		$Bloc['adm_ov_data_clip']   = $Color;
		$Bloc['adm_ov_data_adip']   = $TheUser['user_lastip'];
		$Bloc['adm_ov_data_ally']   = $TheUser['ally_name'];
		$Bloc['adm_ov_data_point']  = pretty_number ( $UserPoints['total_points'] );
		$Bloc['adm_ov_data_activ']  = pretty_time ( time() - $TheUser['onlinetime'] );
		$Bloc['adm_ov_data_pict']   = "m.gif";
		$PrevIP                     = $TheUser['user_lastip'];
		$Bloc['usr_email']    		= $TheUser['email'];
		$Bloc['usr_xp_raid']    	= $TheUser['xpraid'];
		$Bloc['usr_xp_min']    		= $TheUser['xpminier'];
		if ($TheUser['urlaubs_modus'] == 1)
			$Bloc['state_vacancy']  = "<img src=\"../images/true.png\" >";
		else
			$Bloc['state_vacancy']  = "<img src=\"../images/false.png\">";
		if ($TheUser['bana'] == 1)
			$Bloc['is_banned']  = "<img src=\"../images/banned.png\" >";
		else
			$Bloc['is_banned']  = "No";
		$Bloc['usr_planet_gal']    = $TheUser['galaxy'];
		$Bloc['usr_planet_sys']    = $TheUser['system'];
		$Bloc['usr_planet_pos']    = $TheUser['planet'];
		$parse['adm_ov_data_table'] .= parsetemplate( gettemplate('admin/overview_rows'), $Bloc );
		$Count++;
	}

	$parse['adm_ov_data_count']  = $Count;

	display ( parsetemplate(gettemplate('admin/overview_body'), $parse), "Admin CP - General", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}

?>