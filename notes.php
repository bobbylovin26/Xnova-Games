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
require_once dirname(__FILE__) .'/common.php';

$dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];

$a = $_GET['a'];
$n = intval($_GET['n']);
$lang['Please_Wait'] = "Patientez...";

//lenguaje
includeLang('notes');

$lang['PHP_SELF'] = 'notes.'.PHPEXT;

if($_POST["s"] == 1 || $_POST["s"] == 2){//Edicion y agregar notas

	$time = time();
	$priority = $_POST["u"];
	$title = ($_POST["title"]) ? mysql_escape_string(strip_tags($_POST["title"])) : $lang['NoTitle'];
	$text = ($_POST["text"]) ? mysql_escape_string(strip_tags($_POST["text"])) : $lang['NoText'];

	if($_POST["s"] ==1){
		doquery("INSERT INTO {{table}} SET owner={$user['id']}, time=$time, priority=$priority, title='$title', text='$text'","notes");
		message($lang['NoteAdded'], $lang['Please_Wait'],'notes.'.PHPEXT,"3");
	}elseif($_POST["s"] == 2){
		/*
		  pequeño query para averiguar si la nota que se edita es del propio jugador
		*/
		$id = intval($_POST["n"]);
		$note_query = doquery("SELECT * FROM {{table}} WHERE id=$id AND owner=".$user["id"],"notes");

		if(!$note_query){ error($lang['notpossiblethisway'],$lang['Notes']); }

		doquery("UPDATE {{table}} SET time=$time, priority=$priority, title='$title', text='$text' WHERE id=$id","notes");
		message($lang['NoteUpdated'], $lang['Please_Wait'], 'notes.'.PHPEXT, "3");
	}

}
elseif($_POST){//Borrar

	foreach($_POST as $a => $b){
		/*
		  Los checkbox marcados tienen la palabra delmes seguido del id.
		  Y cada array contiene el valor "y" para compro
		*/
		if(preg_match("/delmes/i",$a) && $b == "y"){

			$id = str_replace("delmes","",$a);
			$note_query = doquery("SELECT * FROM {{table}} WHERE id=$id AND owner={$user['id']}","notes");
			//comprobamos,
			if($note_query){
				$deleted++;
				doquery("DELETE FROM {{table}} WHERE `id`=$id;","notes");// y borramos
			}
		}
	}
	if($deleted){
		$mes = ($deleted == 1) ? $lang['NoteDeleted'] : $lang['NoteDeleteds'];
		message($mes,$lang['Please_Wait'],'notes.'.PHPEXT,"3");
	}else{header("Location: notes.". PHPEXT);}

}else{//sin post...
	if($_GET["a"] == 1){//crear una nueva nota.
		/*
		  Formulario para crear una nueva nota.
		*/

		$parse = $lang;

		$parse['c_Options'] = "<option value=2 selected=selected>{$lang['Important']}</option>
			  <option value=1>{$lang['Normal']}</option>
			  <option value=0>{$lang['Unimportant']}</option>";

		$parse['cntChars'] = '0';
		$parse['TITLE'] = $lang['Createnote'];
		$parse['text'] = '';
		$parse['title'] = '';
		$parse['inputs'] = '<input type=hidden name=s value=1>';

		$page .= parsetemplate(gettemplate('notes_form'), $parse);

		display($page,$lang['Notes'],false);

	}
	elseif($_GET["a"] == 2){//editar
		/*
		  Formulario donde se puestra la nota y se puede editar.
		*/
		$note = doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} AND id=$n",'notes',true);

		if(!$note){ message($lang['notpossiblethisway'],$lang['Error']); }

		$cntChars = strlen($note['text']);

		$SELECTED[$note['priority']] = ' selected="selected"';

		$parse = array_merge($note,$lang);

		$parse['c_Options'] = "<option value=2{$SELECTED[2]}>{$lang['Important']}</option>
			  <option value=1{$SELECTED[1]}>{$lang['Normal']}</option>
			  <option value=0{$SELECTED[0]}>{$lang['Unimportant']}</option>";

		$parse['cntChars'] = $cntChars;
		$parse['TITLE'] = $lang['Editnote'];
		$parse['inputs'] = '<input type=hidden name=s value=2><input type=hidden name=n value='.$note['id'].'>';

		$page .= parsetemplate(gettemplate('notes_form'), $parse);

		display($page,$lang['Notes'],false);

	}
	else{//default

		$notes_query = doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} ORDER BY time DESC",'notes');
		//Loop para crear la lista de notas que el jugador tiene
		$count = 0;
		$parse=$lang;
		while($note = mysql_fetch_array($notes_query)){
			$count++;
			//Colorea el titulo dependiendo de la prioridad
			if($note["priority"] == 0){ $parse['NOTE_COLOR'] = "lime";}//Importante
			elseif($note["priority"] == 1){ $parse['NOTE_COLOR'] = "yellow";}//Normal
			elseif($note["priority"] == 2){ $parse['NOTE_COLOR'] = "red";}//Sin importancia

			//fragmento de template
			$parse['NOTE_ID'] = $note['id'];
			$parse['NOTE_TIME'] = date("Y-m-d h:i:s",$note["time"]);
			$parse['NOTE_TITLE'] = $note['title'];
			$parse['NOTE_TEXT'] = strlen($note['text']);

			$list .= parsetemplate(gettemplate('notes_body_entry'), $parse);

		}

		if($count == 0){
			$list .= "<tr><th colspan=4>{$lang['ThereIsNoNote']}</th>\n";
		}

		$parse = $lang;
		$parse['BODY_LIST'] = $list;
		//fragmento de template
		$page .= parsetemplate(gettemplate('notes_body'), $parse);

		display($page,$lang['Notes'],false);
	}
}
?>
