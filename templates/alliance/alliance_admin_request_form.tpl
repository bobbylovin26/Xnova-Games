<br />
<div id="content">
	<script src="scripts/cntchar.js" type="text/javascript"></script>
    <form action="alliance.php?mode=admin&edit=requests&show={id}&sort=0" method="POST">
       <tr>
         <th colspan="2">{Request_from}</th>
       </tr>
       <tr>
         <th colspan="2">{ally_request_text}</th>
       </tr>
       <tr>
         <td class="c" colspan=2>Respuesta a la solicitud</td>
       </tr>
       <tr>
         <th>Motivo <span id="cntChars">0</span> / 500 caracteres</th>
         <th><textarea name="text" cols=40 rows=10 onkeyup="javascript:cntchar(500)"></textarea></th>
       </tr>
       <tr>
         <th colspan="2"><input type="submit" name="action" value="Aceptar"/> <input type="submit" name="action" value="Rechazar"/></th>
       </tr>
       <tr>
         <td colspan=2>&#160;</td>
       </tr>
    </form>
</div>