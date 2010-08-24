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

if (filesize('config.php') == 0)
{
	header('location: install/');
	exit();
}
elseif (file_exists('install/'))
{
	echo("<h2><b>Por favor, elimine el archivo de instalación antes de continuar</b></h2><br>
	Por razones de seguridad, es obligatorio eliminar <em> (o cambiar el nombre) </em> gracias.");
}
else
{
	define('INSIDE'  , true);
	define('INSTALL' , false);

	$InLogin = true;

	$xgp_root = './';
	include($xgp_root . 'extension.inc.php');
	include($xgp_root . 'common.' . $phpEx);

	includeLang('PUBLIC');
	$parse = $lang;
	switch($_GET[page])
	{
		case'lostpassword':
			define('LOGIN'   , true);

			function sendnewpassword($mail)
			{
				global $lang;

				$ExistMail = doquery("SELECT `email` FROM {{table}} WHERE `email` = '". $mail ."' LIMIT 1;", 'users', true);

				if (empty($ExistMail['email']))
				{
					message($lang['mail_not_exist'], "index.php?modo=claveperdida",2, false, false);
				}
				else
				{
					$Caracters="aazertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
					$Count=strlen($Caracters);
					$NewPass="";
					$Taille=6;
					srand((double)microtime()*1000000);
					for($i=0;$i<$Taille;$i++)
					{
						$CaracterBoucle=rand(0,$Count-1);
						$NewPass=$NewPass.substr($Caracters,$CaracterBoucle,1);
					}
					$Title 	= $lang['mail_title'];
					$Body 	= $lang['mail_text'];
					$Body  .= $NewPass;
					mail($mail,$Title,$Body);
					$NewPassSql = md5($NewPass);
					$QryPassChange = "UPDATE {{table}} SET ";
					$QryPassChange .= "`password` ='". $NewPassSql ."' ";
					$QryPassChange .= "WHERE `email`='". $mail ."' LIMIT 1;";
					doquery( $QryPassChange, 'users');
				}
			}

			if($_POST)
			{
				sendnewpassword($_POST['email']);
				message($lang['mail_sended'], "./",2, false, false);
			}
			else
			{
				$parse['forum_url']    = $game_config['forum_url'];
				display(parsetemplate(gettemplate('lostpassword'), $parse), false, '',false, false);
			}
		break;
		case'credit':
			display(parsetemplate(gettemplate('credit_body'), $parse), false, '',false, false);
		break;
		case'contact':
			$QrySelectUser  = "SELECT `username`, `email` ";
			$QrySelectUser .= "FROM `{{table}}` ";
			$QrySelectUser .= "WHERE `authlevel` != '0' ORDER BY `username` ASC;";
			$GameOps = doquery ($QrySelectUser, 'users');

			while($Ops = mysql_fetch_assoc($GameOps))
			{
				$bloc['ctc_data_name']    = $Ops['username'];
				$bloc['ctc_data_mail']    = "<a href=mailto:".$Ops['email'].">".$Ops['email']."</a>";
				$parse['ctc_admin_list'] .= parsetemplate(gettemplate('contact_body_rows'), $bloc);
			}
			display(parsetemplate(gettemplate('contact_body'), $parse), false, '',false, false);
		break;
		default:
			define('LOGIN'   , true);

			if ($_POST)
			{
				$login = doquery("SELECT `id`,`id_planet`,`username`,`password`,`banaday` FROM {{table}} WHERE `username` = '" . mysql_escape_string($_POST['username']) . "' AND `password` = '" . md5($_POST['password']) . "' LIMIT 1", "users", true);

				if($login['banaday'] <= time() && $login['banaday'] != '0' )
				{
					doquery("UPDATE {{table}} SET `banaday` = '0', `bana` = '0' WHERE `username` = '".$login['username']."' LIMIT 1;", 'users');
					doquery("DELETE FROM {{table}} WHERE `who` = '".$login['username']."'",'banned');
				}

				if ($login)
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

					doquery("UPDATE `{{table}}` SET `current_planet` = '".$login['id_planet']."' WHERE `id` ='".$login["id"]."'", 'users');

					unset($dbsettings);
					header("Location: ./game.php?page=overview");
					exit;
				}
				else
				{
					message($lang['login_error'], "./", 2, false, false);
				}
			}
			else
			{
				$parse['servername']   = $game_config['game_name'];
				$parse['forum_url']    = $game_config['forum_url'];
				display(parsetemplate(gettemplate('index_body'), $parse), false, '',false, false);
			}
	}
}
?>