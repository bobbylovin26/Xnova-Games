
<br><br>
<h2>{adm_defdel1}</h2>
<form action="del_def.php" method="post">
<input type="hidden" name="mode" value="addit">
<table width="404">
<tbody>
<tr>
	<td class="c" colspan="7">{adm_defdel2}</td>
</tr><tr>
	<th width="20"></th>
	<th width="130">{adm_am_plid}</th>
	<th width="300"><input name="id" type="text" value="0" size="3" /></th>
</tr><tr>
	<td class="c" colspan="6">&nbsp;</td>
</tr><tr>
	<th>{nr}</th>
	<th>D&eacute;fenses</th>
	<th>{hinz}</th>
</tr><tr>
	<th>1</td>
	<th>Lanceur de Missilles</th>
	<th><input name="misil_launcher" type="text" value="0" /></th>
</tr><tr>
	<th>2</td>
	<th>Artillerie laser l&eacute;g&egrave;re</td>
	<th><input name="small_laser" type="text" value="0" /></th>
</tr><tr>
	<th>3</td>
	<th>Artillerie laser lourde</td>
	<th><input name="big_laser" type="text" value="0" /></th>
</tr><tr>
	<th>4</td>
	<th>Canon de Gauss</td>
	<th><input name="gauss_canyon" type="text" value="0" /></th>
</tr><tr>
	<th>5</td>
	<th>Artillerie &agrave; ions</td>
	<th><input name="ionic_canyon" type="text" value="0" /></th>
</tr><tr>
	<th>6</td>
	<th>Lanceur de plasma</td>
	<th><input name="buster_canyon" type="text" value="0" /></th>
</tr><tr>
	<th>7</td>
	<th>Petit bouclier</td>
	<th><input name="small_protection_shield" type="text" value="0" /></th>
</tr><tr>
	<th>8</td>
	<th>Grand bouclier</td>
	<th><input name="big_protection_shield" type="text" value="0" /></th>
</tr><tr>
	<th>9</td>
	<th>Missile Interception</td>
	<th><input name="interceptor_misil" type="text" value="0" /></th>
</tr><tr>
	<th>10</td>
	<th>Missile Interplan&eacute;taire</td>
	<th><input name="interplanetary_misil" type="text" value="0" /></th>

</tr><tr>
	<th colspan="3"><input type="Submit" value="{adm_am_add}" /></th>
</tbody>
</tr>
</table>
</form>