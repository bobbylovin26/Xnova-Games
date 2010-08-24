<?php

/**
 * frame.php
 *
 * @version 1.0
 * @copyright 2008 by e-Zobar for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$InLogin = false;

$XNova_Host    = $_SERVER['HTTP_HOST'];
$XNova_Script  = $_SERVER['SCRIPT_NAME'];
$Uri_Array     = explode ('/', $XNova_Script);
// On vire le script
array_pop($Uri_Array);
$XNova_URI     = implode ('/', $Uri_Array);

$XNovaRootURL  = "http://". $XNova_Host ."/". $XNova_URI ."/";

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.'.$phpEx);

	$page  = "<html>";
	$page .= "<head>";
	$page .= "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=". $langInfos['ENCODING']."\">";
	$page .= "<link rel=\"shortcut icon\" href=\"favicon.ico\">";
	$page .= "<title>". $game_config['game_name'] ."</title>";
	$page .= "</head>";

	$page .= "</head>";
	$page .= "<frameset framespacing=\"0\" border=\"0\" cols=\"140,*,140\" frameborder=\"0\">";
	$page .= "<frame name=\"LeftMenu\" target=\"Mainframe\" src=\"leftmenu.php\" noresize scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\">";
	$page .= "<frame name=\"Hauptframe\" src=\"overview.php\">";
	$page .= "<frame name=\"RightMenu\" target=\"Mainframe\" src=\"rightmenu.php\" noresize scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\">";
	$page .= "</frameset>";
	$page .= "<body>";
	$page .= "<p>". $lang['NoFrames']."</p>";
	$page .= "</noframes>";
	$page .= "</frameset>";
      $page .= "</body>";
	$page .= "</html>";

	echo $page;

// -----------------------------------------------------------------------------------------------------------
// History version
// 1.0 - Euuhh ... je ne sais plus ...
?>
