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
include($xnova_root_path . 'includes/funciones_A/IsOfficierAccessible.' . $phpEx);

function ShowOfficierPage ( &$CurrentUser ) {
	global $resource, $reslist, $_GET;

	$lang['Desc'][601] = '<br><br>El ge&oacute;logo es un experto en astrominerolog&iacute;a y astrocristalograf&iacute;a. Asiste a sus equipos en la metalurgia y qu&iacute;mica y tambi&eacute;n se encarga de las comunicaciones interplanetarias para optimizar el uso y refinamiento de la materia bruta a lo largo de todo el imperio.<br><br><font color="red">+5% de producci&oacute;n. Nivel Max. : 20</font>';
	$lang['Desc'][602] = '<br><br>El almirante de flota es un veterano de guerra experimentado y un habilidoso estratega. En las batallas mas duras, es capaz de hacerse una idea de la situaci&oacute;n y contactar a sus almirantes subordinados. Un emperador sabio puede apoyarse en su ayuda durante los combates.<br><br><font color="red">+5% Escudo de Naves. Nivel Max. : 20</font>';
	$lang['Desc'][603] = '<br><br>El Ingeniero es un especialista en gesti&oacute;n de energ&iacute;a. En tiempos de paz, aumenta la energ&iacute;a de todas las colonias. En caso de ataque, garantiza el abastecimiento de energ&iacute;a a los ca&ntilde;ones, evitando una posible sobrecarga, lo que conduce a una reducci&oacute;n de defensas perdidas en batalla.<br><br><font color="red">+5% de energia. Nivel Max. : 10</font>';
	$lang['Desc'][604] = '<br><br>El gremio de los Tecn&oacute;cratas est&aacute; compuesto de aut&eacute;nticos genios, y siempre los encontrar&aacute;s en ese peligroso borde donde todo saltar&iacute;a en mil pedazos antes de poder encontrar una explicaci&oacute;n tecnol&oacute;gica y racional. Ning&uacute;n ser humano normal tratar&iacute;an jam&aacute;s intentar descifrar el c&oacute;digo de un tecn&oacute;crata, con su presencia, inspira a los investigadores del imperio.<br><br><font color="red">+5% Velocidad Construcci&oacute;n Naves. Nivel Max : 10</font>';
	$lang['Desc'][605] = "<br><br>El Constructor tiene alterado su ADN, uno solo de estos hombres puede construir una ciudad entera en poco tiempo.<br><br><font color='red'>+10% Rapidez Construccion Edificios. Nivel Max. : 3</font>";
	$lang['Desc'][606] = "<br><br>Los cient&iacute;ficos forman parte de un gremio concurente a la de los tecn&oacute;cratas. Ellos se especializan en la mejora de las tecnolog&iacute;as.<br><br><font color='red'>+10% Rapidez de Investigacion. Nivel Max. : 3</font>";
	$lang['Desc'][607] = "<br><br>El almacenista es parte de la antigua Hermandad del planeta Hsac. Su lema es ganar el m&aacute;ximo, pero por esta raz&oacute;n que necesita espacios de almacenamiento enormes. Esa es la raz&oacute;n por la que el Constructor ha desarrollado una nueva t&eacute;cnica de almacenamiento.<br><br><font color='red'>+50% de Almacenamiento. Nivel Max. : 2</font>";
	$lang['Desc'][608] = "<br><br>El defensor es un miembro del ej&eacute;rcito imperial. Su celo en su trabajo le permite construir una formidable defensa en un breve espacio de tiempo en las colonias hostiles.<br><br><font color='red'>+50% Rapidez Construccion Defensas. Nivel Max. : 2</font>";
	$lang['Desc'][609] = "<br><br>El emperador se&ntilde;al&oacute; el impresionante trabajo que usted proporciona a su imperio. Dar las gracias a usted le da la oportunidad de convertirse en Bunker. El Bunker es la m&aacute;s alta distinci&oacute;n de la Miner&iacute;a de la rama del Ej&eacute;rcito Imperial.<br><br><font color='red'>Desbloquear la Proteccion Planetaria.</font> ";
	$lang['Desc'][610] = "<br><br>El esp&iacute;a es una persona enigm&aacute;tica. Nadie nunca vio su verdadero rostro, a menos que est&eacute; muerto.<br><br><font color='red'>+5 Niveles de espionaje. Nivel Max. : 2</font>";
	$lang['Desc'][611] = "<br><br>El comandante del ej&eacute;rcito imperial ha dominado el arte del manejo de flotas. Su cerebro puede calcular las trayectorias de muchos flota, mucho m&aacute;s que la de un humano normal.<br><br><font color='red'>+3 slots de Flotas. Nivel Max. : 3</font> ";
	$lang['Desc'][612] = "<br><br>El destructor es un funcionario sin misericordia. &eacute;l masacra a todos en los planetas s&oacute;lo por placer. Actualmente est&aacute; desarrollando un nuevo m&eacute;todo de producci&oacute;n de las estrellas de la muerte.<br><br><font color='red'>2 Estrellas al hacer 1. Nivel Max. : 1</font>";
	$lang['Desc'][613] = "<br><br>El venerable General es una persona que ha servido desde hace muchos a&ntilde;os en el ej&eacute;rcito. Los fabricantes de naves producen mas r&aacute;pido en su presencia.<br><br><font color='red'>+25% Rapidez Hangares. Nivel Max. : 3</font>";
	$lang['Desc'][614] = "<br><br>El emperador ha detectado en usted innegables cualidades de conquistador. Le ofrece convertirse en Raider. El Raider es el m&aacute;s alto rango del ej&eacute;rcito imperial.<br><br><font color='red'>Desbloquea la SuperNova.</font>";
	$lang['Desc'][615] = "<br><br>Usted puso de manifiesto que usted es el m&aacute;s grande conquistador del universo. Es momento para que usted tome el lugar que merece.<br><br><font color='red'>Desbloquea la destrucci&oacute;n de planetas.</font>";

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
					message("Nivel máximo alcanzado","¡Error!","officier.php",1);
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