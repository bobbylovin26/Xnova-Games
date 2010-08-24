<center>
<br><br>
<form action="{PHP_SELF}?mode=change" method="post">
<table width="519">
<tbody>
{opt_adm_frame}
<tr>
	<td class="c" colspan="2">Informacion del jugador</td>
</tr><tr>
	<th>Nombre del jugador</th>
	<th><input name="db_character" size="20" value="{opt_usern_data}" type="text"></th>
</tr><tr>
	<th>Contaseña antigua</th>
	<th><input name="db_password" size="20" value="" type="password"></th>
</tr><tr>
	<th>Nueva contraseña (Min. 8 caracteres)</th>
	<th><input name="newpass1"    size="20" maxlength="40" type="password"></th>
</tr><tr>
	<th>Repetir contraseña anterior</th>
	<th><input name="newpass2"    size="20" maxlength="40" type="password"></th>
</tr><tr>
	<th><a title="Puedes cambiar esta dirección en cualquier momento. La misma será permanente sino es modificada dentro de los próximos 7 días.">Direccion de email</a></th>
	<th><input name="db_email" maxlength="100" size="20" value="{opt_mail1_data}" type="text"></th>
</tr><tr>
	<th>Direccion e-mail permanente</th>
	<th>{opt_mail2_data}</th>
</tr><tr>
	<th colspan="2"></th>
</tr><tr>
	<td class="c" colspan="2">Opciones generales</td>
</tr><tr>
	<th>Clasificar los planetas en el orden siguiente:</th>
	<th>
		<select name="settings_sort">
		{opt_lst_ord_data}
		</select>
	</th>
</tr><tr>
	<th>Orden de clasificación:</th>
	<th>
		<select name="settings_order">
		{opt_lst_cla_data}
		</select>
	</th>
</tr><tr>
	<th>Skins (p.e. /css/)<br> <a href="http://80.237.203.201/download/" target="_blank">Descargar</a></th>
	<th><input name="dpath" maxlength="80" size="40" value="{opt_dpath_data}" type="text"> <br>
		<select name="dpaths" size="1">
			<option selected="selected">  </option>
			{opt_lst_skin_data}
		</select>
	</th>
</tr><tr>
	<th>Usar el skin</th>
	<th><input name="design"{opt_sskin_data} type="checkbox"></th>
</tr><tr>
	<th><a title="Con esto podrás prevenir que alguien con una IP distinta se conecte a tu cuenta.">Desactivar la verificacion IP</a></th>
	<th><input name="noipcheck"{opt_noipc_data} type="checkbox" /></th>
</tr><tr>
	<td class="c" colspan="2">Parametros para ver la Galaxia</td>
</tr><tr>
	<th><a title="Cantidad máx. de sondas a enviar de la galaxia.">Cantidad de sondas</a></th>
	<th><input name="spio_anz" maxlength="2" size="2" value="{opt_probe_data}" type="text"></th>
</tr><tr>
	<th>Informacion sobre herramientas</th>
	<th><input name="settings_tooltiptime" maxlength="2" size="2" value="{opt_toolt_data}" type="text"> segundos</th>
</tr><tr>
	<th>Número máx. de mensajes de flota</th>
	<th><input name="settings_fleetactions" maxlength="2" size="2" value="{opt_fleet_data}" type="text"></th>
</tr><tr>
	<th>Mostrar el logo de las alianzas</th>
	<th><input name="settings_allylogo"{opt_allyl_data} type="checkbox" /></th>
</tr><tr>
	<td align="center" class="c">Acceso directo</td>
	<td align="center" class="c">Mostrar</td>
</tr><tr>
	<th><img src="{dpath}img/e.gif" alt=""> Espiar</th>
	<th><input name="settings_esp"{user_settings_esp} type="checkbox" /></th>
</tr><tr>
	<th><img src="{dpath}img/m.gif" alt=""> Escribir mensaje</th>
	<th><input name="settings_wri"{user_settings_wri} type="checkbox" /></th>
</tr><tr>
	<th><img src="{dpath}img/b.gif" alt=""> Agregar a la lista de amigos</th>
	<th><input name="settings_bud"{user_settings_bud} type="checkbox" /></th>
</tr><tr>
	<th><img src="{dpath}img/r.gif" alt=""> Ataque con misiles</th>
	<th><input name="settings_mis"{user_settings_mis} type="checkbox" /></th>
</tr><tr>
	<th><img src="{dpath}img/s.gif" alt=""> Enviar reporte</th>
	<th><input name="settings_rep"{user_settings_rep} type="checkbox" /></th>
</tr><tr>
	<td class="c" colspan="2">Otras opciones</td>
</tr><tr>
	<th><a title="El modo vacaciones protege tu cuenta durante tu ausencia">Activar modo vacaciones</a></th>
	<th><input name="urlaubs_modus"{opt_modev_data} type="checkbox" /></th>
</tr><tr>
	<th><a title="Seleccionando esta opciones borrarás tu cuenta dentro de 7 días">Borrar cuenta</a></th>
	<th><input name="db_deaktjava"{opt_delac_data} type="checkbox" /></th>
</tr><tr>
	<th colspan="2"><input value="Guardar cambios" type="submit"></th>
</tr>
</tbody>
</table>
</form>
</center>