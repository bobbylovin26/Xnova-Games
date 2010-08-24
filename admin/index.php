<?php

/**
 * frames.php
 *
 * @version 2.0
 * @copyright 2009 By lucky for XG PROYECT XNova - Argentina
 *
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './../';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);

	$page  = "<html>";
	$page .= "<head>";
	$page .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
	$page .= "<title>". $game_config['game_name'] ."- Admin CP</title>";
	$page .= "</head>";

	$page .= "<frameset cols=\"*,140\" frameborder=\"no\" border=\"0\" framespacing=\"0\">";
	$page .= "<frame src=\"overview.php\" name=\"Hauptframe\" id=\"mainFrame\" title=\"mainFrame\" />";
	$page .= "<frame src=\"leftmenu.php\" name=\"rightFrame\" scrolling=\"No\" noresize=\"noresize\" id=\"rightFrame\" title=\"rightFrame\" />";
	$page .= "</frameset>";
	$page .= "<noframes><body>";
	$page .= "</body>";
	$page .= "</noframes></html>";

	echo $page;
?>
