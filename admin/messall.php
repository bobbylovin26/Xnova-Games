<?php

/**
 * messall.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] >= 2)
{
	if ($_POST && $_GET['mode'] == "change")
	{
		if ($user['authlevel'] == 3)
		{
			$kolor = 'red';
			$ranga = 'Administrador';
		}

		elseif ($user['authlevel'] == 2)
		{
			$kolor = 'skyblue';
			$ranga = 'Operador';
		}

		elseif ($user['authlevel'] == 1)
		{
			$kolor = 'yellow';
			$ranga = 'Moderador';
		}
		if ((isset($_POST["tresc"]) && $_POST["tresc"] != '') && (isset($_POST["temat"]) && $_POST["temat"] != ''))
		{
			$sq      = doquery("SELECT `id`,`username` FROM {{table}}", "users");
			$Time    = time();
			$From    = "<font color=\"". $kolor ."\">". $ranga ." ".$user['username']."</font>";
			$Subject = "<font color=\"". $kolor ."\">". $_POST['temat'] ."</font>";
			$Message = "<font color=\"". $kolor ."\"><b>". $_POST['tresc'] ."</b></font>";
			$summery=0;

			while ($u = mysql_fetch_array($sq))
			{
				SendSimpleMessage ( $u['id'], $user['id'], $Time, 1, $From, $Subject, $Message);
				$_POST['tresc'] = str_replace(":name:",$u['username'],$_POST['tresc']);
			}
			message("¡Su mensaje ha sido enviado!", "¡Enviado!", "messall." . $phpEx, 3);
		}
		else
		{
			message("¡Debes escribir un asunto!", "¡Error!", "messall." . $phpEx, 3);
		}
	}
	else
	{
		display(parsetemplate(gettemplate('admin/messall_body'), $parse), "Admin CP - Mensaje global", false,'', true, false);
	}
}
else
{
	message ("No tienes permisos suficientes", "¡Error!");
}
?>