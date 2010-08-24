<script src="scripts/cntchar.js" type="text/javascript"></script>
<br>
<table width=519>
	<tr>
	  <td class=c colspan=2>Administrar la alianza</td>
	</tr>
	<tr>
	  <th colspan=2><a href="?mode=admin&edit=rights">Ajustar rangos</a></th>
	</tr>
	<tr>
	  <th colspan=2><a href="?mode=admin&edit=members">Administrar miembros</a></th>
	</tr>
	<tr>
	  <th colspan=2><a href="?mode=admin&edit=tag">Cambiar la etiqueta de la alianza</a></th>
	</tr>
	<tr>
	  <th colspan=2><a href="?mode=admin&edit=name">Cambiar el nombre de la alianza</a></th>
	</tr>
</table>
<br>
<form action="" method="POST">
<input type="hidden" name="t" value="{t}">
<table width=519>
	<tr>
	  <td class="c" colspan="3">Textos</td>
	</tr>
	<tr>
	  <th><a href="?mode=admin&edit=ally&t=1">Texto Externo</a></th>
	  <th><a href="?mode=admin&edit=ally&t=2">Texto Interno</a></th>
      <th><a href="?mode=admin&edit=ally&t=3">Texto de solicitud</a></th>
	</tr>
	<tr>
	  <td class=c colspan=3>Mensaje (<span id="cntChars">0</span> / 5000 caracteres)</td>
	</tr>
	<tr>
	  <th colspan="3"><textarea name="text" cols=70 rows=15 onkeyup="javascript:cntchar(5000)">{text}</textarea>
{request_type}
	</th>
	</tr>
	<tr>
	  <th colspan=3>
	  <input type="hidden" name=t value={t}><input type="reset" value="Limpiar"> 
	  <input type="submit" value="Guardar">
	  </th>
	</tr>
</table>
</form>

<br>

<form action="" method="POST">
<table width=519>
	<tr>
	  <td class=c colspan=2>Opciones</td>
	</tr>
	<tr>
	  <th>Sitio web</th>
	  <th><input type=text name="web" value="{ally_web}" size="70"></th>
	</tr>
	<tr>
	  <th>Imágen de la alianza</th>
	  <th><input type=text name="image" value="{ally_image}" size="70"></th>
	</tr>
	<tr>
	  <th>Solicitudes</th>
	  <th>
	  <select name="request_notallow"><option value=1{ally_request_notallow_0}>No permitidas(alianza cerrada)</option>
	  <option value=0{ally_request_notallow_1}>Permitidas(alianza abierta)</option></select>
	  </th>
	</tr>
	<tr>
	  <th>Rango del fundador</th>
	  <th><input type="text" name="owner_range" value="{ally_owner_range}" size=30></th>
	</tr>
	<tr>
	  <th colspan=2><input type="submit" name="options" value="Guardar"></th>
	</tr>
</table>
</form>
<br />
{Disolve_alliance}
<br />
{Transfer_alliance}