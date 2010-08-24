<div id="header_top">
    <center>
    <table class="header">
    <tbody>
    <tr class="header">
        <td class="header">
            <center>
            <table class="header">
            <tbody>
            <tr class="header">
                <td class="header"> <img src="{dpath}planeten/small/s_{image}.jpg" height="50" width="50"> </td>
                <td  class="header" valign="middle">
                    <select size="1" onChange="eval('location=\''+this.options[this.selectedIndex].value+'\'');">
                    {planetlist}
                    </select>
                </td>
            </tr>
            </tbody>
            </table>
            </center>   </td>
       <td class="header">
          <table width="500" border="0" cellpadding="0" cellspacing="0" class="header" id="resources" padding-right="30">
          <tbody>
          <tr class="header">
             <td class="header" align="center" width="150"><img src="{dpath}images/metall.gif" border="0" height="32" width="48"></td>
             <td class="header" align="center" width="150"><img src="{dpath}images/kristall.gif" border="0" height="32" width="48"></td>
             <td class="header" align="center" width="150"><img src="{dpath}images/deuterium.gif" border="0" height="32" width="48"></td>
             <td class="header" align="center" width="250"><img src="{dpath}images/darkmatter.gif" border="0" height="32" width="48"></td>
             <td class="header" align="center" width="150"><img src="{dpath}images/energie.gif" border="0" height="32" width="48"></td>
             <td class="header" align="center" width="150"><img src="{dpath}images/message.gif" border="0" height="32" width="48"></td>
          </tr>
          <tr class="header">
             <td class="header" align="center" width="150"><i><b><font color="#ffffff">Metal</font></i></td>
             <td class="header" align="center" width="150"><i><b><font color="#ffffff">Cristal</font></b></i></td>
             <td class="header" align="center" width="150"><i><b><font color="#ffffff">Deuterio</font></b></i></td>
             <td class="header" align="center" width="250"><i><b><font color="#ffffff">Materia Oscura</font></b></i></td>  
             <td class="header" align="center" width="150"><i><b><font color="#ffffff">Energ&#237;a</font></b></i></td>
             <td class="header" align="center" width="150"><i><b><font color="#ffffff">Mensajes</font></b></i></td>
          </tr>
          <center>
          <tr class="header">
             <td class="header" align="center" width="150"><div id="metal"></div></td>
             <td class="header" align="center" width="150"><div id="crystal"></div></font></td>
             <td class="header" align="center" width="150"><div id="deut"></div></font></td>
             <td class="header" align="center" width="250">{darkmatter}</td>         
             <td class="header" align="center" width="150">{energy}</td>
             <td class="header" align="center" width="150">{message}</td>
          </tr>
             <td class="header" align="center" width="150">{metal_max}</td>
             <td class="header" align="center" width="150">{crystal_max}</td>
             <td class="header" align="center" width="150">{deuterium_max}</td>
             <td class="header" align="center" width="250">&nbsp;</td>
             <td class="header" align="center" width="150">&nbsp;</td>
             <td class="header" align="center" width="150">&nbsp;</td>
          </tr>
          </table>
       </td>
    </tr>
    </tbody>
    </table>
    {show_umod_notice}
    </center>
</div>
<br />
<br />
<br />
<br />
<br />
<br />
<script LANGUAGE='JavaScript'>
<!--
var now = new Date();
var event = new Date();
var seconds = (Date.parse(now) - Date.parse(event)) / 1000;
var val = 0;
var val2 = 0;
var val3 = 0;
update();
function update() {
  now = new Date();
  seconds = (Date.parse(now) - Date.parse(event)) / 1000;
  val = (( {metal_perhour} / 3600) * seconds) + {metalh};
  if( val >= {metal_mmax} ) val = {metalh};
  document.getElementById('metal').innerHTML = number_format( val ,0);
  val = ( {crystal_perhour} / 3600) * seconds + {crystalh};
  if( val >= {crystal_mmax} ) val = {crystalh};
  document.getElementById('crystal').innerHTML = number_format( val ,0);
  val = ( ({deuterium_perhour} / 3600) * seconds + {deuteriumh});
  if( val >= {deuterium_mmax} ) val = {deuteriumh};
  document.getElementById('deut').innerHTML = number_format( val ,0);
 
  ID=window.setTimeout('update();',1000);
}
function number_format(number,laenge) {
  number = Math.round( number * Math.pow(10, laenge) ) / Math.pow(10, laenge);
  str_number = number+'';
  arr_int = str_number.split('.');
  if(!arr_int[0]) arr_int[0] = '0';
  if(!arr_int[1]) arr_int[1] = '';
  if(arr_int[1].length < laenge){
    nachkomma = arr_int[1];
    for(i=arr_int[1].length+1; i <= laenge; i++){  nachkomma += '0';  }
    arr_int[1] = nachkomma;
  }
  if(arr_int[0].length > 3){
    Begriff = arr_int[0];
    arr_int[0] = '';
    for(j = 3; j < Begriff.length ; j+=3){
      Extrakt = Begriff.slice(Begriff.length - j, Begriff.length - j + 3);
      arr_int[0] = '.' + Extrakt +  arr_int[0] + '';
    }
    str_first = Begriff.substr(0, (Begriff.length % 3 == 0)?3:(Begriff.length % 3));
    arr_int[0] = str_first + arr_int[0];
  }
  return arr_int[0]+''+arr_int[1];
}
// --></script>