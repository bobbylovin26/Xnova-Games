<?php

/**
 * common.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('VERSION','v2.0');

$phpEx = "php";

$game_config   = array();
$user          = array();
$lang          = array();
$link          = "";
$IsUserChecked = false;

define('DEFAULT_SKINPATH' , 'skins/xnova/');
define('TEMPLATE_DIR'     , 'templates/');
define('DEFAULT_LANG'     , 'es');

include($xnova_root_path . 'includes/debug.class.'.$phpEx);
$debug = new debug();

include($xnova_root_path . 'includes/functions.'.$phpEx);

if (INSTALL != true)
{
	//GENERALES
	include($xnova_root_path . 'includes/vars.'.$phpEx);
	include($xnova_root_path . 'includes/constants.'.$phpEx);

	//FUNCIONES
	include($xnova_root_path . 'includes/functions/calculateAttack.'.$phpEx);
	include($xnova_root_path . 'includes/functions/CheckPlanetUsedFields.'.$phpEx);
	include($xnova_root_path . 'includes/functions/ChekUser.'.$phpEx);
	include($xnova_root_path . 'includes/functions/FlyingFleetHandler.'.$phpEx);
	include($xnova_root_path . 'includes/functions/formatCR.'.$phpEx);
	include($xnova_root_path . 'includes/functions/HandleElementBuildingQueue.'.$phpEx);
	include($xnova_root_path . 'includes/functions/IsVacationMode.'.$phpEx);
	include($xnova_root_path . 'includes/functions/PlanetResourceUpdate.'.$phpEx);
	include($xnova_root_path . 'includes/functions/raketenangriff.' . $phpEx);
	include($xnova_root_path . 'includes/functions/SendSimpleMessage.'.$phpEx);
	include($xnova_root_path . 'includes/functions/SetSelectedPlanet.'.$phpEx);
	include($xnova_root_path . 'includes/functions/SortUserPlanets.'.$phpEx);
	include($xnova_root_path . 'includes/functions/strings.'.$phpEx);

	$query = doquery("SELECT * FROM {{table}}",'config');

	while ($row = mysql_fetch_assoc($query))
	{
		$game_config[$row['config_name']] = $row['config_value'];
	}

	if ($InLogin != true)
	{
		$Result        = CheckTheUser ( $IsUserChecked );
		$IsUserChecked = $Result['state'];
		$user          = $Result['record'];
	}
	elseif ($InLogin == false)
	{
		if( $game_config['game_disable'])
		{
			if ($user['authlevel'] < 1)
			{
				message ( stripslashes ( $game_config['close_reason'] ), $game_config['game_name'] );
			}
		}
	}

	includeLang ("system");
	includeLang ('tech');

	$Time = time()+(30*30); //CAMBIAR ESTOS VALORES PARA CAMBIAR EL TIEMPO DE ACTUALIZACION

	if($game_config['actualizar_puntos'] < time())
	{
		include($xnova_root_path . 'admin/statbuilder.'.$phpEx);
		doquery("UPDATE {{table}} SET `config_value` = '". $Time ."' WHERE `config_name` = 'actualizar_puntos';", "config");
	}

	if ( isset ($user) )
	{
		$_fleets = doquery("SELECT `fleet_start_galaxy`,`fleet_start_system`,`fleet_start_planet`,`fleet_start_type` FROM {{table}} WHERE `fleet_start_time` <= '".time()."';", 'fleets'); //  OR fleet_end_time <= ".time()
		while ($row = mysql_fetch_array($_fleets))
		{
			$array                = array();
			$array['galaxy']      = $row['fleet_start_galaxy'];
			$array['system']      = $row['fleet_start_system'];
			$array['planet']      = $row['fleet_start_planet'];
			$array['planet_type'] = $row['fleet_start_type'];

			$temp = FlyingFleetHandler ($array);
		}

		$_fleets = doquery("SELECT `fleet_end_galaxy`,`fleet_end_system`,`fleet_end_planet`,`fleet_end_type` FROM {{table}} WHERE `fleet_end_time` <= '".time()."';", 'fleets'); //  OR fleet_end_time <= ".time()
		while ($row = mysql_fetch_array($_fleets))
		{
			$array                = array();
			$array['galaxy']      = $row['fleet_end_galaxy'];
			$array['system']      = $row['fleet_end_system'];
			$array['planet']      = $row['fleet_end_planet'];
			$array['planet_type'] = $row['fleet_end_type'];

			$temp = FlyingFleetHandler ($array);
		}

		unset($_fleets);

		if ( defined('IN_ADMIN') )
		{
			$UserSkin  = $user['dpath'];
			$local     = stristr ( $UserSkin, "http:");
			if ($local === false)
			{
				if (!$user['dpath'])
				{
					$dpath     = "../". DEFAULT_SKINPATH  ;
				}
				else
				{
					$dpath     = "../". $user["dpath"];
				}
			}
			else
			{
				$dpath     = $UserSkin;
			}
		}
		else
		{
			$dpath     = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
		}

		SetSelectedPlanet ( $user );

		$planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '".$user['current_planet']."';", 'planets', true);
		$galaxyrow = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '".$planetrow['id']."';", 'galaxy', true);

		CheckPlanetUsedFields($planetrow);
	}
}
else
{
	$dpath     = "../" . DEFAULT_SKINPATH;
}
?>
