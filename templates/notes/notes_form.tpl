<script src="scripts/cntchar.js" type="text/javascript"></script>
<br />
<div id="content">
    <form action="notes.php" method="POST">
      {inputs}
      <table width="519">
        <tr>
          <td class=c colspan=2>{TITLE}</td>
        </tr>
        <tr>
          <th>Prioridad</th>
          <th>
            <select name=u>
              {c_Options}
            </select>
          </th>
        </tr>
        <tr>
          <th>Asunto</th>
          <th>
            <input type="text" name="title" size="30" maxlength="30" value="{asunto}">
          </th>
        </tr>
        <tr>
          <th>Nota (<span id="cntChars">0</span> / 5000 caracteres)</th>
          <th>
            <textarea name="text" cols="60" rows="10" onkeyup="javascript:cntchar(5000)">{texto}</textarea>
          </th>
        </tr>
        <tr>
          <td class="c"><a href="notes.php">Volver</a></td>
          <td class="c">
            <input type="reset" value="Reestablecer">
            <input type="submit" value="Guardar">
          </td>
        </tr>
      </table>
    </form>
</div>