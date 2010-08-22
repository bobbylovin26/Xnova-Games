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

if ( defined('INSIDE') ) {
	define('ADMINEMAIL'               , "admin@xnova.fr");
	define('GAMEURL'                  , "http://".$_SERVER['HTTP_HOST']."/");

	// Definition du monde connu !
	define('MAX_GALAXY_IN_WORLD'      , 9);
	define('MAX_SYSTEM_IN_GALAXY'     , 499);
	define('MAX_PLANET_IN_SYSTEM'     , 15);
	// Nombre de colones pour les rapports d'espionnage
	define('SPY_REPORT_ROW'           , 2);
	// Cases données par niveau de Base Lunaire
	define('FIELDS_BY_MOONBASIS_LEVEL', 4);
	// Nombre maximum de colonie par joueur
	define('MAX_PLAYER_PLANETS'       , 21);
	// Nombre maximum d'element dans la liste de construction de batiments
	define('MAX_BUILDING_QUEUE_SIZE'  , 5);
	// Nombre maximum d'element dans une ligne de liste de construction flotte et defenses
	define('MAX_FLEET_OR_DEFS_PER_ROW', 1000);
	// Taux de depassement possible dans l'espace de stockage des hangards ...
	// 1.0 pour 100% - 1.1 pour 110% etc ...
	define('MAX_OVERFLOW'             , 1.1);
	// Affiche les administrateur dans la page des records ...
	// 0 -> les affiche
	// 1 -> les affiche pas
	define('SHOW_ADMIN_IN_RECORDS'    , 0);

	// Valeurs de bases pour les colonies ou planetes fraichement crées
	define('BASE_STORAGE_SIZE'        , 1000000);
	define('BUILD_METAL'              , 500);
	define('BUILD_CRISTAL'            , 500);
	define('BUILD_DEUTERIUM'          , 500);

	// Debug Level
	define('DEBUG', 1); // Debugging off
	// Mot qui sont interdit a la saisie !
	$ListCensure = array ( "<", ">", "script", "doquery", "http", "javascript", "'" );
} else {
	die("Hacking attempt");
}



?>