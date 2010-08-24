<?php

/**
 * alliance.php
 *
 * @version 2.0
 * @copyright 2008 by ??????? for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSTALL' , false);
define('INSIDE', true);

$xgp_root = './';
include($xgp_root . 'extension.inc.php');
include($xgp_root . 'common.'.$phpEx);
include($xgp_root . 'includes/funciones_A/MessageForm.'.$phpEx);

//MODO PRINCIPAL
$mode = $_GET['mode'];
if (empty($mode))   { unset($mode); }
// ORDEN ALTERNATIVA "A"
$a     = intval($_GET['a']);
if (empty($a))      { unset($a); }
// ORDEN 1
$sort1 = intval($_GET['sort1']);
if (empty($sort1))  { unset($sort1); }
// ORDEN 2
$sort2 = intval($_GET['sort2']);
if (empty($sort2))  { unset($sort2); }
// ELIMINAR RANGO
$d = $_GET['d'];
if ((!is_numeric($d)) || (empty($d) && $d != 0))unset($d);
// EDITAR
$edit = $_GET['edit'];
if (empty($edit))unset($edit);
// ADMIN -> RANGOS -> MIEMBROS
$rank = intval($_GET['rank']);
if (empty($rank))unset($rank);
// ADMIN -> EXPULSAR -> MIEMBROS
$kick = intval($_GET['kick']);
if (empty($kick))unset($kick);

$id = intval($_GET['id']);
if (empty($id))unset($id);

$yes      = $_GET['yes'];
$allyid   = intval($_GET['allyid']);
$show     = intval($_GET['show']);
$sendmail = intval($_GET['sendmail']);
$t        = $_GET['t'];
$tag      = mysql_escape_string($_GET['tag']);

// EN ESTE CASO EL USUARIO SOLO ESTÁ DE VISITA EN LA ALIANZA
if ($_GET['mode'] == 'ainfo')
{
	if (isset($tag) && $a == "")
	{
		$allyrow = doquery("SELECT * FROM {{table}} WHERE ally_tag='{$tag}'", "alliance", true);
	}
	elseif(is_numeric($a) && $a != 0 && $tag == "")
	{
		$allyrow = doquery("SELECT * FROM {{table}} WHERE id='{$a}'", "alliance", true);
	}
	else
	{
		message("La alianza no existe.", "¡Error!", "alliance.php",2);
	}

	if (!$allyrow)
	{
		message("La alianza no existe.", "¡Error!", "alliance.php",2);
	}

	extract($allyrow);

	if ($ally_image != "")
	{
		$ally_image = "<tr><th colspan=2><img src=\"".$ally_image."\"></td></tr>";
	}

	if ($ally_description != "")
	{
		$ally_description = "<tr><th colspan=2 height=100>".$ally_description."</th></tr>";
	}
	else
	{
		$ally_description = "<tr><th colspan=2 height=100>Mensaje de descripcion de la alianza.</th></tr>";
	}

	if ($ally_web != "")
	{
		$ally_web = "<tr><th>Web de la alianza</th><th><a href=\"{$ally_web}\">{$ally_web}</a></th></tr>";
	}

	$patterns[] = "#\[fc\]([a-z0-9\#]+)\[/fc\](.*?)\[/f\]#Ssi";
	$replacements[] = '<font color="\1">\2</font>';
	$patterns[] = '#\[img\](.*?)\[/img\]#Smi';
	$replacements[] = '<img src="\1" alt="\1" style="border:0px;" />';
	$patterns[] = "#\[fc\]([a-z0-9\#\ \[\]]+)\[/fc\]#Ssi";
	$replacements[] = '<font color="\1">';
	$patterns[] = "#\[/f\]#Ssi";
	$replacements[] = '</font>';
	$ally_description = preg_replace($patterns, $replacements, $ally_description);

	$parse['ally_description'] 		= nl2br($ally_description);
	$parse['ally_image'] 			= $ally_image;
	$parse['ally_web'] 				= $ally_web;
	$parse['ally_member_scount'] 	= $ally_members;
	$parse['ally_name'] 			= $ally_name;
	$parse['ally_tag'] 				= $ally_tag;

	if ($user['ally_id'] == 0)
	{
		$parse['solicitud'] = "<tr><th>Solicitud</th><th><a href=\"alliance.php?mode=apply&amp;allyid=" . $id . "\">Click aqui para enviar su solicitud a la alianza</a></th></tr>";
	}
	else
	{
		$parse['solicitud'] = "";
	}

	$page .= parsetemplate(gettemplate('alliance/alliance_ainfo'), $parse);
	display($page, "Alianza ".$ally_name);
}
// EN ESTE CASO EL USUARIO NO SE ENCUENTRA AUN EN NINGUNA ALIANZA
if ($user['ally_id'] == 0)
{	//CREAR ALIANZA
	if ($mode == 'make' && $user['ally_request'] == 0)
	{
		if ($yes == 1 && $_POST)
		{
			if (!$_POST['atag'])
			{
				message("Falta la etiqueta de la alianza.", "¡Error!", "alliance.php?mode=make",2);
			}
			if (!$_POST['aname'])
			{
				message("Falta el nombre de la alianza.", "¡Error!","alliance.php?mode=make",2);
			}

			$tagquery = doquery("SELECT * FROM `{{table}}` WHERE ally_tag='".$_POST['atag']."'", 'alliance', true);

			if ($tagquery)
			{
				message(str_replace('%s', $_POST['atag'], "La alianza %s ya existe."), "¡Error!","alliance.php?mode=make",2);
			}

			doquery("INSERT INTO {{table}} SET
			`ally_name`='{$_POST['aname']}',
			`ally_tag`='{$_POST['atag']}' ,
			`ally_owner`='{$user['id']}',
			`ally_owner_range`='Leader',
			`ally_members`='1',
			`ally_register_time`=" . time() , "alliance");

			$allyquery = doquery("SELECT * FROM {{table}} WHERE ally_tag='{$_POST['atag']}'", 'alliance', true);

			doquery("UPDATE {{table}} SET
			`ally_id`='{$allyquery['id']}',
			`ally_name`='{$allyquery['ally_name']}',
			`ally_register_time`='" . time() . "'
			WHERE `id`='{$user['id']}'", "users");

			$page = MessageForm(str_replace('%s', $_POST['atag'], "La alianza %s ha sido creada"),

			str_replace('%s', $_POST['atag'], "La Alianza %s ha sido creada.") . "<br><br>", "", "Continuar");
		}
		else
		{
			$page .= parsetemplate(gettemplate('alliance/alliance_make'), $parse);
		}
		display($page, "Fundar alianza");
	}
	//BUSCAR ALIANZA
	if ($mode == 'search' && $user['ally_request'] == 0)
	{
		$page = parsetemplate(gettemplate('alliance/alliance_searchform'), $parse);

		if ($_POST)
		{
			$search = doquery("SELECT * FROM {{table}} WHERE ally_name LIKE '%{$_POST['searchtext']}%' or ally_tag LIKE '%{$_POST['searchtext']}%' LIMIT 30", "alliance");

			if (mysql_num_rows($search) != 0)
			{
				while ($s = mysql_fetch_array($search))
				{
					$entrada = array();
					$entrada['ally_tag'] = "<a href=\"alliance.php?mode=apply&allyid={$s['id']}\">{$s['ally_tag']}</a>";
					$entrada['ally_name'] = $s['ally_name'];
					$entrada['ally_members'] = $s['ally_members'];

					$parse['result'] .= parsetemplate(gettemplate('alliance/alliance_searchresult_row'), $entrada);
				}

				$page .= parsetemplate(gettemplate('alliance/alliance_searchresult_table'), $parse);
			}
		}
		display($page, "Buscar alianza");
	}

	if ($mode == 'apply' && $user['ally_request'] == 0)
	{ //SOLICITUDES
		if($_GET['allyid'] != NULL)
		{
			$alianza = doquery("SELECT * FROM {{table}} WHERE id='{$_GET['allyid']}'", "alliance", true);
		}

		if($alianza['ally_request_notallow'] == 1)
		{
			message("Esta alianza no admite más miembros", "¡Alianza Cerrada!", "alliance.php",2);
		}
		else
		{
			if (!is_numeric($_GET['allyid']) || !$_GET['allyid'] || $user['ally_request'] != 0 || $user['ally_id'] != 0)
			{
				message("Imposible encontrar la alianza seleccionada.", "¡Error!","alliance.php",2);
			}

			$allyrow = doquery("SELECT ally_tag,ally_request FROM {{table}} WHERE id='" . intval($_GET['allyid']) . "'", "alliance", true);

			if (!$allyrow)
			{
				message("La alianza seleccionada no existe.", "¡Error!","alliance.php",2);
			}

			extract($allyrow);

			if ($_POST['enviar'] == "Enviar")
			{
				doquery("UPDATE {{table}} SET `ally_request`='" . intval($allyid) . "', ally_request_text='" . mysql_escape_string(strip_tags($_POST['text'])) . "', ally_register_time='" . time() . "' WHERE `id`='" . $user['id'] . "'", "users");

				message("Solicitud registrada. Recibiras un mensaje cuando tu solicitud sea aceptada / rechazada. <br><a href=\"alliance.php\">Volver</a>", "Tu solicitud","alliance.php",2);
			}
			else
			{
				$text_apply = ($ally_request) ? $ally_request : "Los líderes de la alianza no han creado un ejemplo de solicitud, o no tienen pretenciones.";
			}

			$parse['allyid'] 			= intval($_GET['allyid']);
			$parse['chars_count'] 		= strlen($text_apply);
			$parse['text_apply'] 		= $text_apply;
			$parse['Write_to_alliance'] = str_replace('%s', $ally_tag, "Escribir solicitud a la alianza %s");

			$page = parsetemplate(gettemplate('alliance/alliance_applyform'), $parse);

			display($page, "Alianza - Enviar solicitud");
		}
	}

	if ($user['ally_request'] != 0)
	{
		$allyquery = doquery("SELECT ally_tag FROM {{table}} WHERE id='" . intval($user['ally_request']) . "' ORDER BY `id`", "alliance", true);

		extract($allyquery);

		if ($_POST['bcancel'])
		{
			doquery("UPDATE {{table}} SET `ally_request`=0 WHERE `id`=" . $user['id'], "users");

			$lang['request_text'] = str_replace('%s', $ally_tag, "Tu solicitud a la alianza %s ha sido borrada. <br/>Ahora puedes escribir una nueva solicitud o crear tu propia alianza.");
			$lang['button_text'] = "Continuar";
			$page = parsetemplate(gettemplate('alliance/alliance_apply_waitform'), $lang);
		}
		else
		{
			$lang['request_text'] = str_replace('%s', $ally_tag, "Ya has enviado una solicitud a la alianza %s. <br/>Por favor, espera hasta que recibas una respuesta o borra la solicitud.");
			$lang['button_text'] = "Borrar solicitud";
			$page = parsetemplate(gettemplate('alliance/alliance_apply_waitform'), $lang);
		}

		display($page, "Tu solicitud");
	}
	else
	{
		display(parsetemplate(gettemplate('alliance/alliance_defaultmenu'), $lang), "Alianza");
	}
}
elseif ($user['ally_id'] != 0 && $user['ally_request'] == 0) // CUANDO YA ESTA EN UNA ALIANZA
{
	$ally = doquery("SELECT * FROM {{table}} WHERE id='{$user['ally_id']}'", "alliance", true);
	$ally_ranks = unserialize($ally['ally_ranks']);

	if ($ally_ranks[$user['ally_rank_id']-1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_can_watch_memberlist_status = true;
	else
		$user_can_watch_memberlist_status = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['memberlist'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_can_watch_memberlist = true;
	else
		$user_can_watch_memberlist = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['mails'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_can_send_mails = true;
	else
		$user_can_send_mails = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['kick'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_can_kick = true;
	else
		$user_can_kick = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['rechtehand'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_can_edit_rights = true;
	else
		$user_can_edit_rights = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['delete'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_can_exit_alliance = true;
	else
		$user_can_exit_alliance = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['bewerbungen'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_bewerbungen_einsehen = true;
	else
		$user_bewerbungen_einsehen = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['bewerbungenbearbeiten'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_bewerbungen_bearbeiten = true;
	else
		$user_bewerbungen_bearbeiten = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['administrieren'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_admin = true;
	else
		$user_admin = false;

	if ($ally_ranks[$user['ally_rank_id']-1]['onlinestatus'] == 1 || $ally['ally_owner'] == $user['id'])
		$user_onlinestatus = true;
	else
		$user_onlinestatus = false;

	if (!$ally)
	{
		doquery("UPDATE {{table}} SET `ally_id`=0 WHERE `id`='{$user['id']}'", "users");
		message("La alianza no existe.", "¡Error!", 'alliance.php');
	}
// < ------------------------------------------------------------ SALIR DE LA ALIANZA ------------------------------------------------------------ >
	if ($mode == 'exit')
	{
		if ($ally['ally_owner'] == $user['id'])
		{
			message("El fundador no puede salir de la alianza.", "¡Error!","alliance.php",2);
		}

		if ($_GET['yes'] == 1)
		{
			doquery("UPDATE {{table}} SET `ally_id` = 0, `ally_name` = '', ally_rank_id = 0 WHERE `id`='{$user['id']}'", "users");
			$lang['Go_out_welldone'] = str_replace("%s", $ally_name, "Abandonaste la alianza %s con éxito.");
			$page = MessageForm($lang['Go_out_welldone'], "<br>", $PHP_SELF, "Continuar");
		}
		else
		{
			$lang['Want_go_out'] = str_replace("%s", $ally_name, "¿Realmente deseas salir de la alianza %s?");
			$page = MessageForm($lang['Want_go_out'], "<br>", "?mode=exit&yes=1", "Si");
		}
		display($page);
	}
// < ------------------------------------------------------------- LISTA DE MIEMBROS ------------------------------------------------------------- >
	if ($mode == 'memberslist')
	{
		if ($ally['ally_owner'] != $user['id'] && !$user_can_kick && $ally_ranks[$user['ally_rank_id']-1]['administrieren'] != 1 )
		{
			message("Acceso Denegado, no puedes ver la lista de miembros.", "¡Error!", "alliance.php",2);
		}

		if ($sort2)
		{
			$sort1 = intval($_GET['sort1']);
			$sort2 = intval($_GET['sort2']);

			if ($sort1 == 1) {
			$sort = " ORDER BY `username`";
			} elseif ($sort1 == 2) {
			$sort = " ORDER BY `ally_rank_id`";
			} elseif ($sort1 == 3) {
			$sort = " ORDER BY `total_points`";
			} elseif ($sort1 == 4) {
			$sort = " ORDER BY `ally_register_time`";
			} elseif ($sort1 == 5) {
			$sort = " ORDER BY `onlinetime`";
			} else {
			$sort = " ORDER BY `id`";
			}

			if ($sort2 == 1) {
			$sort .= " DESC;";
			} elseif ($sort2 == 2) {
			$sort .= " ASC;";
			}
			$listuser = doquery("SELECT * FROM {{table}} inner join `game_statpoints` on `game_users`.`id`=`game_statpoints`.`id_owner` WHERE ally_id='{$user['ally_id']}' AND STAT_type=1 $sort", 'users');
		}
		else
		{
			$listuser = doquery("SELECT * FROM {{table}} WHERE ally_id='{$user['ally_id']}'", 'users');
		}

		$i = 0;

		while ($u = mysql_fetch_array($listuser))
		{
			$UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $u['id'] . "';", 'statpoints', true);

			$i++;
			$u['i'] = $i;

			if ($u["onlinetime"] + 60 * 10 >= time() && $user_can_watch_memberlist_status)
			{
				$u["onlinetime"] = "\"lime\">Conectado<";
			}
			elseif ($u["onlinetime"] + 60 * 20 >= time() && $user_can_watch_memberlist_status)
			{
				$u["onlinetime"] = "\"yellow\">15 min<";
			}
			elseif ($user_can_watch_memberlist_status)
			{
				$u["onlinetime"] = "\"red\">Desconectado<";
			}
			else
			{
				$u["onlinetime"] = "\"orange\">-<";
			}

			if ($ally['ally_owner'] == $u['id'])
			{
				$u["ally_range"] = ($ally['ally_owner_range'] == '')?"Fundador":$ally['ally_owner_range'];
			}
			elseif ($u['ally_rank_id'] == 0 )
			{
				$u["ally_range"] = "Nuevo miembro";
			}
			else
			{
				$u["ally_range"] = $ally_ranks[$u['ally_rank_id']-1]['name'];
			}

			$u["dpath"] = $dpath;
			$u['points'] = "" . pretty_number($UserPoints['total_points']) . "";

			if ($u['ally_register_time'] > 0)
				$u['ally_register_time'] = date("Y-m-d h:i:s", $u['ally_register_time']);
			else
				$u['ally_register_time'] = "-";

			$page_list .= parsetemplate(gettemplate('alliance/alliance_memberslist_row'), $u);
		}

		if ($sort2 == 1) {$s = 2;}
		elseif ($sort2 == 2) {$s = 1;}
		else {$s = 1;}

		if ($i != $ally['ally_members'])
		{
			doquery("UPDATE {{table}} SET `ally_members`='{$i}' WHERE `id`='{$ally['id']}'", 'alliance');
		}

		$parse['i'] = $i;
		$parse['s'] = $s;
		$parse['list'] = $page_list;

		$page .= parsetemplate(gettemplate('alliance/alliance_memberslist_table'), $parse);

		display($page, "Lista de miembros");
	}
// < ------------------------------------------------------------- CORREO CIRCULAR ------------------------------------------------------------- >
	if ($mode == 'circular')
	{
		if ($ally['ally_owner'] != $user['id'] && !$user_can_send_mails)
		{
			message("Acceso Denegado, no puedes enviar un correo circular.", "¡Error!", "alliance.php",2);
		}

		if ($sendmail == 1)
		{
			$_POST['r'] 	= intval($_POST['r']);
			$_POST['text']  = mysql_escape_string(strip_tags($_POST['text']));

			if ($_POST['r'] == 0)
			{
				$sq = doquery("SELECT id,username FROM {{table}} WHERE ally_id='{$user['ally_id']}'", "users");
			}
			else
			{
				$sq = doquery("SELECT id,username FROM {{table}} WHERE ally_id='{$user['ally_id']}' AND ally_rank_id='{$_POST['r']}'", "users");
			}

			$list = '';

			while ($u = mysql_fetch_array($sq))
			{
				SendSimpleMessage($u['id'],$user['id'],'',2,$ally['ally_tag'],$user['username'],$_POST['text']);

				$list .= "<br>{$u['username']} ";
			}

			$page = MessageForm("Mensaje circular enviado", "Los siguiente(s) miembro(s) recibieron tu mensaje:" . $list, "alliance.php", "Continuar", true);

			display($page, "Mensaje circular");
		}

		$lang['r_list'] = "<option value=\"0\">Todos los jugadores</option>";

		if ($ally_ranks)
		{
			foreach($ally_ranks as $id => $array)
			{
				$lang['r_list'] .= "<option value=\"" . ($id + 1) . "\">" . $array['name'] . "</option>";
			}
		}

		$page .= parsetemplate(gettemplate('alliance/alliance_circular'), $lang);

		display($page, "Correo circular");
	}
// < ------------------------------------------------------ EDICION DE LOS PERMISOS O LEYES ------------------------------------------------------ >
	if ($mode == 'admin' && $edit == 'rights')
	{
		if ($ally['ally_owner'] != $user['id'] && !$user_can_edit_rights)
		{
			message("Acceso Denegado, no puedes editar los permisos o rangos.", "¡Error!", "alliance.php",2);
		}
		elseif (!empty($_POST['newrangname']))
		{
			$name = mysql_escape_string(strip_tags($_POST['newrangname']));

			$ally_ranks[] = array('name' => $name,
			'mails' => 0,
			'delete' => 0,
			'kick' => 0,
			'bewerbungen' => 0,
			'administrieren' => 0,
			'bewerbungenbearbeiten' => 0,
			'memberlist' => 0,
			'onlinestatus' => 0,
			'rechtehand' => 0
			);

			$ranks = serialize($ally_ranks);

			doquery("UPDATE {{table}} SET `ally_ranks`='" . $ranks . "' WHERE `id`=" . $ally['id'], "alliance");

			$goto = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];

			header("Location: " . $goto);
			exit();
		}
		elseif ($_POST['id'] != '' && is_array($_POST['id']))
		{
			$ally_ranks_new = array();

			foreach ($_POST['id'] as $id)
			{
				$name = $ally_ranks[$id]['name'];

				$ally_ranks_new[$id]['name'] = $name;

				if (isset($_POST['u' . $id . 'r0'])) {
				$ally_ranks_new[$id]['delete'] = 1;
				} else {
				$ally_ranks_new[$id]['delete'] = 0;
				}

				if (isset($_POST['u' . $id . 'r1']) && $ally['ally_owner'] == $user['id']) {
				$ally_ranks_new[$id]['kick'] = 1;
				} else {
				$ally_ranks_new[$id]['kick'] = 0;
				}

				if (isset($_POST['u' . $id . 'r2'])) {
				$ally_ranks_new[$id]['bewerbungen'] = 1;
				} else {
				$ally_ranks_new[$id]['bewerbungen'] = 0;
				}

				if (isset($_POST['u' . $id . 'r3'])) {
				$ally_ranks_new[$id]['memberlist'] = 1;
				} else {
				$ally_ranks_new[$id]['memberlist'] = 0;
				}

				if (isset($_POST['u' . $id . 'r4'])) {
				$ally_ranks_new[$id]['bewerbungenbearbeiten'] = 1;
				} else {
				$ally_ranks_new[$id]['bewerbungenbearbeiten'] = 0;
				}

				if (isset($_POST['u' . $id . 'r5'])) {
				$ally_ranks_new[$id]['administrieren'] = 1;
				} else {
				$ally_ranks_new[$id]['administrieren'] = 0;
				}

				if (isset($_POST['u' . $id . 'r6'])) {
				$ally_ranks_new[$id]['onlinestatus'] = 1;
				} else {
				$ally_ranks_new[$id]['onlinestatus'] = 0;
				}

				if (isset($_POST['u' . $id . 'r7'])) {
				$ally_ranks_new[$id]['mails'] = 1;
				} else {
				$ally_ranks_new[$id]['mails'] = 0;
				}

				if (isset($_POST['u' . $id . 'r8'])) {
				$ally_ranks_new[$id]['rechtehand'] = 1;
				} else {
				$ally_ranks_new[$id]['rechtehand'] = 0;
				}
			}

			$ranks = serialize($ally_ranks_new);

			doquery("UPDATE {{table}} SET `ally_ranks`='" . $ranks . "' WHERE `id`=" . $ally['id'], "alliance");

			$goto = $_SERVER['PHP_SELF'] . "?" . $_SERVER['QUERY_STRING'];

			header("Location: " . $goto);
			exit();

		}
		elseif(isset($d) && isset($ally_ranks[$d]))
		{
			unset($ally_ranks[$d]);

			$ally['ally_rank'] = serialize($ally_ranks);

			doquery("UPDATE {{table}} SET `ally_ranks`='{$ally['ally_rank']}' WHERE `id`={$ally['id']}", "alliance");
		}

		if (count($ally_ranks) == 0 || $ally_ranks == '')
		{
			$list = "<th>No se definieron rangos.</th>";
		}
		else
		{
			$list = parsetemplate(gettemplate('alliance/alliance_admin_laws_head'), $lang);
			$i = 0;
			foreach($ally_ranks as $a => $b)
			{
				if ($ally['ally_owner'] == $user['id'])
				{
					$lang['id'] = $a;
					$lang['delete'] = "<a href=\"alliance.php?mode=admin&edit=rights&d={$a}\"><img src=\"{$dpath}pic/abort.gif\" title=\"Borrar rango\" border=\"0\"></a>";
					$lang['r0'] = $b['name'];
					$lang['a'] = $a;
					$lang['r1'] = "<input type=checkbox name=\"u{$a}r0\"" . (($b['delete'] == 1)?' checked="checked"':'') . ">"; //{$b[1]}
					$lang['r2'] = "<input type=checkbox name=\"u{$a}r1\"" . (($b['kick'] == 1)?' checked="checked"':'') . ">";
					$lang['r3'] = "<input type=checkbox name=\"u{$a}r2\"" . (($b['bewerbungen'] == 1)?' checked="checked"':'') . ">";
					$lang['r4'] = "<input type=checkbox name=\"u{$a}r3\"" . (($b['memberlist'] == 1)?' checked="checked"':'') . ">";
					$lang['r5'] = "<input type=checkbox name=\"u{$a}r4\"" . (($b['bewerbungenbearbeiten'] == 1)?' checked="checked"':'') . ">";
					$lang['r6'] = "<input type=checkbox name=\"u{$a}r5\"" . (($b['administrieren'] == 1)?' checked="checked"':'') . ">";
					$lang['r7'] = "<input type=checkbox name=\"u{$a}r6\"" . (($b['onlinestatus'] == 1)?' checked="checked"':'') . ">";
					$lang['r8'] = "<input type=checkbox name=\"u{$a}r7\"" . (($b['mails'] == 1)?' checked="checked"':'') . ">";
					$lang['r9'] = "<input type=checkbox name=\"u{$a}r8\"" . (($b['rechtehand'] == 1)?' checked="checked"':'') . ">";

					$list .= parsetemplate(gettemplate('alliance/alliance_admin_laws_row'), $lang);
				}
				else
				{
					$lang['id'] = $a;
					$lang['r0'] = $b['name'];
					$lang['delete'] = "<a href=\"alliance.php?mode=admin&edit=rights&d={$a}\"><img src=\"{$dpath}pic/abort.gif\" alt=\"{$lang['Delete_range']}\" border=0></a>";
					$lang['a'] = $a;
					$lang['r1'] = "<b>-</b>";
					$lang['r2'] = "<input type=checkbox name=\"u{$a}r1\"" . (($b['kick'] == 1)?' checked="checked"':'') . ">";
					$lang['r3'] = "<input type=checkbox name=\"u{$a}r2\"" . (($b['bewerbungen'] == 1)?' checked="checked"':'') . ">";
					$lang['r4'] = "<input type=checkbox name=\"u{$a}r3\"" . (($b['memberlist'] == 1)?' checked="checked"':'') . ">";
					$lang['r5'] = "<input type=checkbox name=\"u{$a}r4\"" . (($b['bewerbungenbearbeiten'] == 1)?' checked="checked"':'') . ">";
					$lang['r6'] = "<input type=checkbox name=\"u{$a}r5\"" . (($b['administrieren'] == 1)?' checked="checked"':'') . ">";
					$lang['r7'] = "<input type=checkbox name=\"u{$a}r6\"" . (($b['onlinestatus'] == 1)?' checked="checked"':'') . ">";
					$lang['r8'] = "<input type=checkbox name=\"u{$a}r7\"" . (($b['mails'] == 1)?' checked="checked"':'') . ">";
					$lang['r9'] = "<input type=checkbox name=\"u{$a}r8\"" . (($b['rechtehand'] == 1)?' checked="checked"':'') . ">";

					$list .= parsetemplate(gettemplate('alliance/alliance_admin_laws_row'), $lang);
				}
			}

			if (count($ally_ranks) != 0)
			{
				$list .= parsetemplate(gettemplate('alliance/alliance_admin_laws_feet'), $lang);
			}
		}

		$lang['list'] 	= $list;
		$lang['dpath'] 	= $dpath;
		display(parsetemplate(gettemplate('alliance/alliance_admin_laws'), $lang), "Alianza - Administrar permisos");
	}
// < ----------------------------------------------------- EDICIONES GENERALES DE LA ALIANZA ----------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'ally')
	{
		if ($t != 1 && $t != 2 && $t != 3)
		{
			$t = 1;
		}

		if ($_POST)
		{
			if (!get_magic_quotes_gpc())
			{
				$_POST['owner_range'] = stripslashes($_POST['owner_range']);
				$_POST['web'] = stripslashes($_POST['web']);
				$_POST['image'] = stripslashes($_POST['image']);
				$_POST['text'] = stripslashes($_POST['text']);
			}
		}

		if ($_POST['options'])
		{
			$ally['ally_owner_range'] 		= mysql_escape_string(htmlspecialchars(strip_tags($_POST['owner_range'])));

			$ally['ally_web'] 				= mysql_escape_string(htmlspecialchars(strip_tags($_POST['web'])));

			$ally['ally_image'] 			= mysql_escape_string(htmlspecialchars(strip_tags($_POST['image'])));

			$ally['ally_request_notallow'] 	= intval($_POST['request_notallow']);

			if ($ally['ally_request_notallow'] != 0 && $ally['ally_request_notallow'] != 1)
			{
				message("Debés seleccionar una opción válida para las solicitudes.", "¡Error!","alliance.php",2);
				exit;
			}

			doquery("UPDATE {{table}} SET
			`ally_owner_range`='{$ally['ally_owner_range']}',
			`ally_image`='{$ally['ally_image']}',
			`ally_web`='{$ally['ally_web']}',
			`ally_request_notallow`='{$ally['ally_request_notallow']}'
			WHERE `id`='{$ally['id']}'", "alliance");
		}
		elseif ($_POST['t'])
		{
			if ($t == 3)
			{

				$ally['ally_request'] = mysql_escape_string(strip_tags($_POST['text']));
				doquery("UPDATE {{table}} SET
				`ally_request`='{$ally['ally_request']}'
				WHERE `id`='{$ally['id']}'", "alliance");
			}
			elseif ($t == 2)
			{
				$ally['ally_text'] = mysql_escape_string(strip_tags($_POST['text']));
				doquery("UPDATE {{table}} SET
				`ally_text`='{$ally['ally_text']}'
				WHERE `id`='{$ally['id']}'", "alliance");
			}
			else
			{
				$ally['ally_description'] = mysql_escape_string(strip_tags($_POST['text']));

				doquery("UPDATE {{table}} SET
				`ally_description`='" . $ally['ally_description'] . "'
				WHERE `id`='{$ally['id']}'", "alliance");
			}
		}

		$lang['dpath'] = $dpath;

		if ($t == 3) {
		$lang['request_type'] = "Texto de la solicitud";
		} elseif ($t == 2) {
		$lang['request_type'] = "Texto interno";
		} else {
		$lang['request_type'] = "Texto externo";
		}

		if ($t == 2)
		{
			$lang['text'] = $ally['ally_text'];
		}
		else
		{
			$lang['text'] = $ally['ally_description'];
		}

		if ($t == 3)
		{
			$lang['text'] = $ally['ally_request'];
		}

		$lang['t'] = $t;

		$lang['ally_web'] 					= $ally['ally_web'];
		$lang['ally_image'] 				= $ally['ally_image'];
		$lang['ally_request_notallow_0'] 	= (($ally['ally_request_notallow'] == 1) ? ' SELECTED' : '');
		$lang['ally_request_notallow_1'] 	= (($ally['ally_request_notallow'] == 0) ? ' SELECTED' : '');
		$lang['ally_owner_range'] 			= $ally['ally_owner_range'];
		$lang['Transfer_alliance'] 			= MessageForm("Transferir alianza", "", "?mode=admin&edit=transfer", "Continuar");
		$lang['Disolve_alliance'] 			= MessageForm("Disolver alianza", "", "?mode=admin&edit=exit", "Continuar");

		$page .= parsetemplate(gettemplate('alliance/alliance_admin'), $lang);
		display($page, "Alianza - Administración general");
	}
// < -------------------------------------------------------- EDICION DE LOS MIEMBROS -------------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'members')
	{
		if ($ally['ally_owner'] != $user['id'] && $user_admin == false)
		{
			message("Acceso Denegado, no puedes editar a los miembros.", "¡Error!", "alliance.php",2);
		}

		if (isset($kick))
		{
			if ($ally['ally_owner'] != $user['id'] && !$user_can_kick)
			{
				message("Acceso Denegado, no puedes editar a los miembros.", "¡Error!", "alliance.php",2);
			}

			$u = doquery("SELECT * FROM {{table}} WHERE id='{$kick}' LIMIT 1", 'users', true);

			if ($u['ally_id'] == $ally['id'] && $u['id'] != $ally['ally_owner'])
			{
				doquery("UPDATE {{table}} SET `ally_id`='0', `ally_name`='', `ally_rank_id` = 0 WHERE `id`='{$u['id']}' LIMIT 1;", 'users');
			}
			}
			elseif (isset($_POST['newrang']))
			{
				$q = doquery("SELECT * FROM {{table}} WHERE id='{$u}' LIMIT 1", 'users', true);

				if ((isset($ally_ranks[$_POST['newrang']-1]) || $_POST['newrang'] == 0) && $q['id'] != $ally['ally_owner'])
				{
					doquery("UPDATE {{table}} SET `ally_rank_id`='" . mysql_escape_string(strip_tags($_POST['newrang'])) . "' WHERE `id`='" . intval($id) . "'", 'users');
				}
			}

		if ($sort2)
		{
			$sort1 = intval($_GET['sort1']);
			$sort2 = intval($_GET['sort2']);

			if ($sort1 == 1) {
			$sort = " ORDER BY `username`";
			} elseif ($sort1 == 2) {
			$sort = " ORDER BY `ally_rank_id`";
			} elseif ($sort1 == 3) {
			$sort = " ORDER BY `total_points`";
			} elseif ($sort1 == 4) {
			$sort = " ORDER BY `ally_register_time`";
			} elseif ($sort1 == 5) {
			$sort = " ORDER BY `onlinetime`";
			} else {
			$sort = " ORDER BY `id`";
			}

			if ($sort2 == 1) {
			$sort .= " DESC;";
			} elseif ($sort2 == 2) {
			$sort .= " ASC;";
			}
			$listuser = doquery("SELECT * FROM {{table}} inner join `game_statpoints` on `game_users`.`id`=`game_statpoints`.`id_owner` WHERE ally_id='{$user['ally_id']}' AND STAT_type=1 $sort", 'users');
		}
		else
		{
			$listuser = doquery("SELECT * FROM {{table}} WHERE ally_id='{$user['ally_id']}'", 'users');
		}

		$i = 0;

		$lang['i'] = mysql_num_rows($listuser);

		while ($u = mysql_fetch_array($listuser))
		{
			$UserPoints = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '" . $u['id'] . "';", 'statpoints', true);

			$i++;
			$u['i'] = $i;

			$u['points'] = "" . pretty_number($UserPoints['total_points']) . "";

			$days = floor(round(time() - $u["onlinetime"]) / 3600 % 24);

			$u["onlinetime"] = str_replace("%s", $days, "%s d");

			if ($ally['ally_owner'] == $u['id'])
			{
				$ally_range = ($ally['ally_owner_range'] == '')?"Fundador":$ally['ally_owner_range'];
			}
			elseif ($u['ally_rank_id'] == 0 || !isset($ally_ranks[$u['ally_rank_id']-1]['name']))
			{
				$ally_range = "Nuevo miembro";
			}
			else
			{
				$ally_range = $ally_ranks[$u['ally_rank_id']-1]['name'];
			}

			if ($ally['ally_owner'] == $u['id'] || $rank == $u['id'])
			{
				$u["acciones"] = '-';
			}
			elseif ($ally_ranks[$user['ally_rank_id']-1]['kick'] == 1  &&  $ally_ranks[$user['ally_rank_id']-1]['administrieren'] == 1 || $ally['ally_owner'] == $user['id'])
			{
				$u["acciones"] = "<a href=\"alliance.php?mode=admin&edit=members&kick=$u[id]\" onclick=\"javascript:return confirm('¿Estás seguro que deseas expulsar a $u[username]?');\"><img src=\"".$dpath."pic/abort.gif\" border=\"0\"></a> <a href=\"alliance.php?mode=admin&edit=members&rank=$u[id]\"><img src=\"".$dpath."pic/key.gif\" border=\"0\"></a>";
			}
			elseif ($ally_ranks[$user['ally_rank_id']-1]['administrieren'] == 1 )
			{
				$u["acciones"] = "<a href=\"alliance.php?mode=admin&edit=members&kick=$u[id]\" onclick=\"javascript:return confirm('¿Estás seguro que deseas expulsar a $u[username]?');\"><img src=\"".$dpath."pic/abort.gif\" border=\"0\"></a> <a href=\"alliance.php?mode=admin&edit=members&rank=$u[id]\"><img src=\"".$dpath."pic/key.gif\" border=\"0\"></a>";
			}
			else
			{
				$u["acciones"] = '-';
			}

			$u["dpath"] = $dpath;

			$u['ally_register_time'] = date("Y-m-d h:i:s", $u['ally_register_time']);

			if ($rank == $u['id'])
			{
				$r['Rank_for'] = str_replace("%s", $u['username'], $lang['Rank_for']);
				$r['options'] .= "<option onclick=\"document.editar_usu_rango.submit();\" value=\"0\">Nuevo miembro</option>";

				foreach($ally_ranks as $a => $b)
				{
					$r['options'] .= "<option onclick=\"document.editar_usu_rango.submit();\" value=\"" . ($a + 1) . "\"";

					if ($u['ally_rank_id']-1 == $a)
					{
						$r['options'] .= ' selected=selected';
					}

					$r['options'] .= ">{$b['name']}</option>";
				}
				$r['id'] = $u['id'];

				$editar_miembros = parsetemplate(gettemplate('alliance/alliance_admin_members_row_edit'), $r);
			}

			if ($rank != $u['id'])
			{
				$u['ally_range'] = $ally_range;
			}
			else
			{
				$u['ally_range'] = $editar_miembros;
			}

			$page_list .= parsetemplate(gettemplate('alliance/alliance_admin_members_row'), $u);

		}
		if ($sort2 == 1) {$s = 2;}
		elseif ($sort2 == 2) {$s = 1;}
		else {$s = 1;}

		if ($i != $ally['ally_members'])
		{
			doquery("UPDATE {{table}} SET `ally_members`='{$i}' WHERE `id`='{$ally['id']}'", 'alliance');
		}

		$lang['memberslist'] = $page_list;
		$lang['s'] = $s;
		$page .= parsetemplate(gettemplate('alliance/alliance_admin_members_table'), $lang);

		display($page, "Alianza - Administrar miembros");
	}

// < -------------------------------------------------------- EDICION DE LAS SOLICITUDES -------------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'requests')
	{
		if ($ally['ally_owner'] != $user['id'] && !$user_bewerbungen_bearbeiten)
		{
			message("Acceso Denegado, no puedes ver ni editar las solicitudes.", "¡Error!", "alliance.php",2);
		}

		if ($_POST['action'] == "Aceptar")
		{
			$_POST['text'] = mysql_escape_string(strip_tags($_POST['text']));

			doquery("UPDATE {{table}} SET ally_members = ally_members+1 WHERE id='{$ally['id']}'", 'alliance');

			doquery("UPDATE {{table}} SET
			ally_name='{$ally['ally_name']}',
			ally_request_text='',
			ally_request='0',
			ally_id='{$ally['id']}'
			WHERE id='{$show}'", 'users');

			SendSimpleMessage($show,$user['id'],'', 2,$ally['ally_tag'],"Fuiste aceptado en ".$ally['ally_name'], "¡Hola!<br>La alianza <b>" . $ally['ally_name'] . "</b> a aceptado tu solicitud.<br>Mensaje del fundador: <br>".$_POST['text']."");
		}
		elseif($_POST['action'] == "Rechazar" && $_POST['action'] != '')
		{
			$_POST['text'] = mysql_escape_string(strip_tags($_POST['text']));

			doquery("UPDATE {{table}} SET ally_request_text='',ally_request='0',ally_id='0' WHERE id='{$show}'", 'users');

			SendSimpleMessage($show,$user['id'],'', 2,$ally['ally_tag'],"Fuiste rechazado en ".$ally['ally_name'], "¡Hola!<br>La alianza <b>" . $ally['ally_name'] . "</b> a rechazado tu solicitud.<br>Mensaje del fundador: <br>".$_POST['text']."");

			header('Location:alliance.php?mode=admin&edit=requests');
			die();
		}

		$i = 0;

		$query = doquery("SELECT id,username,ally_request_text,ally_register_time FROM {{table}} WHERE ally_request='{$ally['id']}'", 'users');

		while ($r = mysql_fetch_array($query))
		{

			if (isset($show) && $r['id'] == $show)
			{
				$s['username'] = $r['username'];
				$s['ally_request_text'] = nl2br($r['ally_request_text']);
				$s['id'] = $r['id'];
			}

			$r['time'] = date("Y-m-d h:i:s", $r['ally_register_time']);
			$parse['list'] .= parsetemplate(gettemplate('alliance/alliance_admin_request_row'), $r);
			$i++;
		}

		if ($parse['list'] == '')
		{
			$parse['list'] = '<tr><th colspan=2>No hay solicitudes</th></tr>';
		}

		if (isset($show) && $show != 0 && $parse['list'] != '')
		{

			$s['Request_from'] = str_replace('%s', $s['username'], "Solicitud de %s");

			$parse['request'] = parsetemplate(gettemplate('alliance/alliance_admin_request_form'), $s);
			$parse['request'] = parsetemplate($parse['request'], $lang);
		}
		else
		{
			$parse['request'] = '';
		}

		$parse['ally_tag'] = $ally['ally_tag'];
		$parse['Back'] = $lang['Back'];

		$parse['There_is_hanging_request'] = str_replace('%n', $i, "Hay %n solicitud/es pendiente/s");

		$page = parsetemplate(gettemplate('alliance/alliance_admin_request_table'), $parse);
		display($page, "Alianza - Revisar solicitudes");
	}
// < -------------------------------------------------------- CAMBIAR NOMBRE DE LA ALIANZA -------------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'name')
	{
		if ($ally['ally_owner'] != $user['id'] && !$user_admin)
		{
			message("Acceso Denegado, no puedes cambiar el nombre de la alianza.", "¡Error!", "alliance.php",2);
		}
		if ($_POST['nombre'] && !empty($_POST['nombre']))
		{
			$ally['ally_name'] = mysql_escape_string(strip_tags($_POST['nombre']));
			doquery("UPDATE {{table}} SET `ally_name` = '". $ally['ally_name'] ."' WHERE `id` = '". $user['ally_id'] ."';", 'alliance');
			doquery("UPDATE {{table}} SET `ally_name` = '". $ally['ally_name'] ."' WHERE `ally_id` = '". $ally['id'] ."';", 'users');
		}

		$parse[caso] 		= "nombre";
		$parse[caso_titulo]	= "Nuevo nombre";
		$page = parsetemplate(gettemplate('alliance/alliance_admin_rename'), $parse);
		display($page, "Alianza - Cambiar nombre de la alianza");
	}
// < ------------------------------------------------------- CAMBIAR ETIQUETA DE LA ALIANZA ------------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'tag')
	{
		if ($ally['ally_owner'] != $user['id'] && !$user_admin)
		{
			message("Acceso Denegado, no puedes cambiar la etiqueta de la alianza.", "¡Error!", "alliance.php",2);
		}
		if ($_POST['etiqueta'] && !empty($_POST['etiqueta']))
		{
			$ally['ally_tag'] = mysql_escape_string(strip_tags($_POST['etiqueta']));
			doquery("UPDATE {{table}} SET `ally_tag` = '". $ally['ally_tag'] ."' WHERE `id` = '". $user['ally_id'] ."';", 'alliance');
		}

		$parse[caso] 		= "etiqueta";
		$parse[caso_titulo]	= "Nueva etiqueta";

		$page .= parsetemplate(gettemplate('alliance/alliance_admin_rename'), $parse);
		display($page, "Alianza - Cambiar etiqueta de la alianza");
	}
// < ------------------------------------------------------------- SALIR DE LA ALIANZA ------------------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'exit')
	{

		if ($ally['ally_owner'] != $user['id'] && !$user_can_exit_alliance)
		{
			message("Acceso Denegado, no puedes disolver la alianza.", "¡Error!", "alliance.php",2);
		}

		$BorrarAlianza = doquery("SELECT id FROM {{table}} WHERE `ally_id`='{$ally['id']}'",'users');

		while ($v = mysql_fetch_array($BorrarAlianza))
		{
			doquery("UPDATE {{table}} SET `ally_name` = '', `ally_id`='0' WHERE `id`='{$v['id']}'", 'users');
		}

		doquery("DELETE FROM {{table}} WHERE id='{$ally['id']}' LIMIT 1", "alliance");

		header('Location: alliance.php');

		exit;
	}
// < ----------------------------------------------------------- TRANSFERIR LA ALIANZA ----------------------------------------------------------- >
	if ($mode == 'admin' && $edit == 'transfer')
	{

		if (isset($_POST['newleader']))
		{
			doquery("UPDATE {{table}} SET `ally_rank_id`='0' WHERE `id`={$user['id']} ", 'users');
			doquery("UPDATE {{table}} SET `ally_owner`='" . mysql_escape_string(strip_tags($_POST['newleader'])) . "' WHERE `id`={$user['ally_id']} ", 'alliance');
			doquery("UPDATE {{table}} SET `ally_rank_id`='0' WHERE `id`='" . mysql_escape_string(strip_tags($_POST['newleader'])) . "' ", 'users');
			header('Location: alliance.php');
			exit;
		}
		if ($ally['ally_owner'] != $user['id'])
		{
			message("Acceso Denegado, no puedes transferir la alianza.", "¡Error!", "alliance.php",2);
		}
		else
		{
			$listuser = doquery("SELECT * FROM {{table}} WHERE ally_id='{$user['ally_id']}'", 'users');

			while ($u = mysql_fetch_array($listuser))
			{
				if ($ally['ally_owner'] != $u['id'])
				{
					if ($u['ally_rank_id'] != 0 )
					{
						if ($ally_ranks[$u['ally_rank_id']-1]['rechtehand'] == 1)
						{
							$righthand['righthand'] .= "\n<option value=\"" . $u['id'] . "\"";
							$righthand['righthand'] .= ">";
							$righthand['righthand'] .= "".$u['username'];
							$righthand['righthand'] .= "&nbsp;[".$ally_ranks[$u['ally_rank_id']-1]['name'];
							$righthand['righthand'] .= "]&nbsp;&nbsp;</option>";
						}
					}
				}
				$righthand["dpath"] = $dpath;
			}

			$page_list .= parsetemplate(gettemplate('alliance/alliance_admin_transfer_row'), $righthand);;
			$parse['s'] = $s;
			$parse['list'] = $page_list;

			$page .= parsetemplate(gettemplate('alliance/alliance_admin_transfer'), $parse);

			display($page, "Alianza - Transferir alianza");
		}
	}
// < -------------------------------------------------------- PARTE DEFAULT DE LA ALIANZA -------------------------------------------------------- >
	{
		// IMAGEN
		if ($ally['ally_ranks'] != '')
		{
			$ally['ally_ranks'] = "<tr><td colspan=2><img src=\"{$ally['ally_image']}\"></td></tr>";
		}
		//RANGOS
		if ($ally['ally_owner'] == $user['id'])
		{
			$range = ($ally['ally_owner_range'] != '')?"Fundador":$ally['ally_owner_range'];
		}
		elseif ($user['ally_rank_id'] != 0 && isset($ally_ranks[$user['ally_rank_id']-1]['name']))
		{
			$range = $ally_ranks[$user['ally_rank_id']-1]['name'];
		}
		else
		{
			$range = "Nuevo miembro";
		}
		// LISTA DE MIEMBROS
		if ($ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['memberlist'] != 0)
		{
			$lang['members_list'] = " (<a href=\"?mode=memberslist\">Lista de miembros</a>)";
		}
		else
		{
			$lang['members_list'] = '';
		}
		// ADMINISTRAR ALIANZA
		if ($ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['administrieren'] != 0)
		{
			$lang['alliance_admin'] = " (<a href=\"?mode=admin&edit=ally\">Administrar la alianza</a>)";
		}
		else
		{
			$lang['alliance_admin'] = '';
		}
		// CORREO CIRCULAR
		if ($ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['mails'] != 0)
		{
			$lang['send_circular_mail'] = "<tr><th>Correo circular</th><th><a href=\"?mode=circular\">Enviar correo circular</a></th></tr>";
		}
		else
		{
			$lang['send_circular_mail'] = '';
		}
		// SOLICITUDES
		$request_count = mysql_num_rows(doquery("SELECT id FROM {{table}} WHERE ally_request='{$ally['id']}'", 'users'));

		if ($request_count != 0)
		{
			if ($ally['ally_owner'] == $user['id'] || $ally_ranks[$user['ally_rank_id']-1]['bewerbungen'] != 0)
				$lang['requests'] = "<tr><th>Solicitudes</th><th><a href=\"alliance.php?mode=admin&edit=requests\">{$request_count} solicitud/es nueva/s</a></th></tr>";
		}
		// SALIR DE LA ALIANZA
		if ($ally['ally_owner'] != $user['id'])
		{
			$lang['ally_owner'] .= MessageForm("Abandonar la alianza", "", "?mode=exit", "Continuar");
		}
		else
		{
			$lang['ally_owner'] .= '';
		}
		// IMAGEN DEL LOGOTIPO
		$lang['ally_image'] = ($ally['ally_image'] != '')?"<tr><th colspan=2><img src=\"{$ally['ally_image']}\"></td></tr>":'';

		$lang['range'] = $range;

		$patterns[] 	= "#\[fc\]([a-z0-9\#]+)\[/fc\](.*?)\[/f\]#Ssi";
		$replacements[] = '<font color="\1">\2</font>';
		$patterns[] 	= '#\[img\](.*?)\[/img\]#Smi';
		$replacements[] = '<img src="\1" alt="\1" style="border:0px;" />';
		$patterns[] 	= "#\[fc\]([a-z0-9\#\ \[\]]+)\[/fc\]#Ssi";
		$replacements[] = '<font color="\1">';
		$patterns[] 	= "#\[/f\]#Ssi";
		$replacements[] = '</font>';

		$ally['ally_description'] = preg_replace($patterns, $replacements, $ally['ally_description']);
		$lang['ally_description'] = nl2br($ally['ally_description']);

		$ally['ally_text'] = preg_replace($patterns, $replacements, $ally['ally_text']);
		$lang['ally_text'] = nl2br($ally['ally_text']);

		if($ally['ally_web'] != '')
			$lang['ally_web'] 		= $ally['ally_web'];
		else
			$lang['ally_web']		= "-";

		$lang['ally_tag'] 		= $ally['ally_tag'];
		$lang['ally_members'] 	= $ally['ally_members'];
		$lang['ally_name'] 		= $ally['ally_name'];

		$page .= parsetemplate(gettemplate('alliance/alliance_frontpage'), $lang);
		display($page, "Alianza - Tu alianza");
	}
}
?>