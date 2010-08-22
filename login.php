<?php
/**
 * Tis file is part of XNova:Legacies
 *
 * @license http://www.gnu.org/licenses/gpl-3.0.txt
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team <http://www.xnova-ng.org>
 * All rights reserved.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

define('INSIDE' , true);
define('INSTALL' , false);
define('LOGIN'   , true);
require_once dirname(__FILE__) .'/common.php';


$InLogin = true;

	includeLang('login');

	if ($_POST) {
		$login = doquery("SELECT * FROM {{table}} WHERE `username` = '" . mysql_escape_string($_POST['username']) . "' LIMIT 1", "users", true);
        if($login['banaday'] <= time() & $login['banaday'] !='0' ){
            doquery("UPDATE {{table}} SET `banaday` = '0', `bana` = '0', `urlaubs_modus` ='0'  WHERE `username` = '".$login['username']."' LIMIT 1;", 'users');
         doquery("DELETE FROM {{table}} WHERE `who` = '".$login['username']."'",'banned');
      }
		if ($login) {
			if ($login['password'] == md5($_POST['password'])) {
				if (isset($_POST["rememberme"])) {
					$expiretime = time() + 31536000;
					$rememberme = 1;
				} else {
					$expiretime = 0;
					$rememberme = 0;
				}

				@include('config.php');
				$cookie = $login["id"] . "/%/" . $login["username"] . "/%/" . md5($login["password"] . "--" . $dbsettings["secretword"]) . "/%/" . $rememberme;
				setcookie(str_replace(' ', '', $game_config['COOKIE_NAME']), $cookie, $expiretime, "/", "", 0);

				unset($dbsettings);
				header("Location: ./frames.php");
				exit;
			} else {
				message($lang['Login_FailPassword'], $lang['Login_Error']);
			}
		} else {
			message($lang['Login_FailUser'], $lang['Login_Error']);
		}
	} else {
		$parse                 = $lang;
		$Count                 = doquery('SELECT COUNT(*) as `players` FROM {{table}} WHERE 1', 'users', true);
		$LastPlayer            = doquery('SELECT `username` FROM {{table}} ORDER BY `register_time` DESC', 'users', true);
		$parse['last_user']    = $LastPlayer['username'];
		$PlayersOnline         = doquery("SELECT COUNT(DISTINCT(id)) as `onlinenow` FROM {{table}} WHERE `onlinetime` > '" . (time()-900) ."';", 'users', true);
		$parse['online_users'] = $PlayersOnline['onlinenow'];
		$parse['users_amount'] = $Count['players'];
		$parse['servername']   = $game_config['game_name'];
		$parse['forum_url']    = $game_config['forum_url'];
		$parse['PasswordLost'] = $lang['PasswordLost'];

		$page = parsetemplate(gettemplate('login_body'), $parse);

		// Test pour prendre le nombre total de joueur et le nombre de joueurs connect�s
		if ($_GET['ucount'] == 1) {
			$page = $PlayersOnline['onlinenow']."/".$Count['players'];
			die ( $page );
		} else {
			display($page, $lang['Login']);
		}
	}

// -----------------------------------------------------------------------------------------------------------
// History version

?>
