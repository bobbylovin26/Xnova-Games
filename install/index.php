<?php
/**
 * XNova Legacies
 *
 * @license GNU General Public Licence version 3
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

define('INSIDE' , true);
define('INSTALL' , false);
require_once dirname(dirname(__FILE__)) . '/common.php';
include(ROOT_PATH . 'includes/databaseinfos.php');
include(ROOT_PATH . 'includes/migrateinfo.php');

$Mode     = isset($_GET['mode']) ? strval($_GET['mode']) : 'intro';
$Page     = isset($_GET['page']) ? intval($_GET['page']) : 1;
$phpself  = $_SERVER['PHP_SELF'];
$nextpage = $Page + 1;

$MainTPL = gettemplate('install/ins_body');
includeLang('install/install');
switch ($Mode) {
    case 'intro':
            $SubTPL = gettemplate ('install/ins_intro');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
         break;
    case 'ins':
        if ($Page == 1) {
            if ($_GET['error'] == 1) {
            adminMessage ($lang['ins_error1'], $lang['ins_error']);
            }
            elseif ($_GET['error'] == 2) {
            adminMessage ($lang['ins_error2'], $lang['ins_error']);
            }

            $SubTPL = gettemplate ('install/ins_form');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
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

            $dz = fopen("../config.php", "w");
            if (!$dz) {
	            header("Location: ?mode=ins&page=1&error=2");
	            exit();
            }
            $fileData =<<<EOF
<?php return array(
    'global' => array(
        'database' => array(
            'engine' => 'mysql',
            'options' => array(
                'hostname' => '{$host}',
                'username' => '{$user}',
                'password' => '{$pass}',
                'database' => '{$db}'
                ),
            'table_prefix' => '{$prefix}',
            )
        )
    );
EOF;
            fwrite($dz, $fileData);
            fclose($dz);

            function doquery ($InQry, $TblName)
            {
                global $prefix;
                $Table  = $prefix.$TblName;
                $DoQry  = str_replace("{{table}}", $Table, $InQry);
                $return = mysql_query($DoQry) or die("MySQL Error: <b>".mysql_error()."</b>");
                return $return;
            }

            doquery ( $QryTableAks        , 'aks'        );
            doquery ( $QryTableAnnonce    , 'annonce'    );
            doquery ( $QryTableAlliance   , 'alliance'   );
            doquery ( $QryTableBanned     , 'banned'     );
            doquery ( $QryTableBuddy      , 'buddy'      );
            doquery ( $QryTableChat       , 'chat'       );
            doquery ( $QryTableConfig     , 'config'     );
            doquery ( $QryInsertConfig    , 'config'     );
            doquery ( $QryTabledeclared        , 'declared'        );
            doquery ( $QryTableErrors     , 'errors'     );
            doquery ( $QryTableFleets     , 'fleets'     );
            doquery ( $QryTableGalaxy     , 'galaxy'     );
            doquery ( $QryTableIraks      , 'iraks'      );
            doquery ( $QryTableLunas      , 'lunas'      );
            doquery ( $QryTableMessages   , 'messages'   );
            doquery ( $QryTableNotes      , 'notes'      );
            doquery ( $QryTablePlanets    , 'planets'    );
            doquery ( $QryTableRw         , 'rw'         );
            doquery ( $QryTableStatPoints , 'statpoints' );
            doquery ( $QryTableUsers      , 'users'      );
            doquery ( $QryTableMulti      , 'multi'      );

            $SubTPL = gettemplate ('install/ins_form_done');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
        }
        elseif ($Page == 3) {
            if ($_GET['error'] == 3) {
            adminMessage ($lang['ins_error3'], $lang['ins_error']);
            }

            $SubTPL = gettemplate ('install/ins_acc');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
        }
        elseif ($Page == 4) {
            $adm_user   = $_POST['adm_user'];
            $adm_pass   = $_POST['adm_pass'];
            $adm_email  = $_POST['adm_email'];
            $adm_planet = $_POST['adm_planet'];
            $adm_sex    = $_POST['adm_sex'];
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
            if (!$_POST['adm_planet']) {
                header("Location: ?mode=ins&page=3&error=3");
                exit();
            }

            $config = include(ROOT_PATH . 'config.php');
            $db_host   = $config['global']['database']['options']['hostname'];
            $db_user   = $config['global']['database']['options']['username'];
            $db_pass   = $config['global']['database']['options']['password'];
            $db_db     = $config['global']['database']['options']['database'];
            $db_prefix = $config['global']['database']['table_prefix'];

            $connection = @mysql_connect($db_host, $db_user, $db_pass);
                if (!$connection) {
                header("Location: ?mode=ins&page=1&error=1");
                exit();
                }

            $dbselect = @mysql_select_db($db_db);
                if (!$dbselect) {
                header("Location: ?mode=ins&page=1&error=1");
                exit();
                }

            function doquery ($InQry, $TblName) {
                global $db_prefix;
                $Table  = $db_prefix.$TblName;
                $DoQry  = str_replace("{{table}}", $Table, $InQry);
                $return = mysql_query($DoQry) or die("MySQL Error: <b>".mysql_error()."</b>");
            return $return;
            }

            $QryInsertAdm  = "INSERT INTO {{table}} SET ";
            $QryInsertAdm .= "`id`                = '1', ";
            $QryInsertAdm .= "`username`          = '". $adm_user ."', ";
            $QryInsertAdm .= "`email`             = '". $adm_email ."', ";
            $QryInsertAdm .= "`email_2`           = '". $adm_email ."', ";
            $QryInsertAdm .= "`authlevel`         = '3', ";
            $QryInsertAdm .= "`sex`               = '". $adm_sex ."', ";
            $QryInsertAdm .= "`id_planet`         = '1', ";
            $QryInsertAdm .= "`galaxy`            = '1', ";
            $QryInsertAdm .= "`system`            = '1', ";
            $QryInsertAdm .= "`planet`            = '1', ";
            $QryInsertAdm .= "`current_planet`    = '1', ";
            $QryInsertAdm .= "`register_time`     = '". time() ."', ";
            $QryInsertAdm .= "`password`          = '". $md5pass ."';";
            doquery($QryInsertAdm, 'users');

            $QryAddAdmPlt  = "INSERT INTO {{table}} SET ";
            $QryAddAdmPlt .= "`name`              = '". $adm_planet ."', ";
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

            $SubTPL = gettemplate ('install/ins_acc_done');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
        }
        break;
    case 'goto':
        if ($Page == 1) {
            $SubTPL = gettemplate ('install/ins_goto_intro');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
        }
        elseif ($Page == 2) {
            if ($_GET['error'] == 1) {
            adminMessage ($lang['ins_error1'], $lang['ins_error']);
            }
            elseif ($_GET['error'] == 2) {
            adminMessage ($lang['ins_error2'], $lang['ins_error']);
            }

            $SubTPL = gettemplate ('install/ins_goto_form');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
        }
        elseif ($Page == 3) {
            $host   = $_POST['host'];
            $user   = $_POST['user'];
            $pass   = $_POST['passwort'];
            $prefix = $_POST['prefix'];
            $db     = $_POST['db'];

            $connection = @mysql_connect($host, $user, $pass);
                if (!$connection) {
                header("Location: ?mode=goto&page=2&error=1");
                exit();
                }

            $dbselect = @mysql_select_db($db);
                if (!$dbselect) {
                header("Location: ?mode=goto&page=2&error=1");
                exit();
                }

            $numcookie = mt_rand(1000, 1234567890);
            $dz = fopen("../config.php", "w");
                if (!$dz) {
                header("Location: ?mode=ins&page=1&error=2");
                exit();
                }

            $fileData =<<<EOF
<?php return array(
    'global' => array(
        'database' => array(
            'engine' => 'mysql',
            'options' => array(
                'hostname' => '{$host}',
                'username' => '{$user}',
                'password' => '{$pass}',
                'database' => '{$db}'
                ),
            'table_prefix' => '{$prefix}',
            )
        )
    );
EOF;
            fwrite($dz, $fileData);
            fclose($dz);

            function doquery($query, $p) {
                $query = str_replace("{{prefix}}", $p, $query);
                $return = mysql_query($query) or die("MySQL Error: <b>".mysql_error()."</b>");
            return $return;
            }
            foreach ($QryMigrate as $query) {
                doquery($query, $prefix);
            }

            $SubTPL = gettemplate ('install/ins_goto_done');
            $bloc   = $lang;
            $frame  = parsetemplate ( $SubTPL, $bloc );
        }
         break;

    case 'bye':
            header("Location: ../");
         break;

    default:
        header('Location: ./');
        die();
}

$parse                 = $lang;
$parse['ins_state']    = $Page;
$parse['ins_page']     = $frame;
$parse['dis_ins_btn']  = "?mode=$Mode&page=$nextpage";
$Displ                 = parsetemplate ($MainTPL, $parse);

display ($Displ, "Installeur", false, '', true);
