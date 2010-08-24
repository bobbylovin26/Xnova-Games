<?php

/**
 * StatBuilder.php
 *
 * @version 2.0
 * @copyright 2008 by Chlorel for XNova
 * Reprogramado 2009 By lucky for XG PROYECT XNova - Argentina
 *
 */

if (!defined('INSIDE'))die(header("location:./"));

$StatDate   = time();

doquery ( "DELETE FROM {{table}} WHERE `stat_code` = '2';" , 'statpoints');
doquery ( "UPDATE {{table}} SET `stat_code` = `stat_code` + '1';" , 'statpoints');

$GameUsers  = doquery("SELECT * FROM {{table}} WHERE `authlevel` = '0';", 'users');

while ($CurUser = mysql_fetch_assoc($GameUsers))
{
	$OldStatRecord  = doquery ("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `id_owner` = '".$CurUser['id']."';",'statpoints', true);
	if ($OldStatRecord)
	{
		$OldTotalRank = $OldStatRecord['total_rank'];
		$OldTechRank  = $OldStatRecord['tech_rank'];
		$OldBuildRank = $OldStatRecord['build_rank'];
		$OldDefsRank  = $OldStatRecord['defs_rank'];
		$OldFleetRank = $OldStatRecord['fleet_rank'];
		doquery ("DELETE FROM {{table}} WHERE `stat_type` = '1' AND `id_owner` = '".$CurUser['id']."';",'statpoints');
	}
	else
	{
		$OldTotalRank = 0;
		$OldTechRank  = 0;
		$OldBuildRank = 0;
		$OldDefsRank  = 0;
		$OldFleetRank = 0;
	}

	$Points         = GetTechnoPoints ( $CurUser );
	$TTechCount     = $Points['TechCount'];
	$TTechPoints    = ($Points['TechPoint'] / $game_config['stat_settings']);
	$TBuildCount    = 0;
	$TBuildPoints   = 0;
	$TDefsCount     = 0;
	$TDefsPoints    = 0;
	$TFleetCount    = 0;
	$TFleetPoints   = 0;
	$GCount         = $TTechCount;
	$GPoints        = $TTechPoints;
	$UsrPlanets     = doquery("SELECT * FROM {{table}} WHERE `id_owner` = '". $CurUser['id'] ."';", 'planets');
	while ($CurPlanet = mysql_fetch_assoc($UsrPlanets) )
	{
		$Points           = GetBuildPoints ( $CurPlanet );
		$TBuildCount     += $Points['BuildCount'];
		$GCount          += $Points['BuildCount'];
		$PlanetPoints     = ($Points['BuildPoint'] / $game_config['stat_settings']);
		$TBuildPoints    += ($Points['BuildPoint'] / $game_config['stat_settings']);

		$Points           = GetDefensePoints ( $CurPlanet );
		$TDefsCount      += $Points['DefenseCount'];;
		$GCount          += $Points['DefenseCount'];
		$PlanetPoints    += ($Points['DefensePoint'] / $game_config['stat_settings']);
		$TDefsPoints     += ($Points['DefensePoint'] / $game_config['stat_settings']);

		$Points           = GetFleetPoints ( $CurPlanet );
		$TFleetCount     += $Points['FleetCount'];
		$GCount          += $Points['FleetCount'];
		$PlanetPoints    += ($Points['FleetPoint'] / $game_config['stat_settings']);
		$TFleetPoints    += ($Points['FleetPoint'] / $game_config['stat_settings']);

		$GPoints         += $PlanetPoints;
		$QryUpdatePlanet  = "UPDATE {{table}} SET ";
		$QryUpdatePlanet .= "`points` = '". $PlanetPoints ."' ";
		$QryUpdatePlanet .= "WHERE ";
		$QryUpdatePlanet .= "`id` = '". $CurPlanet['id'] ."';";
		doquery ( $QryUpdatePlanet , 'planets');
	}

	$Points 		 = GetFlyingFleetPoints ( $CurUser );
	$TFleetCount  	+= $Points['FleetCount'];
	$GCount  		+= $Points['FleetCount'];
	$TFleetPoints 	+= ($Points['FleetPoint'] / $game_config['stat_settings']);
	$GPoints 		+= ($Points['FleetPoint'] / $game_config['stat_settings']);

	$QryInsertStats  = "INSERT INTO {{table}} SET ";
	$QryInsertStats .= "`id_owner` = '". $CurUser['id'] ."', ";
	$QryInsertStats .= "`id_ally` = '". $CurUser['ally_id'] ."', ";
	$QryInsertStats .= "`stat_type` = '1', "; // 1 pour joueur , 2 pour alliance
	$QryInsertStats .= "`stat_code` = '1', "; // de 1 a 2 mis a jour de maniere automatique
	$QryInsertStats .= "`tech_points` = '". $TTechPoints ."', ";
	$QryInsertStats .= "`tech_count` = '". $TTechCount ."', ";
	$QryInsertStats .= "`tech_old_rank` = '". $OldTechRank ."', ";
	$QryInsertStats .= "`build_points` = '". $TBuildPoints ."', ";
	$QryInsertStats .= "`build_count` = '". $TBuildCount ."', ";
	$QryInsertStats .= "`build_old_rank` = '". $OldBuildRank ."', ";
	$QryInsertStats .= "`defs_points` = '". $TDefsPoints ."', ";
	$QryInsertStats .= "`defs_count` = '". $TDefsCount ."', ";
	$QryInsertStats .= "`defs_old_rank` = '". $OldDefsRank ."', ";
	$QryInsertStats .= "`fleet_points` = '". $TFleetPoints ."', ";
	$QryInsertStats .= "`fleet_count` = '". $TFleetCount ."', ";
	$QryInsertStats .= "`fleet_old_rank` = '". $OldFleetRank ."', ";
	$QryInsertStats .= "`total_points` = '". $GPoints ."', ";
	$QryInsertStats .= "`total_count` = '". $GCount ."', ";
	$QryInsertStats .= "`total_old_rank` = '". $OldTotalRank ."', ";
	$QryInsertStats .= "`stat_date` = '". $StatDate ."';";
	doquery ( $QryInsertStats , 'statpoints');
	if($game_config['stat']==1)
		if ($CurUser['authlevel'] >= $game_config['stat_level'])
			doquery("UPDATE {{table}} SET `tech_rank`='0', `tech_old_rank`='0',   `tech_points`='0', `tech_count`='0', `build_rank`='0', `build_old_rank`='0', `build_points`='0',
			`build_count`='0',   `defs_rank`='0', `defs_old_rank`='0', `defs_points`='0', `defs_count`='0', `fleet_rank`='0', `fleet_old_rank`='0', `fleet_points`='0', `fleet_count`='0',
			`total_rank`='0', `total_old_rank`='0',  `total_points`='0',    `total_count`='0' WHERE `id_owner`='".$CurUser['id']."'", "statpoints");
}

$Rank           = 1;
$RankQry        = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `tech_points` DESC;", 'statpoints');
while ($TheRank = mysql_fetch_assoc($RankQry) )
{
	$QryUpdateStats  = "UPDATE {{table}} SET ";
	$QryUpdateStats .= "`tech_rank` = '". $Rank ."' ";
	$QryUpdateStats .= "WHERE ";
	$QryUpdateStats .= " `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TheRank['id_owner'] ."';";
	doquery ( $QryUpdateStats , 'statpoints');
	$Rank++;
}

$Rank           = 1;
$RankQry        = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `build_points` DESC;", 'statpoints');

while ($TheRank = mysql_fetch_assoc($RankQry) )
{
	$QryUpdateStats  = "UPDATE {{table}} SET ";
	$QryUpdateStats .= "`build_rank` = '". $Rank ."' ";
	$QryUpdateStats .= "WHERE ";
	$QryUpdateStats .= " `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TheRank['id_owner'] ."';";
	doquery ( $QryUpdateStats , 'statpoints');
	$Rank++;
}

$Rank           = 1;
$RankQry        = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `defs_points` DESC;", 'statpoints');

while ($TheRank = mysql_fetch_assoc($RankQry) )
{
	$QryUpdateStats  = "UPDATE {{table}} SET ";
	$QryUpdateStats .= "`defs_rank` = '". $Rank ."' ";
	$QryUpdateStats .= "WHERE ";
	$QryUpdateStats .= " `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TheRank['id_owner'] ."';";
	doquery ( $QryUpdateStats , 'statpoints');
	$Rank++;
}

$Rank           = 1;
$RankQry        = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `fleet_points` DESC;", 'statpoints');

while ($TheRank = mysql_fetch_assoc($RankQry) )
{
	$QryUpdateStats  = "UPDATE {{table}} SET ";
	$QryUpdateStats .= "`fleet_rank` = '". $Rank ."' ";
	$QryUpdateStats .= "WHERE ";
	$QryUpdateStats .= " `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TheRank['id_owner'] ."';";
	doquery ( $QryUpdateStats , 'statpoints');
	$Rank++;
}

$Rank           = 1;
$RankQry        = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' ORDER BY `total_points` DESC;", 'statpoints');

while ($TheRank = mysql_fetch_assoc($RankQry) )
{
	$QryUpdateStats  = "UPDATE {{table}} SET ";
	$QryUpdateStats .= "`total_rank` = '". $Rank ."' ";
	$QryUpdateStats .= "WHERE ";
	$QryUpdateStats .= " `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $TheRank['id_owner'] ."';";
	doquery ( $QryUpdateStats , 'statpoints');
	$Rank++;
}

$GameAllys  = doquery("SELECT * FROM {{table}}", 'alliance');

while ($CurAlly = mysql_fetch_assoc($GameAllys))
{
	$OldStatRecord  = doquery ("SELECT * FROM {{table}} WHERE `stat_type` = '2' AND `id_owner` = '".$CurAlly['id']."';",'statpoints');
	if ($OldStatRecord)
	{
		$OldTotalRank = $OldStatRecord['total_rank'];
		$OldTechRank  = $OldStatRecord['tech_rank'];
		$OldBuildRank = $OldStatRecord['build_rank'];
		$OldDefsRank  = $OldStatRecord['defs_rank'];
		$OldFleetRank = $OldStatRecord['fleet_rank'];
		doquery ("DELETE FROM {{table}} WHERE `stat_type` = '2' AND `id_owner` = '".$CurAlly['id']."';",'statpoints');
	}
	else
	{
		$OldTotalRank = 0;
		$OldTechRank  = 0;
		$OldBuildRank = 0;
		$OldDefsRank  = 0;
		$OldFleetRank = 0;
	}

	$QrySumSelect   = "SELECT ";
	$QrySumSelect  .= "SUM(`tech_points`)  as `TechPoint`, ";
	$QrySumSelect  .= "SUM(`tech_count`)   as `TechCount`, ";
	$QrySumSelect  .= "SUM(`build_points`) as `BuildPoint`, ";
	$QrySumSelect  .= "SUM(`build_count`)  as `BuildCount`, ";
	$QrySumSelect  .= "SUM(`defs_points`)  as `DefsPoint`, ";
	$QrySumSelect  .= "SUM(`defs_count`)   as `DefsCount`, ";
	$QrySumSelect  .= "SUM(`fleet_points`) as `FleetPoint`, ";
	$QrySumSelect  .= "SUM(`fleet_count`)  as `FleetCount`, ";
	$QrySumSelect  .= "SUM(`total_points`) as `TotalPoint`, ";
	$QrySumSelect  .= "SUM(`total_count`)  as `TotalCount` ";
	$QrySumSelect  .= "FROM {{table}} ";
	$QrySumSelect  .= "WHERE ";
	$QrySumSelect  .= "`stat_type` = '1' AND ";
	$QrySumSelect  .= "`id_ally` = '". $CurAlly['id'] ."';";
	$Points         = doquery( $QrySumSelect, 'statpoints', true);

	$TTechCount     = $Points['TechCount'];
	$TTechPoints    = $Points['TechPoint'];
	$TBuildCount    = $Points['BuildCount'];
	$TBuildPoints   = $Points['BuildPoint'];
	$TDefsCount     = $Points['DefsCount'];
	$TDefsPoints    = $Points['DefsPoint'];
	$TFleetCount    = $Points['FleetCount'];
	$TFleetPoints   = $Points['FleetPoint'];
	$GCount         = $Points['TotalCount'];
	$GPoints        = $Points['TotalPoint'];

	$QryInsertStats  = "INSERT INTO {{table}} SET ";
	$QryInsertStats .= "`id_owner` = '". $CurAlly['id'] ."', ";
	$QryInsertStats .= "`id_ally` = '0', ";
	$QryInsertStats .= "`stat_type` = '2', ";
	$QryInsertStats .= "`stat_code` = '1', ";
	$QryInsertStats .= "`tech_points` = '". $TTechPoints ."', ";
	$QryInsertStats .= "`tech_count` = '". $TTechCount ."', ";
	$QryInsertStats .= "`tech_old_rank` = '". $OldTechRank ."', ";
	$QryInsertStats .= "`build_points` = '". $TBuildPoints ."', ";
	$QryInsertStats .= "`build_count` = '". $TBuildCount ."', ";
	$QryInsertStats .= "`build_old_rank` = '". $OldBuildRank ."', ";
	$QryInsertStats .= "`defs_points` = '". $TDefsPoints ."', ";
	$QryInsertStats .= "`defs_count` = '". $TDefsCount ."', ";
	$QryInsertStats .= "`defs_old_rank` = '". $OldDefsRank ."', ";
	$QryInsertStats .= "`fleet_points` = '". $TFleetPoints ."', ";
	$QryInsertStats .= "`fleet_count` = '". $TFleetCount ."', ";
	$QryInsertStats .= "`fleet_old_rank` = '". $OldFleetRank ."', ";
	$QryInsertStats .= "`total_points` = '". $GPoints ."', ";
	$QryInsertStats .= "`total_count` = '". $GCount ."', ";
	$QryInsertStats .= "`total_old_rank` = '". $OldTotalRank ."', ";
	$QryInsertStats .= "`stat_date` = '". $StatDate ."';";
	doquery ( $QryInsertStats , 'statpoints');
}
?>