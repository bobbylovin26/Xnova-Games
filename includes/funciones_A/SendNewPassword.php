<?php

/**
 * SendNewPassword.php
 *
 * @version 2.0
 * @copyright 2008 by Tom1991 for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

function sendnewpassword($mail)
{
	$ExistMail = doquery("SELECT `email` FROM {{table}} WHERE `email` = '". $mail ."' LIMIT 1;", 'users', true);

	if (empty($ExistMail['email']))
	{
		message('¡La dirección de correo eléctronico no existe!','¡Error!',"index.php?modo=claveperdida",2);
	}
	else
	{
		$Caracters="aazertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
		$Count=strlen($Caracters);
		$NewPass="";
		$Taille=6;

		srand((double)microtime()*1000000);

		for($i=0;$i<$Taille;$i++)
		{
			$CaracterBoucle=rand(0,$Count-1);

			$NewPass=$NewPass.substr($Caracters,$CaracterBoucle,1);
		}

		$Title 	= "Nueva contraseña";
		$Body 	= "Esta es tu nueva contraseña: ";
		$Body  .= $NewPass;

		mail($mail,$Title,$Body);

		$NewPassSql = md5($NewPass);

		$QryPassChange = "UPDATE {{table}} SET ";
		$QryPassChange .= "`password` ='". $NewPassSql ."' ";
		$QryPassChange .= "WHERE `email`='". $mail ."' LIMIT 1;";
		doquery( $QryPassChange, 'users');
	}
}
?>