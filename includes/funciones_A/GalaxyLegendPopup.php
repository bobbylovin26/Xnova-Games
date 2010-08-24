<?php

/**
 * GalaxyLegendPopup.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function GalaxyLegendPopup ()
{
	$Result  = "<a href=# style=\"cursor: pointer;\"";
	$Result .= " onmouseover='return overlib(\"";
	$Result .= "<table width=240>";
	$Result .= "<tr>";
	$Result .= "<td class=c colspan=2>Leyenda</td>";
	$Result .= "</tr><tr>";
	$Result .= "<td width=220>Jugador fuerte</td><td><span class=strong>f</span></td>";
	$Result .= "</tr><tr>";
	$Result .= "<td width=220>Jugador débil</td><td><span class=noob>d</span></td>";
	$Result .= "</tr><tr>";
	$Result .= "<td width=220>Modo vacaciones</td><td><span class=vacation>v</span></td>";
	$Result .= "</tr><tr>";
	$Result .= "<td width=220>Usuario suspendido</td><td><span class=banned>s</span></td>";
	$Result .= "</tr><tr>";
	$Result .= "<td width=220>Inactivo 7 días</td><td><span class=inactive>i</span></td>";
	$Result .= "</tr><tr>";
	$Result .= "<td width=220>Inactivo 28 días</td><td><span class=longinactive>I</span></td>";
	$Result .= "</tr>";
	$Result .= "</table>\"";
	$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -150, OFFSETY, -150 );'";
	$Result .= " onmouseout='return nd();'>";
	$Result .= "Leyenda</a>";
	return $Result;
}

?>