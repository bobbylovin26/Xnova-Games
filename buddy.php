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
foreach($_GET as $name => $value){//routine de récupération des informations
$$name = intval( $value );
}
switch($mode){
case 1://gestion des requêtes et des 'amitiés' (suppression, acceptation ...)
switch($sm){
case 1://il s'agit d'une suppression ou d'un rejet 
doquery("DELETE FROM {{table}} WHERE `id`='{$bid}'","buddy");
message( "La requ&ecirc;te a &eacute;t&eacute; supprim&eacute;e!", $lang['Buddy_request'], 'buddy.php' );
break;

case 2://on veut accepter une requête
doquery("UPDATE {{table}} SET `active` = '1' WHERE `id` ='{$bid}'","buddy");
message( "La requ&ecirc;te a &eacute;t&eacute; accept&eacute;e!", $lang['Buddy_request'], 'buddy.php' );
break;

case 3:// on veut enregistrer une requête
$test=doquery("SELECT `id` FROM {{table}} WHERE `sender`='{$user[id]}' AND `owner`='{$_POST}' OR `owner`='{$user[id]}' AND `sender`='{$_POST[u]}'","buddy",true);
if($test==array()){
$text=mysql_escape_string( strip_tags( $_POST['text'] ) );//mesure de sécurité
doquery("INSERT INTO {{table}} SET `sender`='{$user[id]}' ,`owner`='{$_POST[u]}' ,`active`='0' ,`text`='{$text}'","buddy");
message( $lang['Request_sent'], $lang['Buddy_request'], 'buddy.php' );}
else{
message( "Une requ&ecirc;te avec ce joueur existe d&eacute;j&agrave; !", $lang['Buddy_request'], 'buddy.php' );
}
break;
} 
break;
case 2://déposer une candidature
if($u==$user['id']){
message('Vous ne pouvez pas vous envoyer une requ&ecirc;te &aagrave; vous-m&ecirc;me!','Erreur','buddy.php');
}
else{
$player=doquery("SELECT `username` FROM {{table}} WHERE `id`='{$u}'","users",true);
$page="<script src=scripts/cntchar.js type=text/javascript></script>
<script src=scripts/win.js type=text/javascript></script>
<center>
<form action=buddy.php?mode=1&sm=3 method=post>
<input type=hidden name=u value={$u}>
<table width=520>
<tr><td class=c colspan=2>Requ&ecirc;te d'ami</td></tr>
<tr><th>Joueur</th><th>{$player[username]}</th></tr>
<tr><th>Texte de requ&ecirc;te (<span id=cntChars>0</span> / 5000 caract&egrave;res)</th><th><textarea name=text cols=60 rows=10 onKeyUp=javascript:cntchar(5000)></textarea></th></tr>
<tr><td class=c><a href=javascript:back();>Revenir en arri&egrave;re</a></td><td class=c><input type=submit value='Envoyer'></td></tr>
</table></form>";
display ( $page, 'buddy', false );
}
break;
default://Affichage de la liste d'amis, des requêtes et des requêtes envoyées par le joueur lui-même
$liste=doquery("SELECT * FROM {{table}} WHERE `sender`='{$user[id]}' OR `owner`='{$user[id]}'","buddy");
while($buddy=mysql_fetch_assoc($liste)){
if($buddy['active']==0){//il s'agit d'une requête non traitée
if($buddy['sender']==$user['id']){//les requêtes que l'utilisateur a envoyé
$owner=doquery("SELECT `id`, `username`, `galaxy`, `system`, `planet`,`ally_id`, `ally_name` FROM {{table}} WHERE `id`='{$buddy[owner]}'","users",true);
$myrequest.="<tr><th><a href=messages.php?mode=write&id={$owner[id]}>{$owner[username]}</a></th>
<th><a href=alliance.php?mode=ainfo&a={$owner[ally_id]}>{$owner[ally_name]}</a></th>
<th><a href=galaxy.php?mode=3&galaxy={$owner[galaxy]}&system={$owner[system]}>{$owner[galaxy]}:{$owner[system]}:{$owner[planet]}</a></th>
<th>{$buddy[text]}</th>
<th><a href=buddy.php?mode=1&sm=1&bid={$buddy[id]}>Supprimer la requ&ecirc;te</a></th></tr>";
}
else{//les requêtes envoyées à l'utilisateur
$sender=doquery("SELECT `id`, `username`, `galaxy`, `system`, `planet`,`ally_id`, `ally_name` FROM {{table}} WHERE `id`='{$buddy[sender]}'","users",true);
$outrequest.="<tr><th><a href=messages.php?mode=write&id={$sender[id]}>{$sender[username]}</a></th>
<th><a href=alliance.php?mode=ainfo&a={$sender[ally_id]}>{$sender[ally_name]}</a></th>
<th><a href=galaxy.php?mode=3&galaxy={$sender[galaxy]}&system={$sender[system]}>{$sender[galaxy]}:{$sender[system]}:{$sender[planet]}</a></th>
<th>{$buddy[text]}</th>
<th><a href=buddy.php?mode=1&sm=2&bid={$buddy[id]}>Accepter</a><br><a href=buddy.php?mode=1&sm=1&bid={$buddy[id]}>Refuser </a></th></tr>";
}
}
else{//il s'agit des 'amitiés' déjà en place
$owner=doquery("SELECT `id`, `username`, `galaxy`, `system`, `planet`,`ally_id`, `ally_name` FROM {{table}} WHERE `id`='{$buddy[owner]}' OR `id`='{$buddy[sender]}'","users",true);
$myfriends.="<tr><th><a href=messages.php?mode=write&id={$owner[id]}>{$owner[username]}</a></th>
<th><a href=alliance.php?mode=ainfo&a={$owner[ally_id]}>{$owner[ally_name]}</a></th>
<th><a href=galaxy.php?mode=3&galaxy={$owner[galaxy]}&system={$owner[system]}>{$owner[galaxy]}:{$owner[system]}:{$owner[planet]}</a></th>
<th><font color=".(( $u["onlinetime"] + 60 * 10 >= time() )?"lime>{$lang['On']}":(( $u["onlinetime"] + 60 * 20 >= time() )?"yellow>{$lang['15_min']}":"red>{$lang['Off']}"))."</font></th>
<th><a href=buddy.php?mode=1&sm=1&bid={$buddy[id]}>Rompre</a></th></tr>";
}
}
$myfriends=($myfriends!='')?$myfriends:'<th colspan=6>Vous n\'avez pas d\'amis</th>';
$nor='<th colspan=6>Il n\'y a pas de requ&ecirc;te</th>';
$outrequest=($outrequest!='')?$outrequest:$nor;
$myrequest=($myrequest!='')?$myrequest:$nor;
$page="<table width=520>
<tr><td class=c colspan=6>Liste d'amis</td></tr>
<tr><td class=c colspan=6><center>Requ&ecirc;tes</a></td></tr>
<tr><td class=c>Pseudo</td>
<td class=c>Alliance</td>
<td class=c>Coordonnees</td>
<td class=c>Texte</td>
<td class=c>Action</td>
</tr>
<tr>{$outrequest}</tr>
<tr><td class=c colspan=6><center>Mes requ&ecirc;tes</a></td></tr>
<tr><td class=c>Pseudo</td>
<td class=c>Alliance</td>
<td class=c>Coordonnees</td>
<td class=c>Texte</td>
<td class=c>Action</td>
</tr>
<tr>{$myrequest}</tr>
<tr><td class=c colspan=6><center>Amiti&eacute;s</a></td></tr>
<tr><td class=c>Pseudo</td>
<td class=c>Alliance</td>
<td class=c>Coordonnees</td>
<td class=c>&Eacute;tat</td>
<td class=c>Action</td>
</tr>
<tr>{$myfriends}</tr>
</table>";
display ( $page, $lang['Buddy_list'], false );
break;
}
?>