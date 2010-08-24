<?php

/**
 * ShowGalaxySelector.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function ShowGalaxySelector ( $Galaxy, $System )
{
	if ($Galaxy > MAX_GALAXY_IN_WORLD) {
		$Galaxy = MAX_GALAXY_IN_WORLD;
	}
	if ($Galaxy < 1) {
		$Galaxy = 1;
	}
	if ($System > MAX_SYSTEM_IN_GALAXY) {
		$System = MAX_SYSTEM_IN_GALAXY;
	}
	if ($System < 1) {
		$System = 1;
	}

	$Result  = "<form action=\"galaxy.php?mode=1\" method=\"post\" id=\"galaxy_form\">";
	$Result .= "<input type=\"hidden\" id=\"auto\" value=\"dr\" >";
	$Result .= "<table border=\"0\">";
	$Result .= "<tr><td>";
	$Result .= "<table><tr>";
	$Result .= "<td class=\"c\" colspan=\"3\">Galaxia</td></tr><tr>";
	$Result .= "<td class=\"l\"><input name=\"galaxyLeft\" value=\"&lt;-\" onclick=\"galaxy_submit('galaxyLeft')\" type=\"button\"></td>";
	$Result .= "<td class=\"l\"><input name=\"galaxy\" value=\"". $Galaxy ."\" size=\"5\" maxlength=\"3\" tabindex=\"1\" type=\"text\"></td>";
	$Result .= "<td class=\"l\"><input name=\"galaxyRight\" value=\"-&gt;\" onclick=\"galaxy_submit('galaxyRight')\" type=\"button\"></td>";
	$Result .= "</tr></table>";
	$Result .= "</td><td>";
	$Result .= "<table><tr>";
	$Result .= "<td class=\"c\" colspan=\"3\">Sistema solar</td></tr><tr>";
	$Result .= "<td class=\"l\"><input name=\"systemLeft\" value=\"&lt;-\" onclick=\"galaxy_submit('systemLeft')\" type=\"button\"></td>";
	$Result .= "<td class=\"l\"><input name=\"system\" value=\"". $System ."\" size=\"5\" maxlength=\"3\" tabindex=\"2\" type=\"text\"></td>";
	$Result .= "<td class=\"l\"><input name=\"systemRight\" value=\"-&gt;\" onclick=\"galaxy_submit('systemRight')\" type=\"button\"></td>";
	$Result .= "</tr></table>";
	$Result .= "</td></tr>";
	$Result .= "</table>";
	$Result .= "<input value=\"Mostrar\" type=\"submit\">";
	$Result .= "</form>";
	return $Result;
}
?>