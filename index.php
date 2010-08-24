<?php

/**
 * index.php
 *
 * @version 2.0
 * @copyright 2008 by e-Zobar for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (filesize('config.php') == 0)
{
	header('location: install/');
	exit();
}
elseif (file_exists('install/'))
{
	echo("<h2><b>Por favor, elimine el archivo de instalación antes de continuar</b></h2><br>
	Por razones de seguridad, es obligatorio eliminar <i> (o cambiar el nombre) </i> gracias.");
}
elseif($_GET[claveperdida] == "" && $_GET[salir] == "")
{
	define('INSIDE'  , true);
	define('INSTALL' , false);
	define('LOGIN'   , true);

	$InLogin = true;

	$xnova_root_path = './';
	include($xnova_root_path . 'extension.inc.php');
	include($xnova_root_path . 'common.' . $phpEx);

	if ($_POST)
	{
		$login = doquery("SELECT `id`,`id_planet`,`username`,`password` FROM {{table}} WHERE `username` = '" . mysql_escape_string($_POST['username']) . "' LIMIT 1", "users", true);

		if($login['banaday'] <= time() && $login['banaday'] !='0' )
		{
			doquery("UPDATE {{table}} SET `banaday` = '0', `bana` = '0' WHERE `username` = '".$login['username']."' LIMIT 1;", 'users');
			doquery("DELETE FROM {{table}} WHERE `who` = '".$login['username']."'",'banned');
		}

		if ($login)
		{
			if ($login['password'] == md5($_POST['password']))
			{
				if (isset($_POST["rememberme"]))
				{
					$expiretime = time() + 31536000;
					$rememberme = 1;
				}
				else
				{
					$expiretime = 0;
					$rememberme = 0;
				}

				@include('config.php');
				$cookie = $login["id"] . "/%/" . $login["username"] . "/%/" . md5($login["password"] . "--" . $dbsettings["secretword"]) . "/%/" . $rememberme;
				setcookie($game_config['COOKIE_NAME'], $cookie, $expiretime, "/", "", 0);

				doquery("UPDATE {{table}} SET `current_planet`='".$login['id_planet']."' WHERE `id` ='".$login["id"]."'", 'users');

				unset($dbsettings);
				header("Location: ./frames.php");
				exit;
			}
			else
			{
				message("¡Datos ingresados incorrectos! <br /><a href=\"index.php\" target=\"_top\">Volver al inicio</a>", "¡Error!", "./",2);
			}
		}
		else
		{
			message("¡Datos ingresados incorrectos! <br /><a href=\"index.php\" target=\"_top\">Volver al inicio</a>", "¡Error!", "./",2);
		}
	}
	else
	{
		$parse['servername']   = $game_config['game_name'];
		$parse['forum_url']    = $game_config['forum_url'];

		display(parsetemplate(gettemplate('index_body'), $parse), "Bienvenido");
	}
}
elseif($_GET[claveperdida] == "ok" && $_GET[salir] == "")
{
	define('INSIDE'  , true);
	define('INSTALL' , false);

	$xnova_root_path = './';
	include($xnova_root_path . 'extension.inc.php');
	include($xnova_root_path . 'common.' . $phpEx);
	include($xnova_root_path . 'includes/functions/SendNewPassword.' . $phpEx);

	if($_POST[email])
	{
		$email               = $_POST['email'];
		sendnewpassword($email);
		message('¡La nueva contraseña ha sido enviado con éxito!', "Enviada", "./",2);
	}
	else
	{
		display(parsetemplate(gettemplate('lostpassword'), $parse), "Recuperar clave", false);
	}
}
elseif($_GET[claveperdida] == "" && $_GET[salir] == "salir")
{
	define('INSIDE'  , true);
	define('INSTALL' , false);

	$xnova_root_path = './';
	include($xnova_root_path . 'extension.inc.php');
	include($xnova_root_path . 'common.'.$phpEx);

	setcookie($game_config['COOKIE_NAME'], "", time()-100000, "/", "", 0);

	message ("Esperamos volverte a ver muy pronto.", "Sesión terminada", "./",1);
}
?>