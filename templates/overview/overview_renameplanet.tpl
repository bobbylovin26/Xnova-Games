<br />
<div id="content">
    <form action="overview.php?mode=renameplanet&pl={planet_id}" method="POST">
    <table width=519>
    <tr>
        <td class="c" colspan=3>Tu planeta</td>
    </tr><tr>
        <th>Coordenadas</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr><tr>
        <th>{galaxy_galaxy}:{galaxy_system}:{galaxy_planet}</th>
        <th>{planet_name}</th>
        <th><input type="submit" name="action" value="Abandonar colonia"></th>
    </tr><tr>
        <th>Nombrar</th>
        <th><input type="text" name="newname" size=25 maxlength=20></th>
        <th><input type="submit" name="action" value="Nombrar"></th>
    </tr>
    </table>
    </form>
</div>