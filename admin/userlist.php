<?php

/**
 * userlist.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);
include($xgp_root . 'includes/funciones_A/DeleteSelectedUser.'.$phpEx);

if ($user['authlevel'] >= 2)
{
	if ($_GET['cmd'] == 'dele')
		DeleteSelectedUser ( $_GET['user'] );
	if ($_GET['cmd'] == 'sort')
		$TypeSort = $_GET['type'];
	else
		$TypeSort = "id";

	$PageTPL = gettemplate('admin/userlist_body');
	$RowsTPL = gettemplate('admin/userlist_rows');

	$query   = doquery("SELECT * FROM {{table}} ORDER BY `". $TypeSort ."` ASC", 'users');

	$parse['adm_ul_table'] = "";
	$i                     = 0;
	$Color                 = "lime";
	while ($u = mysql_fetch_assoc ($query) )
	{
		if ($PrevIP != "")
		{
			if ($PrevIP == $u['user_lastip'])
				$Color = "red";
			else
				$Color = "lime";
		}

		$Bloc['adm_ul_data_id']     = $u['id'];
		$Bloc['adm_ul_data_name']   = $u['username'];
		$Bloc['adm_ul_data_mail']   = $u['email'];
		$Bloc['ip_adress_at_register']   = $u['ip_at_reg'];
		$Bloc['adm_ul_data_adip']   = "<font color=\"".$Color."\">". $u['user_lastip'] ."</font>";
		$Bloc['adm_ul_data_regd']   = gmdate ( "d/m/Y G:i:s", $u['register_time'] );
		$Bloc['adm_ul_data_lconn']  = gmdate ( "d/m/Y G:i:s", $u['onlinetime'] );
		$Bloc['adm_ul_data_banna']  = ( $u['bana'] == 1 ) ? "<a href # title=\"". gmdate ( "d/m/Y G:i:s", $u['banaday']) ."\">Sí</a>" : "No";
		$Bloc['adm_ul_data_actio']  = "<a href=\"userlist.php?cmd=dele&user=".$u['id']."\" onclick=\"return confirm('¿Estás seguro de que deseas eliminar a $u[username]?');\"><img src=\"../images/r1.png\"></a>"; // Lien vers actions 'effacer'
		$PrevIP                     = $u['user_lastip'];
		$parse['adm_ul_table']     .= parsetemplate( $RowsTPL, $Bloc );
		$i++;
	}
	$parse['adm_ul_count'] = $i;

	display( parsetemplate( $PageTPL, $parse ), "Admin CP - Lista de usuarios", false, '', true, false);
}
else
{
	message ( "No tienes permisos suficientes", "¡Error!");
}
?>