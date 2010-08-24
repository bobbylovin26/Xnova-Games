<style type="text/css">
<!--
.style1 {
color: #00FF00;
font-weight: bold;
}
.style2 {color: #00FF00}
-->
</style>
<table width="540" colspan="4">
	<tr>
		<td class="c" colspan="4"><a href="overview.php?mode=renameplanet" title="{Planet_menu}">Planeta "{planet_name}"</a> ({user_username})</td>
	</tr>
        {Have_new_message}
        {Have_new_level_mineur}
        {Have_new_level_raid}
	<tr>
		<th>Hora del servidor</th>
		<th colspan=3>
		<script languaje="JavaScript">
			var mydate=new Date()
			var year=mydate.getYear()
			if (year < 1000)
			year+=1900
			var day=mydate.getDay()
			var month=mydate.getMonth()
			var daym=mydate.getDate()
			if (daym<10)
			daym="0"+daym
			var dayarray=new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado")
			var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
			document.write("<font color='lime' face='Arial' size=''>"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font>")
		</script>
        <form name="Tick">
        	<input type="button" size="12" name="Clock">
        </form>
		<script>
			function show(){
			var Digital=new Date()
			var hours=Digital.getHours()
			var minutes=Digital.getMinutes()
			var seconds=Digital.getSeconds()
			var dn=" AM"
			if (hours> 12){
			dn=" PM"
			hours=hours -12
			}
			if (hours== 0)
			hours=12
			if (minutes<=9)
			minutes="0"+minutes
			if (seconds<=9)
			seconds="0"+seconds
			document.Tick.Clock.value=hours+":"+minutes+":"
			+seconds+" "+dn
			setTimeout("show()",1000)
			}
			show()
		</script>
        </th>
	</tr>
    <tr>
    	{NewsFrame}
    <tr>
		<td colspan="4" class="c">Eventos</td>
	</tr>
		{fleet_list}
	<tr>
		<th>{moon_img}<br />{moon}</th>
		<th colspan="2"><img src="{dpath}planeten/{planet_image}.jpg" height="200" width="200"><br />{building}</th>
		<th>
			<table width="100%" border="0">
				<tr>
					<th colspan="2">Jugador</th>
					<th colspan="2">{user_username}</th>
				</tr>
                <tr>
					<th colspan="2" align="center"><b>Lugar</b></th>
					<th colspan="2" align="center"><b><a href="stat.php?range={u_user_rank}">{user_rank}</a>{max_users}</b></th>         
				</tr>
                <tr>
					<th colspan="4" class="c">Campo de escombros</th>
				</tr>
                <tr>
					<th colspan="4">Metal: {metal_debris} / Cristal: {crystal_debris}</th>
			  </tr>
                <tr>
					<th colspan="4">Puntos generales</th>
				</tr>
                <tr>      
					<th colspan="4">
                    	<table border="0" width="100%">
                        	<tbody>
								<tr>
                                	<td align="right" width="50%" style="background-color: transparent;"><b>Edificios :</b></td>
									<td align="left" width="50%" style="background-color: transparent;"><b>{user_points}</b></td>
                                </tr>
								<tr>
                                	<td align="right" width="50%" style="background-color: transparent;"><b>Flotas :</b></td>
									<td align="left" width="50%" style="background-color: transparent;"><b>{user_fleet}</b></td>
                                </tr>
								<tr>
                                	<td align="right" width="50%" style="background-color: transparent;"><b>Defensa :</b></td>      
									<td align="left" width="50%" style="background-color: transparent;"><b>{user_defs}</b></td>
                                </tr>
                                <tr>
                                	<td align="right" width="50%" style="background-color: transparent;"><b>Investigaci&oacute;n :</b></td>
                                    <td align="left" width="50%" style="background-color: transparent;"><b>{player_points_tech}</b></td>
                               	</tr>
								<tr>
                                	<td align="right" width="50%" style="background-color: transparent;"><b>Totales :</b></td>
									<td align="left" width="50%" style="background-color: transparent;"><b>{total_points}</b></td>
                                </tr>
							</tbody>
						</table>
					</th>
                </tr>
                <tr> 
                    <th colspan="2" align="center">-</th>
                    <th align="center">Minero</th>
                    <th align="center">Guerrero</th>
                </tr>
                <tr> 
                    <th colspan="2" align="center">Nivel</th>
                    <th align="center">{lvl_minier}</th>
                    <th align="center">{lvl_raid}</th>
                </tr>
                <tr>
                    <th colspan="2" align="center">Experiencia</th>
                    <th align="center">{xpminier} / {lvl_up_minier}</th>
                    <th align="center">{xpraid} / {lvl_up_raid}</th>
                </tr>
			</table>
		</th>	
        </tr>
    <tr>
        <th>Otros planetas</th>
        <th class="s" colspan ="4">
            <table class="s" align="top" border="0" style="background-color: transparent;">
            {anothers_planets}
            </table>
        </th>
    </tr>
    <tr>
        <th>Diámetro</th>
        <th colspan="3">{planet_diameter} km (<a title="Campos ocupados">{planet_field_current}</a> / <a title="Campos máximos de construcción">{planet_field_max}</a> campos)</th>
    </tr>
    <tr>
        <th >Campos ocupados</th>
        <th colspan="3" align="center">
        <div  style="border: 1px solid rgb(153, 153, 255); width: 400px;">
        <div  id="CaseBarre" style="background-color: {case_barre_barcolor}; width: {case_barre}px;">
        <font color="#CCF19F">{case_pourcentage}</font>&nbsp;</div>   </th>
    </tr>
    <tr>
        <th>Temperatura</th>
        <th colspan="3">Aprox. {planet_temp_min}º a {planet_temp_max}º</th>
    </tr>
</table> 