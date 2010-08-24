<?php

/**
 * update.php
 *
 * @version 1.5
 * @copyright 2008 By lucky for XG Proyect
 *
 */

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
		case '1.4b':
			$Qry1 = mysql_query("DROP TABLE `$_POST[prefix]_annonce`");
			$Qry2 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_announces' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
			$Qry3 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `super_terraformer`int(11) NOT NULL AFTER `terraformer`; ");
			$Qry4 = mysql_query("ALTER TABLE `$_POST[prefix]_messages` ADD `leido` INT( 11 ) NOT NULL DEFAULT '1';");
			$Qry5 = mysql_query("
			CREATE TABLE `$_POST[prefix]_loteria` (
			  `ID` int(11) NOT NULL,
			  `user` varchar(255) collate latin1_spanish_ci NOT NULL,
			  `tickets` int(5) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;");
			$Qry6 = mysql_query("
			CREATE TABLE `$_POST[prefix]_chat` (
			  `messageid` int(5) unsigned NOT NULL auto_increment,
			  `user` varchar(255) NOT NULL default '',
			  `message` text NOT NULL,
			  `timestamp` int(11) NOT NULL default '0',
			  `ally_id` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`messageid`)
			) TYPE=MyISAM AUTO_INCREMENT=16 AUTO_INCREMENT=16 ;");

			$Qry7 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'Actualizacion';");
			$Qry8 = mysql_query("
			INSERT INTO `$_POST[prefix]_config` (
			`config_name` ,
			`config_value`
			)
			VALUES (
			'actualizar_puntos', '0'
			);");

			$Qry9 = mysql_query("
			ALTER TABLE `$_POST[prefix]_planets` ADD `interceptor` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `supernova` ,
			ADD `cazacrucero` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `interceptor` ,
			ADD `transportador` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `cazacrucero` ,
			ADD `titan` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `transportador` ;");

			$Qry10 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `fotocanyon` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `planet_protector` ,
ADD `baseespacial` INT( 11 ) NOT NULL DEFAULT '0' AFTER `fotocanyon` ;");

			$Qry11 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `humano` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `lang` ,
ADD `alien` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `humano` ,
ADD `predator` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `alien` ,
ADD `dark` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `predator` ;");

			$Qry12 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `humano_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `graviton_tech` ,
ADD `alien_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `humano_tech` ,
ADD `predator_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `alien_tech` ,
ADD `dark_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `predator_tech` ;");

			$Qry13 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `desarrollo_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `expedition_tech` ;");
			$Qry14 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_humano` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `titan` ;");
			$Qry15 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_alien` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `nave_humano` ;");
			$Qry16 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_predator` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `nave_alien` ;");
			$Qry17 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_dark` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `nave_predator` ; ");
			$Qry18 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `id_race` INT DEFAULT '-1' NOT NULL AFTER `Dark`;");
		break;

		case '1.4f':
			$Qry3 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `super_terraformer`int(11) NOT NULL AFTER `terraformer`; ");
			$Qry4 = mysql_query("ALTER TABLE `$_POST[prefix]_messages` ADD `leido` INT( 11 ) NOT NULL DEFAULT '1';");
			$Qry5 = mysql_query("
			CREATE TABLE `$_POST[prefix]_loteria` (
			  `ID` int(11) NOT NULL,
			  `user` varchar(255) collate latin1_spanish_ci NOT NULL,
			  `tickets` int(5) NOT NULL
			) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;");
			$Qry6 = mysql_query("
			CREATE TABLE `$_POST[prefix]_chat` (
			  `messageid` int(5) unsigned NOT NULL auto_increment,
			  `user` varchar(255) NOT NULL default '',
			  `message` text NOT NULL,
			  `timestamp` int(11) NOT NULL default '0',
			  `ally_id` int(11) NOT NULL default '0',
			  PRIMARY KEY  (`messageid`)
			) TYPE=MyISAM AUTO_INCREMENT=16 AUTO_INCREMENT=16 ;");

			$Qry7 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'Actualizacion';");
			$Qry8 = mysql_query("
			INSERT INTO `$_POST[prefix]_config` (
			`config_name` ,
			`config_value`
			)
			VALUES (
			'actualizar_puntos', '0'
			);");

			$Qry9 = mysql_query("
			ALTER TABLE `$_POST[prefix]_planets` ADD `interceptor` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `supernova` ,
			ADD `cazacrucero` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `interceptor` ,
			ADD `transportador` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `cazacrucero` ,
			ADD `titan` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `transportador` ;");

			$Qry10 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `fotocanyon` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `planet_protector` ,
ADD `baseespacial` INT( 11 ) NOT NULL DEFAULT '0' AFTER `fotocanyon` ;");

			$Qry11 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `humano` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `lang` ,
ADD `alien` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `humano` ,
ADD `predator` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `alien` ,
ADD `dark` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `predator` ;");

			$Qry12 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `humano_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `graviton_tech` ,
ADD `alien_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `humano_tech` ,
ADD `predator_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `alien_tech` ,
ADD `dark_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `predator_tech` ;");

			$Qry13 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `desarrollo_tech` INT( 11 ) NOT NULL DEFAULT '0' AFTER `expedition_tech` ;");
			$Qry14 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_humano` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `titan` ;");
			$Qry15 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_alien` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `nave_humano` ;");
			$Qry16 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_predator` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `nave_alien` ;");
			$Qry17 = mysql_query("ALTER TABLE `$_POST[prefix]_planets` ADD `nave_dark` BIGINT( 11 ) NOT NULL DEFAULT '0' AFTER `nave_predator` ; ");
			$Qry18 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `id_race` INT DEFAULT '-1' NOT NULL AFTER `Dark`;");
		break;

		case'1.5a':
			$Qry18 = mysql_query("ALTER TABLE `$_POST[prefix]_users` ADD `id_race` INT DEFAULT '-1' NOT NULL AFTER `Dark`;");
		break;
		}
		echo "<center><h1>¡LISTO!</h1></center>";
		echo "<br>";
		echo "<font color=\"red\"><strong>Recuerda borrar la carpeta install y este archivo tambien</strong></font>";

		mysql_close($conexion);
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
						<th align="center">v9.0a/v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a/v1.3b/v1.3b EU/v1.3c DMV</th>
						<th align="center">v1.4a/v1.4b/1.4c</th>
						<th align="center">1.4d/1.4e/1.4f</th>
						<th align="center">1.5a</th>
					</tr>
					<tr>
						<th align="center"><font color="red"><strong>Versiones ya NO soportadas, recomendamos siempre mantener al d&iacute;a tu juego</strong></red></th>
						<th align="center"><input type="radio" name="modo" value="1.4b"/></th>
						<th align="center"><input type="radio" name="modo" value="1.4f"/></th>
						<th align="center"><input type="radio" name="modo" value="1.5a"/></th>
					</tr>
				</table>
			</th>
		</tr>
		<tr>
			<th align="center" colspan="2"><br><input type="submit" name="continuar" value="Actualizar a la 1.5b"/></th>
		</tr>
	</table>
</form>
<?php
}
echo "</center>";
?>