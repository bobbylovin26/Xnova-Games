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


includeLang('banned');

$parse = $lang;
$parse['dpath'] = $dpath;
$parse['mf'] = $mf;


$query = doquery("SELECT * FROM {{table}} ORDER BY `id`;",'banned');
$i=0;
while($u = mysql_fetch_array($query)){
	$parse['banned'] .=
        "<tr><td class=b><center><b>".$u[1]."</center></td></b>".
	"<td class=b><center><b>".$u[2]."</center></b></td>".
	"<td class=b><center><b>".date("d/m/Y G:i:s",$u[4])."</center></b></td>".
	"<td class=b><center><b>".date("d/m/Y G:i:s",$u[5])."</center></b></td>".
	"<td class=b><center><b>".$u[6]."</center></b></td></tr>";
	$i++;
}

if ($i=="0")
 $parse['banned'] .= "<tr><th class=b colspan=6>Il n'y a pas de joueurs bannis</th></tr>";
else
  $parse['banned'] .= "<tr><th class=b colspan=6>Il y a {$i} joueurs bannis</th></tr>";

display(parsetemplate(gettemplate('banned_body'), $parse),'Banned',true);


// Created by e-Zobar (XNova Team). All rights reversed (C) 2008
?>