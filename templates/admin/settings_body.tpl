<br />
<form action="" method="post">
<input type="hidden" name="opt_save" value="1">
<table width="519" style="color:#FFFFFF" cellpadding="2" cellspacing="2">
<tbody>
<tr>
	<td class="c" colspan="2">Parámetros del servidor</td>
</tr><tr>
	<th>Nombre</th>
	<th><input name="game_name"  size=20 value="{game_name}" type=text></th>
</tr><tr>
	<th>Velocidad general</th>
	<th><input name="game_speed" size="15" value="{game_speed}" type="text"> / x2500(velocidad normal)</th>
</tr><tr>
	<th>Velocidad de las flotas</th>
	<th><input name="fleet_speed" size="15" value="{fleet_speed}" type="text"> / x2500(velocidad normal)</th>
</tr><tr>
	<th>Ajuste del puntaje</th>
	<th>Un punto equivale a <input name="stat_settings" size="15" value="{stat_settings}" type="text"> en recursos gastados</th>
</tr><tr>
	<th>Velocidad de producción</th>
	<th><input name="resource_multiplier" maxlength="8" size="10" value="{resource_multiplier}" type="text">/ x1(velocidad normal)</th>
</tr><tr>
	<th>Enlace del foro<br /></th>
	<th><input name="forum_url" size="40" maxlength="254" value="{forum_url}" type="text"></th>
</tr><tr>
	<th>Estado del servidor (on/off)<br /></th>
	<th><input name="closed"{closed} type="checkbox" /></th>
</tr><tr>
	<th>Mensaje del estado off-line<br /></th>
	<th><textarea name="close_reason" cols="80" rows="5" size="80" >{close_reason}</textarea></th>
</tr><tr>
	<td class="c" colspan="2">Parámetros de los mensajes</td>
</tr><tr>
	<th>BB Code<br />(1 = Act. | 0 = Inac.)</th>
	<th><input name="bbcode_field" size="1" maxlength="254" value="{enable_bbcode}" type="text"></th>
</tr>
<tr>
	<td class="c" colspan="2">Parámetros de los planetas nuevos</td>
</tr><tr>
	<th>Campos iniciales</th>
	<th><input name="initial_fields" maxlength="80" size="10" value="{initial_fields}" type="text"> campos </th>
</tr><tr>
	<th>Producción de metal</th>
	<th><input name="metal_basic_income" maxlength="2" size="10" value="{metal_basic_income}" type="text"> por hora</th>
</tr><tr>
	<th>Producción de cristal</th>
	<th><input name="crystal_basic_income" maxlength="2" size="10" value="{crystal_basic_income}" type="text"> por hora</th>
</tr><tr>
	<th>Producción de deuterio</th>
	<th><input name="deuterium_basic_income" maxlength="2" size="10" value="{deuterium_basic_income}" type="text"> por hora</th>
</tr><tr>
	<th>Producción de energía</th>
	<th><input name="energy_basic_income" maxlength="2" size="10" value="{energy_basic_income}" type="text"> por hora</th>
</tr>
<tr>
	<td class="c" colspan="2">Parámetros varios</td>
</tr><tr>
	<th>Desactivar estadisticas<br></th>
    <th><input name="stat" {actived} type="checkbox" /><input name="stat_level" type="text" value='{stat_level}'></th>
</tr><tr>
	<th>Mostrar noticias</th>
	<th><input name="newsframe"{newsframe} type="checkbox" /></th>
</tr><tr>
	<th colspan="2"><textarea name="NewsText" cols="80" rows="5" size="80" >{NewsTextVal}</textarea></th>
</tr><tr>
	<th>Modo debug</a></th>
	<th><input name="debug"{debug} type="checkbox" /></th>
</tr></tr>
	<th colspan="3"><input value="Guardar parámetros" type="submit"></th>
</tr>
</tbody>
</table>
</form>