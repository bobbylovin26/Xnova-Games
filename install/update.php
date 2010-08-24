<?php

/**
 * update.php
 *
 * @version 1.5
 * @copyright 2008 By lucky for XG Proyect
 *
 */

define('INSIDE'  , true);
define('INSTALL'  , false);

$xnova_root_path = './../';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.'.$phpEx);

echo "<center>";
if ($_POST)
{
if ($_POST[continuar] && !$_POST[aceptar] or empty($_POST[modo]) or empty($_POST[servidor]) or empty($_POST[usuario]) or empty($_POST[clave]) or empty($_POST[base]) or empty($_POST[prefix]))
	{
		echo "Debes aceptar los terminos, y rellenar todos los campos<br>";
		echo "<a href=\"./update.php\">Volver</a>";
	}
	else
	{
		$conexion = mysql_connect($_POST[servidor], $_POST[usuario], $_POST[clave]) or die ('Problemas en la conexión con el servidor.');
		mysql_select_db($_POST[base],$conexion) or die ('Problemas en la conexión con la base de datos.');

		switch($_POST[modo])
		{
		case '1.3b':
		$Qry15 = mysql_query("ALTER TABLE `$_POST[prefix]_users` DROP `sign`;");
		$Qry16 = mysql_query(" ALTER TABLE `$_POST[prefix]_users` CHANGE `rpg_points` `darkmatter` INT( 11 ) NOT NULL DEFAULT '0' ");
		$Qry17 = mysql_query("ALTER TABLE `$_POST[prefix]_fleets` ADD `fleet_resource_darkmatter` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `fleet_resource_deuterium` ;");
		$Qry18 = mysql_query("ALTER TABLE `$_POST[prefix]_users` DROP `avatar`;");
		$Qry19 = mysql_query("DROP TABLE `$_POST[prefix]_chat`;");
		$Qry20 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT( `$_POST[prefix]_config`.`config_name` USING utf8 ) = 'OverviewExternChat' AND CONVERT( `$_POST[prefix]_config`.`config_value` USING utf8 ) = '0' LIMIT 1 ;");
		$Qry21 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT( `$_POST[prefix]_config`.`config_name` USING utf8 ) = 'OverviewExternChatCmd' AND CONVERT( `$_POST[prefix]_config`.`config_value` USING utf8 ) = '' LIMIT 1 ;");
		$Qry22 = mysql_query("DROP TABLE `$_POST[prefix]_multi`, `$_POST[prefix]_declared`, `$_POST[prefix]_annonce`;");
		$Qry23 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_announces' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");

		if ($Qry15)
			$msg .=  "<font color=\"green\"><-HECHO Qry15-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry15-></font><br>";

		if ($Qry16)
			$msg .=  "<font color=\"green\"><-HECHO Qry16-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry16-></font><br>";
		if ($Qry17)
			$msg .=  "<font color=\"green\"><-HECHO Qry17-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry17-></font><br>";
		if ($Qry18)
			$msg .=  "<font color=\"green\"><-HECHO Qry18-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry18-></font><br>";
		if ($Qry19)
			$msg .=  "<font color=\"green\"><-HECHO Qry19-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry19-></font><br>";
		if ($Qry20)
			$msg .=  "<font color=\"green\"><-HECHO Qry20-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry20-></font><br>";
		if ($Qry21)
			$msg .=  "<font color=\"green\"><-HECHO Qry21-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry21-></font><br>";
		if ($Qry22)
			$msg .=  "<font color=\"green\"><-HECHO Qry22-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry22-></font><br>";
		if ($Qry23)
			$msg .=  "<font color=\"green\"><-HECHO Qry23-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry23-></font><br>";
			break;
		case '1.3c':
		$Qry18 = mysql_query("ALTER TABLE `$_POST[prefix]_users` DROP `avatar`;");
		$Qry19 = mysql_query("DROP TABLE `$_POST[prefix]_chat`;");
		$Qry20 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT( `$_POST[prefix]_config`.`config_name` USING utf8 ) = 'OverviewExternChat' AND CONVERT( `$_POST[prefix]_config`.`config_value` USING utf8 ) = '0' LIMIT 1 ;");
		$Qry21 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT( `$_POST[prefix]_config`.`config_name` USING utf8 ) = 'OverviewExternChatCmd' AND CONVERT( `$_POST[prefix]_config`.`config_value` USING utf8 ) = '' LIMIT 1 ;");
		$Qry22 = mysql_query("DROP TABLE `$_POST[prefix]_multi`, `$_POST[prefix]_declared`, `$_POST[prefix]_annonce`;");
		$Qry23 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_announces' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");

		if ($Qry18)
			$msg .=  "<font color=\"green\"><-HECHO Qry18-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry18-></font><br>";
		if ($Qry19)
			$msg .=  "<font color=\"green\"><-HECHO Qry19-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry19-></font><br>";
		if ($Qry20)
			$msg .=  "<font color=\"green\"><-HECHO Qry20-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry20-></font><br>";
		if ($Qry21)
			$msg .=  "<font color=\"green\"><-HECHO Qry21-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry21-></font><br>";
		if ($Qry22)
			$msg .=  "<font color=\"green\"><-HECHO Qry22-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry22-></font><br>";
		if ($Qry23)
			$msg .=  "<font color=\"green\"><-HECHO Qry23-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry23-></font><br>";
			break;

		case '1.4b':
		$Qry22 = mysql_query("DROP TABLE `$_POST[prefix]_annonce`");
		$Qry23 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_announces' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");

		if ($Qry22)
			$msg .=  "<font color=\"green\"><-HECHO Qry22-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry22-></font><br>";

		if ($Qry23)
			$msg .=  "<font color=\"green\"><-HECHO Qry23-></font><br>";
		else
			$msg .=  "<font color=\"red\"><-ERROR Qry23-></font><br>";
			break;
		}

		echo $msg;
		echo "<br>";
		echo "<font color=\"red\"><strong>Recuerda borrar la carpeta install y este archivo tambien</strong></font>";

		mysql_close($link);
	}
}
else
{
?>
<head>
	<title>XNova | Auto-Update v1.5 by lucky for XG PROYECT</title>
	<link rel="stylesheet" type="text/css" href="../css/styles.css">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<form name="aceptar" method="POST" action="">
	<table class="c" border="0" cellspacing="0" cellpadding="0" width="50%">
		<tr>
			<td colspan="2">
		      <div align="justify"><strong>Bienvenido al sistema de actualización de tu XNova.</strong><br>
		        Este sistema actualizará tu XNova de la última versión.<br>
Xtreme-gameZ.com.ar y/o el/los responsable(s) del desarrollo de este update, no se hacen cargo de la perdida de datos y/o errores.<br>
En definitiva para continuar con la actualización debes aceptar los siguientes terminos...<br>
Soy conciente de que este script no es perfecto, y que solo funciona con instalaciones limpias de XNova,
 soportando unicamente las versiones mencionadas
 y que cualquier daño, perdida de datos y/o problemas con mi base de datos corre por mi cuenta(usuario del script update).<br>
 <strong>Confirmo que mi intencion es actualizar solo las versiones soportadas y que previamente realice un backup de mi base de datos.</strong><br>
			  </div></td>
	  </tr>
		<tr>
			<th colspan="2" align="center"><br>Aceptar <input type="checkbox" name="aceptar"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Servidor SQL</th>
			<th align="center"><input type="text" name="servidor"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Usuario SQL</th>
			<th align="center"><input type="text" name="usuario"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Clave SQL</th>
			<th align="center"><input type="text" name="clave"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Nombre de la base SQL</th>
			<th align="center"><input type="text" name="base"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Prefijo de las tablas(sin _)</th>
			<th align="center"><input type="text" name="prefix"/><br><br><br></th>
		</tr>
		<tr>
			<th colspan="2">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<th align="center" colspan="5">Tengo la versi&oacute;n:<br><br><br></th>
					</tr>
					<tr>
						<th align="center">v9.0a/v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a</th>
						<th align="center">v1.3b/v1.3b EU</th>
						<th align="center">v1.3c DMV</th>
						<th align="center">v1.4a/v1.4b</th>
					</tr>
					<tr>
						<th align="center"><font color="red"><strong>Versiones ya NO soportadas [Utiliza un auto-update viejo]</strong></red></th>
						<th align="center"><input type="radio" name="modo" value="1.3b"/></th>
						<th align="center"><input type="radio" name="modo" value="1.3c"/></th>
						<th align="center"><input type="radio" name="modo" value="1.4b"/></th>
					</tr>
				</table>
			</th>
		</tr>
		<tr>
			<th align="center" colspan="2"><br><input type="submit" name="continuar" value="Actualizar a la 1.4c"/></th>
		</tr>
	</table>
</form>
<?php
}
echo "</center>";
?>