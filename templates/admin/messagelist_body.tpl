<br />
<form action="" method="post">
<input type="hidden" name="curr" value="{mlst_data_page}">
<input type="hidden" name="pmax" value="{mlst_data_pagemax}">
<input type="hidden" name="sele" value="{mlst_data_sele}">
    <table width="700" border="0" cellspacing="1" cellpadding="1">
        <tr>
            <td colspan="4" class="c">Lista de mensajes</td>
        </tr>        
        <tr>
            <td class="c"><div align="center"><input type="submit" name="prev" value="[ &lt;- ]" /></div></div></td>
            <td class="c"><div align="center">P&aacute;gina</div></td>
            <td class="c"><div align="center">
            <select name="page" onchange="submit();">
            {mlst_data_pages}
            </select></div>
            </td>
        	<td class="c"><div align="center"><input type="submit" name="next" value="[ -&gt; ]" /></div></td>
        </tr>
        <tr>
            <td class="c">&nbsp;</td>
            <td class="c"><div align="center">Tipo</div></td>
            <td class="c"><div align="center">
            <select name="type" onchange="submit();">
            {mlst_data_types}
            </select></div>
            </td>
            <td class="c">&nbsp;</td>
        </tr>
        <tr>
            <td class="c"><div align="center"><input type="submit" name="delsel" value="Borrar selección" /></div></td>
            <td class="c"><div align="center">Borrar desde</div></td>
            <td class="c"><div align="center"><input type="text"   name="selday" value="dd" size="3" /> <input type="text" name="selmonth"  value="mm" size="3" /> <input type="text" value="yyyy" name="selyear" size="6" /></div></td>
            <td class="c"><div align="center"><input type="submit" name="deldat" value="Borrar desde" /></div></td>
        </tr>
        <tr>
            <th colspan="4">
                <table width="700" border="0" cellspacing="1" cellpadding="1">
                    <tr align="center" valign="middle">
                        <th class="c">ID</th>
                        <th class="c">Tipo</th>
                        <th class="c">Fecha</th>
                        <th class="c">De</th>
                        <th class="c">Para</th>
                        <th class="c" width="350">Contenido</th>
                    </tr>
                    {mlst_data_rows}
                </table>
        	</th>
        </tr>
    </table>
</form>