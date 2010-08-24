<?php

/**
 * marchand.php
 *
 * @version 2.0 (Correciones totales, funciona al 100%)
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);

if (isset($_POST['ress']) && $_POST['ress'] != '')
{
	switch ($_POST['ress'])
	{
		case 'metal':
		{
			if ($_POST['cristal'] < 0 or $_POST['deut'] < 0)
			{
				message("¡Solo se pueden usar números positivos!", "¡Error!", "marchand.". $phpEx,1);
			}
			else
			{
				$necessaire   = (($_POST['cristal'] * 2) + ($_POST['deut'] * 4));

				if ($planetrow['metal'] > $necessaire)
				{
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`metal` = `metal` - ".round($necessaire).", ";
					$QryUpdatePlanet .= "`crystal` = `crystal` + ".round($_POST['cristal']).", ";
					$QryUpdatePlanet .= "`deuterium` = `deuterium` + ".round($_POST['deut'])." ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".$planetrow['id']."';";

					doquery($QryUpdatePlanet , 'planets');

					$planetrow['metal']     -= $necessaire;
					$planetrow['cristal']   += $_POST['cristal'];
					$planetrow['deuterium'] += $_POST['deut'];

				}
				else
				{
					message("No tienes suficiente metal.", "¡Error!", "marchand.". $phpEx,1);
				}
			}
			break;
		}
		case 'cristal':
		{
			if ($_POST['metal'] < 0 or $_POST['deut'] < 0)
			{
				message("¡Solo se pueden usar números positivos!", "¡Error!", "marchand.". $phpEx,1);
			}
			else
			{
				$necessaire   = ((abs($_POST['metal']) * 0.5) + (abs($_POST['deut']) * 2));

				if ($planetrow['crystal'] > $necessaire)
				{
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`metal` = `metal` + ".round($_POST['metal']).", ";
					$QryUpdatePlanet .= "`crystal` = `crystal` - ".round($necessaire).", ";
					$QryUpdatePlanet .= "`deuterium` = `deuterium` + ".round($_POST['deut'])." ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".$planetrow['id']."';";

					doquery($QryUpdatePlanet , 'planets');

					$planetrow['metal']     += $_POST['metal'];
					$planetrow['cristal']   -= $necessaire;
					$planetrow['deuterium'] += $_POST['deut'];
				}
				else
				{
					message("No tienes suficiente cristal.", "¡Error!", "marchand.". $phpEx,1);
				}
			}
			break;
		}
		case 'deuterium':
		{
			if ($_POST['cristal'] < 0 or $_POST['metal'] < 0)
			{
				message("¡Solo se pueden usar números positivos!", "¡Error!", "marchand.". $phpEx,1);
			}
			else
			{
				$necessaire   = ((abs($_POST['metal']) * 0.25) + (abs($_POST['cristal']) * 0.5));

				if ($planetrow['deuterium'] > $necessaire)
				{
					$QryUpdatePlanet  = "UPDATE {{table}} SET ";
					$QryUpdatePlanet .= "`metal` = `metal` + ".round($_POST['metal']).", ";
					$QryUpdatePlanet .= "`crystal` = `crystal` + ".round($_POST['cristal']).", ";
					$QryUpdatePlanet .= "`deuterium` = `deuterium` - ".round($necessaire)." ";
					$QryUpdatePlanet .= "WHERE ";
					$QryUpdatePlanet .= "`id` = '".$planetrow['id']."';";

					doquery($QryUpdatePlanet , 'planets');

					$planetrow['metal']     += $_POST['metal'];
					$planetrow['cristal']   += $_POST['cristal'];
					$planetrow['deuterium'] -= $necessaire;
				}
				else
				{
					message("No tienes suficiente deuterio.", "¡Error!", "marchand.". $phpEx,1);
				}
			}
			break;
		}
	}

	message("Intercambio realizado con éxito", "¡Listo!", "marchand.". $phpEx,1);
}
else
{
	if ($_POST['action'] != 2)
	{
		$template = gettemplate('marchand/marchand_main');
	}
	else
	{
		$parse['mod_ma_res'] = '1';

		switch ($_POST['choix'])
		{
			case 'metal':
			$template = gettemplate('marchand/marchand_metal');
			$parse['mod_ma_res_a'] = '2';
			$parse['mod_ma_res_b'] = '4';
			break;
			case 'cristal':
			$template = gettemplate('marchand/marchand_cristal');
			$parse['mod_ma_res_a'] = '0.5';
			$parse['mod_ma_res_b'] = '2';
			break;
			case 'deut':
			$template = gettemplate('marchand/marchand_deuterium');
			$parse['mod_ma_res_a'] = '0.25';
			$parse['mod_ma_res_b'] = '0.5';
			break;
		}
	}
}

display(parsetemplate ($template,$parse), "Mercader", true, '', false);
?>