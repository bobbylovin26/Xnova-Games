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

    function AbandonColony($user,$planetrow) {
       $destruyed = time() + 3600; //Temps avant la suppression dans la galaxie
       $DeleteMoon = false;
       if ($planetrow["planet_type"]==1){
       //Selectionne si il y a une lune sur la colonie a supprimée
          $QryWithMoon  = "SELECT * FROM {{table}} ";
          $QryWithMoon .= "WHERE ";
          $QryWithMoon .= "`destruyed` = '0' AND ";
          $QryWithMoon .= "`galaxy` = '". $planetrow['galaxy'] ."' AND ";
          $QryWithMoon .= "`system` = '". $planetrow['system'] ."' AND ";
          $QryWithMoon .= "`lunapos` = '". $planetrow['planet'] ."' AND ";
          $QryWithMoon .= "`id_owner` = '". $user['id'] ."' ;";
          $IsMoon = doquery( $QryWithMoon , 'lunas',true);
          if($IsMoon){
          	//Envoi la demande de suppression de la lune associé a la colonie
                $DeleteMoon = true; // borrar luna
            }
       
       //Mise en mode destruction d ela colonie
          $QryUpdatePlanet = "UPDATE {{table}} SET ";
          $QryUpdatePlanet .= "`destruyed` = '" . $destruyed . "', ";
          $QryUpdatePlanet .= "`id_owner` = '0' ";
          $QryUpdatePlanet .= "WHERE ";
          $QryUpdatePlanet .= "`id` = '" . $user['current_planet'] . "' LIMIT 1;";
          doquery($QryUpdatePlanet , 'planets');
       
          //Si on veut supprimer une lune
       }elseif($planetrow["planet_type"]==3){
          $DeleteMoon = true; //borrar luna
       }
       
       if ($DeleteMoon){
          $QryDeleteMoon = "DELETE FROM {{table}} ";
          $QryDeleteMoon .= "WHERE ";
          $QryDeleteMoon .= "`galaxy` = '". $planetrow['galaxy'] ."' AND ";
          $QryDeleteMoon .= "`system` = '". $planetrow['system'] ."' AND ";
          $QryDeleteMoon .= "`planet` = '". $planetrow['planet'] ."' AND ";
          $QryDeleteMoon .= "`planet_type` = '3' AND ";
          $QryDeleteMoon .= "`id_owner` = '". $user['id'] ."' ;";
          doquery($QryDeleteMoon , 'planets');

          $Qrydestructionlune  = "DELETE FROM {{table}} ";
          $Qrydestructionlune .= "WHERE ";
          $Qrydestructionlune .= "`galaxy` = '". $planetrow['galaxy'] ."' AND ";
          $Qrydestructionlune .= "`system` = '". $planetrow['system'] ."' AND ";
          $Qrydestructionlune .= "`lunapos` = '". $planetrow['planet'] ."' AND ";
          $Qrydestructionlune .= "`id_owner` = '". $user['id'] ."' ;";
          doquery( $Qrydestructionlune , 'lunas');
          
          $Qrydestructionlune2  = "UPDATE {{table}} SET ";
          $Qrydestructionlune2 .= "`id_luna` = '0' ";
          $Qrydestructionlune2 .= "WHERE ";
          $Qrydestructionlune2 .= "`galaxy` = '". $planetrow['galaxy'] ."' AND ";
          $Qrydestructionlune2 .= "`system` = '". $planetrow['system'] ."' AND ";
          $Qrydestructionlune2 .= "`planet` = '". $planetrow['planet'] ."' ;";
          doquery( $Qrydestructionlune2 , 'galaxy');
       
       }

    }

    function CheckFleets($planetrow){

       $QryFleet = "SELECT * FROM {{table}} WHERE ";
       $QryFleet .= "(`fleet_start_galaxy` = '".$planetrow["galaxy"]."' AND ";
       $QryFleet .= "`fleet_start_system` = '".$planetrow["system"]."' AND ";
       $QryFleet .= "`fleet_start_planet` = '".$planetrow["planet"]."'";
       if ($planetrow["planet_type"]==3){
          $QryFleet .= " AND `fleet_start_type` = '3'";
       }
       $QryFleet .= ") OR ";
       $QryFleet .= "(`fleet_end_galaxy` = '".$planetrow["galaxy"]."' AND ";
       $QryFleet .= "`fleet_end_system` = '".$planetrow["system"]."' AND ";
       $QryFleet .= "`fleet_end_planet` = '".$planetrow["planet"]."'";
       if ($planetrow["planet_type"]==3){
          $QryFleet .= " AND `fleet_end_type` = '3'";
       }
       $QryFleet .= " AND `fleet_mess` <> 1 ); ";
       $fleets = doquery($QryFleet, 'fleets',true);
       if($fleets){
          return true;
       }
       return false;
    }

    ?>