<script src="scripts/cntchar.js" type="text/javascript"></script>
<br />
<form action="?mode=change" method="post">
    <table width="519">
        <tbody>
            <tr>
                <td class="c" colspan="2">Enviar mensaje global</td>
            </tr>
            <tr>
                <th>Asunto</th>
                <th><input name="temat" maxlength="100" size="20" value="Ninguno" type="text"></th>
            </tr>
            <tr>
                <th>Mensaje (<span id="cntChars">0</span> / 5000 Caracteres)</th>
                <th><textarea name="tresc" cols="40" rows="10" size="100">Sin texto</textarea></th>
            </tr>
            <tr>
                <th colspan="2"><input value="Enviar" type="submit"></th>
            </tr>
        </tbody>
    </table>
</form>