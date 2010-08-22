<?php

/**
 * XNova Legacies
 *
 * @license http://www.xnova-ng.org/license-legacies
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *  - Neither the name of the team or any contributor may be used to endorse or
 * promote products derived from this software without specific prior written
 * permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */
define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('PHPEXT', require 'extension.inc');

define('VERSION','0.8e');       // Afficher la version d'XNova utilisÃ©e...

set_magic_quotes_runtime(0);

$game_config   = array();
$user          = array();
$lang          = array();
$link = NULL;
$IsUserChecked = false;

define('DEFAULT_SKINPATH' , 'skins/xnova/');
define('TEMPLATE_DIR'     , 'templates/');
define('TEMPLATE_NAME'    , 'OpenGame');
define('DEFAULT_LANG'     , 'fr');

$HTTP_ACCEPT_LANGUAGE = DEFAULT_LANG;

include(ROOT_PATH . 'includes/debug.class.'.PHPEXT);
$debug = new debug();

include(ROOT_PATH . 'includes/constants.'.PHPEXT);
include(ROOT_PATH . 'includes/functions.'.PHPEXT);
include(ROOT_PATH . 'includes/unlocalised.'.PHPEXT);
include(ROOT_PATH . 'includes/todofleetcontrol.'.PHPEXT);
include(ROOT_PATH . 'language/'. DEFAULT_LANG .'/lang_info.cfg');

if (INSTALL != true) {
    include(ROOT_PATH . 'includes/vars.'.PHPEXT);
    include(ROOT_PATH . 'includes/db.'.PHPEXT);
    include(ROOT_PATH . 'includes/strings.'.PHPEXT);

    // Lecture de la table de configuration
    $query = doquery("SELECT * FROM {{table}}",'config');
    while ( $row = mysql_fetch_assoc($query) ) {
	    $game_config[$row['config_name']] = $row['config_value'];
    }

	if ($InLogin != true) {
		$Result        = CheckTheUser ( $IsUserChecked );
		$IsUserChecked = $Result['state'];
		$user          = $Result['record'];
	} elseif ($InLogin == false) {
		// Jeux en mode 'clos' ???
		if( $game_config['game_disable']) {
			if ($user['authlevel'] < 1) {
				message ( stripslashes ( $game_config['close_reason'] ), $game_config['game_name'] );
			}
		}
	}

	includeLang ("system");
	includeLang ('tech');
	
		$log = array("login.php","contact.php","reg.php","lostpassword.php","credit.php","banned.php");//page autorisé
		
		// strripos($_SERVER["PHP_SELF"], "/") retourne la position du dernier caractère '/' de la chaîne
		
		if($user['id'] == '' && in_array(substr($_SERVER["PHP_SELF"], strripos($_SERVER["PHP_SELF"], "/") + 1),$log) == false)
		{
			$dpath     = "./" . DEFAULT_SKINPATH;
			message ("<th align=\"left\">Je vous prie de bien vouloir vous connecter sur le serveur!</th><th><a href=\"login.php\"><font color=\"red\">Retour</font></a></th>","<th colspan=\"2\"><center><font color=\"lime\">Vous n'&ecirc;tes pas connect&eacute; !</font></center></th>","login.php","3");
        }

	if ( isset ($user) ) {
		$_fleets = doquery("SELECT * FROM {{table}} WHERE `fleet_start_time` <= '".time()."';", 'fleets'); //  OR fleet_end_time <= ".time()
		while ($row = mysql_fetch_array($_fleets)) {
			$array                = array();
			$array['galaxy']      = $row['fleet_start_galaxy'];
			$array['system']      = $row['fleet_start_system'];
			$array['planet']      = $row['fleet_start_planet'];
			$array['planet_type'] = $row['fleet_start_type'];

			$temp = FlyingFleetHandler ($array);
		}

		$_fleets = doquery("SELECT * FROM {{table}} WHERE `fleet_end_time` <= '".time()."';", 'fleets'); //  OR fleet_end_time <= ".time()
		while ($row = mysql_fetch_array($_fleets)) {
			$array                = array();
			$array['galaxy']      = $row['fleet_end_galaxy'];
			$array['system']      = $row['fleet_end_system'];
			$array['planet']      = $row['fleet_end_planet'];
			$array['planet_type'] = $row['fleet_end_type'];

			$temp = FlyingFleetHandler ($array);
		}

		unset($_fleets);

		include(ROOT_PATH . 'rak.'.PHPEXT);
		if ( defined('IN_ADMIN') ) {
			$UserSkin  = $user['dpath'];
			$local     = stristr ( $UserSkin, "http:");
			if ($local === false) {
				if (!$user['dpath']) {
					$dpath     = "../". DEFAULT_SKINPATH  ;
				} else {
					$dpath     = "../". $user["dpath"];
				}
			} else {
				$dpath     = $UserSkin;
			}
		} else {
			$dpath     = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];
		}

		SetSelectedPlanet ( $user );

		$planetrow = doquery("SELECT * FROM {{table}} WHERE `id` = '".$user['current_planet']."';", 'planets', true);
		$galaxyrow = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '".$planetrow['id']."';", 'galaxy', true);

		CheckPlanetUsedFields($planetrow);
		$mv = array("/xnova sp1/floten3.php","/xnova sp1/resources.php");//page autorisé
        if($user['urlaubs_modus'] == 1 && in_array($_SERVER["PHP_SELF"],$mv) == true){
            message ("Vous &ecirc;tes en mode vacance vous ne pouvez pas jouer!","<center><font color=\"lime\">Mode Vacance Actif</font></center>");
        }
	} else {
		// Bah si dï¿½ja y a quelqu'un qui passe par lï¿½ et qu'a rien a faire de pressï¿½ ...

	}
} else {
	$dpath     = "../" . DEFAULT_SKINPATH;
}

?>
