<script src="scripts/cntchar.js" type="text/javascript"></script>
<br />
<div id="content">
    <form action="alliance.php?mode=apply&allyid={allyid}" method=POST>
    <table width=519>
        <tr>
          <td class=c colspan=2>{Write_to_alliance}</td>
        </tr>
        <tr>
          <th>Mensaje (<span id="cntChars">{chars_count}</span> / 6000 caracteres)</th>
          <th><textarea name="text" cols="40" rows="10" onkeyup="javascript:cntchar(6000)">{text_apply}</textarea></th>
        </tr>
        <tr>
          <th colspan="2"><input type="submit" name="enviar" value="Enviar"/> <input type="submit" name="enviar" value="Recargar"/></th>
        </tr>
    </table>
    </form>
</div>