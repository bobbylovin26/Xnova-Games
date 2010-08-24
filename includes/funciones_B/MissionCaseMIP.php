<?php
/****************************************/
/* MissionCaseMIP.php                */
/* Gestion de misiles interplanetarios   */
/*                               */
/* @version 1.1                   */
/* @copyright 2008 By Minguez for XNova */
/*                              */
/****************************************/
// ----------------------------------------------------------------------------------------------------------------
// Mission Case 10: -> MIP
function MissionCaseMIP ($FleetRow)
{
    global $user, $phpEx, $xgp_root, $pricelist, $lang, $resource, $CombatCaps;

   if ($FleetRow['fleet_start_time'] <= time()) {
        if ($FleetRow['fleet_mess'] == 0) {
            if (!isset($CombatCaps[202]['sd'])) {
                message("<font color=\"red\">" . $lang['sys_no_vars'] . "</font>", $lang['sys_error'], "fleet." . $phpEx, 2);
            }

         includelang('tech');
         includelang('system');


            $QryTargetPlanet = "SELECT * FROM {{table}} ";
            $QryTargetPlanet .= "WHERE ";
            $QryTargetPlanet .= "`galaxy` = '" . $FleetRow['fleet_end_galaxy'] . "' AND ";
            $QryTargetPlanet .= "`system` = '" . $FleetRow['fleet_end_system'] . "' AND ";
            $QryTargetPlanet .= "`planet` = '" . $FleetRow['fleet_end_planet'] . "' AND ";
            $QryTargetPlanet .= "`planet_type` = '" . $FleetRow['fleet_end_type'] . "';";
            $planet = doquery($QryTargetPlanet, 'planets', true);

         $QrySelect  = "SELECT defence_tech,military_tech FROM {{table}} ";
         $QrySelect .= "WHERE ";
         $QrySelect .= "`id` = '".$FleetRow['fleet_owner']."';";
         $UserFleet = doquery( $QrySelect, 'users',true);

         // selected_row es la flota del atakante cambiar por FleetRow

         $verteidiger = $UserFleet["defence_tech"];
         $angreifer = $UserFleet["military_tech"];


         $ids = array(
            0 => 401,
            1 => 402,
            2 => 403,
            3 => 404,
            4 => 405,
            5 => 406,
            6 => 407,
            7 => 408,

            8 => 502,
            9 => 503,

            10 => 409,
            11 => 410,
            12 => 411);

         $def =   array(
            0 => $planet['misil_launcher'],
            1 => $planet['small_laser'],
            2 => $planet['big_laser'],
            3 => $planet['gauss_canyon'],
            4 => $planet['ionic_canyon'],
            5 => $planet['buster_canyon'],
            6 => $planet['small_protection_shield'],
            7 => $planet['big_protection_shield'],
            8 => $planet['interceptor_misil'],
            9 => $planet['interplanetary_misil'],
            10 => $planet['planet_protector'],
            11 => $planet['fotocanyon'],
            12 => $planet['baseespacial']);

         $DefenseLabel =   array(0 => $lang['tech'][401],
            1 => $lang['tech'][402],
            2 => $lang['tech'][403],
            3 => $lang['tech'][404],
            4 => $lang['tech'][405],
            5 => $lang['tech'][406],
            6 => $lang['tech'][407],
            7 => $lang['tech'][408],
            8 => $lang['tech'][502],
            9 => $lang['tech'][503],
            10 => $lang['tech'][409],
            11 => $lang['tech'][410],
            12 => $lang['tech'][411]);
            $irak = raketenangriff($verteidiger, $angreifer, $FleetRow['fleet_amount'], $def, $FleetRow['fleet_target_obj']);
            $message = '';
            if ($planet['interceptor_misil'] >= $FleetRow['fleet_amount']) {
               $message = 'Tus misiles de intersepci&oacute;n destruyeron los misiles interplanetarios<br>';
               $x = $resource[$ids[8]];
               doquery("UPDATE {{table}} SET " . $x . " = " . $x . "-" . $FleetRow['fleet_amount'] . " WHERE id = " . $planet['id'], 'planets');
            } else {

               foreach ($irak['zerstoert'] as $id => $anzahl) {
                       if ($id < 10) {
                     if ($id != 8) $message .= $DefenseLabel[$id] . " (- " . $anzahl . ")<br>";
					$x = $resource[$ids[$id]];
                       $x1 = $x ."-". $anzahl;
                             doquery("UPDATE {{table}} SET " . $x . " = " . $x1 . " WHERE id = " . $planet['id'], 'planets');
                  }
               }
            }
            $UserPlanet = doquery("SELECT name FROM {{table}} WHERE id = '" . $FleetRow['fleet_owner'] . "'", 'planets',true);
            $name = $UserPlanet['name'];
			$name_deffer = $QryTargetPlanet['name'];
            $message_vorlage  = 'Un ataque con misiles (' .$FleetRow['fleet_amount']. ') de ' .$name. ' ';
			$message_vorlage .= 'al planeta ' .$name_deffer.'<br><br>';

            if (empty($message))$message = "Tu planeta no tenia defensa !";

    			doquery("INSERT INTO {{table}} SET
                          `message_owner`='" . $FleetRow['fleet_target_owner'] . "',
                          `message_sender`='".$UserPlanet['id']."',
                          `message_time`=UNIX_TIMESTAMP(),
                          `message_type`='3',
                          `message_from`='Torre de Control',
                          `message_subject`='Ataque con misiles',
                          `message_text`='" . $message_vorlage . $message . "'" , 'messages');
                doquery("INSERT INTO {{table}} SET
                          `message_owner`='" . $UserPlanet['id'] . "',
                          `message_sender`='".$FleetRow['fleet_target_owner']."',
                          `message_time`=UNIX_TIMESTAMP(),
                          `message_type`='3',
                          `message_from`='Torre de Control',
                          `message_subject`='Ataque con misiles',
                          `message_text`='" . $message_vorlage . $message . "'" , 'messages');

                doquery("DELETE FROM {{table}} WHERE fleet_id = '" . $FleetRow['fleet_id'] . "'", 'fleets');
      }
   }
   $FleetRow['fleet_start_time'] <= time();
}
?>