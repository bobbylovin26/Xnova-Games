<?php

/**
 * messages.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.' . $phpEx);
include($xgp_root . 'includes/funciones_A/BBcodeFunction.' . $phpEx);

$OwnerID       		= $_GET['id'];
$MessCategory  		= (isset($_GET['messcat'])) ? $_GET['messcat'] : '100';
$MessPageMode  		= $_GET["mode"];
$DeleteWhat    		= $_POST['deletemessages'];
if (isset ($DeleteWhat))
	$MessPageMode 	= "delete";
$UsrMess       		= doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' ORDER BY `message_time` DESC;", 'messages');

$parse['type'][0]    = "Espionajes";
$parse['type'][1]    = "Jugadores";
$parse['type'][2]    = "Alianza";
$parse['type'][3]    = "Ataques";
$parse['type'][4]    = "Recolección";
$parse['type'][5]    = "Transporte";
$parse['type'][15]   = "Expedicion";
$parse['type'][16]   = "Construcción";

$MessageType   		 = array ( 0, 1, 2, 3, 4, 5, 15, 16);
$TitleColor    		 = array ( 0 => '#FFFF00', 1 => '#FF6699', 2 => '#FF3300', 3 => '#FF9900', 4 => '#773399', 5 => '#009933', 15 => '#030070', 16 => '#007070');
$BackGndColor  		 = array ( 0 => '#663366', 1 => '#336666', 2 => '#000099', 3 => '#666666', 4 => '#999999', 5 => '#999999', 15 => '#999999', 16 => '#999999');

while ($CurMess = mysql_fetch_array($UsrMess))
{
	$MessType              = $CurMess['message_type'];
	$TotalMess[$MessType] += 1;
	$TotalMess[100]       += 1;
}

$page .= "<br /><div id=\"content\"><table width=\"569\">";
$page .= "<tr><td class=\"c\" colspan=\"9\">Mensajes de:</td></tr>";

for ($MessType = 0; $MessType <= 16; $MessType++)
{
	if ( in_array($MessType, $MessageType) )
		$page .= "<th width=\"100\"><a href=\"messages.php?mode=show&amp;messcat=". $MessType ."\"><font color=\"". $TitleColor[$MessType] ."\">". $parse['type'][$MessType] ."</a></th>";
}

$page .= "</tr><tr>";

for ($MessType = 0; $MessType <= 16; $MessType++)
{
	if ( in_array($MessType, $MessageType) )
	{
		$leido		= doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND `message_type`='".$MessType."' AND `leido`='1' ORDER BY `message_time` DESC ;", 'messages');
		$sinleer	= doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND `message_type`='".$MessType."' ORDER BY `message_time` DESC ;", 'messages');
		$page 	   .= "<th width=\"100\" ><font color=\"". $TitleColor[$MessType] ."\">". mysql_num_rows($leido) ."</font>/<font color=\"". $TitleColor[$MessType] ."\">". mysql_num_rows($sinleer) ."</font></th>";
	}
}
$page .= "</tr></table>";

switch ($MessPageMode)
{
	case 'write':
		if (!is_numeric($OwnerID))
		header("location:messages.php");

		$OwnerRecord = doquery("SELECT `username`,`id_planet` FROM {{table}} WHERE `id` = '".$OwnerID."';", 'users', true);
		if (!$OwnerRecord)
			header("location:messages.php");

		$OwnerHome   = doquery("SELECT `galaxy`,`system`,`planet` FROM {{table}} WHERE `id_planet` = '". $OwnerRecord["id_planet"] ."';", 'galaxy', true);
		if (!$OwnerHome)
			header("location:messages.php");

		if ($_POST)
		{
			$error = 0;
			if (!$_POST["subject"])
			{
				$error++;
				$page .= "<table><tr><td><font color=#FF0000>Falta el asunto</font></td></tr></table>";
			}
			if (!$_POST["text"])
			{
				$error++;
				$page .= "<table><tr><td><font color=#FF0000>Falta el mensaje</font></td></tr></table>";
			}
			if ($error == 0)
			{
				$page .= "<table><tr><td><font color=\"#00FF00\">Mensaje enviado</font></td></tr></table>";

				$_POST['text'] = str_replace("'", '&#39;', $_POST['text']);

				$Owner   = $OwnerID;
				$Sender  = $user['id'];
				$From    = $user['username'] ." [".$user['galaxy'].":".$user['system'].":".$user['planet']."]";
				$Subject = $_POST['subject'];

				if($game_config['enable_bbcode'] == 1)
				{
					$Message = trim ( nl2br (bbcode ( image ( strip_tags ( $_POST['text'], '<br>' ) ) ) ) );
				}
				else
				{
					$Message = trim ( nl2br ( strip_tags ( $_POST['text'], '<br>' ) ) );
				}

				SendSimpleMessage ( $Owner, $Sender, '', 1, $From, $Subject, $Message);
				$subject = "";
				$text    = "";
			}
		}
		$parse['id']           = $OwnerID;
		$parse['to']           = $OwnerRecord['username'] ." [".$OwnerHome['galaxy'].":".$OwnerHome['system'].":".$OwnerHome['planet']."]";
		$parse['subject']      = (!isset($subject)) ? "Sin asunto" : $subject ;
		$parse['text']         = $text;

		if($game_config['enable_bbcode'] == 1)
			$page .= parsetemplate(gettemplate('messages_pm_form_bb'), $parse);
		else
			$page .= parsetemplate(gettemplate('messages_pm_form'), $parse);
	break;
	case 'delete':
		$DeleteWhat = $_POST['deletemessages'];
		if ($DeleteWhat == 'deleteall')
			doquery("DELETE FROM {{table}} WHERE `message_owner` = '". $user['id'] ."';", 'messages');
		elseif ($DeleteWhat == 'deletemarked')
		{
			foreach($_POST as $Message => $Answer)
			{
				if (preg_match("/delmes/i", $Message) && $Answer == 'on')
				{
					$MessId   = str_replace("delmes", "", $Message);
					$MessHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MessId ."' AND `message_owner` = '". $user['id'] ."';", 'messages');
					if ($MessHere)
						doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MessId."';", 'messages');
				}
			}
		}
		elseif ($DeleteWhat == 'deleteunmarked')
		{
			foreach($_POST as $Message => $Answer)
			{
				$CurMess    = preg_match("/showmes/i", $Message);
				$MessId     = str_replace("showmes", "", $Message);
				$Selected   = "delmes".$MessId;
				$IsSelected = $_POST[ $Selected ];
				if (preg_match("/showmes/i", $Message) && !isset($IsSelected))
				{
					$MessHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MessId ."' AND `message_owner` = '". $user['id'] ."';", 'messages');
					if ($MessHere)
						doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MessId."';", 'messages');
				}
			}
		}
		$MessCategory = $_POST['category'];
	break;
	case 'show':
		$sql 		= doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND  `message_type`='".$MessCategory."';", 'messages');
		$cant 		= mysql_num_rows($sql);
		$final 		= $cant/10;
		$array_cant = explode(".",$final);
		$array_cant[0];
		$array_cant[1];
		if(!$array_cant[1])
			$fnl=$array_cant[0];
		else
			$fnl=$array_cant[0]+1;

		$page  .= "<script language=\"JavaScript\">\n";
		$page .= "function f(target_url, win_name) {\n";
		$page .= "var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');\n";
		$page .= "new_win.focus();\n";
		$page .= "}\n";
		$page .= "</script>\n";
		$page .= "<table>";
		$page .= "<tr>";
		$page .= "<td></td>";
		$page .= "<td>\n";
		$page .= "<table width=\"519\">";
		$page .= "<form action=\"messages.php\" method=\"post\"><table>";
		$page .= "<tr>";
		$page .= "<td></td>";
		$page .= "<td>\n<input name=\"messages\" value=\"1\" type=\"hidden\">";
		$page .= "<table width=\"519\">";
		$page .= "<tr>";
		$page .= "<th colspan=\"9\">";
		$page .= "<select onchange=\"document.getElementById('deletemessages').options[this.selectedIndex].selected='true'\" id=\"deletemessages2\" name=\"deletemessages2\">";
		$page .= "<option value=\"deletemarked\">Borrar mensajes marcados</option>";
		$page .= "<option value=\"deleteunmarked\">Borrar todos los mensajes sin marcar</option>";
		$page .= "<option value=\"deleteall\">Borrar todos los mensajes</option>";
		$page .= "</select>";
		$page .= "<input value=\"Ok\" type=\"submit\">";
		$page .= "</th>";
		$page .= "</tr><tr>";
		$page .= "<th style=\"color: rgb(242, 204, 74);\" colspan=\"9\">";
		$page .= "<input name=\"category\" value=\"".$MessCategory."\" type=\"hidden\">";
		$page .= "<input onchange=\"document.getElementById('fullreports').checked=this.checked\" id=\"fullreports2\" name=\"fullreports2\" type=\"checkbox\">Mostrar unicamente encabezado de los informes de espionaje</th>";
		$page .= "</tr><tr>";
		$page .= "<th>Acción</th>";
		$page .= "<th>Fecha</th>";
		$page .= "<th>De</th>";
		$page .= "<th>Asunto</th>";
		$page .= "</tr>";

		$UsrMess = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND `message_type` = '".$MessCategory."' ORDER BY `message_time` DESC ".$limit, 'messages');

		while ($CurMess = mysql_fetch_array($UsrMess))
		{
			if ($CurMess['message_type'] == $MessCategory)
			{
				$page .= "\n<tr>";
				$page .= "<input name=\"showmes". $CurMess['message_id'] . "\" type=\"hidden\" value=\"1\">";
				$page .= "<th><input name=\"delmes". $CurMess['message_id'] ."\" type=\"checkbox\"></th>";
				$page .= "<th>". date("m-d H:i:s O", $CurMess['message_time']) ."</th>";
				$page .= "<th>". stripslashes( $CurMess['message_from'] ) ."</th>";
				$page .= "<th> <a href='messages.php?mode=".$MessPageMode."&messcat=".$MessCategory."&ver=".$CurMess['message_id']."'>". stripslashes( $CurMess['message_subject'] ) ."</a> ";
				if($CurMess['leido']==1)
					$color_style=" style='background-color:#FF0000'";
				else
					$color_style="";
				if ($CurMess['message_type'] == 1)
				{
					$page .= "<a href=\"messages.php?mode=write&amp;id=". $CurMess['message_sender'] ."&amp;subject=Re: ". htmlspecialchars( $CurMess['message_subject']) ."\">";
					$page .= "<img src=\"". $dpath ."img/m.gif\" alt=\"Responder\" border=\"0\"></a></th>";
				}
				else
				{
					$page .= "</th>";
				}

				$page .= "</tr>";
			}
		}

		if($_GET["ver"])
		{
			$CurMess = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$user['id']."' AND `message_id` = '".$_GET["ver"]."' ;", 'messages', true);
			$page 	.= "<tr></tr><tr><th></th>";
			$page 	.= "<th>". date("m-d H:i:s O", $CurMess['message_time']) ."</th>";
			$page 	.= "<th>". stripslashes( $CurMess['message_from'] ) ."</th>";
			$page 	.= "<th> <b>". stripslashes( $CurMess['message_subject'] ) ."</b></tr><tr>";
			$page 	.= "<td style=\"background-color: ".$BackGndColor[$CurMess['message_type']]."; background-image: none;\"; class=\"b\"> </td>";
			$page 	.= "<td style=\"background-color: ".$BackGndColor[$CurMess['message_type']]."; background-image: none;\"; colspan=\"4\" class=\"b\">". stripslashes( nl2br( $CurMess['message_text'] ) ) ."</td></tr>";

			$QryUpdatemen  = "UPDATE {{table}} SET ";
			$QryUpdatemen .= "`leido` = '0' "; // Vraiment pas envie de me casser le fion a virer la derniere virgule du sub query
			$QryUpdatemen .= "WHERE ";
			$QryUpdatemen .= "`message_id` = '".$_GET["ver"]."';";
			doquery ( $QryUpdatemen, 'messages' );
		}

		$page .= "<tr>";
		$page .= "<th style=\"color: rgb(242, 204, 74);\" colspan=\"4\">";
		$page .= "<input onchange=\"document.getElementById('fullreports2').checked=this.checked\" id=\"fullreports\" name=\"fullreports\" type=\"checkbox\">Mostrar unicamente encabezado de los informes de espionaje</th>";
		$page .= "</tr><tr>";
		$page .= "<th colspan=\"4\">";
		$page .= "<select onchange=\"document.getElementById('deletemessages2').options[this.selectedIndex].selected='true'\" id=\"deletemessages\" name=\"deletemessages\">";
		$page .= "<option value=\"deletemarked\">Borrar mensajes marcados</option>";
		$page .= "<option value=\"deleteunmarked\">Borrar todos los mensajes sin marcar</option>";
		$page .= "<option value=\"deleteall\">Borrar todos los mensajes</option>";
		$page .= "</select>";
		$page .= "<input value=\"Ok\" type=\"submit\">";
		$page .= "</th>";
		$page .= "</tr><tr>";
		$page .= "<td colspan=\"4\"></td>";
		$page .= "</tr>";
		$page .= "</table>\n";
		$page .= "</td>";
		$page .= "</tr>";
		$page .= "</table>\n";
		$page .= "</form>";
		$page .= "</td>";
		$page .= "</table>\n";
		$page .= "</div>";
	break;
}
display($page, "Mensajes");
?>