<br>
<form action="notes.php" method=post>
  <table width=519>
	<tr>
	  <td class=c colspan=4>Notas</td>
	</tr>
	<tr>
	  <th colspan=4><a href="{PHP_SELF}?a=1">Crear nueva nota</a></th>
	</tr>
	<tr>
	  <td class="c">&nbsp;</td>
	  <td class="c">Fecha</td>
	  <td class="c">Asunto</td>
	  <td class="c">Tamaño</td>
	</tr>

	{BODY_LIST}

<tr>
	  <td colspan=4><input value="Borrar" type="submit"></td>
	</tr>
  </table>
</form>
</center>
</body>
</html>