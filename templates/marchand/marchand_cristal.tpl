<script type="text/javascript" >
function calcul() {
	var Metal = document.forms['marchand'].elements['metal'].value;
	var Deuterium = document.forms['marchand'].elements['deut'].value;

	Metal = Metal * {mod_ma_res_a};
	Deuterium = Deuterium * {mod_ma_res_b};

	var Cristal = Metal + Deuterium;
	document.getElementById("cristal").innerHTML=Cristal;

	if (isNaN(document.forms['marchand'].elements['metal'].value)) {
		document.getElementById("cristal").innerHTML="Sólo números";
	}
	if (isNaN(document.forms['marchand'].elements['deut'].value)) {
		document.getElementById("cristal").innerHTML="Sólo números";
	}
}
</script>
<br />
<div id="content">
    <form id="marchand" action="marchand.php" method="post">
    <input type="hidden" name="ress" value="cristal">
    <table width="569">
    <tr>
        <td class="c" colspan="5"><b>Venta de cristal</b></td>
    </tr><tr>
        <th>Recurso</th>
        <th>Cantidad</th>
        <th>Cuota de intercambio</th>
    </tr><tr>
        <th>Cristal</th>
        <th><span id='cristal'></span>&nbsp;</th>
        <th>{mod_ma_res}</th>
    </tr><tr>
        <th>Metal</th>
        <th><input name="metal" type="text" value="0" onkeyup="calcul()"/></th>
        <th>{mod_ma_res_a}</th>
    </tr><tr>
        <th>Deuterio</th>
        <th><input name="deut" type="text" value="0" onkeyup="calcul()"/></th>
        <th>{mod_ma_res_b}</th>
    </tr><tr>
        <th colspan="6"><input type="submit" value="Intercambiar" /></th>
    </tr>
    </table>
    </form>
</div>