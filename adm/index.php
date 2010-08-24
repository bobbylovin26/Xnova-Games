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

define('INSIDE'  , true);
define('INSTALL' , false);
define('IN_ADMIN', true);

$xgp_root = './../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if ($user['authlevel'] < 1) die(message ($lang['not_enough_permissions']));

	$page  = "<html>";
	$page .= "<head>";
	$page .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\" />";
	$page .= "<title>". $game_config['game_name'] ." - Admin CP</title>";
	$page .= "</head>";
	$page .= "<frameset cols=\"*,130\" frameborder=\"no\" border=\"0\" framespacing=\"0\">";
	$page .= "<frame src=\"overview.php\" name=\"Hauptframe\" id=\"mainFrame\" title=\"mainFrame\" />";
	$page .= "<frame src=\"menu.php\" name=\"rightFrame\" scrolling=\"No\" noresize=\"noresize\" id=\"rightFrame\" title=\"rightFrame\" />";
	$page .= "</frameset>";
	$page .= "<noframes><body>";
	$page .= "</body>";
	$page .= "</noframes></html>";

	echo $page;

?>