<?php

/**
 * moonoptions.php
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

if ($user['authlevel'] >= 2)
{
	if ($_POST && $_POST['add_moon'])
	{
		$PlanetID  = $_POST['add_moon'];
		$MoonName  = $_POST['name'];

		$QrySelectPlanet  = "SELECT * FROM {{table}} ";
		$QrySelectPlanet .= "WHERE ";
		$QrySelectPlanet .= "`id` = '". $PlanetID ."';";
		$PlanetSelected   = doquery ( $QrySelectPlanet, 'planets', true);

		$Galaxy    = $PlanetSelected['galaxy'];
		$System    = $PlanetSelected['system'];
		$Planet    = $PlanetSelected['planet'];
		$Owner     = $PlanetSelected['id_owner'];
		$MoonID    = time();

		CreateOneMoonRecord ( $Galaxy, $System, $Planet, $Owner, $MoonID, $MoonName, 20 );

		message ("Luna agregada con éxito.","¡Listo!","moonoptions.php",2);
	}
	elseif($_POST && $_POST['del_moon'])
	{
		$MoonID        	  = $_POST['del_moon'];

		$QrySelectMoon  = "SELECT * FROM {{table}} ";
		$QrySelectMoon .= "WHERE ";
		$QrySelectMoon .= "`id` = '". $MoonID ."';";
		$MoonSelected = doquery ( $QrySelectMoon, 'lunas', true);

		$Galaxy    = $MoonSelected['galaxy'];
		$System    = $MoonSelected['system'];
		$Planet    = $MoonSelected['lunapos'];
		$Owner     = $MoonSelected['id_owner'];


		$DeleteMoonQry1  = "DELETE FROM {{table}} WHERE `id` = '".$MoonID."';";
		doquery($DeleteMoonQry1, 'lunas');

		$DeleteMoonQry2  = "DELETE FROM {{table}} WHERE `galaxy` ='".$Galaxy."' AND `system` ='".$System."' AND `planet` ='".$Planet."';";
		doquery($DeleteMoonQry2, 'planets');

		$QryUpdateGalaxy  = "UPDATE {{table}} SET ";
		$QryUpdateGalaxy .= "`id_luna` = '0' ";
		$QryUpdateGalaxy .= "WHERE ";
		$QryUpdateGalaxy .= "`galaxy` = '". $Galaxy ."' AND ";
		$QryUpdateGalaxy .= "`system` = '". $System ."' AND ";
		$QryUpdateGalaxy .= "`planet` = '". $Planet ."' ";
		$QryUpdateGalaxy .= "LIMIT 1;";
		doquery( $QryUpdateGalaxy , 'galaxy');

		message ("Luna eliminada con éxito.","¡Listo!","moonoptions.php",2);
	}
	else
	{
		display (parsetemplate(gettemplate("admin/moonoptions"), $parse), "Admin CP - Agregar luna", false, '', true, false);
	}
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}
?>