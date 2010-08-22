<?php
/**
 * XNova Legacies
 *
 * @license http://www.xnova-ng.org/license-legacies
 * @see http://www.xnova-ng.org/
 *
 * Copyright (c) 2009-Present, XNova Support Team
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 *  - Redistributions of source code must retain the above copyright notice,
 * this list of conditions and the following disclaimer.
 *  - Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *  - Neither the name of the team or any contributor may be used to endorse or
 * promote products derived from this software without specific prior written
 * permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 *
 *                                --> NOTICE <--
 *  This file is part of the core development branch, changing its contents will
 * make you unable to use the automatic updates manager. Please refer to the
 * documentation for further information about customizing XNova.
 *
 */

define('INSIDE' , true);
define('INSTALL' , false);
define('IN_ADMIN', true);
require_once dirname(__FILE__) .'./../common.php';

	if ($user['authlevel'] >= "2") {
		includeLang('admin/messagelist');

		$BodyTpl    = gettemplate('admin/messagelist_body');
		$RowsTpl    = gettemplate('admin/messagelist_table_rows');

        $Prev       = ( !empty($_POST['prev'])   ) ? true : false;
        $Next       = ( !empty($_POST['next'])   ) ? true : false;
        $DelSel     = ( !empty($_POST['delsel']) ) ? true : false;
        $DelDat     = ( !empty($_POST['deldat']) ) ? true : false;
        $CurrPage   = ( !empty($_POST['curr'])   ) ? $_POST['curr'] : 1;
        $Selected   = ( !empty($_POST['sele'])   ) ? $_POST['sele'] : 0;
        $SelType    = $_POST['type'];
        $SelPage    = $_POST['page'];

        $ViewPage = 1;
        if ( $Selected != $SelType ) {
            $Selected = $SelType;
            $ViewPage = 1;
        } elseif ( $CurrPage != $SelPage ) {
            $ViewPage = ( !empty($SelPage) ) ? $SelPage : 1;
        }

        if       ($Prev   == true) {
            $CurrPage -= 1;
            if ($CurrPage >= 1) {
                $ViewPage = $CurrPage;
            } else {
                $ViewPage = 1;
            }
        } elseif ($Next   == true) {
            $Mess      = doquery("SELECT COUNT(*) AS `max` FROM {{table}} WHERE `message_type` = '". $Selected ."';", 'messages', true);
            $MaxPage   = ceil ( ($Mess['max'] / 25) );
            $CurrPage += 1;
            if ($CurrPage <= $MaxPage) {
                $ViewPage = $CurrPage;
            } else {
                $ViewPage = $MaxPage;
            }
        } elseif ($DelSel == true) {
            foreach($_POST['sele'] as $MessId => $Value) {
                if ($Value = "on") {
                    doquery ( "DELETE FROM {{table}} WHERE `message_id` = '". $MessId ."';", 'messages');
                }
            }
        } elseif ($DelDat == true) {
            $SelDay    = $_POST['selday'];
            $SelMonth  = $_POST['selmonth'];
            $SelYear   = $_POST['selyear'];
            $LimitDate = mktime (0,0,0, $SelMonth, $SelDay, $SelYear );
            if ($LimitDate != false) {
                doquery ( "DELETE FROM {{table}} WHERE `message_time` <= '". $LimitDate ."';", 'messages');
                doquery ( "DELETE FROM {{table}} WHERE `time` <= '". $LimitDate ."';", 'rw');
            }
        }

        $Mess     = doquery("SELECT COUNT(*) AS `max` FROM {{table}} WHERE `message_type` = '". $Selected ."';", 'messages', true);
        $MaxPage  = ceil ( ($Mess['max'] / 25) );

		$parse                      = $lang;
		$parse['mlst_data_page']    = $ViewPage;
		$parse['mlst_data_pagemax'] = $MaxPage;
		$parse['mlst_data_sele']    = $Selected;

		$parse['mlst_data_types']  = "<option value=\"0\"".  (($Selected == "0")  ? " SELECTED" : "") .">". $lang['mlst_mess_typ__0'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"1\"".  (($Selected == "1")  ? " SELECTED" : "") .">". $lang['mlst_mess_typ__1'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"2\"".  (($Selected == "2")  ? " SELECTED" : "") .">". $lang['mlst_mess_typ__2'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"3\"".  (($Selected == "3")  ? " SELECTED" : "") .">". $lang['mlst_mess_typ__3'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"4\"".  (($Selected == "4")  ? " SELECTED" : "") .">". $lang['mlst_mess_typ__4'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"5\"".  (($Selected == "5")  ? " SELECTED" : "") .">". $lang['mlst_mess_typ__5'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"15\"". (($Selected == "15") ? " SELECTED" : "") .">". $lang['mlst_mess_typ_15'] ."</option>";
		$parse['mlst_data_types'] .= "<option value=\"99\"". (($Selected == "99") ? " SELECTED" : "") .">". $lang['mlst_mess_typ_99'] ."</option>";

		$parse['mlst_data_pages']  = "";
		for ( $cPage = 1; $cPage <= $MaxPage; $cPage++ ) {
			$parse['mlst_data_pages'] .= "<option value=\"".$cPage."\"".  (($ViewPage == $cPage)  ? " SELECTED" : "") .">". $cPage ."/". $MaxPage ."</option>";
		}

		$parse['mlst_scpt']  = "<script language=\"JavaScript\">\n";
		$parse['mlst_scpt'] .= "function f(target_url, win_name) {\n";
		$parse['mlst_scpt'] .= "var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');\n";
		$parse['mlst_scpt'] .= "new_win.focus();\n";
		$parse['mlst_scpt'] .= "}\n";
		$parse['mlst_scpt'] .= "</script>\n";

		$parse['tbl_rows']   = "";
		$parse['mlst_title'] = $lang['mlst_title'];

		$StartRec           = 1 + (($ViewPage - 1) * 25);
		$Messages           = doquery("SELECT * FROM {{table}} WHERE `message_type` = '". $Selected ."' ORDER BY `message_time` DESC LIMIT ". $StartRec .",25;", 'messages');
		while ($row = mysql_fetch_assoc($Messages)) {
			$OwnerData = doquery ("SELECT `username` FROM {{table}} WHERE `id` = '". $row['message_owner'] ."';", 'users',true);
			$bloc['mlst_id']      = $row['message_id'];
			$bloc['mlst_from']    = $row['message_from'];
			$bloc['mlst_to']      = $OwnerData['username'] ." ID:". $row['message_owner'];
			$bloc['mlst_text']    = $row['message_text'];
			$bloc['mlst_time']    = gmdate ( "d. M Y H:i:s", $row['message_time'] );

			$parse['mlst_data_rows'] .= parsetemplate($RowsTpl , $bloc);
		}

		$display            = parsetemplate($BodyTpl , $parse);

		if (isset($_POST['delit'])) {
			doquery ("DELETE FROM {{table}} WHERE `message_id` = '". $_POST['delit'] ."';", 'messages');
			AdminMessage ( $lang['mlst_mess_del'] ." ( ". $_POST['delit'] ." )", $lang['mlst_title'], "./messagelist.".PHPEXT, 3);
		}
		display ($display, $lang['mlst_title'], false, '', true);
	} else {
		message($lang['sys_noalloaw'], $lang['sys_noaccess']);
	}

?>
