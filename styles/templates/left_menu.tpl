<div id="leftmenu">
<script language="JavaScript">
function f(target_url,win_name) {
  var new_win = window.open(target_url,win_name,'resizable=yes,scrollbars=yes,menubar=no,toolbar=no,width=550,height=280,top=0,left=0');
  new_win.focus();
}
</script>
<div id='menu'>
<br />
<center>
<div><center><strong>{servername}</strong> (<a href="game.php?page=changelog"><font color="red">{version}</font></a>)<center></div>
<table class="style" width="130" cellspacing="0" cellpadding="0">
<tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Navigation}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=overview">{lm_overview}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=galaxy&mode=0">{lm_galaxy}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=imperium">{lm_empire}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=fleet">{lm_fleet}</a></div></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Constructions}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings">{lm_buildings}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings&mode=research">{lm_research}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings&mode=fleet">{lm_shipshard}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buildings&mode=defense">{lm_defenses}</a></div></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Economy}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=resources">{lm_resources}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=officier">{lm_officiers}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=trader">{lm_trader}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=techtree">{lm_technology}</a></div></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Relations}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=messages">{lm_messages}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=alliance">{lm_alliance}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=buddy">{lm_buddylist}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="#" onClick="f('game.php?page=notes', '{lm_notes}')">{lm_notes}</a></div></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Observation}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=statistics&range={user_rank}">{lm_statistics}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=search">{lm_search}</a></div></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Other}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=options">{lm_options}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="game.php?page=banned">{lm_banned}</a></div></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_Comunication}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2"><div><a href="index.php?page=contact" target="_blank">{lm_contact}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="{forum_url}" target="_blanck">{lm_forums}</a></div></td>
</tr><tr>
	<td colspan="2"><div><a href="javascript:top.location.href='game.php?page=logout'" style="color:red">{lm_logout}</a></div></td>
</tr>
	{admin_link}
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
	<td colspan="2" background="{dpath}img/bg1.gif"><center>{lm_server_rates}</center></td>
</tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr><tr>
        <td style="padding-left: 3px">{lm_game_speed}</td>
        <td align="right" style="padding-right: 3px">x {lm_tx_game}</td>
    </tr>
    <tr>
      <td style="padding-left: 3px">{lm_fleet_speed}</td>
      <td align="right" style="padding-right: 3px">x {lm_tx_fleet}</td>
    </tr>
    <tr>
      <td style="padding-left: 3px">{lm_resources_speed}</td>
      <td align="right" style="padding-right: 3px">x {lm_tx_serv}</td>
    </tr>
    <tr>
      <td style="padding-left: 3px">{lm_queues}</td>
      <td align="right" style="padding-right: 3px">{lm_tx_queue}</td>
    </tr>
<tr><tr>
	<td height="1px" colspan="2" style="background-color:#FFFFFF"></td>
</tr>
	<td colspan="2"><div><center><a href="index.php?page=credit" target="_blank" title="&copy; CopyRight 2008 - 2009">&copy; 2008 - 2009</a></center></div></td>
</tr>
</table>
</center>
</div>
</div>
</div>