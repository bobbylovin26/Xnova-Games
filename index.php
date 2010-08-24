<?php

/**
 * index.php
 *
 * @version 1.0
 * @copyright 2008 by e-Zobar for XNova
 */
$page=preg_replace("/[^a-z0-9_ ]/i", "", $page);
if(!@include("includes/$page.php"))header('location: login.php');

if (filesize('config.php') == 0) {
	header('location: install/');
	exit();
}
			elseif (file_exists('./install/'))
		{
			echo("<h2><b>Merci de supprimer le dossier install avant de continuer</b></h2><br>
			Pour des raisons de s&eacute;curit&eacute;, il est d&eacute;sormais obligatoire de supprimer <i>(ou de renommer)</i> ce dossier.");
		} else { 
		header('location: login.php');
	exit();
	}
		


// -----------------------------------------------------------------------------------------------------------
// History version
// 1.0 - Creation avec redirection vers l'installeur si pas de config.php
// 1.1 - Détéction du dossier install, si présent, peut pas continuer
?>