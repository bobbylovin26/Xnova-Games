<br />
<br />
<form method="post" action="">
	<br />
	<table width="80%" border="0" cellpadding="1">
    <tr>
      <th colspan="2" class="c">{cs_title}</th>
    </tr>
	<tr>
      <td class="c">{cs_point_per_resources_used}</td>
      <td class="c"><label>
        <input type="text" name="stat_settings" id="stat_settings" value="{stat_settings}" />
      </label> {cs_resources}</td>
    </tr>
	<tr>
      <td class="c">{cs_users_per_block}</td>
      <td class="c"><label>
        <input type="text" name="stat_amount" id="stat_amount" value="{stat_amount}" />
      </label></td>
    </tr>
	<tr>
      <td class="c">{cs_fleets_on_block}</td>
      <td class="c"><label>
	  <select name="stat_flying" id="stat_flying">
          <option value="1" {sel_sf1}>{cs_yes}</option>
          <option value="0" {sel_sf0}>{cs_no}</option>
      </select>
      </label></td>
    </tr>
	<tr>
      <td class="c">{cs_time_between_updates}</td>
      <td class="c"><label>
        <input type="text" name="stat_update_time" id="stat_update_time" value="{stat_update_time}" />
      </label> {cs_minutes}</td>
    </tr>
    <tr>
      <td class="c">{cs_points_to_zero}</td>
      <td class="c"><label>
	  <select name="stat" id="stat">
          <option value="1" {sel_sta1}>{cs_yes}</option>
          <option value="0" {sel_sta0}>{cs_no}</option>
      </select>
      </label></td>
    </tr>
    <tr>
      <td class="c">{cs_access_lvl}</td>
      <td class="c"><label>
        <input type="text" name="stat_level" id="stat_level" value="{stat_level}" />
      </label></td>
    </tr>
	
    <tr>
      <td colspan="2" class="a"><label>
        <input type="submit" name="save" value="{cs_save_changes}" />
      </label></td>
    </tr>
  </table>
  <br />
</form>