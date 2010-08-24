<?php

/**
 * alliance.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);

	$QrySelectUser  = "SELECT `username`, `email`, `authlevel` ";
	$QrySelectUser .= "FROM {{table}} ";
	$QrySelectUser .= "WHERE `authlevel` != '0' ORDER BY `authlevel` DESC;";
	$GameOps = doquery ( $QrySelectUser, 'users');

	while( $Ops = mysql_fetch_assoc($GameOps) )
	{
		$bloc['ctc_data_name']    = $Ops['username'];
		$bloc['ctc_data_auth']    = $lang['user_level'][$Ops['authlevel']];
		$bloc['ctc_data_mail']    = "<a href=mailto:".$Ops['email'].">".$Ops['email']."</a>";
		$parse['ctc_admin_list'] .= parsetemplate(gettemplate('contact_body_rows'), $bloc);
	}

	$page = parsetemplate(gettemplate('contact_body'), $parse);
	display($page, "Contacto", false);

?>