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
// Recup des variables
$Attaquant = $_GET['current'];
$NbreMip   = $_POST['SendMI'];

$Galaxy    = $_GET['galaxy'];
$System    = $_GET['system'];
$Planet    = $_GET['planet'];

$PlaneteAttaquant = doquery("SELECT * FROM {{table}} WHERE `id`='" . $Attaquant . "'", "planets", true);
$PlaneteAdverse   = doquery("SELECT * FROM {{table}} WHERE galaxy = " . $Galaxy . " AND system = " . $System . " AND planet = " . $Planet . "", "planets", true);

$MipAttaquant = $PlaneteAttaquant['interplanetary_misil'];
if ($MipAttaquant < $NbreMip) {
    message('Vous ne poss&eacute;dez pas assez de Missilles !', 'Erreur');
}

$AntiMipAdverse = $PlaneteAdverse['interceptor_misil'];
$MipRestant     = $NbreMip - $AntiMipAdverse;
$AntiMipRestant = $$AntiMipAdverse - $NbreMip;

echo $MipRestant;
echo $AntiMipRestant;
// L'attaquant se fait exploser tout ses MIP
if ($MipRestant <= 0) {
    doquery("UPDATE {{table}} SET `interplanetary_misil`='0' WHERE `id`='" . $Attaquant . "'", "planets");
    doquery("UPDATE {{table}} SET `interceptor_misil`='" . $AntiMipRestant . "' WHERE `id`='" . $PlaneteAdverse['id_owner'] . "'", "planets");
    // Message à l'attaquant
    $Owner    = $user['id'];
    $Sender   = "0";
    $Time     = time();
    $Type     = 3;
    $From     = "Quartier G&eacute;n&eacute;ral";
    $Subject  = "Rapport d'attaque par MIP";
    $Message  = "Malheureusement tout vos missiles interplan&eacute;taire ont &eacute;t&eacute; d&eacute;truits par le syst&egrave;me de d&eacute;fense adverse.";
    SendSimpleMessage($Owner, $Sender, $Time, $Type, $From, $Subject, $Message);

    // Message a l'attaqué
    $Owner2   = $PlaneteAdverse['id_owner'];
    $Message2 = "Vous avez d&eacute;truit " . $NbreMip . " Missiles Interplan&eacute;taire adverse. <br>Il vous reste " . $AntiMipRestant . " Missiles d'interception";
    SendSimpleMessage($Owner2, $Sender, $Time, $Type, $From, $Subject, $Message2);
}

if($MipRestant > 0){
	$Id = $PlaneteAdverse['id'];
	MipAttack($NbreMip, $Id);
}

?>