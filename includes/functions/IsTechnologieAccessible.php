<?php

/**
 * IsTechnologieAccessible.php
 *
 * @version 1.0
 * @copyright 2008 By Chlorel for XNova
 */

// Verification si l'on a le droit ou non a un element
function IsTechnologieAccessible($user, $planet, $Element) {
    global $requeriments, $resource;

    if (isset($requeriments[$Element])) {
        $enabled = true;
        foreach($requeriments[$Element] as $ReqElement => $EleLevel) {
            
            // Id possible pour les races de 1000 à 1200
            // Ce qui veut dire que vous pouvez créer jusqu'à 200 races ;-)
            // Cà devrait suffir normalement ;-)
            if ($ReqElement >= 1000 && $ReqElement <= 1200)
                {
                    if ($ReqElement == $user['id_race'] + 1000)
                            return true;                        
                }                        
            if (@$user[$resource[$ReqElement]] && $user[$resource[$ReqElement]] >= $EleLevel) {
                // break;
            } elseif ($planet[$resource[$ReqElement]] && $planet[$resource[$ReqElement]] >= $EleLevel) {
                $enabled = true;
            } else {
                $enabled = false;            
            }
        }
        return $enabled;
    } else {
        $enabled = true;
    }
    return $enabled;
}

?>