<br />
<div id="content">
    <form action="search.php" method="post">
     <table width="519">
      <tr>
       <td class="c">Buscar en el Universo</td>
      </tr>
      <tr>
       <th>
        <select name="type">
         <option value="playername"{type_playername}>Nombre del jugador</option>
         <option value="planetname"{type_planetname}>Nombre del planeta</option>
         <option value="allytag"{type_allytag}>Etiqueta de la alianza</option>
         <option value="allyname"{type_allyname}>Nombre de la alianza</option>
        </select>
        &nbsp;&nbsp;
        <input type="text" name="searchtext" value="{searchtext}"/>
        &nbsp;&nbsp;
    
        <input type="submit" value="Buscar" />
       </th>
      </tr>
    </table>
    </form>
    {search_results}