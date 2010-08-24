<tr>
  <th colspan="2">
<br>Crear cuenta de administración<br>
Con esta cuenta podrás administrar el juego<br><br>
<table width="270" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>Usuario:</td>
    <td><input name="adm_user" size="20" maxlength="20" type="text" onKeypress="
     if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
     if (event.which==60 || event.which==62) return false;"></td>
  </tr>
  <tr>
    <td>Contraseña:</td>
    <td><input name="adm_pass" size="20" maxlength="20" type="password" onKeypress="
     if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
     if (event.which==60 || event.which==62) return false;"></td>
  </tr>
  <tr>
    <td>Correo electrónico:</td>
    <td><input name="adm_email" size="20" maxlength="40" type="text" onKeypress="
     if (event.keyCode==60 || event.keyCode==62) event.returnValue = false;
     if (event.which==60 || event.which==62) return false;"></td>
  </tr>
</table>
<br>
</th>
</tr>
<tr>
  <th colspan="2"><input type="button" name="next" onclick="submit();" value="Crear" ></th>
</tr>