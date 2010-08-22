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

	$open = true;

	$raportrow = doquery("SELECT * FROM {{table}} WHERE `rid` = '".(mysql_escape_string($_GET["raport"]))."';", 'rw', true);

	if (($raportrow["id_owner1"] == $user["id"]) or
		($raportrow["id_owner2"] == $user["id"]) or
		 $open) {
		$Page  = "<html>";
		$Page .= "<head>";
		$Page .= "<link rel=\"stylesheet\" type=\"text/css\" href=\"".$dpath."/formate.css\">";
		$Page .= "<meta http-equiv=\"content-type\" content=\"text/html; charset=iso-8859-2\" />";
		$Page .= "</head>";
		$Page .= "<body>";
		$Page .= "<center>";
		$Page .= "<table width=\"99%\">";
		$Page .= "<tr>";
		if (($raportrow["id_owner1"] == $user["id"]) and
			($raportrow["a_zestrzelona"] == 1)) {
			$Page .= "<td>Le contact avec la flotte attaquante a &eacute;t&eacute; perdue.<br>";
			$Page .= "(En d'autres termes, elle a &eacute;t&eacute; abattu au premier tour .)</td>";
		} else {
			$Page .= "<td>". stripslashes( $raportrow["raport"] ) ."</td>";
		}
		$Page .= "</tr>";
		$Page .= "</table>";
		$Page .= "</center>";
		$Page .= "</body>";
		$Page .= "</html>";

		echo $Page;
	}

// -----------------------------------------------------------------------------------------------------------
// History version

?>