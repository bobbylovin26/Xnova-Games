<form action="overview.php?mode=renameplanet&pl={planet_id}" method="POST">
    <table width="519">
    <tr>
        <td colspan="3" class="c">Petición de seguridad</td>
    </tr><tr>
        <th colspan="3">Confirmar borrado de planeta {galaxy_galaxy}:{galaxy_system}:{galaxy_planet} con contraseña</th>
    </tr><tr>
        <th>Contraseña</th>
        <th><input type="password" name="pw"></th>
        <th><input type="submit" name="action" value="¡Borrar planeta!"></th>
    </tr>
    </table>
<input type="hidden" name="kolonieloeschen" value="1">
<input type="hidden" name="deleteid" value ="{planet_id}">
</form>