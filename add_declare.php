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


		includeLang('admin');

		$mode      = $_POST['mode'];

		$PageTpl   = gettemplate("add_declare");
		$parse     = $lang;

		if ($mode == 'addit') {
			$declarator              = $user['id'];
			$declarator_name  = addslashes(htmlspecialchars($user['username']));
			$decl1        	   		  = addslashes(htmlspecialchars($_POST['dec1']));
			$decl2       		       = addslashes(htmlspecialchars($_POST['dec2']));
			$decl3        		      = addslashes(htmlspecialchars($_POST['dec3']));
			$reason1        	  	 = addslashes(htmlspecialchars($_POST['reason']));

			$QryDeclare  = "INSERT INTO {{table}} SET ";
			$QryDeclare .= "`declarator` = '". $declarator ."', ";
			$QryDeclare .= "`declarator_name` = '". $declarator_name ."', ";			$QryDeclare .= "`declared_1` = '". $decl1 ."', ";
			$QryDeclare .= "`declared_2` = '". $decl2 ."', ";
			$QryDeclare .= "`declared_3` = '". $decl3 ."', ";
			$QryDeclare .= "`reason`     = '". $reason1 ."' ";
	
			doquery( $QryDeclare, "declared");
			doquery("UPDATE {{table}} SET multi_validated ='1' WHERE username='{$user['username']}'","users");

			AdminMessage ( "Merci, votre demande a ete prise en compte. Les autres joueurs que vous avez implique doivent egalement et imperativement suivre cette procedure aussi.", "Ajout" );
		}
		$Page = parsetemplate($PageTpl, $parse);

		display ($Page, "Declaration d\'IP partagee", false, '', true);


?>