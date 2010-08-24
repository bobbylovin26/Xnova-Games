<?php

/**
 * ShowGalaxyTitles.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function ShowGalaxyTitles ( $Galaxy, $System )
{
	$Result  = "\n";
	$Result .= "<tr>";
	$Result .= "<td class=c colspan=8>Sistema solar ".$Galaxy.":".$System."</td>";
	$Result .= "</tr><tr>";
	$Result .= "<td class=c>Pos</td>";
	$Result .= "<td class=c>Planeta</td>";
	$Result .= "<td class=c>Nombre (Actividad)</td>";
	$Result .= "<td class=c>Luna</td>";
	$Result .= "<td class=c>Escombros</td>";
	$Result .= "<td class=c>Jugador (Estado)</td>";
	$Result .= "<td class=c>Alianza</td>";
	$Result .= "<td class=c>Acciones</td>";
	$Result .= "</tr>";

	return $Result;
}
?>