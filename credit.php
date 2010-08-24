<?php

/**
 * credit.php
 *
 * @version 2.0
 * @copyright 2008 by e-Zobar for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc.php');
include($xnova_root_path . 'common.' . $phpEx);


display(parsetemplate(gettemplate('credit_body'), $parse), "Créditos", false);

?>