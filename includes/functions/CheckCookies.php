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
