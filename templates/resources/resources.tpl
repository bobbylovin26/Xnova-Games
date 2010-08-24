<br />
<div id="content">
    <form action="" method="post">
    <table width="569">
    <tbody>
    <tr>
        <td class="c" colspan="5">{Production_of_resources_in_the_planet}</td>
    </tr><tr>
        <th height="22">&nbsp;</th>
        <th width="60">Metal</th>
        <th width="60">Cristal</th>
        <th width="60">Deuterio</th>
        <th width="60">Energ&iacute;a</th>
    </tr><tr>
        <th height="22">Ingresos b&aacute;sicos</th>
        <td class="k">{metal_basic_income}</td>
        <td class="k">{crystal_basic_income}</td>
        <td class="k">{deuterium_basic_income}</td>
        <td class="k">{energy_basic_income}</td>
    </tr>
    {resource_row}
    <tr>
        <th height="22">Capacidad de los almacenes</th>
        <td class="k">{metal_max}</td>
        <td class="k">{crystal_max}</td>
        <td class="k">{deuterium_max}</td>
        <td class="k">-</td>
        <td class="k"><input name="action" value="Calcular" type="submit"></td>
    </tr><tr>
        <th height="22">Suma:</th>
        <td class="k">{metal_total}</td>
        <td class="k">{crystal_total}</td>
        <td class="k">{deuterium_total}</td>
        <td class="k">{energy_total}</td>
    </tr>
    </tbody>
    </table>
    </form>
    <br>
    <table width="569">
    <tbody>
    <tr>
        <td class="c" colspan="4">Producción ampliada</td>
    </tr><tr>
        <th>&nbsp;</th>
        <th>Diaria</th>
        <th>Semanal</th>
        <th>Mensual</th>
    </tr><tr>
        <th>Metal</th>
        <th>{daily_metal}</th>
        <th>{weekly_metal}</th>
        <th>{monthly_metal}</th>
    </tr><tr>
        <th>Cristal</th>
        <th>{daily_crystal}</th>
        <th>{weekly_crystal}</th>
        <th>{monthly_crystal}</th>
    </tr><tr>
        <th>Deuterio</th>
        <th>{daily_deuterium}</th>
        <th>{weekly_deuterium}</th>
        <th>{monthly_deuterium}</th>
    </tr>
    </tbody>
    </table>
    <br>
    <table width="569">
    <tbody>
    <tr>
        <td class="c" colspan="3">Estado de los almacenes</td>
    </tr><tr>
        <th>Metal</th>
        <th>{metal_storage}</th>
        <th width="250">
            <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
            <div id="AlmMBar" style="background-color: {metal_storage_barcolor}; width: {metal_storage_bar}px;">
            &nbsp;
            </div>
            </div>
        </th>
    </tr><tr>
        <th>Cristal</th>
        <th>{crystal_storage}</th>
        <th width="250">
            <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
            <div id="AlmCBar" style="background-color: {crystal_storage_barcolor}; width: {crystal_storage_bar}px; opacity: 0.98;">
            &nbsp;
            </div>
            </div>
        </th>
    </tr><tr>
        <th>Deuterio</th>
        <th>{deuterium_storage}</th>
        <th width="250">
            <div style="border: 1px solid rgb(153, 153, 255); width: 250px;">
            <div id="AlmDBar" style="background-color: {deuterium_storage_barcolor}; width: {deuterium_storage_bar}px;">
            &nbsp;
            </div>
            </div>
        </th>
    </tr>
    </tbody>
    </table>
</div>