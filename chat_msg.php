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

// On efface les anciens messages
$timemoment=time();
$time_1h=$timemoment - 3600;

// On selectionne les messages présents dans la base de donnée
$query = doquery("SELECT * FROM {{table}} ORDER BY messageid ASC", "chat");
while($v=mysql_fetch_object($query)){
	$nick=htmlentities($v->user);
	$msg=htmlentities($v->message);

	// Les différentes polices (gras, italique, couleurs, etc...)
	$msg=preg_replace("#\[a=(ft|https?://)(.+)\](.+)\[/a\]#isU", "<a href=\"$1$2\" target=\"_blank\">$3</a>", $msg);
	$msg=preg_replace("#\[b\](.+)\[/b\]#isU","<b>$1</b>",$msg);
	$msg=preg_replace("#\[i\](.+)\[/i\]#isU","<i>$1</i>",$msg);
	$msg=preg_replace("#\[u\](.+)\[/u\]#isU","<u>$1</u>",$msg);
	$msg=preg_replace("#\[c=(blue|yellow|green|pink|red|orange)\](.+)\[/c\]#isU","<font color=\"$1\">$2</font>",$msg);

	// Les smileys avec leurs raccourcis
	$msg=preg_replace("#:c#isU","<img src=\"images/smileys/cry.png\" align=\"absmiddle\" title=\":c\" alt=\":c\">",$msg);
	$msg=preg_replace("#:/#isU","<img src=\"images/smileys/confused.png\" align=\"absmiddle\" title=\":/\" alt=\":/\">",$msg);
	$msg=preg_replace("#o0#isU","<img src=\"images/smileys/dizzy.png\" align=\"absmiddle\" title=\"o0\" alt=\"o0\">",$msg);
	$msg=preg_replace("#\^\^#isU","<img src=\"images/smileys/happy.png\" align=\"absmiddle\" title=\"^^\" alt=\"^^\">",$msg);
	$msg=preg_replace("#:D#isU","<img src=\"images/smileys/lol.png\" align=\"absmiddle\" title=\":D\" alt=\":D\">",$msg);
	$msg=preg_replace("#:\|#isU","<img src=\"images/smileys/neutral.png\" align=\"absmiddle\" title=\":|\" alt=\":|\">",$msg);
	$msg=preg_replace("#:\)#isU","<img src=\"images/smileys/smile.png\" align=\"absmiddle\" title=\":)\" alt=\":)\">",$msg);
	$msg=preg_replace("#:o#isU","<img src=\"images/smileys/omg.png\" align=\"absmiddle\" title=\":o\" alt=\":o\">",$msg);
	$msg=preg_replace("#:p#isU","<img src=\"images/smileys/tongue.png\" align=\"absmiddle\" title=\":p\" alt=\":p\">",$msg);
	$msg=preg_replace("#:\(#isU","<img src=\"images/smileys/sad.png\" align=\"absmiddle\" title=\":(\" alt=\":(\">",$msg);
	$msg=preg_replace("#;\)#isU","<img src=\"images/smileys/wink.png\" align=\"absmiddle\" title=\";)\" alt=\";)\">",$msg);
	$msg=preg_replace("#:s#isU","<img src=\"images/smileys/shit.png\" align=\"absmiddle\" title=\":s\" alt=\":s\">",$msg);
	$msg=preg_replace("#xnova#","<a href=\"http://www.xnova.fr\">XNova</a>",$msg);

	// Affichage du message
	$msg="<div align=\"left\">".$nick." > ".$msg."<br></div>";
	print stripslashes($msg);
}

// Shoutbox by e-Zobar - Copyright XNova Team 2008
?>