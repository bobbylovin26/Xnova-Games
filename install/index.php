<?php

/**
 * index.php (Instalador)
 *
 * @version 2.0
 * @copyright 2008 by e-Zobar for XNova
 * Based on first Chlorel's code
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.'.$phpEx);
include($xgp_root . 'install/databaseinfos.'.$phpEx);

$Mode     = $_GET['mode'];
$Page     = $_GET['page'];
$phpself  = $_SERVER['PHP_SELF'];
$nextpage = $Page + 1;

	if (empty($Mode)) { $Mode = 'intro'; }
	if (empty($Page)) { $Page = 1;       }

	switch ($Mode) {
		case 'intro':
				$frame  = parsetemplate(gettemplate('install/ins_intro'), false);
		 	break;
		case 'ins':
			if ($Page == 1) {
				if ($_GET['error'] == 1) {
				message ("La conexi&oacute;n a la base de datos a fallado", "¡Error!","?mode=ins&page=1",3);
				}
				elseif ($_GET['error'] == 2) {
				message ("El fichero config.php no puede ser sustituido, no tenia acceso chmod 777", "¡Error!","?mode=ins&page=1",3);
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
					if (!$dz) {
					header("Location: ?mode=ins&page=1&error=2");
					exit();
					}

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

				doquery ( $QryTableAks        , 'aks'        );
				$parse['aks_created'][create_aks] .= "Creación de la tabla \"aks\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableAlliance   , 'alliance'   );
				$parse['aks_created'][create_alliance] .= "Creación de la tabla \"alliance\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableBanned     , 'banned'     );
				$parse['aks_created'][create_banned] .= "Creación de la tabla \"banned\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableBuddy      , 'buddy'      );
				$parse['aks_created'][create_buddy] .= "Creación de la tabla \"buddy\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableConfig     , 'config'     );
				$parse['aks_created'][create_config] .= "Creación de la tabla \"config\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryInsertConfig    , 'config'     );
				$parse['aks_created'][populate_config] .= "Inyección de datos en la tabla \"config\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableErrors     , 'errors'     );
				$parse['aks_created'][create_errors] .= "Creación de la tabla \"errors\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableFleets     , 'fleets'     );
				$parse['aks_created'][create_fleets] .= "Creación de la tabla \"fleets\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableGalaxy     , 'galaxy'     );
				$parse['aks_created'][create_galaxy] .= "Creación de la tabla \"galaxy\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableLunas      , 'lunas'      );
				$parse['aks_created'][create_lunas] .= "Creación de la tabla \"lunas\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableMessages   , 'messages'   );
				$parse['aks_created'][create_messages] .= "Creación de la tabla \"messages\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableNotes      , 'notes'      );
				$parse['aks_created'][create_notes] .= "Creación de la tabla \"notes\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTablePlanets    , 'planets'    );
				$parse['aks_created'][create_planets] .= "Creación de la tabla \"planets\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableRw         , 'rw'         );
				$parse['aks_created'][create_rw] .= "Creación de la tabla \"rw\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableStatPoints , 'statpoints' );
				$parse['aks_created'][create_statpoints] .= "Creación de la tabla \"statpoints\" .................... <b><font color=\"lime\">¡Listo!</font></b>";
				doquery ( $QryTableUsers      , 'users'      );
				$parse['aks_created'][create_users] .= "Creación de la tabla \"users\" .................... <b><font color=\"lime\">¡Listo!</font></b>";

				$frame  = parsetemplate ( gettemplate ('install/ins_form_done'), $parse['aks_created'] );
			}
			elseif ($Page == 3) {
				if ($_GET['error'] == 3) {
				message ("¡Debes completar todos los campos!", "¡Error!","?mode=ins&page=3",2);
				}
				$frame  = parsetemplate ( gettemplate ('install/ins_acc'), false );
			}
			elseif ($Page == 4) {
				$adm_user   = $_POST['adm_user'];
				$adm_pass   = $_POST['adm_pass'];
				$adm_email  = $_POST['adm_email'];
				$md5pass    = md5($adm_pass);

				if (!$_POST['adm_user']) {
					header("Location: ?mode=ins&page=3&error=3");
					exit();
				}
				if (!$_POST['adm_pass']) {
					header("Location: ?mode=ins&page=3&error=3");
					exit();
				}
				if (!$_POST['adm_email']) {
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

				$frame  = parsetemplate ( gettemplate ('install/ins_acc_done'), false );
			}
			break;
		default:
	}
	$parse['ins_state']    = $Page;
	$parse['ins_page']     = $frame;
	$parse['dis_ins_btn']  = "?mode=$Mode&page=$nextpage";
	$Displ                 = parsetemplate (gettemplate('install/ins_body'), $parse);

	display ($Displ, "Instalacion de XG Proyect", false, '', true, false, false);

?>