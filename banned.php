<?php

/**
 * banned.php
 *
 * @version 1.0
 * @copyright 2008 by ??????? for XNova
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.'.$phpEx);

$parse['dpath'] = $dpath;

$query = doquery("SELECT * FROM {{table}} ORDER BY `id`;",'banned');

$i=0;

while($u = mysql_fetch_array($query))
{
	$parse['banned'] .=
        "<tr><td class=b><center><b>".$u[1]."</center></td></b>".
	"<td class=b><center><b>".$u[2]."</center></b></td>".
	"<td class=b><center><b>".gmdate("d/m/Y G:i:s",$u[4])."</center></b></td>".
	"<td class=b><center><b>".gmdate("d/m/Y G:i:s",$u[5])."</center></b></td>".
	"<td class=b><center><b>".$u[6]."</center></b></td></tr>";
	$i++;
}

if ($i=="0")
	$parse['banned'] .= "<tr><th class=b colspan=6>No hay jugadores baneados</th></tr>";
else
  	$parse['banned'] .= "<tr><th class=b colspan=6>Existe {$i} jugador/es baneado/s</th></tr>";

display(parsetemplate(gettemplate('banned_body'), $parse),'Jugador Baneados',false);

?>