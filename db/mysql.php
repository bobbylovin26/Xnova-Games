<?php

function doquery($query, $table, $fetch = false){
  global $link, $debug;
//    echo $query."<br />";
$dbsettings = require ROOT_PATH . 'config.php';



	if(!$link)
	{
		$link = mysql_connect($dbsettings["server"], $dbsettings["user"],
				$dbsettings["pass"]) or
				$debug->error(mysql_error()."<br />$query","SQL Error");
				//message(mysql_error()."<br />$query","SQL Error");

		mysql_select_db($dbsettings["name"]) or $debug->error(mysql_error()."<br />$query","SQL Error");
		echo mysql_error();
	}
	// por el momento $query se mostrara
	// pero luego solo se vera en modo debug



	$sql = str_replace("{{table}}", $dbsettings["prefix"].$table, $query);


	$sqlquery = mysql_query($sql) or
				$debug->error(mysql_error()."<br />$sql<br />","SQL Error");
				//print(mysql_error()."<br />$query"."SQL Error");


	unset($dbsettings);//se borra la array para liberar algo de memoria

	global $numqueries,$debug;//,$depurerwrote003;
	$numqueries++;
	//$depurerwrote003 .= ;
	$debug->add("<tr><th>Query $numqueries: </th><th>$query</th><th>$table</th><th>$fetch</th></tr>");

	if($fetch)
	{ //hace el fetch y regresa $sqlrow
		$sqlrow = mysql_fetch_array($sqlquery);
		return $sqlrow;
	}else{ //devuelve el $sqlquery ("sin fetch")
		return $sqlquery;
	}

}
?>
