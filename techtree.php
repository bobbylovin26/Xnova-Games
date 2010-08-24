<?php

/**
 * techtree.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);

$HeadTpl = gettemplate('techtree_head');
$RowTpl  = gettemplate('techtree_row');
foreach($lang['tech'] as $Element => $ElementName)
{
	$parse            = array();
	$parse['tt_name'] = $ElementName;

	if (!isset($resource[$Element]))
	{
		$parse['Requirements']  = $lang['Requirements'];
		$page                  .= parsetemplate($HeadTpl, $parse);
	}
	else
	{
		if (isset($requeriments[$Element]))
		{
			$parse['required_list'] = "";
			foreach($requeriments[$Element] as $ResClass => $Level)
			{
				if( isset( $user[$resource[$ResClass]] ) && $user[$resource[$ResClass]] >= $Level)
				{
					$parse['required_list'] .= "<font color=\"#00ff00\">";
				}
				elseif ( isset($planetrow[$resource[$ResClass]] ) && $planetrow[$resource[$ResClass]] >= $Level) {
					$parse['required_list'] .= "<font color=\"#00ff00\">";
				}
				else
				{
					$parse['required_list'] .= "<font color=\"#ff0000\">";
				}
				$parse['required_list'] .= $lang['tech'][$ResClass] ." (". $lang['level'] ." ". $Level .")";
				$parse['required_list'] .= "</font><br>";
			};
		}
		else
		{
			$parse['required_list'] = "";
			$parse['tt_detail']     = "";
		}
		$parse['tt_info']   = $Element;
		$page              .= parsetemplate($RowTpl, $parse);
	}
}

$parse['techtree_list'] = $page;
$page                   = parsetemplate(gettemplate('techtree_body'), $parse);

display($page, "Tecnologías");
?>
