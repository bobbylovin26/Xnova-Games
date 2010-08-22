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
define('IN_ADMIN', true);
require_once dirname(__FILE__) .'./../common.php';

include(ROOT_PATH . 'admin/statfunctions.' . PHPEXT);

	if ($user['authlevel'] >= 1)
	{
		includeLang('admin');
		includeLang('admin/statconfig');

		// On récupère la quantité mémoire avant l'actualisation
		// It gets much memory before the update
		$MemoryInitial = round(memory_get_usage() / 1024, 1);
		
		$mtime        = microtime();
		$mtime        = explode(" ", $mtime);
		$mtime        = $mtime[1] + $mtime[0];
		
		// Heure du début de l'actualisation
		// Start time of the update
		$starttime    = $mtime;
		
		$StatDate   = time();
		
		$Members = array();

		/*************************************************************************************/
		/*                    Début du calcul des statistiques des joueurs                   */
		/*                         Start calculating player statistics                       */
		/*************************************************************************************/
					
		// On récupère le classement des joueurs
		// It retrieves the player rankings
		$sql = <<<EOF
						SELECT	u.*, 
								s.build_rank, 
								s.defs_rank, 
								s.fleet_rank, 
								s.tech_rank, 
								s.total_rank 
						FROM {{table}}users AS u 
						LEFT JOIN {{table}}statpoints AS s ON u.id = s.id_owner AND s.stat_type = '1' 
						WHERE u.id = s.id_owner 
						ORDER BY u.id;
EOF;
		$nb = 0;

		$Users = doquery( $sql, '');

		while ($TheUser = mysql_fetch_assoc ($Users))
		{
			$Members['id_owner'][$nb] 				= intval($TheUser['id']);
			$Members['ally_id'][$nb] 				= intval($TheUser['ally_id']);				
			$Members['old_build_rank'][$nb] 		= intval($TheUser['build_rank']);
			$Members['old_defs_rank'][$nb]			= intval($TheUser['defs_rank']);
			$Members['old_fleet_rank'][$nb] 		= intval($TheUser['fleet_rank']);
			$Members['old_tech_rank'][$nb]			= intval($TheUser['tech_rank']);
			$Members['old_total_rank'][$nb] 		= intval($TheUser['total_rank']);
				
			// Calcul des points pour la recherche
			// Scoring for search
			$Points         	= GetTechnoPoints ( $TheUser );
			$Members['tech_count'][$nb]		= $Points['TechCount'];
			$Members['tech_point'][$nb]		= ($Points['TechPoint'] / $game_config['stat_settings']);

			$nb++;
		}	
		
		// On récupère les planètes de tous les joueurs
		// It retrieves the planets of all players
		$sql = <<<EOF
						SELECT 		p.* 
						FROM   		{{table}}planets AS p
						LEFT JOIN	{{table}}users AS u ON u.id = p.id_owner 
						WHERE		u.id = p.id_owner
						ORDER BY	p.id_owner
EOF;

		$Planets = doquery(	$sql , '');

		// On récupère l'id le plus petit, normalement 1 mais on sait jamais ;)
		// It retrieves the smallest id, normally 1 but you never know ;)
		$sql = <<<EOF
						SELECT		Min(id) AS `min` 
						FROM		{{table}};
EOF;
		$MinID = doquery($sql, 'users', true);		
		$IdUser = intval($MinID['min']);
		
		$nb = 0;
		
		while ($ThePlanet = mysql_fetch_assoc ($Planets))
		{
			if ($ThePlanet['id_owner'] != $IdUser)
			{				
				// On est sur une planète d'un autre joueur
				// It is on a planet of another player
				
				$sql = <<<EOF
								SELECT 		* 
								FROM		{{table}} 
								WHERE		`fleet_owner` = '{$IdUser}';
EOF;
				
				$ResultFlyingFleet = doquery( $sql, 'fleets');
				
				$Points = GetFlyingFleetPoints($ResultFlyingFleet);
				
				$Members['fleets_points'][$nb] += $Points['FleetPoint'];
				$Members['fleets_counts'][$nb] += $Points['FleetCount'];
				
				// On calcule les points totaux du joueur actuel
				// It gets the current player's total points
				$Members['total_points'][$nb]	= $Members['tech_point'][$nb] + $Members['build_points'][$nb] + $Members['defs_points'][$nb] + $Members['fleets_points'][$nb];				
				$Members['total_counts'][$nb]	= $Members['tech_count'][$nb] + $Members['build_counts'][$nb] + $Members['defs_counts'][$nb] + $Members['fleets_counts'][$nb];
				
				// On récupère l'id du nouveau joueur
				// It retrieves the id of the new player
				$IdUser = intval($ThePlanet['id_owner']);

				$nb++;
				
				// Initialisation
				// Initialization
				$Members['build_counts'][$nb]	= 0;
				$Members['build_points'][$nb]	= 0;
				
				$Members['defs_counts'][$nb]	= 0;
				$Members['defs_points'][$nb]	= 0;
		
				$Members['fleets_counts'][$nb]	= 0;
				$Members['fleets_points'][$nb]	= 0;
			}
			
			// Calcul des points apportés par les bâtiments
			// Calculation of the points made by the buildings
			$Points							 = GetBuildPoints ( $ThePlanet );
			$Members['build_counts'][$nb]	+= $Points['BuildCount'];
			$Members['build_points'][$nb]	+= ($Points['BuildPoint'] / $game_config['stat_settings']);			
			$PlanetPoints					= ($Points['BuildPoint'] / $game_config['stat_settings']);
			
			// Calcul des points apportés par les défenses
			// Calculation of the points made by defense
			$Points							 = GetDefensePoints ( $ThePlanet );
			$Members['defs_counts'][$nb]	+= $Points['DefenseCount'];
			$Members['defs_points'][$nb]	+= ($Points['DefensePoint'] / $game_config['stat_settings']);
			$PlanetPoints					+= ($Points['DefensePoint'] / $game_config['stat_settings']);

			// Calcul des points apportés par les vaisseaux
			// Calculation of the points made by the vessels
			$Points							 = GetFleetPoints ( $ThePlanet );
			$Members['fleets_counts'][$nb]	+= $Points['FleetCount'];
			$Members['fleets_points'][$nb]	+= ($Points['FleetPoint'] / $game_config['stat_settings']);
			$PlanetPoints					+= ($Points['FleetPoint'] / $game_config['stat_settings']);
			
			$IdPlanet = intval($ThePlanet['id']);
			
			// Mise à jour des points de la planète
			// Updated points of the planet
			$QryUpdatePlanet = <<<EOF
							UPDATE 		{{table}}
							SET 		`points` = '{$PlanetPoints}' 
							WHERE		`id` = '{$IdPlanet}';
EOF;
			doquery ( $QryUpdatePlanet , 'planets');

		}		
		
		// On efface les anciens statistiques des joueurs
		// It erases the old player statistics
		doquery ("DELETE FROM {{table}} WHERE `stat_type` = '1';", 'statpoints');
		
		/*************************************************************************************/
		/*                     Fin du calcul des statistiques des joueurs                    */
		/*                        Finish calculating player statistics                       */
		/*************************************************************************************/
		
		/*************************************************************************************/
		/*          Début de la mise à jour des nouvelles statistiques des joueurs           */
		/*                      Start updating new player statistics                         */
		/*************************************************************************************/
		
		// Mise à jour des joueurs par bloc
		// Update player block
		$BlocMembers = 25;
		
		if ( sizeof($Members['id_owner']) > $BlocMembers	)
		{
			$NumberQuerys = floor(sizeof($Members['id_owner']) / $BlocMembers);
			$Query = 0;
		}
		else
		{
			$NumberQuerys = 1;
			$Query = 0;
			$BlocMembers = sizeof($Members['id_owner']);
		}
		
		While ( $Query <= $NumberQuerys)
		{
		
			$QryInsertStats  = <<<EOF
										INSERT INTO {{table}} 
										(`id_owner`, `id_ally`, `stat_type`, `stat_code`, `tech_points`, `tech_count`,
										`tech_old_rank`, `build_points`, `build_count`, `build_old_rank`, `defs_points`, 
										`defs_count`, `defs_old_rank`, `fleet_points`, `fleet_count`, `fleet_old_rank`, 
										`total_points`, `total_count`, `total_old_rank`, `stat_date`) VALUES 
EOF;

			for ($Count = $Query * $BlocMembers ; $Count < $BlocMembers * ($Query + 1) ; $Count++)
			{
				if ($Members['id_owner'][$Count] <> 0)
					$QryInsertStats .= <<<EOF
												('	{$Members['id_owner'][$Count]}				'	, 	'{$Members['ally_id'][$Count]}			'	,	'1'		,		'1', 
												 '	{$Members['tech_point'][$Count]}		'	, 	'{$Members['tech_count'][$Count]}		'	,	'{$Members['old_tech_rank'][$Count]}	', 
												 '	{$Members['build_points'][$Count]}		'	, 	'{$Members['build_counts'][$Count]}		'	,	'{$Members['old_build_rank'][$Count]}	', 
												 '	{$Members['defs_points'][$Count]}		'	, 	'{$Members['defs_counts'][$Count]}		'	,	'{$Members['old_defs_rank'][$Count]}	', 
												 '	{$Members['fleets_points'][$Count]}		'	, 	'{$Members['fleets_counts'][$Count]}	'	,	'{$Members['old_fleet_rank'][$Count]}	', 
												 '	{$Members['total_points'][$Count]}		'	, 	'{$Members['total_counts'][$Count]}		'	,	'{$Members['old_total_rank'][$Count]}	', 
												 '	{$StatDate}								'), 
EOF;
			}
			
			$Query++;
		
			$QryInsertStats = substr($QryInsertStats, 0, -2);
			

			
			doquery ( $QryInsertStats , 'statpoints');
		}
		/*************************************************************************************/
		/*           Fin de la mise à jour des nouvelles statistiques des joueurs            */
		/*                     Finish updating new player statistics                         */
		/*************************************************************************************/
		
		/*************************************************************************************/
		/*                    Début de la mise du classement des joueurs                     */
		/*                     	   Start to set the player rankings                          */
		/*************************************************************************************/

		// Mise à jour du classement des Recherches
		// Update Ranking Searches
		doquery("SET @row=0;", '');
		$RankQry = doquery("SELECT @row:=@row+1 AS TechRank, `id_owner` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `tech_points` DESC;", 'statpoints');
		
		while ($TheRank = mysql_fetch_assoc($RankQry))
		{
			$IdOwner = intval($TheRank['id_owner']);
			
			$QryUpdateStats  = <<<EOF
										UPDATE 	{{table}} SET 
												`tech_rank` = '{$TheRank['TechRank']}' 
										WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '{$IdOwner}';
EOF;
			doquery ( $QryUpdateStats , 'statpoints');
		}

		// Mise à jour du classement des Bâtiments
		// Update rank Buildings
		doquery("SET @row=0;", '');
		$RankQry = doquery("SELECT @row:=@row+1 AS BuildRank, `id_owner` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `build_points` DESC;", 'statpoints');
		
		while ($TheRank = mysql_fetch_assoc($RankQry))
		{
			$IdOwner = intval($TheRank['id_owner']);
			
			$QryUpdateStats  = <<<EOF
										UPDATE 	{{table}} SET 
												`build_rank` = '{$TheRank['BuildRank']}' 
										WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '{$IdOwner}';
EOF;
			doquery ( $QryUpdateStats , 'statpoints');
		}

		// Mise à jour du classement des Défenses
		// Update rank Defenses
		doquery("SET @row=0;", '');
		$RankQry = doquery("SELECT @row:=@row+1 AS DefRank, `id_owner` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `defs_points` DESC;", 'statpoints');
		
		while ($TheRank = mysql_fetch_assoc($RankQry))
		{			
			$IdOwner = intval($TheRank['id_owner']);
			
			$QryUpdateStats  = <<<EOF
										UPDATE 	{{table}} SET 
												`defs_rank` = '{$TheRank['DefRank']}' 
										WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '{$IdOwner}';
EOF;
			doquery ( $QryUpdateStats , 'statpoints');
		}

		// Mise à jour du classement des Flottes
		// Update rank Fleet
		doquery("SET @row=0;", '');
		$RankQry = doquery("SELECT @row:=@row+1 AS FleetRank, `id_owner` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `fleet_points` DESC;", 'statpoints');
		
		$RankQry        = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `fleet_points` DESC;", 'statpoints');
		while ($TheRank = mysql_fetch_assoc($RankQry))
		{		
			$IdOwner = intval($TheRank['id_owner']);
			
			$QryUpdateStats  = <<<EOF
										UPDATE 	{{table}} SET 
												`defs_rank` = '{$TheRank['FleetRank']}' 
										WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '{$IdOwner}';
EOF;
			doquery ( $QryUpdateStats , 'statpoints');
		}

		// Mise à jour du classement Général
		// Update Rank General
		doquery("SET @row=0;", '');
		$RankQry = doquery("SELECT @row:=@row+1 AS TotalRank, `id_owner` FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `total_points` DESC;", 'statpoints');
		
		while ($TheRank = mysql_fetch_assoc($RankQry))
		{	
			$IdOwner = intval($TheRank['id_owner']);
			
			$QryUpdateStats  = <<<EOF
										UPDATE 	{{table}} SET 
												`defs_rank` = '{$TheRank['TotalRank']}' 
										WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '{$IdOwner}';
EOF;
			doquery ( $QryUpdateStats , 'statpoints');
		}			
		
		// On libère de la mémoire en détruisant la variable
		// It frees up memory by destroying the variable
		unset($Members);
			
		/*************************************************************************************/
		/*                     Fin de la mise du classement des joueurs                      */
		/*                     	  Finish to set the player rankings                          */
		/*************************************************************************************/
		
		/*************************************************************************************/
		/*                   Début du calcul des statistiques par alliance                   */
		/*                      Start calculating statistics by alliance                     */
		/*************************************************************************************/
		
		$AllyStats = array();					
		
		// On récupère le classement des alliances
		// It retrieves the alliance rankings
		$GameAllys = doquery("	SELECT DISTINCT		s1.id_owner, 
													s1.build_rank, 
													s1.defs_rank, 
													s1.fleet_rank, 
													s1.tech_rank, 
													s1.total_rank 
								FROM 				{{table}} AS s1
								LEFT JOIN			{{table}} AS s2 ON s1.id_owner = s2.id_ally 
								WHERE 				s1.stat_type = '2' AND s1.id_owner = s2.id_ally 
								ORDER BY 			`id_owner`;", 'statpoints');
		
		$nb = 0;
		
		while ($CurAlly = mysql_fetch_assoc($GameAllys)) {
			$AllyStats['id_owner'][$nb] 		= intval($CurAlly['id_owner']);
			$AllyStats['old_build_rank'][$nb]	= intval($CurAlly['build_rank']);
			$AllyStats['old_defs_rank'][$nb]	= intval($CurAlly['defs_rank']);
			$AllyStats['old_fleet_rank'][$nb] 	= intval($CurAlly['fleet_rank']);
			$AllyStats['old_tech_rank'][$nb]	= intval($CurAlly['tech_rank']);
			$AllyStats['old_total_rank'][$nb]	= intval($CurAlly['total_rank']);
			
			$nb++;
		}

		$Qry = <<<EOF
						SET 	@row=0;
EOF;
		doquery($Qry, '');
		
		// On récupère les id des alliances
		// It retrieves the id alliances
		$QryAllys = <<<EOF
						SELECT DISTINCT		`id_ally` 
						FROM				{{table}}
						WHERE				`stat_type` = '1' and `id_ally` <> 0 
						ORDER BY			`id_ally`;
EOF;
		$Allys = doquery($QryAllys, 'statpoints');			
			
		$nb = 0;
		while ($TheAlly = mysql_fetch_assoc ($Allys))
		{
			$IdAlly = intval($TheAlly['id_ally']);
			
			// On fait la somme des points de chaque joueur appartenant à l'alliance
			// It is the sum of points each player belonging to the alliance
			$QrySumSelect = <<<EOF
										SELECT		SUM(`tech_points`)  as `TechPoint`, 
													SUM(`tech_count`)   as `TechCount`, 
													SUM(`build_points`) as `BuildPoint`, 
													SUM(`build_count`)  as `BuildCount`, 
													SUM(`defs_points`)  as `DefsPoint`, 
													SUM(`defs_count`)   as `DefsCount`, 
													SUM(`fleet_points`) as `FleetPoint`, 
													SUM(`fleet_count`)  as `FleetCount`, 
													SUM(`total_points`) as `TotalPoint`, 
													SUM(`total_count`)  as `TotalCount` 
										FROM		{{table}}
										WHERE		`stat_type` = '1' 
													AND 
													`id_ally` = '{$IdAlly}';
EOF;
			$Points         = doquery( $QrySumSelect, 'statpoints', true);
			
			$AllyStats['tech_count'][$nb]		= $Points['TechCount'];
			$AllyStats['tech_points'][$nb]		= $Points['TechPoint'];
			$AllyStats['build_count'][$nb]		= $Points['BuildCount'];
			$AllyStats['build_points'][$nb]		= $Points['BuildPoint'];
			$AllyStats['defs_count'][$nb]		= $Points['DefsCount'];
			$AllyStats['defs_points'][$nb]		= $Points['DefsPoint'];
			$AllyStats['fleet_count'][$nb]		= $Points['FleetCount'];
			$AllyStats['fleet_points'][$nb]		= $Points['FleetPoint'];
			$AllyStats['total_count'][$nb]		= $Points['TotalCount'];
			$AllyStats['total_points'][$nb]		= $Points['TotalPoint'];
			
			$nb++;
		}

		// On efface les statistiques des alliances
		// It clears the statistics alliances
		doquery ("DELETE FROM {{table}} WHERE `stat_type` = '2';", 'statpoints');
		
		/*************************************************************************************/
		/*                    Fin du calcul des statistiques des alliances                   */
		/*                        Finish calculating player statistics                       */
		/*************************************************************************************/
		
		/*************************************************************************************/
		/*         Début de la mise à jour des nouvelles statistiques des alliances          */
		/*                     Start updating new alliance statistics                        */
		/*************************************************************************************/
		
		$BlocAlly = 25;

		if ( sizeof($AllyStats['id_owner']) > $BlocAlly	)
		{
			$NumberQuerys = floor(sizeof($AllyStats['id_owner']) / $BlocAlly) + 1;
			$Query = 0;
		}
		else
		{
			$NumberQuerys = 1;
			$Query = 0;
			$BlocAlly = sizeof($AllyStats['id_owner']);
		}

		While ( $Query < $NumberQuerys)
		{
		
			$QryInsertStats  = <<<EOF
										INSERT INTO {{table}} 
										(`id_owner`, `id_ally`, `stat_type`, `stat_code`, `tech_points`, `tech_count`, 
										`tech_old_rank`, `build_points`, `build_count`, `build_old_rank`, `defs_points`, 
										`defs_count`, `defs_old_rank`, `fleet_points`, `fleet_count`, `fleet_old_rank`, 
										`total_points`, `total_count`, `total_old_rank`, `stat_date`) VALUES 
EOF;
			
			for ($Count = $Query * $BlocAlly ; $Count < $BlocAlly * $NumberQuerys ; $Count++)
			{
		
				$QryInsertStats  .= <<<EOF
											(	'{$AllyStats['id_owner'][$Count]}', '0', '2', '1', '{$AllyStats['tech_points'][$Count]}', '{$AllyStats['tech_count'][$Count]}', 
												'{$AllyStats['old_tech_rank'][$Count]}', '{$AllyStats['build_points'][$Count]}', '{$AllyStats['build_count'][$Count]}', 
												'{$AllyStats['old_build_rank'][$Count]}', '{$AllyStats['defs_points'][$Count]}', '{$AllyStats['defs_count'][$Count]}', 
												'{$AllyStats['old_defs_rank'][$Count]}', '{$AllyStats['fleet_points'][$Count]}', '{$AllyStats['fleet_count'][$Count]}', 
												'{$AllyStats['old_fleet_rank'][$Count]}', '{$AllyStats['total_points'][$Count]}', '{$AllyStats['total_count'][$Count]}', 
												'{$AllyStats['old_total_rank'][$Count]}', '{$StatDate}'	
											), 
EOF;
			}
			$Query++;
			
			$QryInsertStats = substr($QryInsertStats, 0, -2);

			doquery ( $QryInsertStats , 'statpoints');
		}
		
		// On libère de la mémoire en détruisant la variable
		// It frees up memory by destroying the variable
		unset($AllyStats);
			
		/*************************************************************************************/
		/*                    Fin de la mise du classement des alliances                     */
		/*                     	 Finish to set the alliance rankings                         */
		/*************************************************************************************/
		
		$game_config['stats'] = $StatDate;
		
		$mtime        = microtime();
		$mtime        = explode(" ", $mtime);
		$mtime        = $mtime[1] + $mtime[0];
		
		// Heure de la fin de l'actualisation
		// Finish time of the update
		$endtime      = $mtime;
		
		// Durée de l'actualisation
		// Duration of update
		$LengthTime = round($endtime - $starttime, 2);
		
		// On récupère le pique de mémoire
		// It retrieves the peak memory
		$MemoryPeak = round(memory_get_peak_usage() / 1024, 1);
		
		// On récupère la quantité mémoire après l'actualisation
		// It gets much memory after the update
		$MemoryFinish = round(memory_get_usage() / 1024, 1);
		
		$AdminMessage = <<<EOF
								<p>{$lang['adm_done']}</p>
								{$lang['adm_delay_actu_stats']} {$LengthTime} secondes{$lang['adm_new_line']}
								{$lang['adm_mem_start']} {$MemoryInitial} {$lang['adm_units']}{$lang['adm_new_line']}
								{$lang['adm_peak_mem']} {$MemoryPeak} {$lang['adm_units']}{$lang['adm_new_line']}
								{$lang['adm_mem_finish']} {$MemoryFinish} {$lang['adm_units']}{$lang['adm_new_line']}
EOF;
		AdminMessage ( $AdminMessage, $lang['adm_stat_title'] );

	} else
	{
		AdminMessage ( $lang['sys_noalloaw'], $lang['sys_noaccess'] );
	}
?>