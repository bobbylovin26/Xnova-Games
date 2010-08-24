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
		$conexion = @mysql_connect($_POST[servidor], $_POST[usuario], $_POST[clave])
		or die ('<font color=red><strong>Problemas en la conexión con el servidor, es probable que el <u>nombre del servidor, usuario o clave sean incorrectas o que mysql no esta funcionando.</u></strong></font>');
		@mysql_select_db($_POST[base],$conexion)
		or die ('<font color=red><strong>Problemas en la conexión con la base de datos. Este error puede deberse a que <u>la base de datos no existe o escribiste mal el nombre de la misma.</u></strong></font>');

		switch($_POST[modo])
		{
			case '1.4b':
				$Qry1 = mysql_query("DROP TABLE `$_POST[prefix]_annonce`");
				$Qry2 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_announces' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry4 = mysql_query("ALTER TABLE `$_POST[prefix]_messages` ADD `leido` INT( 11 ) NOT NULL DEFAULT '1';");
				$Qry7 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'Actualizacion';");
				$Qry8 = mysql_query("
				INSERT INTO `$_POST[prefix]_config` (
				`config_name` ,
				`config_value`
				)
				VALUES (
				'actualizar_puntos', '0'
				);");
				$Qry18 = mysql_query("DROP TABLE `$_POST[prefix]_chat`, `$_POST[prefix]_loteria`;");
				$Qry19 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'OverviewBanner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry20 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'OverviewClickBanner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry21 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyFrame' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry22 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyOwner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry23 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyFunct' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry24 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ForumBannerFrame' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry25 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_enable' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry26 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_name' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry27 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_url' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry28 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_marchand' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry29 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_notes' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry30 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'banner_source_post' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '../images/bann.png' LIMIT 1;");
				$Qry31 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'bot_name' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = 'XNoviana Reali' LIMIT 1;");
				$Qry32 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'bot_adress' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = 'xnova@xnova.fr' LIMIT 1;");
				$Qry33 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_bot' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry34 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ban_duration' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '30' LIMIT 1;");
				$Qry35 = mysql_query("ALTER TABLE `$_POST[prefix]_planets`
	  DROP `super_terraformer`,
	  DROP `interceptor`,
	  DROP `cazacrucero`,
	  DROP `transportador`,
	  DROP `titan`,
	  DROP `nave_humano`,
	  DROP `nave_alien`,
	  DROP `nave_predator`,
	  DROP `nave_dark`,
	  DROP `fotocanyon`,
	  DROP `baseespacial`;");
	  $Qry36 = mysql_query("ALTER TABLE `$_POST[prefix]_users`
	  DROP `humano`,
	  DROP `alien`,
	  DROP `predator`,
	  DROP `dark`,
	  DROP `id_race`,
	  DROP `kolorminus`,
	  DROP `kolorplus`,
	  DROP `kolorpoziom`,
	  DROP `desarrollo_tech`,
	  DROP `humano_tech`,
	  DROP `alien_tech`,
	  DROP `predator_tech`,
	  DROP `dark_tech`
	  DROP `raids1`,
	  DROP `raidsdraw`,
	  DROP `raidswin`,
	  DROP `raidsloose`;");
			break;

			case '1.4f':
				$Qry4 = mysql_query("ALTER TABLE `$_POST[prefix]_messages` ADD `leido` INT( 11 ) NOT NULL DEFAULT '1';");
				$Qry7 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'Actualizacion';");
				$Qry8 = mysql_query("
				INSERT INTO `$_POST[prefix]_config` (
				`config_name` ,
				`config_value`
				)
				VALUES (
				'actualizar_puntos', '0'
				);");
				$Qry18 = mysql_query("DROP TABLE `$_POST[prefix]_chat`, `$_POST[prefix]_loteria`;");
				$Qry19 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'OverviewBanner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry20 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'OverviewClickBanner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry21 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyFrame' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry22 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyOwner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry23 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyFunct' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry24 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ForumBannerFrame' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry25 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_enable' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry26 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_name' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry27 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_url' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry28 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_marchand' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry29 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_notes' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry30 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'banner_source_post' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '../images/bann.png' LIMIT 1;");
				$Qry31 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'bot_name' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = 'XNoviana Reali' LIMIT 1;");
				$Qry32 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'bot_adress' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = 'xnova@xnova.fr' LIMIT 1;");
				$Qry33 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_bot' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry34 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ban_duration' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '30' LIMIT 1;");
				$Qry35 = mysql_query("ALTER TABLE `$_POST[prefix]_planets`
	  DROP `super_terraformer`,
	  DROP `interceptor`,
	  DROP `cazacrucero`,
	  DROP `transportador`,
	  DROP `titan`,
	  DROP `nave_humano`,
	  DROP `nave_alien`,
	  DROP `nave_predator`,
	  DROP `nave_dark`,
	  DROP `fotocanyon`,
	  DROP `baseespacial`;");
	  $Qry36 = mysql_query("ALTER TABLE `$_POST[prefix]_users`
	  DROP `humano`,
	  DROP `alien`,
	  DROP `predator`,
	  DROP `dark`,
	  DROP `id_race`,
	  DROP `kolorminus`,
	  DROP `kolorplus`,
	  DROP `kolorpoziom`,
	  DROP `desarrollo_tech`,
	  DROP `humano_tech`,
	  DROP `alien_tech`,
	  DROP `predator_tech`,
	  DROP `dark_tech`
	  DROP `raids1`,
	  DROP `raidsdraw`,
	  DROP `raidswin`,
	  DROP `raidsloose`;");
			break;

			case'1.5a':
				$Qry18 = mysql_query("DROP TABLE `$_POST[prefix]_chat`, `$_POST[prefix]_loteria`;");
				$Qry19 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'OverviewBanner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry20 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'OverviewClickBanner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry21 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyFrame' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry22 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyOwner' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry23 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ExtCopyFunct' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry24 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ForumBannerFrame' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry25 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_enable' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry26 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_name' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry27 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'link_url' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '' LIMIT 1;");
				$Qry28 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_marchand' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry29 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_notes' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '1' LIMIT 1;");
				$Qry30 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'banner_source_post' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '../images/bann.png' LIMIT 1;");
				$Qry31 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'bot_name' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = 'XNoviana Reali' LIMIT 1;");
				$Qry32 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'bot_adress' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = 'xnova@xnova.fr' LIMIT 1;");
				$Qry33 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'enable_bot' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '0' LIMIT 1;");
				$Qry34 = mysql_query("DELETE FROM `$_POST[prefix]_config` WHERE CONVERT(`$_POST[prefix]_config`.`config_name` USING utf8) = 'ban_duration' AND CONVERT(`$_POST[prefix]_config`.`config_value` USING utf8) = '30' LIMIT 1;");
				$Qry35 = mysql_query("ALTER TABLE `$_POST[prefix]_planets`
	  DROP `super_terraformer`,
	  DROP `interceptor`,
	  DROP `cazacrucero`,
	  DROP `transportador`,
	  DROP `titan`,
	  DROP `nave_humano`,
	  DROP `nave_alien`,
	  DROP `nave_predator`,
	  DROP `nave_dark`,
	  DROP `fotocanyon`,
	  DROP `baseespacial`;");
	  $Qry36 = mysql_query("ALTER TABLE `$_POST[prefix]_users`
	  DROP `humano`,
	  DROP `alien`,
	  DROP `predator`,
	  DROP `dark`,
	  DROP `id_race`,
	  DROP `kolorminus`,
	  DROP `kolorplus`,
	  DROP `kolorpoziom`,
	  DROP `desarrollo_tech`,
	  DROP `humano_tech`,
	  DROP `alien_tech`,
	  DROP `predator_tech`,
	  DROP `dark_tech`
	  DROP `raids1`,
	  DROP `raidsdraw`,
	  DROP `raidswin`,
	  DROP `raidsloose`;");
			break;
		}
		echo "<center><h1>¡LISTO!</h1></center>";
		echo "<br>";
		echo "<font color=\"red\"><strong>Recuerda borrar la carpeta install y este archivo también</strong></font>";

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
	<table class="c" border="0" cellspacing="0" cellpadding="0" width="800px">
		<tr>
			<td colspan="2">
		      <div align="justify"><h2>Bienvenido al sistema de actualización de tu XNova.</h2>
		        Este sistema actualizará tu XG Proyect de la última versión.<br>
<u>Terminos de uso:</u><br>
Soy conciente de que este script no es perfecto, y que solo funciona con instalaciones limpias de XG Proyect,
 soportando unicamente las versiones mencionadas
 y que cualquier daño, perdida de datos y/o problemas con mi base de datos corre por mi cuenta(usuario del script update).<br>
			  </div></td>
	  </tr>
		<tr>
			<th colspan="2" align="center"><br>Aceptar las condiciones<input type="checkbox" name="aceptar"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Servidor SQL <font color="orange">(ej: localhost)</font></th>
			<th align="left"><input type="text" name="servidor"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Usuario SQL <font color="orange">(ej: root)</font></th>
			<th align="left"><input type="text" name="usuario"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Clave SQL <font color="orange">(ej: abc12345)</font></th>
			<th align="left"><input type="text" name="clave"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Nombre de la base SQL <font color="orange">(ej: ogame)</font></th>
			<th align="left"><input type="text" name="base"/><br><br></th>
		</tr>
		<tr>
			<th align="center">Prefijo de las tablas(sin _) <font color="orange">(ej: game)</font></th>
			<th align="left"><input type="text" name="prefix"/><br><br><br></th>
		</tr>
		<tr>
			<th colspan="2">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<th align="center" colspan="3"><font color="lime"><h2>Tengo la versi&oacute;n:</h2></font><br><br><br></th>
					</tr>
					<tr>
						<th align="center">v1.4a/v1.4b/1.4c</th>
						<th align="center">v1.4d/v1.4e/v1.4f</th>
						<th align="center">v1.5a/v1.5b</th>
					</tr>
					<tr>
						<th align="center"><input type="radio" name="modo" value="1.4b"/></th>
						<th align="center"><input type="radio" name="modo" value="1.4f"/></th>
						<th align="center"><input type="radio" name="modo" value="1.5a"/></th>
					</tr>
				</table>
			</th>
		</tr>
		<tr>
			<th align="center" colspan="3"><br><input type="submit" name="continuar" value="Actualizar a la versi&oacute;n 2.2"/></th>
		</tr>
		<tr>
			<th align="center" colspan="3"><br><br><br><font color="red">Versiones ya no soportadas: v9.0a/v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a/v1.3b/v1.3b EU/v1.3c DMV</font></th>
		</tr>
	</table>
</form>
<?php
}
echo "</center>";
?>