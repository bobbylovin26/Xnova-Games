<?php

/**
 * constantes.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if ( defined('INSIDE') )
{
	// EMAIL DEL ADMINSITRADOR Y URL DEL JUEGO - ESTOS DATOS SON PEDIDOS EN REG.PHP
	define('ADMINEMAIL'               , "info@xgproyect.com");
	define('GAMEURL'                  , "http://".$_SERVER['HTTP_HOST']."/");

	//DATOS DEL UNIVERSO, CANTIDAD DE GALAXIAS, SISTEMAS Y PLANETAS || POR DEFECTO 9-499-15 RESPECTIVAMENTE
	define('MAX_GALAXY_IN_WORLD'      ,   9);
	define('MAX_SYSTEM_IN_GALAXY'     , 499);
	define('MAX_PLANET_IN_SYSTEM'     ,  15);

	//NÚMERO DE COLUMNAS PARA LOS INFORMES DE ESPIONAJE
	define('SPY_REPORT_ROW'           , 3);

	// CAMPOS POR CADA NIVEL DE LA BASE LUNAR
	define('FIELDS_BY_MOONBASIS_LEVEL', 6);

	// CANTIDAD DE CAMPOS QUE DA EL TERRAFORMER
	define('FIELDS_BY_TERRAFORMER'	  , 5);

	// CANTIDAD DE PLANETAS QUE PUEDE TENER UN JUGADOR
	define('MAX_PLAYER_PLANETS'       , 9);

	// CANTIDAD DE EDIFICIOS QUE PUEDEN IR EN LA COLA DE CONSTRUCCION
	define('MAX_BUILDING_QUEUE_SIZE'  , 5);

	//CANTIDAD DE NAVES QUE SE PUEDEN CONSTRUIR DE UNA SOLA VEZ
	define('MAX_FLEET_OR_DEFS_PER_ROW', 1000000);

	// PORCENTAJE DE RECURSOS QUE PUEDEN SER SOBREALMANCENADOS
	// 1.0 PARA 100% - 1.1 PARA 110% Y ASI SUCESIVAMENTE
	define('MAX_OVERFLOW'             , 1);

	//RECURSOS INICIALES DE LOS PLANETAS RECIEN COLONIZADOS
	define('BASE_STORAGE_SIZE'        , 100000);
	define('BUILD_METAL'              ,    500);
	define('BUILD_CRISTAL'            ,    500);
	define('BUILD_DEUTERIUM'          , 	 0);
}
else
{
	die(header("location:../"));
}
?>