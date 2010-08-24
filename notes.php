<?php

/**
 * notes.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.'.$phpEx);

$dpath = (!$user["dpath"]) ? DEFAULT_SKINPATH : $user["dpath"];

$a = $_GET['a'];
$n = intval($_GET['n']);

if($_POST["s"] == 1 || $_POST["s"] == 2)
{
	$time = time();
	$priority = $_POST["u"];
	$title = ($_POST["title"]) ? mysql_escape_string(strip_tags($_POST["title"])) : "Sin t&iacute;tulo";
	$text = ($_POST["text"]) ? mysql_escape_string(strip_tags($_POST["text"])) : "Sin texto";

	if($_POST["s"] ==1)
	{
		doquery("INSERT INTO {{table}} SET owner={$user['id']}, time=$time, priority=$priority, title='$title', text='$text'","notes");
		message("La nota ha sido creada. <br><a href=\"notes.php\">Volver</a>", "&#161;Listo!",'notes.'.$phpEx,"3");
	}
	elseif($_POST["s"] == 2)
	{
		$id = intval($_POST["n"]);
		$note_query = doquery("SELECT * FROM {{table}} WHERE id=$id AND owner=".$user["id"],"notes");

		if(!$note_query){ error("¡Error, la acción no es posible!","¡Error en notas!"); }

		doquery("UPDATE {{table}} SET time=$time, priority=$priority, title='$title', text='$text' WHERE id=$id","notes");
		message("La nota ha sido actualizada. <br><a href=\"notes.php\">Volver</a>", "&#161;Listo!", 'notes.'.$phpEx, "3");
	}
}
elseif($_POST)
{
	foreach($_POST as $a => $b)
	{
		if(preg_match("/delmes/i",$a) && $b == "y")
		{
			$id = str_replace("delmes","",$a);
			$note_query = doquery("SELECT * FROM {{table}} WHERE id=$id AND owner={$user['id']}","notes");

			if($note_query)
			{
				$deleted++;
				doquery("DELETE FROM {{table}} WHERE `id`=$id;","notes");
			}
		}
	}
	if($deleted)
	{
		$mes = ($deleted == 1) ? "Nota eliminada<br><a href=\"notes.php\">Volver</a>" : "Notas eliminadas <br><a href=\"notes.php\">Volver</a>";
		message($mes,"&#161;Listo!",'notes.'.$phpEx,"3");
	}
	else
	{
		header("Location: notes.$phpEx");
	}

}
else
{
	if($_GET["a"] == 1)
	{
		$parse['c_Options'] = "<option value=2 selected=selected>Importante</option>
		<option value=1>Normal</option>
		<option value=0>Sin importancia</option>";
		$parse['TITLE'] 	= "Hacer una nota";
		$parse[inputs]  	= "<input type=hidden name=s value=1>";

		display(parsetemplate(gettemplate('notes/notes_form'), $parse), "Notas - Crear");

	}
	elseif($_GET["a"] == 2)
	{
		$note = doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} AND id=$n",'notes',true);

		if(!$note){ message("La nota no existe","&#161;Error!"); }

		$SELECTED[$note['priority']] = ' selected="selected"';

		$parse['c_Options'] = "<option value=2{$SELECTED[2]}>Importante</option>
		<option value=1{$SELECTED[1]}>Normal</option>
		<option value=0{$SELECTED[0]}>Sin importancia</option>";

		$parse['TITLE'] 	= "Editar nota";
		$parse['inputs'] 	= '<input type=hidden name=s value=2><input type=hidden name=n value='.$note['id'].'>';
		$parse[asunto]		= $note[title];
		$parse[texto]		= $note[text];

		display(parsetemplate(gettemplate('notes/notes_form'), $parse),"Notas - Editar");

	}
	else
	{
		$notes_query = doquery("SELECT * FROM {{table}} WHERE owner={$user['id']} ORDER BY time DESC",'notes');

		$count = 0;

		while($note = mysql_fetch_array($notes_query))
		{
			$count++;

			if($note["priority"] == 0){ $parse['NOTE_COLOR'] = "lime";}
			elseif($note["priority"] == 1){ $parse['NOTE_COLOR'] = "yellow";}
			elseif($note["priority"] == 2){ $parse['NOTE_COLOR'] = "red";}

			$parse['NOTE_ID'] 		= $note['id'];
			$parse['NOTE_TIME'] 	= date("Y-m-d h:i:s",$note["time"]);
			$parse['NOTE_TITLE'] 	= $note['title'];
			$parse['NOTE_TEXT'] 	= strlen($note['text']);

			$list .= parsetemplate(gettemplate('notes/notes_body_entry'), $parse);

		}

		if($count == 0)
		{
			$list .= "<tr><th colspan=4>No tienes notas</th>\n";
		}

		$parse['BODY_LIST'] = $list;

		display(parsetemplate(gettemplate('notes/notes_body'), $parse),"Notas");
	}
}
?>
