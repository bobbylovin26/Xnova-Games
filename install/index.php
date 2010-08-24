<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

define('INSIDE'  , true);
define('INSTALL' , true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.'.$phpEx);
include_once('databaseinfos.'.$phpEx);

$Mode     = $_GET['mode'];
$Page     = $_GET['page'];
$phpself  = $_SERVER['PHP_SELF'];
$nextpage = $Page + 1;

if(version_compare(PHP_VERSION, "5.2.5", "<"))
	die("Error! Tu servidor debe tener al menos php 5.2.5");

if (empty($Mode)) { $Mode = 'intro'; }
if (empty($Page)) { $Page = 1;       }

switch ($Mode) {
	case'license':
		$frame  = parsetemplate(gettemplate('install/ins_license'), false);
		break;
	case 'intro':
		$frame  = parsetemplate(gettemplate('install/ins_intro'), false);
		break;
	case 'ins':
		if ($Page == 1) {
			if ($_GET['error'] == 1) {
				message ("La conexi&oacute;n a la base de datos a fallado","?mode=ins&page=1", 3, false, false);
			}
			elseif ($_GET['error'] == 2) {
				message ("El fichero config.php no puede ser sustituido, no tenia acceso chmod 777","?mode=ins&page=1", 3, false, false);
			}

			$frame  = parsetemplate ( gettemplate ('install/ins_form'), false);
		}
		elseif ($Page == 2) {
			$host   = $_POST['host'];
			$user   = $_POST['user'];
			$pass   = $_POST['passwort'];
			$prefix = $_POST['prefix'];
			$db     = $_POST['db'];

			$connection = @mysql_connect($host, $user, $pass);
			if (!$connection) {
				header("Location: ?mode=ins&page=1&error=1");
				exit();
			}

			$dbselect = @mysql_select_db($db);
			if (!$dbselect) {
				header("Location: ?mode=ins&page=1&error=1");
				exit();
			}

			$numcookie = mt_rand(1000, 1234567890);
			$dz = fopen("../config.php", "w");
			if (!$dz)
			{
				header("Location: ?mode=ins&page=1&error=2");
				exit();
			}

			$parse[first]	= "Conexión establecida con éxito...";

			fwrite($dz, "<?php\n");
			fwrite($dz, "if(!defined(\"INSIDE\")){ header(\"location:".$xgp_root."\"); }\n");
			fwrite($dz, "\$dbsettings = Array(\n");
			fwrite($dz, "\"server\"     => \"".$host."\", // MySQL server name.\n");
			fwrite($dz, "\"user\"       => \"".$user."\", // MySQL username.\n");
			fwrite($dz, "\"pass\"       => \"".$pass."\", // MySQL password.\n");
			fwrite($dz, "\"name\"       => \"".$db."\", // MySQL database name.\n");
			fwrite($dz, "\"prefix\"     => \"".$prefix."\", // Tables prefix.\n");
			fwrite($dz, "\"secretword\" => \"XGProyect".$numcookie."\"); // Cookies.\n");
			fwrite($dz, "?>");
			fclose($dz);

			$parse[second]	= "Archivo config.php creado con éxito...";

			doquery ($QryTableAks        , 'aks'    	);
			doquery ($QryTableAlliance   , 'alliance'   );
			doquery ($QryTableBanned     , 'banned'     );
			doquery ($QryTableBuddy      , 'buddy'      );
			doquery ($QryTableConfig     , 'config'     );
			doquery ($QryInsertConfig    , 'config'     );
			doquery ($QryTableErrors     , 'errors'     );
			doquery ($QryTableFleets     , 'fleets'     );
			doquery ($QryTableGalaxy     , 'galaxy'     );
			doquery ($QryTableLunas      , 'lunas'      );
			doquery ($QryTableMessages   , 'messages'   );
			doquery ($QryTableNotes      , 'notes'      );
			doquery ($QryTablePlanets    , 'planets'    );
			doquery ($QryTableRw         , 'rw'         );
			doquery ($QryTableStatPoints , 'statpoints'	);
			doquery ($QryTableUsers      , 'users'  	);

			$parse[third]	= "Tablas creadas con éxito...";

			$frame  = parsetemplate(gettemplate('install/ins_form_done'), $parse);
		}
		elseif ($Page == 3)
		{
			if ($_GET['error'] == 3)
				message ("¡Debes completar todos los campos!","?mode=ins&page=3", 2, false, false);

			$frame  = parsetemplate(gettemplate('install/ins_acc'), false);
		}
		elseif ($Page == 4)
		{
			$adm_user   = $_POST['adm_user'];
			$adm_pass   = $_POST['adm_pass'];
			$adm_email  = $_POST['adm_email'];
			$md5pass    = md5($adm_pass);

			if (!$_POST['adm_user'])
			{
				header("Location: ?mode=ins&page=3&error=3");
				exit();
			}
			if (!$_POST['adm_pass'])
			{
				header("Location: ?mode=ins&page=3&error=3");
				exit();
			}
			if (!$_POST['adm_email'])
			{
				header("Location: ?mode=ins&page=3&error=3");
				exit();
			}

			$QryInsertAdm  = "INSERT INTO {{table}} SET ";
			$QryInsertAdm .= "`id`                = '1', ";
			$QryInsertAdm .= "`username`          = '". $adm_user ."', ";
			$QryInsertAdm .= "`email`             = '". $adm_email ."', ";
			$QryInsertAdm .= "`email_2`           = '". $adm_email ."', ";
			$QryInsertAdm .= "`authlevel`         = '3', ";
			$QryInsertAdm .= "`id_planet`         = '1', ";
			$QryInsertAdm .= "`galaxy`            = '1', ";
			$QryInsertAdm .= "`system`            = '1', ";
			$QryInsertAdm .= "`planet`            = '1', ";
			$QryInsertAdm .= "`current_planet`    = '1', ";
			$QryInsertAdm .= "`register_time`     = '". time() ."', ";
			$QryInsertAdm .= "`password`          = '". $md5pass ."';";
			doquery($QryInsertAdm, 'users');

			$QryAddAdmPlt  = "INSERT INTO {{table}} SET ";
			$QryAddAdmPlt .= "`id_owner`          = '1', ";
			$QryAddAdmPlt .= "`galaxy`            = '1', ";
			$QryAddAdmPlt .= "`system`            = '1', ";
			$QryAddAdmPlt .= "`planet`            = '1', ";
			$QryAddAdmPlt .= "`last_update`       = '". time() ."', ";
			$QryAddAdmPlt .= "`planet_type`       = '1', ";
			$QryAddAdmPlt .= "`image`             = 'normaltempplanet02', ";
			$QryAddAdmPlt .= "`diameter`          = '12750', ";
			$QryAddAdmPlt .= "`field_max`         = '163', ";
			$QryAddAdmPlt .= "`temp_min`          = '47', ";
			$QryAddAdmPlt .= "`temp_max`          = '87', ";
			$QryAddAdmPlt .= "`metal`             = '500', ";
			$QryAddAdmPlt .= "`metal_perhour`     = '0', ";
			$QryAddAdmPlt .= "`metal_max`         = '1000000', ";
			$QryAddAdmPlt .= "`crystal`           = '500', ";
			$QryAddAdmPlt .= "`crystal_perhour`   = '0', ";
			$QryAddAdmPlt .= "`crystal_max`       = '1000000', ";
			$QryAddAdmPlt .= "`deuterium`         = '500', ";
			$QryAddAdmPlt .= "`deuterium_perhour` = '0', ";
			$QryAddAdmPlt .= "`deuterium_max`     = '1000000';";
			doquery($QryAddAdmPlt, 'planets');

			$QryAddAdmGlx  = "INSERT INTO {{table}} SET ";
			$QryAddAdmGlx .= "`galaxy`            = '1', ";
			$QryAddAdmGlx .= "`system`            = '1', ";
			$QryAddAdmGlx .= "`planet`            = '1', ";
			$QryAddAdmGlx .= "`id_planet`         = '1'; ";
			doquery($QryAddAdmGlx, 'galaxy');

			doquery("UPDATE {{table}} SET `config_value` = '1' WHERE `config_name` = 'LastSettedGalaxyPos';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '1' WHERE `config_name` = 'LastSettedSystemPos';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = '1' WHERE `config_name` = 'LastSettedPlanetPos';", 'config');
			doquery("UPDATE {{table}} SET `config_value` = `config_value` + '1' WHERE `config_name` = 'users_amount' LIMIT 1;", 'config');

			$frame  = parsetemplate(gettemplate('install/ins_acc_done'), $parse);
		}
		break;
	case'upgrade':
		if ($_POST)
		{
			$conexion = mysql_connect($_POST[servidor], $_POST[usuario], $_POST[clave])
			or die ('<font color=red><strong>Problemas en la conexión con el servidor, es probable que el <u>nombre del servidor, usuario o clave sean incorrectas o que mysql no esta funcionando.</u></strong></font>');
			@mysql_select_db($_POST[base],$conexion)
			or die ('<font color=red><strong>Problemas en la conexión con la base de datos. Este error puede deberse a que <u>la base de datos no existe o escribiste mal el nombre de la misma.</u></strong></font>');

			if ($_POST[continuar] && (empty($_POST[modo]) or empty($_POST[servidor]) or empty($_POST[usuario]) or empty($_POST[clave]) or empty($_POST[base]) or empty($_POST[prefix])))
			{
				message("Debes aceptar los terminos, y rellenar todos los campos<br><a href=\"./index.php\">Volver</a>","", "", false, false);
			}
			else
			{
				if(filesize('../config.php') == 0)
				{
					die(message("Error!, tu archivo config.php se encuentra vació o no configurado. En caso de no ser así verifica que su chmod sea de 777","", "", false, false));
				}
				else
				{
					include_once("../config.php");

					if($_POST[prefix] != $dbsettings["prefix"])
					{
						die(message("Error!, el prefix seleccionado (<font color=\"red\"><strong>".$_POST[prefix]."</strong></font>) no coincide con el de la base de datos.","", "", false, false));
					}
				}

				switch($_POST[modo])
				{
					case'2.3':
						$Qry36 = mysql_query("ALTER TABLE `$_POST[prefix]users`
					  DROP `new_message`,
					  DROP `raids`,
					  DROP `p_infligees`,
					  DROP `mnl_alliance`,
					  DROP `mnl_joueur`,
					  DROP `mnl_attaque`,
					  DROP `mnl_spy`,
					  DROP `mnl_exploit`,
					  DROP `mnl_transport`,
					  DROP `mnl_expedition`,
					  DROP `mnl_general`,
					  DROP `mnl_buildlist`,
					  DROP `multi_validated`;");

						$Qry37 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'urlaubs_modus_erz' AND CONVERT(`$_POST[prefix]config`.`config_value` USING utf8) = '1' LIMIT 1;");
						$Qry39 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'enable_bbcode' AND CONVERT(`$_POST[prefix]config`.`config_value` USING utf8) = '1' LIMIT 1;");
						$Qry40 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'enable_bbcode' AND CONVERT(`$_POST[prefix]config`.`config_value` USING utf8) = '0' LIMIT 1;");
						$Qry41 = mysql_query("ALTER TABLE `$_POST[prefix]users` DROP `lvl_minier`, DROP `lvl_raid`, DROP `xpraid`, DROP `xpminier`;");
						$Qry42 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('adm_attack', '0');");
						$Qry43 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('stat', '1');");
						$Qry44 = mysql_query("ALTER TABLE `$_POST[prefix]users` DROP `lang`;");
						$Qry45 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name` ,`config_value`)VALUES ('lang', 'spanish');");
						$Qry46 = mysql_query("ALTER TABLE `$_POST[prefix]users` ADD `new_message` INT( 11 ) NOT NULL DEFAULT '0' AFTER `db_deaktjava` ;");
						$Qry47 = mysql_query("ALTER TABLE `$_POST[prefix]messages` DROP `leido`");
						$Qry48 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'stat_level' LIMIT 1;");
						$Qry49 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'stat' LIMIT 1;");
						$Qry50 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES
								('stat', 1),
								('stat_level', 2),
								('stat_last_update', 1),
								('stat_settings', 1000),
								('stat_amount', 25),
								('stat_update_time', 15),
								('stat_flying', 1);");
						$Qry51 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'actualizar_puntos' LIMIT 1;");
						$Qry52 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'OverviewNewsFrame' LIMIT 1;");
						$Qry53 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'OverviewNewsText' LIMIT 1;");
						$Qry54 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE `config_name` = 'VERSION'");
						$Qry55 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('VERSION', '2.7');");
						$Qry56 = mysql_query("ALTER TABLE `$_POST[prefix]rw`DROP `id_owner1`, DROP `id_owner2`;");
						$Qry57 = mysql_query("ALTER TABLE `$_POST[prefix]rw` ADD `owners` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';");
						$Qry58 = mysql_query("ALTER TABLE `$_POST[prefix]fleets` CHANGE `fleet_group` `fleet_group` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' ;");
						$Qry59 = mysql_query("ALTER TABLE `$_POST[prefix]aks` ADD `planet_type` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `planet` ;");
						$Qry60 = mysql_query("ALTER TABLE `$_POST[prefix]aks` CHANGE `eingeladen` `eingeladen` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
						$Qry61 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner1`");
						$Qry62 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner2`");
						break;
					case'2.4':
						$Qry39 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'enable_bbcode' AND CONVERT(`$_POST[prefix]config`.`config_value` USING utf8) = '1' LIMIT 1;");
						$Qry40 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'enable_bbcode' AND CONVERT(`$_POST[prefix]config`.`config_value` USING utf8) = '0' LIMIT 1;");
						$Qry41 = mysql_query("ALTER TABLE `$_POST[prefix]users` DROP `lvl_minier`, DROP `lvl_raid`, DROP `xpraid`, DROP `xpminier`;");
						$Qry42 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('adm_attack', '0');");
						$Qry43 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('stat', '1');");
						$Qry44 = mysql_query("ALTER TABLE `$_POST[prefix]users` DROP `lang`;");
						$Qry45 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name` ,`config_value`)VALUES ('lang', 'spanish');");
						$Qry46 = mysql_query("ALTER TABLE `$_POST[prefix]users` ADD `new_message` INT( 11 ) NOT NULL DEFAULT '0' AFTER `db_deaktjava` ;");
						$Qry47 = mysql_query("ALTER TABLE `$_POST[prefix]messages` DROP `leido`");
						$Qry48 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'stat_level' LIMIT 1;");
						$Qry49 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'stat' LIMIT 1;");
						$Qry50 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES
								('stat', 1),
								('stat_level', 2),
								('stat_last_update', 1),
								('stat_settings', 1000),
								('stat_amount', 25),
								('stat_update_time', 15),
								('stat_flying', 1);");
						$Qry51 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'actualizar_puntos' LIMIT 1;");
						$Qry52 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'OverviewNewsFrame' LIMIT 1;");
						$Qry53 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'OverviewNewsText' LIMIT 1;");
						$Qry54 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE `config_name` = 'VERSION'");
						$Qry55 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('VERSION', '2.7');");
						$Qry56 = mysql_query("ALTER TABLE `$_POST[prefix]rw`DROP `id_owner1`, DROP `id_owner2`;");
						$Qry57 = mysql_query("ALTER TABLE `$_POST[prefix]rw` ADD `owners` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';");
						$Qry58 = mysql_query("ALTER TABLE `$_POST[prefix]fleets` CHANGE `fleet_group` `fleet_group` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' ;");
						$Qry59 = mysql_query("ALTER TABLE `$_POST[prefix]aks` ADD `planet_type` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `planet` ;");
						$Qry60 = mysql_query("ALTER TABLE `$_POST[prefix]aks` CHANGE `eingeladen` `eingeladen` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
						$Qry61 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner1`");
						$Qry62 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner2`");
						break;
					case'2.5':
						$Qry52 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'OverviewNewsFrame' LIMIT 1;");
						$Qry53 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE CONVERT(`$_POST[prefix]config`.`config_name` USING utf8) = 'OverviewNewsText' LIMIT 1;");
						$Qry54 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE `config_name` = 'VERSION'");
						$Qry55 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('VERSION', '2.7');");
						$Qry56 = mysql_query("ALTER TABLE `$_POST[prefix]rw`DROP `id_owner1`, DROP `id_owner2`;");
						$Qry57 = mysql_query("ALTER TABLE `$_POST[prefix]rw` ADD `owners` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';");
						$Qry58 = mysql_query("ALTER TABLE `$_POST[prefix]fleets` CHANGE `fleet_group` `fleet_group` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' ;");
						$Qry59 = mysql_query("ALTER TABLE `$_POST[prefix]aks` ADD `planet_type` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `planet` ;");
						$Qry60 = mysql_query("ALTER TABLE `$_POST[prefix]aks` CHANGE `eingeladen` `eingeladen` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
						$Qry61 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner1`");
						$Qry62 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner2`");
						break;
					case'2.6':
						$Qry54 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE `config_name` = 'VERSION'");
						$Qry55 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('VERSION', '2.7');");
						$Qry56 = mysql_query("ALTER TABLE `$_POST[prefix]rw`DROP `id_owner1`, DROP `id_owner2`;");
						$Qry57 = mysql_query("ALTER TABLE `$_POST[prefix]rw` ADD `owners` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';");
						$Qry58 = mysql_query("ALTER TABLE `$_POST[prefix]fleets` CHANGE `fleet_group` `fleet_group` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' ;");
						$Qry59 = mysql_query("ALTER TABLE `$_POST[prefix]aks` ADD `planet_type` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `planet` ;");
						$Qry60 = mysql_query("ALTER TABLE `$_POST[prefix]aks` CHANGE `eingeladen` `eingeladen` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
						$Qry61 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner1`");
						$Qry62 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner2`");
						break;
					case'2.7':
						$Qry54 = mysql_query("DELETE FROM `$_POST[prefix]config` WHERE `config_name` = 'VERSION'");
						$Qry55 = mysql_query("INSERT INTO `$_POST[prefix]config` (`config_name`, `config_value`) VALUES ('VERSION', '2.7');");
						$Qry56 = mysql_query("ALTER TABLE `$_POST[prefix]rw`DROP `id_owner1`, DROP `id_owner2`;");
						$Qry57 = mysql_query("ALTER TABLE `$_POST[prefix]rw` ADD `owners` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';");
						$Qry58 = mysql_query("ALTER TABLE `$_POST[prefix]fleets` CHANGE `fleet_group` `fleet_group` VARCHAR( 15 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' ;");
						$Qry59 = mysql_query("ALTER TABLE `$_POST[prefix]aks` ADD `planet_type` TINYINT( 1 ) NOT NULL DEFAULT '1' AFTER `planet` ;");
						$Qry60 = mysql_query("ALTER TABLE `$_POST[prefix]aks` CHANGE `eingeladen` `eingeladen` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL");
						$Qry61 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner1`");
						$Qry62 = mysql_query("ALTER TABLE `$_POST[prefix]rw` DROP INDEX `id_owner2`");
				}
				message("XG Proyect finalizó la actualización con éxito, para finalizar borra el directorio install y luego haz <a href=\"./../\">click aqui</a>", "", "", false, false);
			}
		}
		else
			$frame  = parsetemplate(gettemplate('install/ins_update'), false);
		break;
	default:
}
$parse['ins_state']    = $Page;
$parse['ins_page']     = $frame;
$parse['dis_ins_btn']  = "?mode=$Mode&page=$nextpage";
display (parsetemplate (gettemplate('install/ins_body'), $parse), false, '', true, false);
?>