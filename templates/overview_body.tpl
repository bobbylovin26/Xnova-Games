<style type="text/css">
<!--
.style1 {
   color: #00FF00;
   font-weight: bold;
}
.style2 {color: #00FF00}
-->
</style>
<br />
<table width="540" colspan="4">
<tr>
   <td class="c" colspan="4"><a href="overview.php?mode=renameplanet" title="{Planet_menu}">{Planet} "{planet_name}"</a> ({user_username})</td>
</tr>
{Have_new_message}
{Have_new_level_mineur}
{Have_new_level_raid}
<tr>
        <th>{Server_time}</th>
        <th colspan=3><script languaje="JavaScript">

var mydate=new Date()
var year=mydate.getYear()
if (year < 1000)
year+=1900
var day=mydate.getDay()
var month=mydate.getMonth()
var daym=mydate.getDate()
if (daym<10)
daym="0"+daym
var dayarray=new Array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sabado")
var montharray=new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre")
document.write("<font color='lime' face='Arial' size=''>"+dayarray[day]+" "+daym+" de "+montharray[month]+" de "+year+"</font>")</script>
<form name="Tick">
<input type="button" size="12" name="Clock">
</form>
<script>
function show(){
var Digital=new Date()
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn=" AM"
if (hours> 12){
dn=" PM"
hours=hours -12
}
if (hours== 0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.Tick.Clock.value=hours+":"+minutes+":"
+seconds+" "+dn
setTimeout("show()",1000)
}
show()

</script></th>
      </tr>
</form>
</th>
</tr>
{NewsFrame}
<tr>
   <td colspan="4" class="c">{Events}</td>
</tr>
{fleet_list}
<tr>
   <th>{moon_img}<br />{moon}</th>
   <th colspan="2"><a href="overview.php?mode=renameplanet" title="{Planet_menu}">{Planet} "{planet_name}"</a><br /><img src="{dpath}planeten/{planet_image}.jpg" height="200" width="200"><br />{coords} <a href="galaxy.php?mode=0&galaxy={galaxy_galaxy}&system={galaxy_system}">[{galaxy_galaxy}:{galaxy_system}:{galaxy_planet}]</a><br />{building}</th>
   <th><table width="100%" border="0">
      <tr>
         <th colspan="2">{ov_user}</th>
         <th colspan="2">{user_username}</th>
      </tr><tr>
         <th colspan="2" align="center"><b>{Rank}</b></th>
         <th colspan="2" align="center"><b><a href="stat.php?range={u_user_rank}">{user_rank}</a> {of} {max_users}</b></th>         
      </tr><tr>
         <th colspan="4" class="c">{ov_local_cdr}</th>
      </tr><tr>
         <th colspan="4"><font>{metal}</font>: {metal_debris} / <font>{crystal}</font> : {crystal_debris}{get_link}</th>
      </tr><tr>
         <th colspan="4">{Points}</th>
      </tr><tr>      
         <th colspan="4"><table border="0" width="100%"><tbody>
         <tr><td align="right" width="50%" style="background-color: transparent;"><b>{ov_pts_build} :</b></td>
         <td align="left" width="50%" style="background-color: transparent;"><b>{user_points}</b></td></tr>
         <tr><td align="right" width="50%" style="background-color: transparent;"><b>{ov_pts_fleet} :</b></td>
         <td align="left" width="50%" style="background-color: transparent;"><b>{user_fleet}</b></td></tr>
         <tr><td align="right" width="50%" style="background-color: transparent;"><b>{ov_pts_def} :</b></td>      
         <td align="left" width="50%" style="background-color: transparent;"><b>{user_defs}</b></td></tr>
         <tr><td align="right" width="50%" style="background-color: transparent;"><b>{ov_pts_reche} :</b></td>
         <td align="left" width="50%" style="background-color: transparent;"><b>{player_points_tech}</b></td></tr>
         <tr><td align="right" width="50%" style="background-color: transparent;"><b>{ov_pts_total} :</b></td>
         <td align="left" width="50%" style="background-color: transparent;"><b>{total_points}</b></td></tr>
         </tbody></table></th>
      </tr><tr> 
         <th colspan="2" align="center">{ov_off_title}</th>
         <th align="center">{ov_off_mines}</th>
         <th align="center">{ov_off_raids}</th>
      </tr><tr> 
         <th colspan="2" align="center">{ov_off_level}</th>
         <th align="center">{lvl_minier}</th>
         <th align="center">{lvl_raid}</th>
      </tr><tr>
      <th colspan="2" align="center">{ov_off_expe}</th>
      <th align="center">{xpminier} / {lvl_up_minier}</th>
      <th align="center">{xpraid} / {lvl_up_raid}</th>
      </tr></table></th>
</tr>
<tr>
<th>Otros planetas</th>
<th class="s" colspan ="4">
      <table class="s" align="top" border="0" style="background-color: transparent;">
         {anothers_planets}
  </table></th></tr>
<tr>
   <th>{Diameter}</th>
   <th colspan="3">{planet_diameter} km (<a title="{Developed_fields}">{planet_field_current}</a> / <a title="{max_eveloped_fields}">{planet_field_max}</a> {fields})</th>
</tr><tr>
   <!--Ajout du pourcentage de case utilisï¿½e et d'une barre-->
   <th >{Developed_fields}</th>
   <th colspan="3" align="center">
      <div  style="border: 1px solid rgb(153, 153, 255); width: 400px;">
      <div  id="CaseBarre" style="background-color: {case_barre_barcolor}; width: {case_barre}px;">
      <font color="#CCF19F">{case_pourcentage}</font>&nbsp;</div>   </th>
</tr>
   <th>{Temperature}</th>
   <th colspan="3">{approx} {planet_temp_min}º a {planet_temp_max}º</th>
</tr>
{ExternalTchatFrame}
<br /> 
</table> 
{ClickBanner}
</center> 
</body> 
</html>  