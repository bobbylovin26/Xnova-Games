<?php

/**
 * officier.php
 *
 * @version 2.0
 * @copyright 2008 by Tom1991 for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);
include($xnova_root_path . 'includes/functions/IsOfficierAccessible.' . $phpEx);

function ShowOfficierPage ( &$CurrentUser ) {
	global $lang, $resource, $reslist, $_GET;

	includeLang('officier');

	if ($CurrentUser['darkmatter'] < 0)
	{
		doquery("UPDATE {{table}} SET `darkmatter` = '0' WHERE `id` = '". $CurrentUser['id'] ."';", 'users');
	}

	if ($_GET['mode'] == 2)
	{
		if ((floor($CurrentUser['darkmatter'] / 1000)) > 0)
		{
			$Selected    = $_GET['offi'];
			if ( in_array($Selected, $reslist['officier']) )
			{
				$Result = IsOfficierAccessible ( $CurrentUser, $Selected );

				if ( $Result == 1 )
				{
					$CurrentUser[$resource[$Selected]] += 1;

					$CurrentUser['darkmatter']         -= 1000;

					if($Selected == 610)
					{
						$CurrentUser['spy_tech']      += 5;
					}
					elseif ($Selected == 611)
					{
						$CurrentUser['computer_tech'] += 3;
					}

					// CAMBIE ALGUNOS VALORES Y LOS ADAPTE A LA MATERIA OSCURA (BY lucky Xtreme-gameZ.com.ar DarkMatter ADD-ON)
					$QryUpdateUser  = "UPDATE {{table}} SET ";
					$QryUpdateUser .= "`darkmatter` = '". $CurrentUser['darkmatter'] ."', ";
					$QryUpdateUser .= "`spy_tech` = '". $CurrentUser['spy_tech'] ."', ";
					$QryUpdateUser .= "`computer_tech` = '". $CurrentUser['computer_tech'] ."', ";
					$QryUpdateUser .= "`".$resource[$Selected]."` = '". $CurrentUser[$resource[$Selected]] ."' ";
					$QryUpdateUser .= "WHERE ";
					$QryUpdateUser .= "`id` = '". $CurrentUser['id'] ."';";
					doquery( $QryUpdateUser, 'users' );
				}
				elseif ( $Result == -1 )
				{
					message("Nivel máximo alcanzado","¡Error!","officier.php",1);
				}
				elseif ( $Result == 0 )
				{
					$Message = $lang['Noob'];
				}
			}
		}
		else
		{
			message("No tienes materia oscura suficiente","¡Error!","officier.php",1);
		}

		header("location:officier.php");

	}
	else
	{
		$parse['alv_points']   	= floor($CurrentUser['darkmatter'] / 1000);
		for ( $Officier = 601; $Officier <= 615; $Officier++ )
		{
			$Result = IsOfficierAccessible ( $CurrentUser, $Officier );
			if ( $Result != 0 )
			{
				$bloc['off_id']       = $Officier;
				$bloc['off_lvl']      = $CurrentUser[$resource[$Officier]];
				$bloc['off_desc']     = $lang['Desc'][$Officier];
				if ($Result == 1)
				{
					$bloc['off_link'] = "<a href=\"officier.php?mode=2&offi=".$Officier."\"><font color=\"#00ff00\">Reclutar</font>";
				}
				else
				{
					$bloc['off_link'] = "Nivel máximo";
				}
				$parse['disp_off_tbl'] .= parsetemplate( gettemplate('officier_rows'), $bloc );
			}
		}
		$page           = parsetemplate( gettemplate('officier_body'), $parse);
	}

	return $page;
}

display(ShowOfficierPage ( $user ), "Oficiales");
?>