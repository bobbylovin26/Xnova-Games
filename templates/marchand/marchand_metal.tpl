<script type="text/javascript" >
function calcul() {
	var Cristal = document.forms['marchand'].elements['cristal'].value;
	var Deuterium = document.forms['marchand'].elements['deut'].value;

	Cristal   = Cristal * {mod_ma_res_a};
	Deuterium = Deuterium * {mod_ma_res_b};

	var Metal = Cristal + Deuterium;
	document.getElementById("met").innerHTML = Metal;

	if (isNaN(document.forms['marchand'].elements['cristal'].value)) {
		document.getElementById("met").innerHTML = "S�lo n�meros";
	}
	if (isNaN(document.forms['marchand'].elements['deut'].value)) {
		document.getElementById("met").innerHTML = "S�lo n�meros";
	}
}
</script>
<br />
<div id="content">
    <form id="marchand" action="marchand.php" method="post">
    <input type="hidden" name="ress" value="metal">
    <table width="569">
    <tr>
        <td class="c" colspan="5"><b>Venta de metal</b></td>
    </tr><tr>
        <th>Recurso</th>
        <th>Cantidad</th>
        <th>Cuota de intercambio</th>
    </tr><tr>
        <th>Metal</th>
        <th><span id='met'></span>&nbsp;</th>
        <th>{mod_ma_res}</th>
    </tr><tr>
        <th>Cristal</th>
        <th><input name="cristal" type="text" value="0" onkeyup="calcul()"/></th>
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