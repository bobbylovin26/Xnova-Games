<?php

/**
 * game.php
 *
 * @version 2.0
 * @copyright 2008 by e-Zobar for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$InLogin = false;

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.'.$phpEx);

	$page  = "<html>";
	$page .= "<head>";
	$page .= "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=iso-8859-1\">";
	$page .= "<link rel=\"shortcut icon\" href=\"favicon.ico\">";
	$page .= "<title>". $game_config['game_name'] ."</title>";
	$page .= "</head>";
	$page .= "<frameset framespacing=\"0\" border=\"0\" cols=\"190,*\" frameborder=\"0\">";
	$page .= "<frame name=\"LeftMenu\" target=\"Mainframe\" src=\"leftmenu.php\" noresize scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\">";
	$page .= "<frame name=\"Hauptframe\" src=\"overview.php\">";
	$page .= "<noframes>";
	$page .= "<body>";
	$page .= "</noframes>";
	$page .= "</frameset>";
    $page .= "</body>";
	$page .= "</html>";
	echo $page;
?>
