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

    $InLogin = true;

require_once dirname(__FILE__) .'/common.php';



    define('ADMINEMAIL',"NoReply@Xnova.fr"); //Changez l'email duquel on va envoyer le message
    define('GAMEURL',"http://".$_SERVER['HTTP_HOST']."/");

	includeLang('lostpassword');
    include("config.php");


    if($_GET['action'] == '1'){

       $add = 0;
       $name = doquery("SELECT * FROM {{table}} WHERE `username`='{$_POST['pseudo']}'",'users',true);
       $email = doquery("SELECT * FROM {{table}} WHERE `email_2`='{$_POST['email']}'",'users',true);
       if(!$name){$add++; message('Ce nom de joueur n a pas ete trouve','Erreur','lostpassword.php');}
       if(!$email){$add++; message('Cette adresse email n a pas ete trouvee!','Erreur','lostpassword.php');}
       if(!$_POST['pseudo']){$add++; message('Entrez votre pseudo!','Erreur','lostpassword.php');}
       if(!$_POST['email']){$add++; message('Entrez un email!','Erreur','lostpassword.php');}
       if($name['id']!=$email['id']){$add++; message('L adresse mail ne correspond pas au pseudo!!','Erreur','lostpassword.php');}


    if($add==0){   
    $user_array = doquery("SELECT `email`,`username` FROM {{table}} WHERE `email` = '{$_POST['email']}' AND `username` = '{$_POST['pseudo']}' LIMIT 1","users",true);
    $email = $_POST['email'];
    $email = $_POST['email'];
    $hashh = (time());
    $actor = "From: Serveur Xnova";  // Changez le nom du serv ici
    $up = "Serveur Xnova - Changer le mot de passe"; // Ici aussi
    mail($email, $up, "
    Vous devez changer votre mot de passe dans votre compte mais pour vous logger vous pouvez utiliser le
    mot de passe :

    Votre nouveau mot de passe est : $hashh

    Attention, n oubliez pas de changer votre mot de passe apres s etre connecté !

      ", $actor);

    $user_array = doquery("SELECT `email_2` FROM {{table}} WHERE `email_2` = '{$_POST['email']}' LIMIT 1","users",true);
    $md5newpass = md5($hashh);

    if($user_array)
    {
    doquery("UPDATE {{table}} SET `password`='{$md5newpass}' WHERE `email_2`='{$_POST['email']}'",'users');
    message('Mot de passe envoye ! Veuiller regarder dans votre boite mail, ou dans vos spam!','Nouveau mot de passe','index.php');

    }
    else
    message('Cette email n existe pas !','Erreur');
    }}


       $parse = $lang;
       $page = parsetemplate(gettemplate('lostpassword'), $parse);
       
       display($page,$lang['registry']);
    ?>
