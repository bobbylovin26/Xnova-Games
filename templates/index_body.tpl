<div id="main">
<script type="text/javascript">
var lastType = "";
function changeAction(type) {
	if (document.formular.Uni.value == '') {
		alert('{log_univ}');
	} else {
		if(type == "login" && lastType == "") {
			var url = "http://" + document.formular.Uni.value + "";
			document.formular.action = url;
		} else {
			var url = "http://" + document.formular.Uni.value + "/reg.php";
			document.formular.action = url;
			document.formular.submit();
		}
	}
}
</script>
<div id="login">
<div id="login_input">
<form name="formular" action="" method="post" onsubmit="changeAction('login');">
<table width="400" border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr style="vertical-align: top;">
	<td style="padding-right: 4px;">
		Usuario <input name="username" value="" type="text">
		Contraseña <input name="password" value="" type="password">
	</td>
</tr><tr>
	<td style="padding-right: 4px;">
		Recordar Contraseña <input name="rememberme" type="checkbox"> <script type="text/javascript">document.formular.Uni.focus(); </script><input name="submit" value="Ingresar" type="submit">
	</td>
</tr><tr>
	<td style="padding-right: 4px;">
		<a href="index.php?claveperdida=ok">¿Olvidaste tu Contraseña?</a>
	</td>
</tr>
</tbody>
</table>
</form>
</div>
</div>
<div id="mainmenu" style="margin-top: 20px;">
<a href="reg.php">Registrarse</a>
<a href="{forum_url}">Foros</a>
<a href="contact.php">Contacto</a>
<a href="credit.php">Créditos</a>
</div>
<div id="rightmenu" class="rightmenu">
<div id="title">Bienvenido a {servername}</div>
<div id="content">
<center>
<div id="text1">
<div style="text-align: left;"><strong>{servername}</strong> es un <strong>juego de simulacion estratégica espacial</strong> con <strong>miles de jugadores</strong> a lo largo del mundo compitiendo por ser el mejor <strong>simultáneamente</strong>. Todo lo que necesitas para jugar, es un navegador web estándar. 
</div>
</div>
<div id="register" class="bigbutton" onclick="document.location.href='reg.php';"><font color="#cc0000">¡Registrate!</font></div>
<div id="text2">
<div id="text3">
<center><b>¡Únete ya y forma parte del fantástico mundo de {servername}!</b></center>
</div>
</div>
</center>
</div>
</div>
</div>