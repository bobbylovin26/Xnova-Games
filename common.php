<?php

/**
 * common.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('VERSION','v2.2');

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

include($xnova_root_path . 'includes/funciones.'.$phpEx);

if (INSTALL != true)
{
	//GENERALES
	include($xnova_root_path . 'includes/vars.'.$phpEx);
	include($xnova_root_path . 'includes/constantes.'.$phpEx);

	/**
	* INICIO DEL BLOQUE
	*  -----------------------------------------------------------------------------------
	* ESTO OBTIENE LAS FUNCIONES B
	* ESTE PEQUEÑO SCRIPT BUSCA EN LA CARPETA FUNCIONES B TODAS LAS FUNCIONES EXISTENTES
	* CUMPLE LA MISMA FUNCION QUE CUALQUIER INCLUDE, NO MAS QUE SE RESUME EN UNAS,
	* POCAS LINEAS DE CODIGO.
	*  -----------------------------------------------------------------------------------
	* NOTA:
	* 	- FUNCIONES "A"(funciones_A) = NO GENERAN CONFLICTOS Y SUELEN ESTAR EN 1 O 2 ARCHIVOS.-
	* 		LAS FUNCIONES "A" ESTAN INCLUIDAS DIRECTAMENTE A SU ARCHIVO CORRESPONDIENTE.-
	*  -----------------------------------------------------------------------------------
	* 	- FUNCIONES "B"(funciones_B) = SUELEN ESTAR EN VARIOS ARCHIVOS Y GENERAN CONFLICTOS AL INCLUIRLAS INDIVIDUALMENTE.-
	* 		ESTO SUCEDE A QUE VARIAS VECES SE HACEN VARIAS PETICIONES A UN MISMO ARCHIVO (EJ: MOVIMIENTOS DE FLOTAS, POR ENDE
	* CON UN INCLUDE_ONCE NO SE SOLUCIONA ESTE ASPECTO).
	*
	*/
	$carpeta = opendir($xnova_root_path . 'includes/funciones_B');

	while (($archivo = readdir($carpeta)) !== false)
	{
		$extension = "." . substr($archivo, -3);

		if ($extension == "." . $phpEx)
			require_once $xnova_root_path . 'includes/funciones_B/' . $archivo;
	}
	//FIN DEL BLOQUE QUE OBTIENE LAS FUNCIONES B


	$query = doquery("SELECT * FROM {{table}}",'config');

	while ($row = mysql_fetch_assoc($query))
	{
		$game_config[$row['config_name']] = $row['config_value'];
	}

	if ($InLogin != true)
	{
		include($xnova_root_path . 'includes/funciones_A/CheckUser.'.$phpEx);

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

	if (isset($user))
	{
		include($xnova_root_path . 'includes/funciones_A/FlyingFleetHandler.'.$phpEx);

		$_fleets = doquery("SELECT * FROM {{table}} WHERE `fleet_end_time` <= '".time()."';", 'fleets');

		while ($row = mysql_fetch_array($_fleets))
		{

			$array                = array();
			$array['galaxy']      = $row['fleet_end_galaxy'];
			$array['system']      = $row['fleet_end_system'];
			$array['planet']      = $row['fleet_end_planet'];
			$array['planet_type'] = $row['fleet_end_type'];

			$temp = FlyingFleetHandler ($array);

			if($row['fleet_end_time'] <= time())
			{
				unset($array);
				$array                = array();
				$array['galaxy']      = $row['fleet_start_galaxy'];
				$array['system']      = $row['fleet_start_system'];
				$array['planet']      = $row['fleet_start_planet'];
				$array['planet_type'] = $row['fleet_start_type'];

				$temp = FlyingFleetHandler ($array);
			}

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
