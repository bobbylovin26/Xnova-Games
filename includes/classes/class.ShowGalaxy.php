<?php

##############################################################################
# *																			 #
# * XG PROYECT																 #
# *  																		 #
# * @copyright Copyright (C) 2008 - 2009 By lucky from Xtreme-gameZ.com.ar	 #
# *																			 #
# *																			 #
# *  This program is free software: you can redistribute it and/or modify    #
# *  it under the terms of the GNU General Public License as published by    #
# *  the Free Software Foundation, either version 3 of the License, or       #
# *  (at your option) any later version.									 #
# *																			 #
# *  This program is distributed in the hope that it will be useful,		 #
# *  but WITHOUT ANY WARRANTY; without even the implied warranty of			 #
# *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the			 #
# *  GNU General Public License for more details.							 #
# *																			 #
##############################################################################

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowGalaxy
{
	private function GalaxyLegendPopup ()
	{
		global $lang;

		$Result  = "<a href=# style=\"cursor: pointer;\"";
		$Result .= " onmouseover='return overlib(\"";
		$Result .= "<table width=240>";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=2>". $lang['gl_legend'] ."</td>";
		$Result .= "</tr><tr>";
		$Result .= "<td width=220>". $lang['gl_strong_player'] ."</td><td><span class=strong>". $lang['gl_s'] ."</span></td>";
		$Result .= "</tr><tr>";
		$Result .= "<td width=220>". $lang['gl_week_player'] ."</td><td><span class=noob>". $lang['gl_w'] ."</span></td>";
		$Result .= "</tr><tr>";
		$Result .= "<td width=220>". $lang['gl_vacation'] ."</td><td><span class=vacation>". $lang['gl_v'] ."</span></td>";
		$Result .= "</tr><tr>";
		$Result .= "<td width=220>". $lang['gl_banned'] ."</td><td><span class=banned>". $lang['gl_b'] ."</span></td>";
		$Result .= "</tr><tr>";
		$Result .= "<td width=220>". $lang['gl_inactive_seven'] ."</td><td><span class=inactive>". $lang['gl_i'] ."</span></td>";
		$Result .= "</tr><tr>";
		$Result .= "<td width=220>". $lang['gl_inactive_twentyeight'] ."</td><td><span class=longinactive>". $lang['gl_I'] ."</span></td>";
		$Result .= "</tr>";
		$Result .= "</table>\"";
		$Result .= ", STICKY, MOUSEOFF, DELAY, 750, CENTER, OFFSETX, -150, OFFSETY, -150 );'";
		$Result .= " onmouseout='return nd();'>";
		$Result .= "". $lang['gl_legend'] ."</a>";
		return $Result;
	}

	public function InsertGalaxyScripts ($CurrentPlanet)
	{
		$Script  = "<div style=\"top: 10px;\" id=\"content\">";
		$Script .= "<script language=\"JavaScript\">\n";
		$Script .= "function galaxy_submit(value) {\n";
		$Script .= "	document.getElementById('auto').name = value;\n";
		$Script .= "	document.getElementById('galaxy_form').submit();\n";
		$Script .= "}\n\n";
		$Script .= "function fenster(target_url,win_name) {\n";
		$Script .= "	var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=640,height=480,top=0,left=0');\n";
		$Script .= "	new_win.focus();\n";
		$Script .= "}\n";
		$Script .= "</script>\n";
		$Script .= "<script language=\"JavaScript\" src=\"scripts/tw-sack.js\"></script>\n";
		$Script .= "<script type=\"text/javascript\">\n\n";
		$Script .= "var ajax = new sack();\n";
		$Script .= "var strInfo = \"\";\n";
		$Script .= "function whenResponse () {\n";
		$Script .= "	retVals   = this.response.split(\"|\");\n";
		$Script .= "	Message   = retVals[0];\n";
		$Script .= "	Infos     = retVals[1];\n";
		$Script .= "	retVals   = Infos.split(\" \");\n";
		$Script .= "	UsedSlots = retVals[0];\n";
		$Script .= "	SpyProbes = retVals[1];\n";
		$Script .= "	Recyclers = retVals[2];\n";
		$Script .= "	Missiles  = retVals[3];\n";
		$Script .= "	retVals   = Message.split(\";\");\n";
		$Script .= "	CmdCode   = retVals[0];\n";
		$Script .= "	strInfo   = retVals[1];\n";
		$Script .= "	addToTable(\"done\", \"success\");\n";
		$Script .= "	changeSlots( UsedSlots );\n";
		$Script .= "	setShips(\"probes\", SpyProbes );\n";
		$Script .= "	setShips(\"recyclers\", Recyclers );\n";
		$Script .= "	setShips(\"missiles\", Missiles );\n";
		$Script .= "}\n\n";
		$Script .= "function doit (order, galaxy, system, planet, planettype, shipcount) {\n";
		$Script .= "	ajax.requestFile = \"FleetAjax.php?action=send\";\n";
		$Script .= "	ajax.runResponse = whenResponse;\n";
		$Script .= "	ajax.execute = true;\n\n";
		$Script .= "	ajax.setVar(\"thisgalaxy\", ". $CurrentPlanet["galaxy"] .");\n";
		$Script .= "	ajax.setVar(\"thissystem\", ". $CurrentPlanet["system"] .");\n";
		$Script .= "	ajax.setVar(\"thisplanet\", ". $CurrentPlanet["planet"] .");\n";
		$Script .= "	ajax.setVar(\"thisplanettype\", ". $CurrentPlanet["planet_type"] .");\n";
		$Script .= "	ajax.setVar(\"mission\", order);\n";
		$Script .= "	ajax.setVar(\"galaxy\", galaxy);\n";
		$Script .= "	ajax.setVar(\"system\", system);\n";
		$Script .= "	ajax.setVar(\"planet\", planet);\n";
		$Script .= "	ajax.setVar(\"planettype\", planettype);\n";
		$Script .= "	if (order == 6)\n";
		$Script .= "		ajax.setVar(\"ship210\", shipcount);\n";
		$Script .= "	if (order == 7) {\n";
		$Script .= "		ajax.setVar(\"ship208\", 1);\n\n";
		$Script .= "		ajax.setVar(\"ship203\", 2);\n\n";
		$Script .= "	}\n";
		$Script .= "	if (order == 8)\n";
		$Script .= "		ajax.setVar(\"ship209\", shipcount);\n\n";
		$Script .= "	ajax.runAJAX();\n";
		$Script .= "}\n\n";
		$Script .= "function addToTable(strDataResult, strClass) {\n";
		$Script .= "	var e = document.getElementById('fleetstatusrow');\n";
		$Script .= "	var e2 = document.getElementById('fleetstatustable');\n";
		$Script .= "	e.style.display = '';\n";
		$Script .= "	if(e2.rows.length > 2) {\n";
		$Script .= "		e2.deleteRow(2);\n";
		$Script .= "	}\n";
		$Script .= "	var row = e2.insertRow(0);\n";
		$Script .= "	var td1 = document.createElement(\"td\");\n";
		$Script .= "	var td1text = document.createTextNode(strInfo);\n";
		$Script .= "	td1.appendChild(td1text);\n";
		$Script .= "	var td2 = document.createElement(\"td\");\n";
		$Script .= "	var span = document.createElement(\"span\");\n";
		$Script .= "	var spantext = document.createTextNode(strDataResult);\n";
		$Script .= "	var spanclass = document.createAttribute(\"class\");\n";
		$Script .= "	spanclass.nodeValue = strClass;\n";
		$Script .= "	span.setAttributeNode(spanclass);\n";
		$Script .= "	span.appendChild(spantext);\n";
		$Script .= "	td2.appendChild(span);\n";
		$Script .= "	row.appendChild(td1);\n";
		$Script .= "	row.appendChild(td2);\n";
		$Script .= "}\n\n";
		$Script .= "function changeSlots(slotsInUse) {\n";
		$Script .= "	var e = document.getElementById('slots');\n";
		$Script .= "	e.innerHTML = slotsInUse;\n";
		$Script .= "}\n\n";
		$Script .= "function setShips(ship, count) {\n";
		$Script .= "	var e = document.getElementById(ship);\n";
		$Script .= "	e.innerHTML = count;\n";
		$Script .= "}\n";
		$Script .= "</script>\n";

		return $Script;
	}

	public function ShowGalaxyFooter ($Galaxy, $System,  $CurrentMIP, $CurrentRC, $CurrentSP, $maxfleet_count, $fleetmax)
	{
		global $planetcount, $xgp_root, $phpEx, $lang;

		$Result  = "";
		$PlanetCountMessage = $planetcount ." ". $lang['gl_populed_planets'];

		$LegendPopup = $this->GalaxyLegendPopup ();
		$Recyclers   = pretty_number($CurrentRC);
		$SpyProbes   = pretty_number($CurrentSP);

		$Result .= "\n";
		$Result .= "<tr>";
		$Result .= "<th width=\"30\">16</th>";
		$Result .= "<th colspan=7>";
		$Result .= "<a href=game.php?page=fleet&galaxy=".$Galaxy."&amp;system=".$System."&amp;planet=16;planettype=1&amp;target_mission=15>". $lang['gl_out_space'] ."</a>";
		$Result .= "</th>";
		$Result .= "</tr>";
		$Result .= "\n";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=6>( ".$PlanetCountMessage." )</td>";
		$Result .= "<td class=c colspan=2>". $LegendPopup ."</td>";
		$Result .= "</tr>";
		$Result .= "\n";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=3><span id=\"missiles\">". $CurrentMIP ."</span> ". $lang['gl_avaible_missiles'] ."</td>";
		$Result .= "<td class=c colspan=3><span id=\"slots\">". $maxfleet_count ."</span>/". $fleetmax ." ". $lang['gl_fleets'] ."</td>";
		$Result .= "<td class=c colspan=2>";
		$Result .= "<span id=\"recyclers\">". $Recyclers ."</span> ". $lang['gl_avaible_recyclers'] ."<br>";
		$Result .= "<span id=\"probes\">". $SpyProbes ."</span> ". $lang['gl_avaible_spyprobes'] ."</td>";
		$Result .= "</tr>";
		$Result .= "\n";
		$Result .= "<tr style=\"display: none;\" id=\"fleetstatusrow\">";
		$Result .= "<th class=c colspan=8><!--<div id=\"fleetstatus\"></div>-->";
		$Result .= "<table style=\"font-weight: bold\" width=\"100%\" id=\"fleetstatustable\">";
		$Result .= "<!-- will be filled with content later on while processing ajax replys -->";
		$Result .= "</table>";
		$Result .= "</th>";
		$Result .= "\n";
		$Result .= "</tr>";
		return $Result;
	}

	public function ShowGalaxyMISelector ( $Galaxy, $System, $Planet, $Current, $MICount )
	{
		global $lang;

		$Result  = "<form action=\"MissilesAjax.php?c=".$Current."&mode=2&galaxy=".$Galaxy."&system=".$System."&planet=".$Planet."\" method=\"POST\">";
		$Result .= "<tr>";
		$Result .= "<table border=\"0\">";
		$Result .= "<tr>";
		$Result .= "<td class=\"c\" colspan=\"2\">";
		$Result .= $lang['gl_missil_launch'] . " [".$Galaxy.":".$System.":".$Planet."]";
		$Result .= "</td>";
		$Result .= "</tr>";
		$Result .= "<tr>";
		$String  = sprintf($lang['gl_missil_to_launch'], $MICount);
		$Result .= "<td class=\"c\">".$String." <input type=\"text\" name=\"SendMI\" size=\"2\" maxlength=\"7\" /></td>";
		$Result .= "<td class=\"c\">Objetivo: <select name=\"Target\">";
		$Result .= "<option value=\"all\" selected>".$lang['gl_all_defenses']."</option>";
		$Result .= "<option value=\"0\">".$lang['tech'][401]."</option>";
		$Result .= "<option value=\"1\">".$lang['tech'][402]."</option>";
		$Result .= "<option value=\"2\">".$lang['tech'][403]."</option>";
		$Result .= "<option value=\"3\">".$lang['tech'][404]."</option>";
		$Result .= "<option value=\"4\">".$lang['tech'][405]."</option>";
		$Result .= "<option value=\"5\">".$lang['tech'][406]."</option>";
		$Result .= "<option value=\"6\">".$lang['tech'][407]."</option>";
		$Result .= "<option value=\"7\">".$lang['tech'][408]."</option>";
		$Result .= "</select>";
		$Result .= "</td>";
		$Result .= "</tr>";
		$Result .= "<tr>";
		$Result .= "<td class=\"c\" colspan=\"2\"><input type=\"submit\" name=\"aktion\" value=\"".$lang['gl_missil_launch_action']."\"></td>";
		$Result .= "</tr>";
		$Result .= "</table>";
		$Result .= "</form>";

		return $Result;
	}

	public function ShowGalaxyRows ($Galaxy, $System, $HavePhalanx, $CurrentGalaxy, $CurrentSystem, $CurrentRC, $CurrentMIP)
	{
		global $planetcount, $dpath, $user, $xgp_root, $phpEx;

		include_once($xgp_root . 'includes/classes/class.GalaxyRows.' . $phpEx);
		$ClassGalaxyRows = new GalaxyRows();

		$UserPoints    = doquery("SELECT * FROM {{table}} WHERE `stat_type` = '1' AND `stat_code` = '1' AND `id_owner` = '". $user['id'] ."';", 'statpoints', true);

		$Result = "";
		for ($Planet = 1; $Planet < 1+(MAX_PLANET_IN_SYSTEM); $Planet++)
		{
			unset($GalaxyRowPlanet);
			unset($GalaxyRowMoon);
			unset($GalaxyRowPlayer);
			unset($GalaxyRowAlly);

			$GalaxyRow = doquery("SELECT * FROM {{table}} WHERE `galaxy` = '".$Galaxy."' AND `system` = '".$System."' AND `planet` = '".$Planet."';", 'galaxy', true);

			$Result .= "\n";
			$Result .= "<tr>";

			if ($GalaxyRow)
			{
				if ($GalaxyRow["id_planet"] != 0)
				{
					$GalaxyRowPlanet = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRow["id_planet"] ."';", 'planets', true);

					if ($GalaxyRowPlanet['destruyed'] != 0 && $GalaxyRowPlanet['id_owner'] != '' && $GalaxyRow["id_planet"] != '')
					{
						$ClassGalaxyRows->CheckAbandonPlanetState ($GalaxyRowPlanet);
					}
					else
					{
						$planetcount++;
						$GalaxyRowPlayer = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRowPlanet["id_owner"] ."';", 'users', true);
					}

					if ($GalaxyRow["id_luna"] != 0)
					{
						$GalaxyRowMoon   = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRow["id_luna"] ."';", 'lunas', true);

						if ($GalaxyRowMoon["destruyed"] != 0)
						{
							$ClassGalaxyRows->CheckAbandonMoonState ($GalaxyRowMoon);
						}
					}

					if ($GalaxyRowPlanet['id_owner'] <> 0)
						$GalaxyRowUser     = doquery("SELECT * FROM {{table}} WHERE `id` = '". $GalaxyRowPlanet['id_owner'] ."';", 'users', true);
					else
						$GalaxyRowUser     = array();

				}
			}

			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowPos        ( $GalaxyRow, $Galaxy, $System, $Planet, 1 );
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowPlanet     ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 1, $HavePhalanx, $CurrentGalaxy, $CurrentSystem);
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowPlanetName ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 1, $HavePhalanx, $CurrentGalaxy, $CurrentSystem);
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowMoon       ( $GalaxyRow, $GalaxyRowMoon  , $GalaxyRowPlayer, $Galaxy, $System, $Planet, 3 );
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowDebris     ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 2, $CurrentRC);
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowUser       ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0, $UserPoints );
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowAlly       ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0 );
			$Result .= "\n";
			$Result .= $ClassGalaxyRows->GalaxyRowActions    ( $GalaxyRow, $GalaxyRowPlanet, $GalaxyRowPlayer, $Galaxy, $System, $Planet, 0, $CurrentGalaxy, $CurrentSystem, $CurrentMIP);
			$Result .= "\n";
			$Result .= "</tr>";
		}
		return $Result;
	}

	public function ShowGalaxySelector ( $Galaxy, $System )
	{
		global $lang;

		if ($Galaxy > MAX_GALAXY_IN_WORLD)
			$Galaxy = MAX_GALAXY_IN_WORLD;

		if ($Galaxy < 1)
			$Galaxy = 1;

		if ($System > MAX_SYSTEM_IN_GALAXY)
			$System = MAX_SYSTEM_IN_GALAXY;

		if ($System < 1)
			$System = 1;

		$Result  = "<form action=\"game.php?page=galaxy&mode=1\" method=\"post\" id=\"galaxy_form\">";
		$Result .= "<input type=\"hidden\" id=\"auto\" value=\"dr\" >";
		$Result .= "<table border=\"0\">";
		$Result .= "<tr><td>";
		$Result .= "<table><tr>";
		$Result .= "<td class=\"c\" colspan=\"3\">".$lang['gl_galaxy']."</td></tr><tr>";
		$Result .= "<td class=\"l\"><input name=\"galaxyLeft\" value=\"&lt;-\" onclick=\"galaxy_submit('galaxyLeft')\" type=\"button\"></td>";
		$Result .= "<td class=\"l\"><input name=\"galaxy\" value=\"". $Galaxy ."\" size=\"5\" maxlength=\"3\" tabindex=\"1\" type=\"text\"></td>";
		$Result .= "<td class=\"l\"><input name=\"galaxyRight\" value=\"-&gt;\" onclick=\"galaxy_submit('galaxyRight')\" type=\"button\"></td>";
		$Result .= "</tr></table>";
		$Result .= "</td><td>";
		$Result .= "<table><tr>";
		$Result .= "<td class=\"c\" colspan=\"3\">".$lang['gl_solar_system']."</td></tr><tr>";
		$Result .= "<td class=\"l\"><input name=\"systemLeft\" value=\"&lt;-\" onclick=\"galaxy_submit('systemLeft')\" type=\"button\"></td>";
		$Result .= "<td class=\"l\"><input name=\"system\" value=\"". $System ."\" size=\"5\" maxlength=\"3\" tabindex=\"2\" type=\"text\"></td>";
		$Result .= "<td class=\"l\"><input name=\"systemRight\" value=\"-&gt;\" onclick=\"galaxy_submit('systemRight')\" type=\"button\"></td>";
		$Result .= "</tr></table>";
		$Result .= "</td></tr>";
		$Result .= "</table>";
		$Result .= "<input value=\"".$lang['gl_show']."\" type=\"submit\">";
		$Result .= "</form>";
		return $Result;
	}

	public function ShowGalaxyTitles ( $Galaxy, $System )
	{
		global $lang;

		$Result  = "\n";
		$Result .= "<tr>";
		$Result .= "<td class=c colspan=8>" . $lang['gl_solar_system'] . " " . $Galaxy.":".$System."</td>";
		$Result .= "</tr><tr>";
		$Result .= "<td class=c>".$lang['gl_pos']."</td>";
		$Result .= "<td class=c>".$lang['gl_planet']."</td>";
		$Result .= "<td class=c>".$lang['gl_name_activity']."</td>";
		$Result .= "<td class=c>".$lang['gl_moon']."</td>";
		$Result .= "<td class=c>".$lang['gl_debris']."</td>";
		$Result .= "<td class=c>".$lang['gl_player_estate']."</td>";
		$Result .= "<td class=c>".$lang['gl_alliance']."</td>";
		$Result .= "<td class=c>".$lang['gl_actions']."</td>";
		$Result .= "</tr>";

		return $Result;
	}
}
?>