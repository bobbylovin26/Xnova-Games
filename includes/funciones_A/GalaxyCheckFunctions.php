<?php

/**
 * GalaxyCheckFunctions.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:../../"));

function CheckAbandonMoonState($lunarow)
{
	if (($lunarow['destruyed'] + 172800) <= time() && $lunarow['destruyed'] != 0)
		$query = doquery("DELETE FROM {{table}} WHERE id = '" . $lunarow['id'] . "'", "lunas");
}

function CheckAbandonPlanetState(&$planet)
{
	if ($planet['destruyed'] <= time())
	{
		doquery("DELETE FROM {{table}} WHERE id={$planet['id']}", 'planets');
		doquery("UPDATE {{table}} SET id_planet=0 WHERE id_planet={$planet['id']}", 'galaxy');
	}
}
?>