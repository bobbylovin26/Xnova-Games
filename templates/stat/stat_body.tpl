<br>
<center>
<form name="stats" method="post">
    <table width="519">
        <tr>
           <td colspan="6" class="c">Estadísticas(Actualizadas: {stat_date})</td>
        </tr>
        <tr>
            <th colspan="6" class="c">Mostrar <select name="who" onChange="javascript:document.stats.submit()">{who}</select> por <select name="type" onChange="javascript:document.stats.submit()">{type}</select> en las posiciones <select name="range" onChange="javascript:document.stats.submit()">{range}</select></th>
        <tr>
    </table>
</form>
<table width="519">
    {stat_header}
    {stat_values}
</table>
</center>
</body>
</html>