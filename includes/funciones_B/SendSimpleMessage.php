<?php

/**
 * SendSimpleMessage.php
 *
 * @version 1.3
 * @copyright 2008 by Chlorel for XNova
 */

function SendSimpleMessage ( $Owner, $Sender, $Time, $Type, $From, $Subject, $Message) {

	if ($Time == '') {
		$Time = time();
	}

	$QryInsertMessage  = "INSERT INTO {{table}} SET ";
	$QryInsertMessage .= "`message_owner` = '". $Owner ."', ";
	$QryInsertMessage .= "`message_sender` = '". $Sender ."', ";
	$QryInsertMessage .= "`message_time` = '" . $Time . "', ";
	$QryInsertMessage .= "`message_type` = '". $Type ."', ";
	$QryInsertMessage .= "`message_from` = '". addslashes( $From ) ."', ";
	$QryInsertMessage .= "`message_subject` = '". addslashes( $Subject ) ."', ";
	$QryInsertMessage .= "`message_text` = '". addslashes( $Message ) ."';";
	doquery( $QryInsertMessage, 'messages');

}

?>