<?php
/**
* buddy.php
*
* @version 1.1
* @copyright 2008 by BenjaminV for XNova
*/

define('INSIDE' , true );
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);

includeLang('buddy');
foreach($_GET as $name => $value){
$$name = intval( $value );
}
switch($mode){
case 1:
switch($sm){
case 1:
doquery("DELETE FROM {{table}} WHERE `id`='{$bid}'","buddy");
message( "La solicitud fue cancelada", $lang['Buddy_request'], 'buddy.php' );
break;

case 2:
doquery("UPDATE {{table}} SET `active` = '1' WHERE `id` ='{$bid}'","buddy");
message( "La solicitud fue aceptada!", $lang['Buddy_request'], 'buddy.php' );
break;

case 3:
$test=doquery("SELECT `id` FROM {{table}} WHERE `sender`='{$user[id]}' AND `owner`='{$_POST}' OR `owner`='{$user[id]}' AND `sender`='{$_POST[u]}'","buddy",true);
if($test==array()){
$text=mysql_escape_string( strip_tags( $_POST['text'] ) );
doquery("INSERT INTO {{table}} SET `sender`='{$user[id]}' ,`owner`='{$_POST[u]}' ,`active`='0' ,`text`='{$text}'","buddy");
message( $lang['Request_sent'], $lang['Buddy_request'], 'buddy.php' );}
else{
message( "&#161;Ya existe una solicitud a ese jugador!", $lang['Buddy_request'], 'buddy.php' );
}
break;
}
break;
case 2:
if($u==$user['id']){
message('&#161;No puedes solicitarte como compa&#241;ero a ti mismo!','Error','buddy.php');
}
else{
$player=doquery("SELECT `username` FROM {{table}} WHERE `id`='{$u}'","users",true);
$page="<script src=scripts/cntchar.js type=text/javascript></script>
<script src=scripts/win.js type=text/javascript></script>
<center>
<form action=buddy.php?mode=1&sm=3 method=post>
<input type=hidden name=u value={$u}>
<table width=520>
<tr><td class=c colspan=2>Mensaje de solicitud</td></tr>
<tr><th>Jugador</th><th>{$player[username]}</th></tr>
<tr><th>Texto de solicitud (<span id=cntChars>0</span> / 5000 caracteres)</th><th><textarea name=text cols=60 rows=10 onKeyUp=javascript:cntchar(5000)></textarea></th></tr>
<tr><td class=c><a href=javascript:back();>Enviar Mensaje</a></td><td class=c><input type=submit value='Enviar'></td></tr>
</table></form>";
display ( $page, 'buddy', false );
}
break;
default:
$liste=doquery("SELECT * FROM {{table}} WHERE `sender`='{$user[id]}' OR `owner`='{$user[id]}'","buddy");
while($buddy=mysql_fetch_assoc($liste)){
if($buddy['active']==0){
if($buddy['sender']==$user['id']){
$owner=doquery("SELECT `id`, `username`, `galaxy`, `system`, `planet`,`ally_id`, `ally_name` FROM {{table}} WHERE `id`='{$buddy[owner]}'","users",true);
$myrequest.="<tr><th><a href=messages.php?mode=write&id={$owner[id]}>{$owner[username]}</a></th>
<th><a href=alliance.php?mode=ainfo&a={$owner[ally_id]}>{$owner[ally_name]}</a></th>
<th><a href=galaxy.php?mode=3&galaxy={$owner[galaxy]}&system={$owner[system]}>{$owner[galaxy]}:{$owner[system]}:{$owner[planet]}</a></th>
<th>{$buddy[text]}</th>
<th><a href=buddy.php?mode=1&sm=1&bid={$buddy[id]}>Cancelar Solicitud</a></th></tr>";
}
else{
$sender=doquery("SELECT `id`, `username`, `galaxy`, `system`, `planet`,`ally_id`, `ally_name` FROM {{table}} WHERE `id`='{$buddy[sender]}'","users",true);
$outrequest.="<tr><th><a href=messages.php?mode=write&id={$sender[id]}>{$sender[username]}</a></th>
<th><a href=alliance.php?mode=ainfo&a={$sender[ally_id]}>{$sender[ally_name]}</a></th>
<th><a href=galaxy.php?mode=3&galaxy={$sender[galaxy]}&system={$sender[system]}>{$sender[galaxy]}:{$sender[system]}:{$sender[planet]}</a></th>
<th>{$buddy[text]}</th>
<th><a href=buddy.php?mode=1&sm=2&bid={$buddy[id]}>Aceptar</a><br><a href=buddy.php?mode=1&sm=1&bid={$buddy[id]}>Rechazar </a></th></tr>";
}
}
else{
$owner=doquery("SELECT `id`, `username`, `galaxy`, `system`, `planet`,`ally_id`, `ally_name` FROM {{table}} WHERE `id`='{$buddy[owner]}' OR `id`='{$buddy[sender]}'","users",true);
$myfriends.="<tr><th><a href=messages.php?mode=write&id={$owner[id]}>{$owner[username]}</a></th>
<th><a href=alliance.php?mode=ainfo&a={$owner[ally_id]}>{$owner[ally_name]}</a></th>
<th><a href=galaxy.php?mode=3&galaxy={$owner[galaxy]}&system={$owner[system]}>{$owner[galaxy]}:{$owner[system]}:{$owner[planet]}</a></th>
<th><font color=".(( $u["onlinetime"] + 60 * 10 >= time() )?"lime>{$lang['On']}":(( $u["onlinetime"] + 60 * 20 >= time() )?"yellow>{$lang['15_min']}":"red>{$lang['Off']}"))."</font></th>
<th><a href=buddy.php?mode=1&sm=1&bid={$buddy[id]}>Eliminar</a></th></tr>";
}
}
$myfriends=($myfriends!='')?$myfriends:'<th colspan=6></th>';
$nor='<th colspan=6></th>';
$outrequest=($outrequest!='')?$outrequest:$nor;
$myrequest=($myrequest!='')?$myrequest:$nor;
$page="<table width=520>
<tr><td class=c colspan=6>Lista de compa�eros</td></tr>
<tr><td class=c colspan=6><center>Solicitudes</a></td></tr>
<tr><td class=c>Jugador</td>
<td class=c>Alianza</td>
<td class=c>Coordenadas</td>
<td class=c>Texto</td>
<td class=c>Acci�n</td>
</tr>
<tr>{$outrequest}</tr>
<tr><td class=c colspan=6><center>Mis solicitudes</a></td></tr>
<tr><td class=c>Jugador</td>
<td class=c>Alianza</td>
<td class=c>Coordenadas</td>
<td class=c>Texto</td>
<td class=c>Acci�n</td>
</tr>
<tr>{$myrequest}</tr>
<tr><td class=c colspan=6><center>Compa�eros</a></td></tr>
<tr><td class=c>Jugador</td>
<td class=c>Alianza</td>
<td class=c>Coordenadas</td>
<td class=c>Estado</td>
<td class=c>Acci�n</td>
</tr>
<tr>{$myfriends}</tr>
</table>";
display ( $page, $lang['Buddy_list'], false );
break;
}
?>