<br>
<a onmouseover="this.T_WIDTH=116;return escape('Virer ce membre');" href="alliance.php?mode=admin&edit=members&kickid={id}" onclick="javascript:return confirm('&Ecirc;tes-vous s&ucirc;r de vouloir virer ce membre?');"><img src="{dpath}pic/abort.gif" border=0 ></a>&nbsp;<a onmouseover="this.T_WIDTH=98;return escape('Attribuer un rang');" href="alliance.php?mode=admin&edit=members&rank={id}"><img src="{dpath}pic/key.gif" border=0></a>
<script src="scripts/wz_tooltip.js" type="text/javascript"></script>[/code]

et enfin
templates\OpenGame\alliance_admin_request_form.tpl
[code]<br>
<form action="alliance.php?mode=admin&edit=requests&show={id}&sort=0" method="POST">
<tr>
<th colspan=2>{Request_from}</th>
</tr>
<tr>
<th colspan=2>{ally_request_text}</th>
</tr>
<tr>
<td class="c" colspan=2>{Request_responde}</td>
</tr>
<tr>
<th>&#160;</th>
<th><input type="submit" name="action" value="Accepter"></th>
</tr>
<tr>
<th>{Motive_optional} <span id="cntChars">0</span> / 500 {characters}</th>
<th><textarea name="text" cols=40 rows=10 onkeyup="javascript:cntchar(500)"></textarea></th>
</tr>
<tr>
<th>&#160;</th>
<th><input type="submit" name="action" value="Refuser"></th>
</tr>
<tr>
<td colspan=2>&#160;</td>
</tr>
</form>