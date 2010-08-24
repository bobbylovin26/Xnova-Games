<?php

$lang['ins_appname']      = 'Instalacion <a href=\"http://xtreme-gamez.com.ar/foros/" target=\"_blank\">XNova</a>';
$lang['ins_tx_state']     = "Etapa";
$lang['ins_tx_sys']       = "Gesti&oacute;n del sistema";
$lang['ins_btn_next']     = "Siguiente";
$lang['ins_btn_inst']     = "Instalar";
$lang['ins_btn_creat']    = "Crear";
$lang['ins_btn_login']    = "Finalizar";
$lang['ins_btn_prev']     = "Precedente";

$lang['ins_mnu_intro']    = "Introducci&oacute;n";
$lang['ins_mnu_inst']     = "Instalar";
$lang['ins_mnu_upgr']     = "Actualizar";
$lang['ins_mnu_quit']     = "Salir";

$lang['ins_error']        = "Error";
$lang['ins_error1']       = "La conexi&oacute;n a la base de datos a fallado;";
$lang['ins_error2']       = "El fichero config.php no puede ser sustituido, no tenia acceso chmod 777";

$lang['ins_tx_welco']     = "<p align=\"center\"><strong>Bienvenido a la Instalacion de Xnova.</strong></p>
<p align=\"center\"><strong>Con este asistente podras instalar todo facilmente, se&ntilde;alando los datos del host y base de datos, se creara todo automaticamente.</strong></p>
<p align=\"center\"><strong>Informacion de Xnova <a href=\"http://fr.wikipedia.org/wiki/Open_Source\" target=\"_blank\">OPEN SOURCE</a> Legal <a href=\"http://creativecommons.org/licenses/by-nc/2.0/fr/\" target=\"_blank\">licence Creative Common.</a></strong></p>
<p>Este Release de XNova fue llevado a cabo por Lucky y PowerMaster para <a href=\"http://www.xtreme-gamez.com.ar/foros\" target=\"_blank\">Xtreme-GameZ</a>
<p align=\"center\"><strong>Borrar los Copyright y/o derechos de autor constituye un delito, Xnova es OpenSource, libre para todos, respeta esto por favor.</strong></p>
<p align=\"center\"><strong>Esta version de Xnova 0.9a ha sido traducida, modificada, corregida y aumentada por Calzon para Xnova Project Espa&ntilde;a.</strong></p>";
$lang['ins_tx_intr1']     = "El proyecto XNova le permitir&aacute; instalar un clon de ogame casi perfecto";
$lang['ins_tx_intr2']     = "El proyecto XNova es libre, gratuito y OpenSource. Gracias de no hacer utilizaci&oacute;n comercial";

$lang['ins_tx_intr3']     = "Por respeto para el equipo de desarrollo de este proyecto, se les ruega no suprimir el copyright de los ficheros fuente.";
$lang['ins_tx_inst1']     = "El fichero config.php debe ser en CHMOD 777";
$lang['ins_tx_inst2']     = "Debe poseer una base de datos MySQL";
$lang['ins_tx_inst3']     = "Debe llenar el formulario siguiente correctamente para seguir la instalaci&oacute;n:";
$lang['ins_tx_acc1']      = "Est&aacute; a punto de crear una cuenta administrador";
$lang['ins_tx_acc2']      = "Llene el formulario siguiente con la informaci&oacute;n de la cuenta:";

$lang['ins_tx_goto1']     = "Al elegir este m&eacute;todo de instalaci&oacute;n, va a transformar una base de datos UGamela una base de datos XNova.";
$lang['ins_tx_goto2']     = "Esta opci&oacute;n funciona, pero sigue siendo preferible a una instalaci&oacute;n completa de XNova.";
$lang['ins_tx_goto3']     = "Usted toma un riesgo de inflexi&oacute;n en su base de datos, haga una copia de seguridad antes !";
$lang['ins_tx_goto4']     = "Ya tienes instalado Xnova";
$lang['ins_tx_goto5']     = "Rellene el siguiente formulario con informaci&oacute;n exacta de la base de datos que se instal&oacute;. Si comete un error, la transferencia fallara:";
$lang['ins_tx_done1']     = "La base de datos se instalo correctamente!";
$lang['ins_tx_done2']     = "El Administrador ha sido correctamente establecido!";
$lang['ins_tx_done3']     = "Ahora debes borrar la carpeta <i>install</i> asi evitaras problemas graves de seguridad!";
$lang['ins_tx_done4']     = "La transferencia se realizo correctamente!";

$lang['ins_form_server']  = "Servidor SQL";
$lang['ins_form_db']      = "Base de datos";
$lang['ins_form_prefix']  = "Prefix de las tablas";
$lang['ins_form_login']   = "Usuario";
$lang['ins_form_pass']    = "Contrase&ntilde;a";
$lang['ins_form_install'] = "Instalar";

$lang['ins_acc_user']     = "Usuario";
$lang['ins_acc_pass']     = "Contrase&ntilde;a";
$lang['ins_acc_email']    = "Direcci&oacute;n correo electr&oacute;nico";


$lang['txt_1'] = "  <p>Bievenido al sistema de instalacion de Xnova.<br>
si tienes problemas graves con la instalacion pregunta en el foro.<br>
Si miras un error de intento de bloqueo de mysql continua normal con la instalacion, se debe a que no tienes suficientes permisos pero todo funciona bien.<br>";
$lang['txt_2'] = "Antes de instalar cambie los permisos de <i>config.php</i> <u>propiedades </u>modo atributo a \"CHMOD 777\"";
$lang['txt_3'] = "Antes de empezar, asegurate de tener una base de datos en <u>MySQL</u>.<BR>
Este puede ser el siguiente : <em>base.domaine.ext</em> o su direccion IP (<em>192.168.0.1</em> o <em>127.0.0.1</em>)<BR>
La mayor&iacute;a de las veces, el valor por defecto es que le corresponde. Entonces usted no necesita cambiar esta configuraci&oacute;n.";
$lang['txt_4'] = "Utilice este campo para indicar el nombre de la base de datos que ser&aacute; la sede de XNova. </p>
<p align=\"left\">La base de datos contendr&aacute; todos los datos necesarios para el funcionamiento del juego Si tienes un foro o una solicitud usando MySQL, es muy recomendable para instalar XNova.";
$lang['txt_5'] = "<p align=\"left\">En esta parte se pide acceso a MySQL.</p>
    <p align=\"left\">Un usuario de MySQL corresponde a un grupo o una persona con privilegios espec&iacute;ficos de uso, determinado por ti mismo (ya sea local o dedicada) o por su acogida.</p>
    <p align=\"left\">En el caso de hosting <em>free</em>, Xnova no se puede instalar. Los usuarios de MySQL no tiene los privilegios de uso de la funci&oacute;n<em> LOCK TABLE</em>.</p>";
$lang['txt_6'] = "<p align=\"left\">Indique en esta etapa prefijo de las tablas a ser creadas y llenadas por esta instalaci&oacute;n.</p>
	            <p align=\"left\">Este es el buen funcionamiento del juego, la clasificaci&oacute;n y la separaci&oacute;n de los m&uacute;ltiples universos(<em>aunque no es aconsejable instalar varios juegos sobre la misma base.</em>)</p>";

$lang['create_aks'] = "Creaci&#243;n de la tabla \"aks\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_alliance'] = "Creaci&#243;n de la tabla \"alliance\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_banned'] = "Creaci&#243;n de la tabla \"banned\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_buddy'] = "Creaci&#243;n de la tabla \"buddy\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_config'] = "Creaci&#243;n de la tabla \"config\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['populate_config'] = "Creaci&#243;n de la tabl \"config\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_errors'] = "Creaci&#243;n de la tabla \"errors\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_fleets'] = "Creaci&#243;n de la tabla \"fleets\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_galaxy'] = "Creaci&#243;n de la tabla \"galaxy\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_lunas'] = "Creaci&#243;n de la tabla \"lunas\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_messages'] = "Creaci&#243;n de la tabla \"messages\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_notes'] = "Creaci&#243;n de la tabla \"notes\"........<b><font color=\"lime\">Realizado!</font></b>";
 $lang['create_planets'] = "Creaci&#243;n de la tabla \"planets\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_rw'] = "Creaci&#243;n de la tabla \"rw\"........<b><font color=\"lime\">Realizado; !</font></b>";
$lang['create_statpoints'] = "Creaci&#243;n de la tabla \"statpoints\"........<b><font color=\"lime\">Realizado; !</font></b>";
$lang['create_users'] = "Creaci&#243;n de la tabla \"users\"........<b><font color=\"lime\">Realizado!</font></b>";
$lang['create_multi'] = "Creaci&#243;n de la tabla \"multi\"........<b><font color=\"lime\">Realizado!</font></b>";

?>