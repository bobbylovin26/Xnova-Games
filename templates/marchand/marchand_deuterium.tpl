<script type="text/javascript" >
function calcul() {
	var Metal   = document.forms['marchand'].elements['metal'].value;
	var Cristal = document.forms['marchand'].elements['cristal'].value;

	Metal   = Metal * {mod_ma_res_a};
	Cristal = Cristal * {mod_ma_res_b};

	var Deuterium = Metal + Cristal;
	document.getElementById("deuterio").innerHTML=Deuterium;

	if (isNaN(document.forms['marchand'].elements['metal'].value)) {
		document.getElementById("deuterio").innerHTML="S�lo n�meros";
	}
	if (isNaN(document.forms['marchand'].elements['cristal'].value)) {
		document.getElementById("deuterio").innerHTML="S�lo n�meros";
	}
}
</script>
<br />
<div id="content">
    <form id="marchand" action="marchand.php" method="post">
    <input type="hidden" name="ress" value="deuterium">
    <table width="569">
    <tr>
        <td class="c" colspan="5"><b>Venta de deuterio</b></td>
    </tr><tr>
        <th>Recurso</th>
        <th>Cantidad</th>
        <th>Cuota de intercambio</th>
    </tr><tr>
        <th>Deuterio</th>
        <th><span id='deuterio'></span>&nbsp;</th>
        <th>{mod_ma_res}</th>
    </tr><tr>
        <th>Metal</th>
        <th><input name="metal" type="text" value="0" onkeyup="calcul()"/></th>
        <th>{mod_ma_res_a}</th>
    </tr><tr>
        <th>Cristal</th>
        <th><input name="cristal" type="text" value="0" onkeyup="calcul()"/></th>
        <th>{mod_ma_res_b}</th>
    </tr><tr>
        <th colspan="6"><input type="submit" value="Intercambiar" /></th>
    </tr>
    </table>
    </form>
</div>