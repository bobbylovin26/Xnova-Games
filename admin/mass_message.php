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

function mass_message_run($parent){
	if($_POST["mode"] == "change"){
		if(isset($_POST["tresc"])&& $_POST["tresc"] != ''){
			$game_config['tresc'] = $parent->safe_get_post_var("tresc");
		}
		if(isset($_POST["temat"])&& $_POST["temat"] != ''){
			$game_config['temat'] = $parent->safe_get_post_var("temat");
		}
		$kolor = 'red';
		if($game_config['tresc'] !='' and $game_config['temat']){
			$sq = $parent->db->query("SELECT `id` FROM {{table}}","users");
			while($u = $parent->db->fetch_assoc($sq)){
				doquery("INSERT INTO {{table}} SET
					`message_owner`='{$u['id']}',
					`message_sender`='1' ,
					`message_time`='".time()."',
					`message_type`='0',
					`message_from`='<font color=\"$kolor\">Administracja</font>',
					`message_subject`='<font color=\"$kolor\">{$game_config['temat']}</font>',
					`message_text`='<font color=\"$kolor\"><b>{$game_config['tresc']}</b></font>'
					","messages");
				$parent->db->query("UPDATE {{table}} SET new_message=new_message+1 WHERE id='{$u['id']}'",'users');
			}
			$parent->smarty->assign("message","<font color=\"lime\">Wys³a³e¶ wiadomo¶æ do wszystkich graczy</font>");
		}
	}
	$parent->smarty->display("mass_message.tpl");
}

function mass_message_info(){
	return array("name" => "Send MassMessages","description"=>"Sends messagess to all players","default_weight"=>"0");
}
?>