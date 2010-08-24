<tr>
  <th colspan="2">
<div align="left">
<p>Bievenido al sistema de instalacion de Xnova.<br>
si tienes problemas graves con la instalacion pregunta en el foro.<br>
Si miras un error de intento de bloqueo de mysql continua normal con la instalacion, se debe a que no tienes suficientes permisos pero todo funciona bien.<br>
    <br>
  </p>
</div>
<p align="left">Antes de instalar cambie los permisos de <i>config.php</i> <u>propiedades </u>modo atributo a "CHMOD 777"</p>
<fieldset>
<p align="left">Antes de empezar, asegurate de tener una base de datos en <u>MySQL</u>.<BR>
Este puede ser el siguiente : <em>base.domaine.ext</em> o su direccion IP (<em>192.168.0.1</em> o <em>127.0.0.1</em>)<BR>
La mayor&iacute;a de las veces, el valor por defecto es que le corresponde. Entonces usted no necesita cambiar esta configuraci&oacute;n.</p>
<div align="left">
      <p><strong>Servidor SQL:</strong></p>
      <p>
        <input type="text" name="host" value="localhost" size="30" />
      </p>
    </div>
  
                		<p align="left">Utilice este campo para indicar el nombre de la base de datos que ser&aacute; la sede de XG Proyect. </p>
                        <p align=\"left\">La base de datos contendr&aacute; todos los datos necesarios para el funcionamiento del juego Si tienes un foro o una solicitud usando MySQL, es muy recomendable para instalar XG Proyect.</p>
                		<p align="left">Base de datos:</p>
	<p align="left"> 
	  <input type="text" name="db" value="" size="30" />
    </p>
                	
	</fieldset>
    <p>&nbsp;</p>
    <fieldset>
    <p align=\"left\">En esta parte se pide acceso a MySQL.</p>
    <p align=\"left\">Un usuario de MySQL corresponde a un grupo o una persona con privilegios espec&iacute;ficos de uso, determinado por ti mismo (ya sea local o dedicada) o por su acogida.</p>
    <p align=\"left\">En el caso de hosting <em>free</em>, XG Proyect no se puede instalar. Los usuarios de MySQL no tiene los privilegios de uso de la funci&oacute;n<em> LOCK TABLE</em>.</p>
    <div align="left">
      <table width="533" border="1">
        <tr>
          <td><p align="center"><strong>Usuario:</strong></p>
              <p align="center">
                <input type="text" name="user" value="" size="30" />
            </p></td>
          <td><p align="center"><strong>Contrase&ntilde;a:</strong></p>
              <p align="center">
                <input type="password" name="passwort" value="" size="30" />
            </p></td>
        </tr>
          </table>
    </div>

    </fieldset>
    <p>&nbsp;</p>
	            <fieldset>
	            <p align=\"left\">Indique en esta etapa prefijo de las tablas a ser creadas y llenadas por esta instalaci&oacute;n.</p>
	            <p align=\"left\">Este es el buen funcionamiento del juego, la clasificaci&oacute;n y la separaci&oacute;n de los m&uacute;ltiples universos(<em>aunque no es aconsejable instalar varios juegos sobre la misma base.</em>)</p>
	            <p align="left">Prefix de las tablas:</p>
	            <p align="left">
	              <input type="text" name="prefix" value="game_" size="30" />
	            </p>
	            </fieldset>            <br>
</th>
</tr>
<tr>
  <th colspan="2"><input type="button" name="next" onclick="submit();" value="Instalar" ></th>
</tr>