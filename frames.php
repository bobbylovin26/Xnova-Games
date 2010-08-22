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


$InLogin = false;

$XNova_Host    = $_SERVER['HTTP_HOST'];
$XNova_Script  = $_SERVER['SCRIPT_NAME'];
$Uri_Array     = explode ('/', $XNova_Script);
// On vire le script
array_pop($Uri_Array);
$XNova_URI     = implode ('/', $Uri_Array);

$XNovaRootURL  = "http://". $XNova_Host ."/". $XNova_URI ."/";

require_once dirname(__FILE__) .'/common.php';

	$page  = "<html>";
	$page .= "<head>";
	$page .= "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=". $langInfos['ENCODING']."\">";
	$page .= "<link rel=\"shortcut icon\" href=\"favicon.ico\">";
	$page .= "<title>". $game_config['game_name'] ."</title>";
	$page .= "</head>";

	$page .= "<frameset framespacing=\"0\" border=\"0\" cols=\"190,*\" frameborder=\"0\">";
	$page .= "<frame name=\"LeftMenu\" target=\"Mainframe\" src=\"leftmenu.php\" noresize scrolling=\"no\" marginwidth=\"0\" marginheight=\"0\">";
	$page .= "<frame name=\"Hauptframe\" src=\"overview.php\">";
	$page .= "<noframes>";
	$page .= "<body>";
	$page .= "<p>". $lang['NoFrames']."</p>";
	$page .= "</noframes>";
	$page .= "</frameset>";
      $page .= "</body>";
	$page .= "</html>";

	echo $page;

// -----------------------------------------------------------------------------------------------------------
// History version
// 1.0 - Euuhh ... je ne sais plus ...
?>
