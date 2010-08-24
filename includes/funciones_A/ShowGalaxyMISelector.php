<?php

/**
 * ShowGalaxyMISelector.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function ShowGalaxyMISelector ( $Galaxy, $System, $Planet, $Current, $MICount )
{
	global $lang;

	$Result  = "<form action=\"raketenangriff.php?c=".$Current."&mode=2&galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."\" method=\"POST\">";
	$Result .= "<tr>";
	$Result .= "<table border=\"0\">";
	$Result .= "<tr>";
	$Result .= "<td class=\"c\" colspan=\"2\">";
	$Result .= "Lanzamiento de Misiles [".$Galaxy.":".$System.":".$Planet."]";
	$Result .= "</td>";
	$Result .= "</tr>";
	$Result .= "<tr>";
	$String  = sprintf("Número de misiles (<b>%d</b> restantes):", $MICount);
	$Result .= "<td class=\"c\">".$String." <input type=\"text\" name=\"SendMI\" size=\"2\" maxlength=\"7\" /></td>";
	$Result .= "<td class=\"c\">Objetivo: <select name=\"Target\">";
	$Result .= "<option value=\"all\" selected>Todo</option>";
	$Result .= "<option value=\"0\">".$lang['tech'][401]."</option>";
	$Result .= "<option value=\"1\">".$lang['tech'][402]."</option>";
	$Result .= "<option value=\"2\">".$lang['tech'][403]."</option>";
	$Result .= "<option value=\"3\">".$lang['tech'][404]."</option>";
	$Result .= "<option value=\"4\">".$lang['tech'][405]."</option>";
	$Result .= "<option value=\"5\">".$lang['tech'][406]."</option>";
	$Result .= "<option value=\"6\">".$lang['tech'][407]."</option>";
	$Result .= "<option value=\"7\">".$lang['tech'][408]."</option>";
	$Result .= "</select>";
	$Result .= "</td>";
	$Result .= "</tr>";
	$Result .= "<tr>";
	$Result .= "<td class=\"c\" colspan=\"2\"><input type=\"submit\" name=\"aktion\" value=\"".$lang['gm_send']."\"></td>";
	$Result .= "</tr>";
	$Result .= "</table>";
	$Result .= "</form>";

	return $Result;
}

?>