<script src="scripts/cntchar.js" type="text/javascript"></script>

<form action="?mode=circular&sendmail=1" method="POST">
  <table width="530">
	<tr>
	  <td class="c" colspan=2>Enviar correo circular</td>
	</tr>
	<tr>
	  <th>Destinatario</th>
	  <th>
		<select name="r">
		  {r_list}
		</select>
	  </th>
	</tr>
	<tr>
	  <th>Mensaje (<span id="cntChars">0</span> / 5000 caracteres)</th>
	  <th>
	    <textarea name="text" cols="60" rows="10" onkeyup="javascript:cntchar(5000)"></textarea>
	  </th>
	</tr>
	<tr>
	  <td class="c"><a href="alliance.php">Volver</a></td>
	  <td align="center" class="c">
		<input type="reset" value="Limpiar">
		<input type="submit" value="Enviar">
	  </td>
	</tr>
  </table>
</form>
