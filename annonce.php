<?php

/**
* annonce.php
*
* @version 1.0
* @copyright 2008 by ??????? for XNova
*/

define('INSIDE' , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);

$users = doquery("SELECT `username`,`galaxy`,`system` FROM {{table}} WHERE id='".$user['id']."';", 'users',true);
$action = $_GET['action'];

switch($action){
case 1://on veut poster une annonce
$page .='<HTML>
<center>
<br>
<table width="600">
<td class="c" colspan="10" align="center"><b><font color="white">Ajouter une Annonce</font></b></td></tr>
<form action="annonce.php?action=2" method="post">
<td class="c" colspan="10" align="center"><b>Ressources &agrave; Vendre</font></b></td>
<tr><th colspan="5">M&eacute;tal</th><th colspan="5"><input type="texte" value="0" name="metalvendre" /></th></tr>
<tr><th colspan="5">Cristal</th><th colspan="5"><input type="texte" value="0" name="cristalvendre" /></th></tr>
<tr><th colspan="5">Deuterium</th><th colspan="5"><input type="texte" value="0" name="deutvendre" /></th></tr>

<td class="c" colspan="10" align="center"><b>Ressources Souhait&eacute;es</font></b></td></tr>
<tr><th colspan="5">M&eacute;tal</th><th colspan="5"><input type="texte" value="0" name="metalsouhait" /></th></tr>
<tr><th colspan="5">Cristal</th><th colspan="5"><input type="texte" value="0" name="cristalsouhait" /></th></tr>
<tr><th colspan="5">Deuterium</th><th colspan="5"><input type="texte" value="0" name="deutsouhait" /></th></tr>
<tr><th colspan="10"><input type="submit" value="Envoyer" /></th></tr>

<form>
</table>
</HTML>';

display($page);
break;

case 2:// On vient d'envoyer une annonce, on l'enregistre et on affiche un message comme quoi on l'a bien fait
foreach($_POST as $name => $value){
$$name=$value;
}
if(($metalvendre!=0 && $metalsouhait==0) ||($cristalvendre!=0 && $cristalsouhait==0) || ($deutvendre!=0 && $deutsouhait==0)){
doquery("INSERT INTO {{table}} SET user='{$users['username']}', galaxie='{$users['galaxy']}', systeme='{$users['system']}', metala='{$metalvendre}', cristala='{$cristalvendre}', deuta='{$deutvendre}', metals='{$metalsouhait}', cristals='{$cristalsouhait}', deuts='{$deutsouhait}'" , "annonce");

message ('Votre Annonce a bien &eacute;t&eacute; enregistr&eacute;e !', '&Eacute;tat de l\'annonce',"annonce.php");
}

else{
message ('Votre annonce n\'est pas valide !', '&Eacute;tat de l\'annonce',"annonce.php?action=1");
}

break;

case 3://Suppression d'annonce

doquery("DELETE FROM {{table}} WHERE `id` = {$_GET[id]}" , "annonce");
message ('Votre Annonce a bien &eacute;t&eacute; supprim&eacute;e !', '&Eacute;tat de l\'annonce',"annonce.php");
break;

default://Sinon on affiche la liste des annonces
$annonce = doquery("SELECT * FROM {{table}} ORDER BY `id` DESC ", "annonce");

$page2 = "<HTML>
<center>
<br>
<table width=\"600\">
<td class=\"c\" colspan=\"10\"><font color=\"#FFFFFF\">Petites Annonces</font></td></tr>
<tr><th colspan=\"3\">Infos de livraison</th><th colspan=\"3\">Ressources &agrave; vendre</th><th colspan=\"3\">Ressources souhait&eacute;es</th><th>Action</th></tr>
<tr><th>Vendeur</th><th>Galaxie</th><th>Syst&egrave;me</th><th>M&eacute;tal</th><th>Cristal</th><th>Deuterium</th><th>M&eacute;tal</th><th>Cristal</th><th>Deuterium</th><th>Supprimer</th></tr>";

while ($b = mysql_fetch_assoc($annonce)) {
$page2 .= '<tr><th> ';
foreach($b as $name => $value){
if($name!='id')
{$page2 .= $value ;
$page2 .= '</th><th>';}}
$page2 .= ($b['user']==$users['username'])?"<a href=\"annonce.php?action=3&id={$b[id]}\">X</a></th></tr>":"</th></tr>";
}

$page2 .= "<tr><th colspan=\"10\" align=\"center\"><a href=\"annonce.php?action=1\">Ajouter une Annonce</a></th></tr>
</td>
</table>
</HTML>";

display($page2);
break;
}

// Créé par Tom1991 Copyright 2008
// Modifié par BenjaminV
?>