<?php

/**
 * reg.php
 *
 * @version 1.1
 * @copyright 2008 by Chlorel for XNova
 */

define('INSIDE' , true);
define('INSTALL' , false);
define('LOGIN'   , true);

$InLogin = true;

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);

function sendpassemail($emailaddress, $password)
{
	global $game_config;
    $parse['gameurl'] = GAMEURL;
    $parse['password'] = $password;
    $email = parsetemplate("Muchas gracias por registrarte en nuestro juego. \n Tu contraseña es: {password} \n\n ¡Disfrutá del juego! \n {gameurl}", $parse);
    $status = mymail($emailaddress, "Registro en " . $game_config['game_name'], $email);
    return $status;
}

function mymail($to, $title, $body, $from = '')
{
    $from = trim($from);

    if (!$from) {
        $from = ADMINEMAIL;
    }

    $rp = ADMINEMAIL;

    $head = '';
    $head .= "Content-Type: text/html \r\n";
	$head  .= "charset: iso-8859-1 \r\n";
    $head .= "Date: " . date('r') . " \r\n";
    $head .= "Return-Path: $rp \r\n";
    $head .= "From: $from \r\n";
    $head .= "Sender: $from \r\n";
    $head .= "Reply-To: $from \r\n";
    $head .= "Organization: $org \r\n";
    $head .= "X-Sender: $from \r\n";
    $head .= "X-Priority: 3 \r\n";
    $body = str_replace("\r\n", "\n", $body);
    $body = str_replace("\n", "\r\n", $body);

    return mail($to, $title, $body, $head);
}

if ($_POST) {
    $errors = 0;
    $errorlist = "";

    $_POST['email'] = strip_tags($_POST['email']);
    if (!is_email($_POST['email'])) {
        $errorlist .= "&#161;Correo electr&oacute;nico inv&aacute;lido!<br />";
        $errors++;
    }

    if (!$_POST['character']) {
        $errorlist .= "&#161;El campo del usuario no puedo estar vac&#237;o!<br />";
        $errors++;
    }

    if (strlen($_POST['passwrd']) < 4) {
        $errorlist .= "&#161;La contrase&ntilde;a debe tener al menos 4 caracteres!<br />";
        $errors++;
    }

    if (preg_match("/[^A-z0-9_\-]/", $_POST['character']) == 1) {
        $errorlist .= "&#161;El campo de usuario s&oacute;lo puede contener caracteres alfanum&eacute;ricos!<br />";
        $errors++;
    }

    if ($_POST['rgt'] != 'on') {
        $errorlist .= "&#161;Debe aceptar nuestros t&#233;rminos y condiciones de uso!<br />";
        $errors++;
    }

    $ExistUser = doquery("SELECT `username` FROM {{table}} WHERE `username` = '" . mysql_escape_string($_POST['character']) . "' LIMIT 1;", 'users', true);
    if ($ExistUser) {
        $errorlist .= "&#161;El nombre de usuario elegido ya existe!<br />";
        $errors++;
    }

    $ExistMail = doquery("SELECT `email` FROM {{table}} WHERE `email` = '" . mysql_escape_string($_POST['email']) . "' LIMIT 1;", 'users', true);
    if ($ExistMail) {
        $errorlist .= "&#161;El email ingresado ya existe!<br />";
        $errors++;
    }

    if ($errors != 0) {
        message ($errorlist, "<font color=\"red\">Error en el registro</font>", "reg.php", "3");
    } else {
    	$newpass	= $_POST['passwrd'];
        $UserName 	= $_POST['character'];
        $UserEmail 	= $_POST['email'];
        $md5newpass = md5($newpass);

        $QryInsertUser = "INSERT INTO {{table}} SET ";
        $QryInsertUser .= "`username` = '" . mysql_escape_string(strip_tags($UserName)) . "', ";
        $QryInsertUser .= "`email` = '" . mysql_escape_string($UserEmail) . "', ";
        $QryInsertUser .= "`email_2` = '" . mysql_escape_string($UserEmail) . "', ";
	    $QryInsertUser .= "`ip_at_reg` = '" . $_SERVER["REMOTE_ADDR"] . "', ";
        $QryInsertUser .= "`id_planet` = '0', ";
        $QryInsertUser .= "`register_time` = '" . time() . "', ";
        $QryInsertUser .= "`password`='" . $md5newpass . "';";
        doquery($QryInsertUser, 'users');
        // On cherche le numero d'enregistrement de l'utilisateur fraichement créé
        $NewUser = doquery("SELECT `id` FROM {{table}} WHERE `username` = '" . mysql_escape_string($_POST['character']) . "' LIMIT 1;", 'users', true);
        $iduser = $NewUser['id'];
        // Recherche d'une place libre !
        $LastSettedGalaxyPos = $game_config['LastSettedGalaxyPos'];
        $LastSettedSystemPos = $game_config['LastSettedSystemPos'];
        $LastSettedPlanetPos = $game_config['LastSettedPlanetPos'];
        while (!isset($newpos_checked)) {
            for ($Galaxy = $LastSettedGalaxyPos; $Galaxy <= MAX_GALAXY_IN_WORLD; $Galaxy++) {
                for ($System = $LastSettedSystemPos; $System <= MAX_SYSTEM_IN_GALAXY; $System++) {
                    for ($Posit = $LastSettedPlanetPos; $Posit <= 4; $Posit++) {
                        $Planet = round (rand (4, 12));

                        switch ($LastSettedPlanetPos) {
                            case 1:
                                $LastSettedPlanetPos += 1;
                                break;
                            case 2:
                                $LastSettedPlanetPos += 1;
                                break;
                            case 3:
                                if ($LastSettedSystemPos == MAX_SYSTEM_IN_GALAXY) {
                                    $LastSettedGalaxyPos += 1;
                                    $LastSettedSystemPos = 1;
                                    $LastSettedPlanetPos = 1;
                                    break;
                                } else {
                                    $LastSettedPlanetPos = 1;
                                }
                                $LastSettedSystemPos += 1;
                                break;
                        }
                        break;
                    }
                    break;
                }
                break;
            }

            $QrySelectGalaxy = "SELECT * ";
            $QrySelectGalaxy .= "FROM {{table}} ";
            $QrySelectGalaxy .= "WHERE ";
            $QrySelectGalaxy .= "`galaxy` = '" . $Galaxy . "' AND ";
            $QrySelectGalaxy .= "`system` = '" . $System . "' AND ";
            $QrySelectGalaxy .= "`planet` = '" . $Planet . "' ";
            $QrySelectGalaxy .= "LIMIT 1;";
            $GalaxyRow = doquery($QrySelectGalaxy, 'galaxy', true);

            if ($GalaxyRow["id_planet"] == "0") {
                $newpos_checked = true;
            }

            if (!$GalaxyRow) {
                CreateOnePlanetRecord ($Galaxy, $System, $Planet, $NewUser['id'], $UserPlanet, true);
                $newpos_checked = true;
            }
            if ($newpos_checked) {
                doquery("UPDATE {{table}} SET `config_value` = '" . $LastSettedGalaxyPos . "' WHERE `config_name` = 'LastSettedGalaxyPos';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $LastSettedSystemPos . "' WHERE `config_name` = 'LastSettedSystemPos';", 'config');
                doquery("UPDATE {{table}} SET `config_value` = '" . $LastSettedPlanetPos . "' WHERE `config_name` = 'LastSettedPlanetPos';", 'config');
            }
        }
        // Recherche de la reference de la nouvelle planete (qui est unique normalement !
        $PlanetID = doquery("SELECT `id` FROM {{table}} WHERE `id_owner` = '". $NewUser['id'] ."' LIMIT 1;" , 'planets', true);

        // Mise a jour de l'enregistrement utilisateur avec les infos de sa planete mere
        $QryUpdateUser = "UPDATE {{table}} SET ";
        $QryUpdateUser .= "`id_planet` = '" . $PlanetID['id'] . "', ";
        $QryUpdateUser .= "`current_planet` = '" . $PlanetID['id'] . "', ";
        $QryUpdateUser .= "`galaxy` = '" . $Galaxy . "', ";
        $QryUpdateUser .= "`system` = '" . $System . "', ";
        $QryUpdateUser .= "`planet` = '" . $Planet . "' ";
        $QryUpdateUser .= "WHERE ";
        $QryUpdateUser .= "`id` = '" . $NewUser['id'] . "' ";
        $QryUpdateUser .= "LIMIT 1;";
        doquery($QryUpdateUser, 'users');
        // Envois d'un message in-game sympa ^^
        $from = "Admin";
        $sender = "Admin";
        $Subject = "Bienvenido";
        $message = "&#161;Bienvenido a XG Proyect!<p>Al comenzar, construye una mina de Metal.<br />Para hacerlo, haz click en el enlace \"Edificios\" en la izquierda, y dale a \"construir\" a la derecha de la mina de metal.<br />Ahora tienes algo de tiempo para conocer m&#225;s cosas del juego.<p>Podr&#225;s encontrar ayuda:<br />En el <a href=\"http://www.xtreme-gamez.com.ar/foros\" target=\"_blank\">Foro</a><br />Ahora, tu mina deber&#237;a estar acabada.<br />Como no producen nada sin energ&#237;a, deber&#237;as construir una Planta de energ&#237;a solar, vuelve a Edificios, y elige construir la Planta de energ&#237;a solar.<p>Para ver todas las naves, estructuras defensivas, edificios e investigaciones que puedes investigar, puedes echarle un vistazo al &#226;rbol de tecnolog&#237;a en \"Tecnolog&#237;a\" en el menú izquierdo.<p>Ahora ya puedes empezar la conquista del universo... &#161;Buena suerte!";
        SendSimpleMessage($iduser, $sender, $Time, 1, $from, $Subject, $message);

        doquery("UPDATE {{table}} SET `config_value` = `config_value` + '1' WHERE `config_name` = 'users_amount' LIMIT 1;", 'config');

        $Message = "&#161;Gracias por registrarte!";
        if (sendpassemail($_POST['email'], "$newpass")) {
            $Message .= " (" . htmlentities($_POST["email"]) . ")";
        } else {
            $Message .= " (" . htmlentities($_POST["email"]) . ")";
            $Message .= "<br><br>Un error se produjo en el env&iacute;o del e-mail. Tu contrase&ntilde;a es: <b>" . $newpass . "</b>";
        }
        message( $Message, "&#161;Registro completado con &#233;xito!", "index.".$phpEx, "3" );
    }
} else {
	$parse['servername']   = $game_config['game_name'];
	$parse['forum_url']    = $game_config['forum_url'];
    display (parsetemplate(gettemplate('registry_form'), $parse), "Registro", false);
}
?>
