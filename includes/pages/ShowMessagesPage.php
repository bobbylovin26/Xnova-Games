<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

if(!defined('INSIDE')){ die(header("location:../../"));}

function ShowMessagesPage($CurrentUser)
{
	global $xgp_root, $phpEx, $game_config, $dpath, $lang;

	$OwnerID       = $_GET['id'];
	$MessCategory  = $_GET['messcat'];
	$MessPageMode  = $_GET["mode"];
	$DeleteWhat    = $_POST['deletemessages'];

	if (isset ($DeleteWhat))
		$MessPageMode = "delete";

	$UsrMess       = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$CurrentUser['id']."' ORDER BY `message_time` DESC;", 'messages');
	$UnRead        = doquery("SELECT * FROM {{table}} WHERE `id` = '". $CurrentUser['id'] ."';", 'users', true);

	$MessageType   = array ( 0, 1, 2, 3, 4, 5, 15, 99, 100 );
	$TitleColor    = array ( 0 => '#FFFF00', 1 => '#FF6699', 2 => '#FF3300', 3 => '#FF9900', 4 => '#773399', 5 => '#009933', 15 => '#030070', 99 => '#007070', 100 => '#ABABAB'  );
	$BackGndColor  = array ( 0 => '#663366', 1 => '#336666', 2 => '#000099', 3 => '#666666', 4 => '#999999', 5 => '#999999', 15 => '#999999', 99 => '#999999', 100 => '#999999'  );

	for ($MessType = 0; $MessType < 101; $MessType++)
	{
		if (in_array($MessType, $MessageType))
		{
			$WaitingMess[$MessType] = $UnRead[$messfields[$MessType]];
			$TotalMess[$MessType]   = 0;
		}
	}

	while ($CurMess = mysql_fetch_array($UsrMess))
	{
		$MessType              = $CurMess['message_type'];
		$TotalMess[$MessType] += 1;
		$TotalMess[100]       += 1;
	}

	switch ($MessPageMode)
	{
		case 'write':
			if (!is_numeric($OwnerID))
				header("location:game.php?page=messages");

			$OwnerRecord = doquery("SELECT * FROM {{table}} WHERE `id` = '".$OwnerID."';", 'users', true);

			if (!$OwnerRecord)
				header("location:game.php?page=messages");

			$OwnerHome   = doquery("SELECT * FROM {{table}} WHERE `id_planet` = '". $OwnerRecord["id_planet"] ."';", 'galaxy', true);
			if (!$OwnerHome)
				header("location:game.php?page=messages");

			if ($_POST)
			{
				$error = 0;
				if (!$_POST["subject"])
				{
					$error++;
					$page .= "<table><tr><td><font color=#FF0000".$lang['mg_no_subject']."</font></td></tr></table>";
				}
				if (!$_POST["text"])
				{
					$error++;
					$page .= "<table><tr><td><font color=#FF0000>".$lang['mg_no_text']."</font></td></tr></table>";
				}
				if ($error == 0)
				{
					$page .= "<table><tr><td><font color=\"#00FF00\">".$lang['mg_msg_sended']."</font></td></tr></table>";

					$_POST['text'] = str_replace("'", '&#39;', $_POST['text']);

					$Owner   = $OwnerID;
					$Sender  = $CurrentUser['id'];
					$From    = $CurrentUser['username'] ." [".$CurrentUser['galaxy'].":".$CurrentUser['system'].":".$CurrentUser['planet']."]";
					$Subject = $_POST['subject'];
					$Message = trim ( nl2br ( strip_tags ( $_POST['text'], '<br>' ) ) );
					SendSimpleMessage($Owner, $Sender, '', 1, $From, $Subject, $Message);
					$subject = "";
					$text    = "";
				}
			}
			$parse['id']           = $OwnerID;
			$parse['to']           = $OwnerRecord['username'] ." [".$OwnerHome['galaxy'].":".$OwnerHome['system'].":".$OwnerHome['planet']."]";
			$parse['subject']      = (!isset($subject)) ? $lang['ms_no_subject'] : $subject ;
			$parse['text']         = $text;
			$page                 .= parsetemplate(gettemplate('messages_pm_form'), $parse);
		break;
		case 'delete':
			$DeleteWhat = $_POST['deletemessages'];
			if($DeleteWhat == 'deleteall')
				doquery("DELETE FROM {{table}} WHERE `message_owner` = '". $CurrentUser['id'] ."';", 'messages');
			elseif ($DeleteWhat == 'deletemarked')
			{
				foreach($_POST as $Message => $Answer)
				{
					if (preg_match("/delmes/i", $Message) && $Answer == 'on')
					{
						$MessId   = str_replace("delmes", "", $Message);
						$MessHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MessId ."' AND `message_owner` = '". $CurrentUser['id'] ."';", 'messages');
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
						$MessHere = doquery("SELECT * FROM {{table}} WHERE `message_id` = '". $MessId ."' AND `message_owner` = '". $CurrentUser['id'] ."';", 'messages');
						if ($MessHere)
							doquery("DELETE FROM {{table}} WHERE `message_id` = '".$MessId."';", 'messages');

					}
				}
			}
			$MessCategory = $_POST['category'];
			header("location:game.php?page=messages");
		break;
		case 'show':
			$page  .= "<script language=\"JavaScript\">\n";
			$page .= "function f(target_url, win_name) {\n";
			$page .= "var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');\n";
			$page .= "new_win.focus();\n";
			$page .= "}\n";
			$page .= "</script>\n";
			$page .= "<br /><div id=\"content\"><table>";
			$page .= "<tr>";
			$page .= "<td></td>";
			$page .= "<td>\n";
			$page .= "<table width=\"519\">";
			$page .= "<form action=\"game.php?page=messages\" method=\"post\"><table>";
			$page .= "<tr>";
			$page .= "<td></td>";
			$page .= "<td>\n<input name=\"messages\" value=\"1\" type=\"hidden\">";
			$page .= "<table width=\"519\">";
			$page .= "<tr>";
			$page .= "<th colspan=\"9\">";
			$page .= "<select onchange=\"document.getElementById('deletemessages').options[this.selectedIndex].selected='true'\" id=\"deletemessages2\" name=\"deletemessages2\">";
			$page .= "<option value=\"deletemarked\">".$lang['ms_delete_marked']."</option>";
			$page .= "<option value=\"deleteunmarked\">".$lang['ms_delete_unmarked']."</option>";
			$page .= "<option value=\"deleteall\">".$lang['ms_delete_all']."</option>";
			$page .= "</select>";
			$page .= "<input value=\"".$lang['ms_confirm_delete']."\" type=\"submit\">";
			$page .= "</th>";
			$page .= "</tr><tr>";
			$page .= "<th style=\"color: rgb(242, 204, 74);\" colspan=\"9\">";
			$page .= "<input name=\"category\" value=\"".$MessCategory."\" type=\"hidden\">";
			$page .= "<input onchange=\"document.getElementById('fullreports').checked=this.checked\" id=\"fullreports2\" name=\"fullreports2\" type=\"checkbox\">".$lang['ms_show_only_header_spy_reports']."</th>";
			$page .= "</tr><tr>";
			$page .= "<th>".$lang['ms_action']."</th>";
			$page .= "<th>".$lang['ms_date']."</th>";
			$page .= "<th>".$lang['ms_from']."</th>";
			$page .= "<th>".$lang['ms_subject']."</th>";
			$page .= "</tr>";

			if ($MessCategory == 100)
			{
				$UsrMess       = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$CurrentUser['id']."' ORDER BY `message_time` DESC;", 'messages');
				$SubUpdateQry  = "";

				$QryUpdateUser  = "UPDATE {{table}} SET ";
				$QryUpdateUser .= "`new_message` = '0' ";
				$QryUpdateUser .= "WHERE ";
				$QryUpdateUser .= "`id` = '".$CurrentUser['id']."';";
				doquery ( $QryUpdateUser, 'users');

				while ($CurMess = mysql_fetch_array($UsrMess))
				{
					$page .= "\n<tr>";
					$page .= "<input name=\"showmes". $CurMess['message_id'] . "\" type=\"hidden\" value=\"1\">";
					$page .= "<th><input name=\"delmes". $CurMess['message_id'] . "\" type=\"checkbox\"></th>";
					$page .= "<th>". date("m-d H:i:s", $CurMess['message_time']) ."</th>";
					$page .= "<th>". stripslashes( $CurMess['message_from'] ) ."</th>";
					$page .= "<th>". stripslashes( $CurMess['message_subject'] ) ." ";
					if ($CurMess['message_type'] == 1)
					{
						$page .= "<a href=\"game.php?page=messages&mode=write&amp;id=". $CurMess['message_sender'] ."&amp;subject=Re: " . htmlspecialchars( $CurMess['message_subject']) ."\">";
						$page .= "<img src=\"". $dpath ."img/m.gif\" alt=\"Responder\" border=\"0\"></a></th>";
					}
					else
					{
						$page .= "</th>";
					}
					$page .= "</tr><tr>";
					$page .= "<td style=\"background-color: ".$BackGndColor[$CurMess['message_type']]."; background-image: none;\"; class=\"b\"> </td>";
					$page .= "<td style=\"background-color: ".$BackGndColor[$CurMess['message_type']]."; background-image: none;\"; colspan=\"3\" class=\"b\">". stripslashes( nl2br( $CurMess['message_text'] ) ) ."</td>";
					$page .= "</tr>";
				}
			}
			else
			{
				$UsrMess       = doquery("SELECT * FROM {{table}} WHERE `message_owner` = '".$CurrentUser['id']."' AND `message_type` = '".$MessCategory."' ORDER BY `message_time` DESC;", 'messages');

				while ($CurMess = mysql_fetch_array($UsrMess))
				{
					if ($CurMess['message_type'] == $MessCategory)
					{
						$QryUpdateUser  = "UPDATE {{table}} SET ";
						$QryUpdateUser .= "`new_message` = '0' ";
						$QryUpdateUser .= "WHERE ";
						$QryUpdateUser .= "`id` = '".$CurrentUser['id']."';";
						doquery ( $QryUpdateUser, 'users');

						$page .= "\n<tr>";
						$page .= "<input name=\"showmes". $CurMess['message_id'] . "\" type=\"hidden\" value=\"1\">";
						$page .= "<th><input name=\"delmes". $CurMess['message_id'] ."\" type=\"checkbox\"></th>";
						$page .= "<th>". date("m-d H:i:s O", $CurMess['message_time']) ."</th>";
						$page .= "<th>". stripslashes( $CurMess['message_from'] ) ."</th>";
						$page .= "<th>". stripslashes( $CurMess['message_subject'] ) ." ";
						if ($CurMess['message_type'] == 1)
						{
							$page .= "<a href=\"game.php?page=messages&mode=write&amp;id=". $CurMess['message_sender'] ."&amp;subject=Re:". htmlspecialchars( $CurMess['message_subject']) ."\">";
							$page .= "<img src=\"". $dpath ."img/m.gif\" border=\"0\"></a></th>";
						}
						else
							$page .= "</th>";

						$page .= "</tr><tr>";
						$page .= "<td class=\"b\"> </td>";
						$page .= "<td colspan=\"3\" class=\"b\">". nl2br( stripslashes( $CurMess['message_text'] ) ) ."</td>";
						$page .= "</tr>";
					}
				}
			}


			$page .= "<tr>";
			$page .= "<th style=\"color: rgb(242, 204, 74);\" colspan=\"4\">";
			$page .= "<input onchange=\"document.getElementById('fullreports2').checked=this.checked\" id=\"fullreports\" name=\"fullreports\" type=\"checkbox\">".$lang['ms_show_only_header_spy_reports']."</th>";
			$page .= "</tr><tr>";
			$page .= "<th colspan=\"4\">";
			$page .= "<select onchange=\"document.getElementById('deletemessages2').options[this.selectedIndex].selected='true'\" id=\"deletemessages\" name=\"deletemessages\">";
			$page .= "<option value=\"deletemarked\">".$lang['ms_delete_marked']."</option>";
			$page .= "<option value=\"deleteunmarked\">".$lang['ms_delete_unmarked']."</option>";
			$page .= "<option value=\"deleteall\">".$lang['ms_delete_all']."</option>";
			$page .= "</select>";
			$page .= "<input value=\"".$lang['ms_confirm_delete']."\" type=\"submit\">";
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
		default:
			$page  = "<script language=\"JavaScript\">\n";
			$page .= "function f(target_url, win_name) {\n";
			$page .= "var new_win = window.open(target_url, win_name, 'resizable=yes, scrollbars=yes, menubar=no, toolbar=no, width=550, height=280, top=0, left=0');\n";
			$page .= "new_win.focus();\n";
			$page .= "}\n";
			$page .= "</script>\n";
			$page .= "<div id=\"content\">";
			$page .= "<br>";
			$page .= "<table width=\"569\">";
			$page .= "<tr>";
			$page .= "	<td class=\"c\" colspan=\"3\">".$lang['ms_message_title']."</td>";
			$page .= "</tr><tr>";
			$page .= "	<th colspan=\"2\">".$lang['ms_message_type']."</th>";
			$page .= "	<th>".$lang['ms_total']."</th>";
			$page .= "</tr>";
			$page .= "<tr>";
			$page .= "	<th colspan=\"2\"><a href=\"game.php?page=messages&mode=show&amp;messcat=100\"><font color=\"". $TitleColor[100] ."\">". $lang['mg_type'][100] ."</a></th>";
			$page .= "	<th><font color=\"". $TitleColor[100] ."\">". $TotalMess[100] ."</font></th>";
			$page .= "</tr>";
			for ($MessType = 0; $MessType < 100; $MessType++)
			{
				if ( in_array($MessType, $MessageType) )
				{
					$page .= "<tr>";
					$page .= "	<th colspan=\"2\"><a href=\"game.php?page=messages&mode=show&amp;messcat=". $MessType ." \"><font color=\"". $TitleColor[$MessType] ."\">". $lang['mg_type'][$MessType] ."</a></th>";
					$page .= "	<th><font color=\"". $TitleColor[$MessType] ."\">". $TotalMess[$MessType] ."</font></th>";
					$page .= "</tr>";
				}
			}
			$page .= "</table>";
			$page .= "</div>";
		break;
	}

	display($page);
}
?>