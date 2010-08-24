<script>document.body.style.overflow = "auto";</script> 
<body>
<!DOCTYPE HTML>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="../scripts/animatedcollapse.js"></script>
<script type="text/javascript">

animatedcollapse.addDiv('pla', 'fade=1,height=auto')
animatedcollapse.addDiv('inves', 'fade=1,height=auto')
animatedcollapse.addDiv('info', 'fade=1,height=auto')
animatedcollapse.addDiv('recursos', 'fade=1,height=auto')
animatedcollapse.addDiv('edificios', 'fade=1,height=auto')
animatedcollapse.addDiv('especiales', 'fade=1,height=auto')
animatedcollapse.addDiv('naves', 'fade=1,height=auto')
animatedcollapse.addDiv('defensa', 'fade=1,height=auto')
animatedcollapse.addDiv('datos', 'fade=1,height=auto')
animatedcollapse.addDiv('destr', 'fade=1,height=auto')
animatedcollapse.addDiv('alianza', 'fade=1,height=auto')
animatedcollapse.addDiv('puntaje', 'fade=1,height=auto')

animatedcollapse.addDiv('imagen', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('externo', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('interno', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('solicitud', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('puntaje_ali', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('banned', 'fade=0,speed=400,group=pets')

animatedcollapse.ontoggle=function($, divobj, state){
}

animatedcollapse.init()
</script>
<style>
.image{width:100%;height:100%;_height:auto;}
a.link{font-size:14px;font-variant:small-caps;margin-left:120px;}a.link:hover{font-size:16px;font-variant:small-caps;margin-left:120px;}
span.no_moon{font-size:14px;font-variant:small-caps;margin-left:120px;font-family: Arial, Helvetica, sans-serif;}span.no_moon:hover{font-size:14px;font-variant:small-caps;margin-left:120px;color:#FF0000;cursor:default;font-family: Arial, Helvetica, sans-serif;}
a.ccc{font-size:15px;}a.ccc:hover{font-size:15px;color:aqua;}
table.tableunique{border:0px;background:url(images/Adm/blank.gif);width:100%;}
th.unico{border:0px;text-align:left;}
th.unico2{border:0px;text-align:center;}
td{color:#FFFFFF;font-size:11px;font-variant:small-caps;}
</style>


<table class="tableunique">
	<tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('datos')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ac_account_data}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="datos">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c" colspan="2">&nbsp;</td></tr>
			<tr><th height="22px">{ac_id}</th><th>{id}</th></tr>
			<tr><th height="22px">{ac_name}</th><th>{nombre}</th></tr>
			<tr><th height="22px">{ac_mail}</th><th>{email_1}</th></tr>
			<tr><th height="22px">{ac_perm_mail}</th><th>{email_2}</th></tr>
			<tr><th height="22px">{ac_auth_level}</th><th>{nivel}</th></tr>
			<tr><th height="22px">{ac_on_vacation}</th><th>{vacas}</th></tr>
			<tr><th height="22px">{ac_banned}</th><th>{suspen} {mas}</th></tr>
			<tr><th height="22px">{ac_alliance}</th><th>{alianza}{id_ali}</th></tr>
			<tr><th height="22px">{ac_reg_ip}</th><th>{ip}</th></tr>
			<tr><th height="22px">{ac_last_ip}</th><th>{ip2}</th></tr>
			<tr><th height="22px">{ac_checkip_title}</th><th>{ipcheck}</th></tr>
			<tr><th height="22px">{ac_register_time}</th><th>{reg_time}</th></tr>
			<tr><th height="22px">{ac_act_time}</th><th>{onlinetime}</th></tr>
			<tr><th height="22px">{ac_home_planet_id}</th><th>{id_p}</th></tr>
			<tr><th height="22px">{ac_home_planet_coord}</th><th>[{g}:{s}:{p}]</th></tr>
			<tr><th height="22px">{ac_user_system}</th><th>{info}</th></tr>
			<tr><th height="22px">{ac_ranking}</th><th><a href="javascript:animatedcollapse.toggle('puntaje')">{ac_see_ranking}</a></th></tr>
			</table>
			<br>
			
			<!-- PUNTAJE DEL USUARIO -->
			<div id="puntaje" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c" colspan="3" class="centrado2">{ac_user_ranking}</td></tr>
			<td width="15%"></td><td width="40%" class="centrado">{ac_points_count}</td><td width="5%" class="centrado">{ac_ranking}</td>
			<tr><th width="15%" class="centrado">{ac_tenology}</th><th width="40%">{point_tecno} ({count_tecno} {ac_tenology})</th><th width="5%" class="ranking"># {ranking_tecno}</th></tr>
			<tr><th width="15%" class="centrado">{ac_defenses}</th><th width="40%">{point_def} ({count_def} {ac_defenses})</th><th width="5%" class="ranking"># {ranking_def}</th></tr>
			<tr><th width="15%" class="centrado">{ac_fleets}</th><th width="40%">{point_fleet} ({count_fleet} {ac_ships})</th><th width="5%" class="ranking"># {ranking_fleet}</th></tr>
			<tr><th width="15%" class="centrado">{ac_builds}</th><th width="40%">{point_builds} ({count_builds} {ac_builds})</th><th width="5%" class="ranking"># {ranking_builds}</th></tr>
			<tr><th colspan="3" class="total">{ac_total_points}<font color="#FF0000">{total_points}</font></th></tr>
			</table>
			<br>
			</div>
			
			
			<div id="banned" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c" colspan="4">{ac_suspended_title}</td></tr>
			<th>{ac_suspended_time}</th><th>{sus_time}</th>
			<tr><th>{ac_suspended_longer}</th><th>{sus_longer}</th>
			<tr><th>{ac_suspended_reason}</th><th>{sus_reason}</th>
			<tr><th>{ac_suspended_autor}</th><th>{sus_author}</th>
			</table>
			<br>
			</div>
			</div>
		</th>
	</tr><tr>
		<th class="unico">{AllianceHave}</th>
	</tr><tr>
		<th class="unico">
			<div id="alianza" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c" colspan="2">{ac_info_ally}</td></tr>
			<tr><th width="25%" align="center" >ID</th><th>{id_aliz}</th></tr>
			<tr><th>{ac_leader}</th><th>{ali_lider}</th></tr>
			<tr><th>{ac_tag}</th><th>{tag}</th></tr>
			<tr><th>{ac_name_ali}</th><th>{ali_nom}</th></tr>
			<tr><th>{ac_ext_text}</th><th>{ali_ext}</th></tr>
			<tr><th>{ac_int_text}</th><th>{ali_int}</th></tr>
			<tr><th>{ac_sol_text}</th><th>{ali_sol}</th></tr>
			<tr><th>{ac_image}</th><th>{ali_logo}</th></tr>
			<tr><th>{ac_ally_web}</th><th>{ali_web}</th></tr>
			<tr><th>{ac_register_ally_time}</th><th>{ally_register_time}</th></tr>
			<tr><th>{ac_total_members}</th><th>{ali_cant}</th></tr>
			<tr><th>{ac_ranking}</th><th><a href="#" rel="toggle[puntaje_ali]">{ac_see_ranking}</a></th></tr>
			</table>
			<br>

			<div id="imagen" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c">{ac_ali_logo_11}</td></tr>
			<tr><th width="60%"><img src="{ali_logo2}" class="image"/></th></tr>
			<tr><th><a href="{ali_logo2}" target="_blank">{ac_view_image}</a></th></tr>
			<tr><th>{ac_urlnow} <input type="text" size="50" value="{ali_logo2}"></th></tr>
			</table>
			<br>
			</div>

			<div id="externo" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c">{ac_ali_text_11}</td></tr>
			<tr><th width="60%">{ali_ext2}</th></tr>
			</table>
			<br>
			</div>

			<div id="interno" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c">{ac_ali_text_22}</td></tr>
			<tr><th width="60%">{ali_int2}</th></tr>
			</table>
			<br>
			</div>

			<div id="solicitud" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c">{ac_ali_text_33}</td></tr>
			<tr><th width="60%">{ali_sol2}</th></tr>
			</table>
			<br>
			</div>

			<!-- PUNTAJE DE LA ALIANZA DEL USUARIO -->
			<div id="puntaje_ali" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr><td class="c" colspan="3">{ac_ally_ranking}</td></tr>
			<td width="15%"></td><td width="40%">{ac_points_count}</td><td width="5%" class="centrado">{ac_ranking}</td>
			<tr><th width="15%">{ac_tenology}</th><th width="40%">{point_tecno_ali} ({count_tecno_ali} {ac_tenology})</th><th width="5%"># {ranking_tecno_ali}</th></tr>
			<tr><th width="15%">{ac_defenses}</th><th width="40%">{point_def_ali} ({count_def_ali} {ac_defenses})</th><th width="5%"># {ranking_def_ali}</th></tr>
			<tr><th width="15%">{ac_fleets}</th><th width="40%">{point_fleet_ali} ({count_fleet_ali} {ac_ships})</th><th width="5%"># {ranking_fleet_ali}</th></tr>
			<tr><th width="15%">{ac_builds}</th><th width="40%">{point_builds_ali} ({count_builds_ali} {ac_builds})</th><th width="5%"># {ranking_builds_ali}</th></tr>
			<tr><th colspan="3">{ac_total_points}<font color="#FF0000">{total_points_ali}</font></th></tr>
			</table>
			<br>
			</div>
			</div>
		</th>
	</tr><tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('pla')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ac_id_names_coords}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="pla" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" width="70%" align="center">
			<tr>
				<td class="c">{ac_name}</td>
				<td class="c">{ac_id}</td>
				<td class="c">{ac_diameter}</td>
				<td class="c">{ac_fields}</td>
				<td class="c">{ac_temperature}</td>
			</tr>
				{planets_moons}
			</table>
			<br>
			</div>
		</th>
	</tr><tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('recursos')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ac_resources}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="recursos" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" width="70%" align="center">
			<tr>
				<td class="c"></td>
				<td class="c">{Metal}</td>
				<td class="c">{Crystal}</td>
				<td class="c">{Deuterium}</td>
				<td class="c">{Energy}</td>
			</tr>
				{resources}
			<tr>
				<th colspan="5" height="30px">{Darkmatter}: &nbsp;&nbsp;{mo}</th>
			</tr>
			</table>
			<br />
			</div>	
		</th>
	</tr><tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('edificios')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ad_buildings}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="edificios" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" width="100%" align="center">
			<td class="c" colspan="16">&nbsp;</td>
			<tr>
				<td width="10%"></td>
				<td width="10%">{ad_metal_mine}</td>
				<td width="10%">{ad_crystal_mine}</td>
				<td width="10%">{ad_deuterium_sintetizer}</td>
				<td width="10%">{ad_solar_plant}</td>
				<td width="10%">{ad_fusion_plant}</td>
				<td width="10%">{ad_robot_factory}</td>
				<td width="10%">{ad_nano_factory}</td>
				<td width="10%">{ad_shipyard}</td>
				<td width="10%">{ad_metal_store}</td>
				<td width="10%">{ad_crystal_store}</td>
				<td width="10%">{ad_deuterium_store}</td>
				<td width="10%">{ad_laboratory}</td>
				<td width="10%">{ad_terraformer}</td>
				<td width="10%">{ad_ally_deposit}</td>
				<td width="10%">{ad_silo}</td>
			</tr>
				{buildings}
			</table>
			<br />
			</div>
		</th>
	</tr><tr>
		<th class="unico">{MoonHave}</th>
	</tr><tr>
		<th class="unico">
			<div id="especiales" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="70%">
			<tr>
				<td class="c" width="10%">&nbsp;</td>
				<td class="c" width="10%">{ac_lunar_base}</td>
				<td class="c" width="10%">{ac_phalanx}</td>
				<td class="c" width="10%">{ac_jump_gate}</td>
			</tr>
				{moon_buildings}
			</table>
			<br />
			</div>
		</th>
	</tr><tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('naves')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ac_ships}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="naves" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="100%">
			<tr><td class="c" colspan="20">&nbsp;</td></tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td width="10%">{ad_small_ship_cargo}</td>
				<td width="10%">{ad_big_ship_cargo}</td>
				<td width="10%">{ad_light_hunter}</td>
				<td width="10%">{ad_heavy_hunter}</td>
				<td width="10%">{ad_crusher}</td>
				<td width="10%">{ad_battle_ship}</td>
				<td width="10%">{ad_colonizer}</td>
				<td width="10%">{ad_recycler}</td>
				<td width="10%">{ad_spy_sonde}</td>
				<td width="10%">{ad_bomber_ship}</td>
				<td width="10%">{ad_solar_satelit}</td>
				<td width="10%">{ad_destructor}</td>
				<td width="10%">{ad_dearth_star}</td>
				<td width="10%">{ad_battleship}</td>
				<td width="10%">{ac_supernova}</td>
			</tr>
				{ships}
			</table>
			<br />
			</div>
		</th>
	</tr><tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('defensa')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ac_defense}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="defensa" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="100%">
			<tr><td class="c" colspan="20">&nbsp;</td></tr>
			<tr>
				<td width="10%">&nbsp;</td>
				<td width="10%">{ad_misil_launcher}</td>
				<td width="10%">{ad_small_laser}</td>
				<td width="10%">{ad_big_laser}</td>
				<td width="10%">{ad_gauss_canyon}</td>
				<td width="10%">{ad_ionic_canyon}</td>
				<td width="10%">{ad_buster_canyon}</td>
				<td width="10%">{ad_small_protection_shield}</td>
				<td width="10%">{ad_big_protection_shield}</td>
				<td width="10%">{ac_planet_protector}</td>
				<td width="10%">{ad_interceptor_misil}</td>
				<td width="10%">{ad_interplanetary_misil}</td>
			</tr>
				{defenses}
			</table>
			<br />
			</div>
		</th>
	</tr><tr>
		<th class="unico"><a href="javascript:animatedcollapse.toggle('inves')" class="link">
		<img src="../styles/images/Adm/arrowright.png" width="16" height="10"/> {ac_officier_research}</a></th>
	</tr><tr>
		<th class="unico">
			<div id="inves" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr>
			<td class="c" width="50%">{ac_research}</td>
			<td class="c" width="50%">{ac_officier}</td>
			</tr>
			<tr><th>{ad_spy_tech}: <font color=aqua>{tec_espia}</font></th><th>{ac_geologist}: <font color=aqua>{ofi_geologo}</font></th></tr>
			<tr><th>{ad_computer_tech}: <font color=aqua>{tec_compu}</font></th><th>{ac_admiral}: <font color=aqua>{ofi_almirante}</font></th></tr>
			<tr><th>{ad_military_tech}: <font color=aqua>{tec_militar}</font></th><th>{ac_engineer}: <font color=aqua>{ofi_ingeniero}</font></th></tr>
			<tr><th>{ad_defence_tech}: <font color=aqua>{tec_defensa}</font></th><th>{ac_technocrat}: <font color=aqua>{ofi_tecnocrata}</font></th></tr>
			<tr><th>{ad_shield_tech}: <font color=aqua>{tec_blindaje}</font></th><th>{ac_spy}: <font color=aqua>{ofi_espia}</font></th></tr>
			<tr><th>{ad_energy_tech}: <font color=aqua>{tec_energia}</font></th><th>{ac_constructor}: <font color=aqua>{ofi_constructor}</font></th></tr>
			<tr><th>{ad_hyperspace_tech}: <font color=aqua>{tec_hiperespacio}</font></th><th>{ac_scientific}: <font color=aqua>{ofi_cientifico}</font></th></tr>
			<tr><th>{ad_combustion_tech}: <font color=aqua>{tec_combustion}</font></th><th>{ac_commander}: <font color=aqua>{ofi_comandante}</font></th></tr>
			<tr><th>{ad_impulse_motor_tech}: <font color=aqua>{tec_impulso}</font></th><th>{ac_storer}: <font color=aqua>{ofi_almacenista}</font></th></tr>
			<tr><th>{ad_hyperspace_motor_tech}: <font color=aqua>{tec_hiperespacio_p}</font></th><th>{ac_defender}: <font color=aqua>{ofi_defensa}</font></th></tr>
			<tr><th>{ad_laser_tech}: <font color=aqua>{tec_laser}</font></th><th>{ac_destroyer}: <font color=aqua>{ofi_destructor}</font></th></tr>
			<tr><th>{ad_ionic_tech}: <font color=aqua>{tec_ionico}</font></th><th>{ac_general}: <font color=aqua>{ofi_general}</font></th></tr>
			<tr><th>{ad_buster_tech}: <font color=aqua>{tec_plasma}</font></th><th>{ac_protector}: <font color=aqua>{ofi_bunker}</font></th></tr>
			<tr><th>{ad_intergalactic_tech}: <font color=aqua>{tec_intergalactico}</font></th><th>{ac_conqueror}: <font color=aqua>{ofi_conquis}</font></th></tr>
			<tr><th>{ad_expedition_tech}: <font color=aqua>{tec_expedicion}</font></th><th>{ac_emperor}: <font color=aqua>{ofi_emperador}</font></th></tr>
			<tr><th>{ad_graviton_tech}: <font color=aqua>{tec_graviton}</font></th></tr>
			</table>
			<br />
			</div>
		</th>
	</tr><tr>
		<th class="unico">{DestructionHave}</th>
	</tr><tr>
		<th class="unico">
			<div id="destr" style="display:none">
			<table cellspacing="0" style="border-collapse: collapse" align="center" width="60%">
			<tr>
				<td class="c">{ac_name}</td>
				<td class="c">{ac_id}</td>
				<td class="c">{ac_coords}</td>
				<td class="c">{ac_time_destruyed}</td>
			</tr>
				{destroyed}
			</table>
			<br />
			</div>
		</th>
	</tr><tr>
		<th height="100px" class="unico2">
		<a onMouseOver='return overlib("{ac_note_k}{ac_note_m}{ac_note_b}{ac_note_t}{ac_note_c}", CENTER, OFFSETX, -160, OFFSETY, -80, WIDTH, 250);' onMouseOut='return nd();' class="ccc">
		[Leyenda]</a></th>
	</tr>
</table>

<br><br><br><br>
</body>