<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By Neko from Xtreme-gameZ.com.ar	 #
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

$xgp_root = '../';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);
include('AdminFunctions/Autorization.' . $phpEx);

if ($ConfigGame != 1) die();

$parse 	= $lang;
$Query	=	$_POST['querie'];

if ($_POST)
{
	mysql_query($Query);
	
	if(mysql_error())
	{
		$parse['display'] = "<tr><th><font color=red>".mysql_error()."</font></th></tr>";
	}
	else
	{
		$parse['display'] = "<tr><th><font color=lime>".$lang['qe_succes']."</font></th></tr>";
	}
}

display(parsetemplate(gettemplate('adm/QueriesBody'), $parse), false, '', true, false);
?>