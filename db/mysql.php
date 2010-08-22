<?php
/**
 * XNova Legacies
 *
 * @license GNU General Public Licence version 3
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

function doquery($query, $table, $fetch = false){
  global $link, $debug;
//    echo $query."<br />";
$config = require ROOT_PATH . 'config.php';



	if(!$link)
	{
		$link = mysql_connect(
			$config['global']['database']['options']['hostname'],
			$config['global']['database']['options']['username'],
			$config['global']['database']['options']['password'])
				or trigger_error(E_WARNING, mysql_error() . "$query<br />" . PHP_EOL);

		mysql_select_db($config['global']['database']['options']['hostname'])
			or trigger_error(E_WARNING, mysql_error()."$query<br />" . PHP_EOL);
	}
	$sql = str_replace("{{table}}", $config['global']['database']['table_prefix'].$table, $query);

	$sqlquery = mysql_query($sql) or
		trigger_error(E_WARNING, mysql_error()."$sql<br />" . PHP_EOL);

	global $numqueries,$debug;//,$depurerwrote003;
	$numqueries++;

	if($fetch)
	{ //hace el fetch y regresa $sqlrow
		$sqlrow = mysql_fetch_array($sqlquery);
		return $sqlrow;
	}else{ //devuelve el $sqlquery ("sin fetch")
		return $sqlquery;
	}

}
?>
