<br />
<form action="" method="post">
<table width="400">
<tr>
	<td class="c" colspan="2">Banear jugador</td>
</tr><tr>
	<th width="200">Nombre de usuario</th>
	<th width="200"><input name="ban_name" type="text" size="25" /></th>
</tr><tr>
	<th>Razón del baneo</th>
	<th><input name="why" type="text" value="" size="25" maxlength="50"></th>
</tr><tr>
	<td class="c" colspan="2">Tiempo de baneo</td>
</tr><tr>
	<th>Días</th>
	<th><input name="days" type="text" value="0" size="5" /></th>
</tr><tr>
	<th>Horas</th>
	<th><input name="hour" type="text" value="0" size="5" /></th>
</tr><tr>
	<th>Minutos</th>
	<th><input name="mins" type="text" value="0" size="5" /></th>
</tr><tr>
	<th>Segundos</th>
	<th><input name="secs" type="text" value="0" size="5" /></th>
</tr><tr>
	<th colspan="2"><input type="submit" value="Banear jugador" /></th>
</tr>
</table>
</form>
<br />
<form action="" method="post">
<table width="400">
<tr>
	<td class="c" colspan="2">Desbanear jugador</td>
</tr><tr>
	<th width="200">Nombre del jugador</th>
	<th width="200"><input name="unban_name" maxlength="80" size="25" value="" type="text"></th>
</tr><tr>
	<th colspan="2"><input value="Desbanear" type="submit"></th>
</tr>
</table>
</form>