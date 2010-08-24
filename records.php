<?php

define('INSIDE'  , true);
define('INSTALL' , false);

$xnova_root_path = './';
include($xnova_root_path . 'extension.inc');
include($xnova_root_path . 'common.' . $phpEx);

       includeLang('records');

       $RecordTpl = gettemplate('records_body');
       $HeaderTpl = gettemplate('records_section_header');
       $TableRows = gettemplate('records_section_rows');

       $parse['rec_title'] = $lang['rec_title'];

       $bloc['section']    = $lang['rec_build'];
       $bloc['player']     = $lang['rec_playe'];
       $bloc['level']      = $lang['rec_level'];
       $parse['building']  = parsetemplate( $HeaderTpl, $bloc);

       $bloc['section']    = $lang['rec_specb'];
       $bloc['player']     = $lang['rec_playe'];
       $bloc['level']      = $lang['rec_level'];
       $parse['buildspe']  = parsetemplate( $HeaderTpl, $bloc);

       $bloc['section']    = $lang['rec_techn'];
       $bloc['player']     = $lang['rec_playe'];
       $bloc['level']      = $lang['rec_level'];
       $parse['research']  = parsetemplate( $HeaderTpl, $bloc);

       $bloc['section']    = $lang['rec_fleet'];
       $bloc['player']     = $lang['rec_playe'];
       $bloc['level']      = $lang['rec_nbre'];
       $parse['fleet']     = parsetemplate( $HeaderTpl, $bloc);

       $bloc['section']    = $lang['rec_defes'];
       $bloc['player']     = $lang['rec_playe'];
       $bloc['level']      = $lang['rec_nbre'];
       $parse['defenses']  = parsetemplate( $HeaderTpl, $bloc);

       if ($game_config['stat'] == 1 ) {
          $RecConditionP1       = "WHERE `id_level` < '".$game_config['stat_level']."'";
         $RecConditionP       = "`id_level` < '".$game_config['stat_level']."' and";
          $RecConditionU1       = "WHERE `authlevel` < '".$game_config['stat_level']."'";
         $RecConditionU       = " `authlevel` < '".$game_config['stat_level']."'  and";
       } else {
          $RecConditionP       = "";
          $RecConditionU       = "";
         $RecConditionP1       = "";
          $RecConditionU1      = "";
       }

       foreach($lang['tech'] as $Element => $ElementName) {
          if ($ElementName != "") {
             if ($resource[$Element] != "") {
                // Je sais bien qu'il n'y a aucune raison de blinder ce test ...
                // Mais avec les zozos qui vont le pomper ... Mieux vaut prevoir que guerir !!
                if       ($Element >=   1 && $Element <=  39 || $Element == 44) {
                   // Batiment
                   $PlanetRow          = doquery ("SELECT `id_owner`, `". $resource[$Element] ."` AS `current` FROM {{table}} WHERE ".$RecConditionP." `". $resource[$Element]. "` = (SELECT MAX(`". $resource[$Element] ."`) FROM {{table}} ".$RecConditionP1." ) ;", 'planets', true);
                
                $UserRow            = doquery ("SELECT `username`, `authlevel` FROM {{table}} WHERE `id` = '".$PlanetRow['id_owner']."';", 'users', true);
                   $Row['element']     = $ElementName;
                   if($PlanetRow['id_level'] < 3){
                $Row['winner']      = (($PlanetRow['current'] != 0) ? $UserRow['username'] : $lang['rec_rien']);
                }else{
                $Row['winner']      = (($PlanetRow['current'] != 0) ? $UserRow['username'] : $lang['rec_rien']);
                }
                   $Row['count']       = ($PlanetRow['current'] != 0) ? pretty_number( $PlanetRow['current'] ) : $lang['rec_rien'];
                   $parse['building'] .= parsetemplate( $TableRows, $Row);
                } elseif ($Element >=  41 && $Element <=  99 && $Element != 44) {
                   // Batiment spéciaux
                   $PlanetRow          = doquery ("SELECT `id_owner`, `". $resource[$Element] ."` AS `current` FROM {{table}} WHERE  ".$RecConditionP." `". $resource[$Element]. "` = (SELECT MAX(`". $resource[$Element] ."`) FROM {{table}} ".$RecConditionP1." );", 'planets', true);
                $UserRow            = doquery ("SELECT `username` FROM {{table}} WHERE `id` = '".$PlanetRow['id_owner']."';", 'users', true);
                   $Row['element']     = $ElementName;
                   $Row['winner']      = ($PlanetRow['current'] != 0) ? $UserRow['username'] : $lang['rec_rien'];
                   $Row['count']       = ($PlanetRow['current'] != 0) ? pretty_number( $PlanetRow['current'] ) : $lang['rec_rien'];
                   $parse['buildspe'] .= parsetemplate( $TableRows, $Row);
                } elseif ($Element >= 101 && $Element <= 199) {
                   // Techno
        $UserRow            = doquery ("SELECT `username`, `". $resource[$Element] ."` AS `current` FROM {{table}} WHERE ".$RecConditionU." `". $resource[$Element] ."` = (SELECT MAX(`". $resource[$Element] ."`) FROM {{table}} ".$RecConditionU1." );", 'users', true);
                   $Row['element']     = $ElementName;
                   $Row['winner']      = ($UserRow['current'] != 0) ? $UserRow['username'] : $lang['rec_rien'];
                   $Row['count']       = ($UserRow['current'] != 0) ? pretty_number( $UserRow['current'] ) : $lang['rec_rien'];
                   $parse['research'] .= parsetemplate( $TableRows, $Row);
                } elseif ($Element >= 201 && $Element <= 399) {
                   // Flotte
                   $PlanetRow          = doquery ("SELECT `id_owner`, `". $resource[$Element] ."` AS `current` FROM {{table}} WHERE    ".$RecConditionP." `". $resource[$Element]. "` = (SELECT MAX(`". $resource[$Element] ."`) FROM {{table}} ".$RecConditionP1."  );", 'planets', true);
                $UserRow            = doquery ("SELECT `username` FROM {{table}} WHERE `id` = '".$PlanetRow['id_owner']."';", 'users', true);
                   $Row['element']     = $ElementName;
                   $Row['winner']      = ($PlanetRow['current'] != 0) ? $UserRow['username'] : $lang['rec_rien'];
                   $Row['count']       = ($PlanetRow['current'] != 0) ? pretty_number( $PlanetRow['current'] ) : $lang['rec_rien'];
                   $parse['fleet']    .= parsetemplate( $TableRows, $Row);
                } elseif ($Element >= 401 && $Element <= 599) {
                   // Défenses
                   $PlanetRow          = doquery ("SELECT `id_owner`, `". $resource[$Element] ."` AS `current` FROM {{table}} WHERE ".$RecConditionP." `". $resource[$Element]. "` = (SELECT MAX(`". $resource[$Element] ."`) FROM {{table}} ".$RecConditionP1." );", 'planets', true);
                $UserRow            = doquery ("SELECT `username` FROM {{table}} WHERE `id` = '".$PlanetRow['id_owner']."';", 'users', true);
                   $Row['element']     = $ElementName;
                   $Row['winner']      = ($PlanetRow['current'] != 0) ? $UserRow['username'] : $lang['rec_rien'];
                   $Row['count']       = ($PlanetRow['current'] != 0) ? pretty_number( $PlanetRow['current'] ) : $lang['rec_rien'];
                   $parse['defenses'] .= parsetemplate( $TableRows, $Row);
                }
             }
          }
       }

       $page = parsetemplate( $RecordTpl, $parse );
       display($page, $lang['rec_title']);