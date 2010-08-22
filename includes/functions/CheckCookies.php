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

function CheckCookies ( $IsUserChecked )
{
    global $lang, $game_config;

    @session_start(); // TODO: Ouch!

    includeLang('cookies');

    $UserRow = array();

    if (isset($_COOKIE[$game_config['COOKIE_NAME']])) {
        $TheCookie  = explode("/%/", $_COOKIE['nova-cookie']);
        $UserRow = doquery('SELECT * FROM {{table}} WHERE `username` = "'
            . mysql_real_escape_string($TheCookie[1]). '" LIMIT 1;', 'users', true);


        // On teste si on a bien le bon UserID
        if ($UserRow["id"] != intval($TheCookie[0])) {
            message( $lang['cookies']['Error2'] );
        }

        // On teste si le mot de passe est correct !
        if ($_SESSION['session_hash'] !== intval($TheCookie[2])) {
            message( $lang['cookies']['Error3'] );
        }

        $NextCookie = implode("/%/", $TheCookie);
        // Au cas ou dans l'ancien cookie il etait question de se souvenir de moi
        // 3600 = 1 Heure // 86400 = 1 Jour // 31536000 = 365 Jours
        // on ajoute au compteur!
        if ($TheCookie[3] == 1) {
            $ExpireTime = time() + 31536000;
        } else {
            $ExpireTime = 0;
        }

        if ($IsUserChecked == false) {
            setcookie ($game_config['COOKIE_NAME'], $NextCookie, $ExpireTime, "/", "", 0);
            $QryUpdateUser  = "UPDATE {{table}} SET ";
            $QryUpdateUser .= "`onlinetime` = '". time() ."', ";
            $QryUpdateUser .= "`current_page` = '". mysql_real_escape_string($_SERVER['REQUEST_URI']) ."', ";
            $QryUpdateUser .= "`user_lastip` = '". mysql_real_escape_string($_SERVER['REMOTE_ADDR']) ."', ";
            $QryUpdateUser .= "`user_agent` = '". mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) ."' ";
            $QryUpdateUser .= "WHERE ";
            $QryUpdateUser .= "`id` = '". $TheCookie[0] ."' LIMIT 1;";
            doquery( $QryUpdateUser, 'users');
            $IsUserChecked = true;
        } else {
            $QryUpdateUser  = "UPDATE {{table}} SET ";
            $QryUpdateUser .= "`onlinetime` = '". time() ."', ";
            $QryUpdateUser .= "`current_page` = '". mysql_real_escape_string($_SERVER['REQUEST_URI']) ."', ";
            $QryUpdateUser .= "`user_lastip` = '". mysql_real_escape_string($_SERVER['REMOTE_ADDR']) ."', ";
            $QryUpdateUser .= "`user_agent` = '". mysql_real_escape_string($_SERVER['HTTP_USER_AGENT']) ."' ";
            $QryUpdateUser .= "WHERE ";
            $QryUpdateUser .= "`id` = '". $TheCookie[0] ."' LIMIT 1;";
            doquery( $QryUpdateUser, 'users');
            $IsUserChecked = true;
        }
    }

    $Return['state']  = $IsUserChecked;
    $Return['record'] = $UserRow;

    return $Return;
}
