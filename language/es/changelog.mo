<?php

$lang['Version']     = 'Versión';
$lang['Description'] = 'Descripción';
$lang['changelog']   = array(

'<font color="lime">1.5b</font>' => ' 03/04/09 12:57
- Cambios y correcciones en templates y textos.-
- Loteria reparada (By lucky).-
- Correciones en el instalador, soportando correctamente las razas, y también en el auto-update.-
- Razas corregidas (By Tonique).-
- Corregido un bug en el instalador.-
',

'1.5a' => ' 26/03/09 12:00
- Corregido el link de administración.-
- Mejoras en el instalador.-
- Fix corregido bug que mostraba mal la leyenda en la galaxia.-
- Actualizado el auto-update para poder pasar fácilmente de la versión 1.4f o de la 1.4c a la 1.5a.-
- Ahora la instalacion incluye la lotería y el chat, no deberás hacer nada manualmente.-
- Arreglada la página de amigos ahora debería mostrar bien a tus amigos y no a vos (By lucky).-
- Mejorado el auto-update de puntos, ahora podrás instalar sin realizar modificaciones en los archivos.-
- Unificamos la versión de XG Proyect con la de calzon.-
',

'1.4f' => ' 18/03/09 12:00
- Fix pequeñas correciones en la base de datos.-
- Fix pequeñas correcciones en traducciones generales.-
- Fix Corregidas variables en alianza, nueva estructuracion, mejor optimizada.-
- Mod Agregado terraformer y super terraformer a constants.php, (personalizable campos que dara cada uno).-
- Mod Administradores u operadores no aparecen mas Estadisticas.-
- Mod Completadas algunas imagenes faltantes en el skin, cambiada la de la supernova por una de mejor calidad.-
- Mod Optimizacion de consultas y variables generales (sistema mas limpio).-
- Mod Nuevo edificio, Super Terraformer, aumenta 10 campos por nivel (winjet).-
<font color="red">- Tecnologias y naves unicas de razas. 70% completado.-</font>
<font color="red">- Formas de Gobierno (democracia, socialismo y pirateria) 30% completado.-</font>
<font color="red">- Fix a bug destruccion de luna.-</font>
',

'1.4e' => ' 12/03/09 12:00
- Fix a textos e imagenes de naves y defensas nuevas asi como a razas.-
- Fix Enviar mutiples flotas, expediciones, misiones, al ir atras (modo test por ahora).-
- Fix Corregido bug en consumo de deuterio (flotenajax.php).-
- Fix corregido bug al abandonar colonias por fallo seguridad (overview.php).-
- Fix En Estadisticas aparecias en una alianza aunque ya hubieras salido (alliance.php).-
- Mod 4 Nuevas naves: Interceptor, Cazador Crucero, Transportador y Titan.-
- Mod 2 Nuevas defensas: Cañon de Fotones y Base Espacial.-
- Mod Nueva Tecnologia de Desarrollo, aumenta colas posibles a edificios.
<font color="green">- Mod Razas: Humanos, Aliens, Predators y Darks, con cada nivel aumenta:.-</font>
<font color="green">- Humanos: Mina Metal +3% produccion, +2% Ataque y Escudos.-</font>
<font color="green">- Aliens: Mina Cristal +3% produccion, +3% Blindaje.-</font>
<font color="green">- Predators: +10% Ataque.-</font>
<font color="green">- Darks: Sintetizador Deuterio +3% produccion, +4% Blindaje y Escudos.-</font>
',

'1.4d' => ' 09/03/09 12:00
- Fix algunas traducciones.-
- Fix Ajustado a resolucion 1024x768, reacomodo en columnas de edificios y frames.php-
- Fix multiplicacion/Duplicacion de ligeros y estrellas de la muerte (flotten1.php).-
- Fix Seguridad de carpetas, una mas, aparte de la que ya existia.-
- Fix en Mercader, devolvia recursos al meter numeros negativos (marchand.php).-
- Fix Misiles (projectxnova) adaptado y corregido a esta version (MissionCaseMIP.php).-
- Fix agregado entero en funcion investigaciones (ResearchBuildingPage.php).-
- Fix, pequeña correccion en alianzas rangos y administracion(alliance.php).-
- Fix, Correccion en Galaxia (galaxy.php).-
- Mod/Fix Arreglo a mensajes(project xnova) adaptado, corregido y aumentado para esta version.-
- Mod actualizacion automatica (ahora si es automatica) y no consume recursos.-
- Mod Edificios en columnas de 5.-
- Mod Menu Derecho agregada compatibilidad, reordenadas las funciones.-
- Mod Agregado Records (Records.php).-
- Mod Agregado Chat.-
- Mod Agregado Simulador de Batallas.-
- Mod Agregado Loteria (project xnova), adaptado y corregido a esta version.-
- Mod Reacomodo vision general (projectxnova), corregida compatilidad (overview.php).-
- Mod Recursos en tiempo real (tonique) modo test por ahora.-
- Borrado actualizacion automatica, consume muchos recursos (todos haciendo click a vision general).-
',

'1.4c' => ' 08/02/09 19:00

- Eliminados los recursos en tiempo real debido a que se quedaban congelados.-
- Reparados los oficiales espía y comandante.- (By jtsamper foro project.xnova.es)
- En la galaxia ya no puedes reciclar o espiar sin deuterio.-
- Prevenir números negativos y carácteres no numéricos en la galaxia (By neurus foro Xproject.xnova.es).-
- Ahora para ver la galaxia necesitas deuterio (Original project.xnova.es fixeado por lucky).-
- Al disolver una alianza esta ya no aparece en las estadísticas (By xesar foro project.xnova.es).-
- Corregida una redirección que funcionaba mal en la alianza.-
- Corregido un pequeño error de sintaxis en la flota que tiraba severos reportes de errores (Gracias edering).-
- Agregado un mensaje recordatorio de como se debe incrementar o eliminar la materia oscura (Gracias edering).-
- Anuncios eliminados (Por votación de los usuarios de XG).-
- El auto-update no soporta más las siguientes versiones:  v0.9a/v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a (Si tienes alguna des estas versiones deberás usar un update anterior).-
- Ahora en la busqueda al hacer click en el link te redirecciona al sistema del jugador y no al tuyo (By Anghelito).-
',

'1.4b' => ' 06/12/08 17:13

- Desbaneo reparado.-
- Oficiales reparados.-
- Ahora al iniciar sesión con tu cuenta, iniciará siempre desde el planeta principal y no desde una colonia.-
- Un moderador u operador ya no podrá cambiarse los permisos a Administrador.-
- Galaxia optimizada.-
- Ahora cuando colonizas tu planeta se llamará "Colonia" y no "Planeta Principal" (By lucky).-
- El auto-update no soporta más las siguientes versiones:  v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a (Si tienes alguna des estas versiones deberás usar un update anterior).-
- Corregidas algunas redirecciones y mejoradas otras.-
- Ahora puedes usar espacios en blanco en el nombre de tu planeta (By lucky).-
- Borrado de archivos innecesarios (esto no termina más).-
- Reparada la tabla que muestra las flotas en vuelo en el panel del admin.-
- Mejoras, organización, limpieza y optimización del lenguaje (No pongo más que cambie en los lenguajes porque ya es detallar mucho, para nada).-
',

'1.4a' => ' 06/12/08 17:13

- Reparado el reset del universo.-
- El auto-update no soporta más las siguientes versiones: v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a (Si tienes alguna des estas versiones deberás usar un update anterior).-
- Más limpieza de archivos innecesarios.-
- Limpieza y pulido del panel de admin (lenguaje).-
- Lista de planetas <-> Lista de usuarios cambiado (lenguaje - Gracias Alberto14).-
- Ahora puedes agregar y remover materia oscura desde el panel de administración (By lucky).-
- Actualización en tiempo real de los recursos (By Alberto14).-
- Cambidas las imágenes del XNova, por las imágenes del OGame original.-
- Borradas imágenes innecesarias.-
- Optimizadas las imágenes de los oficiales.-
- Eliminado el multi totalmente (A pedido del público).-
- Eliminados los records totalmente (A pedido del público).-
- Eliminado el chat totalmente (A pedido del público).-
- Traducidos algunos textos en el formulario de envío de mensajes (lenguaje).-
- Complementado el infos.mo con los datos del verdadero OGame (lenguaje).-
- Pulido y limpieza del search (lenguaje).-
- Pulido y limpieza del overview (lenguaje).-
- Pulido y limpieza del leftmenu (lenguaje).-
- Pulido y limpieza del registro (lenguaje).-
- Pulido y limpieza del login (lenguaje).-
- Cambios de lenguaje en notes.-
- Cambios en el login Contact -> Contacto y Forum -> Foros.-
- Eliminado player.mo - no tenía ninguna utilidad.-
- Limpieza del archivo de lenguaje login.-
- Reemplazados todos los "Titanio", "Silicio" y "Gashofa" por "Metal", "Cristal" y "Deuterio".-
- Correciones de lenguaje en el install y limpieza de dicho archivo (Gracias Alberto14).-
',

'1.3c DMV' => ' 30/11/08 05:30 "DMV = Dark Matter Version Exclusivo Xtreme-gameZ.com.ar" 

- Correciones en los lenguajes de la supernova o super nave de batalla y el protector planetario (algo siempre me olvido).-
- Modificación de la ubicación de algunos arhcivos.-
- Eliminada una carpeta llamada .svn a la cual no le encontre utilidad.-
- Limpieza de archivos innecesarios y duplicados.-
- Implementada la materia oscura (Código 100% x lucky) (Gracias Reyndio por la idea).-
----- Los oficiales ahora se manejan por la materia oscura 1 punto oficial = 1000 materia oscura.-
----- En las expediciones se obtiene la materia oscura necesaria.-
----- No existen más los puntos de oficiales, aun asi se sube el nivel de minero y flota.-
----- Se siguen mostrando los registros de ataque.-
----- Auto-Update actualizado especialmente para soportar la materia oscura.-

- Ya no se pueden atacar lunas + fuerte o + debiles que uno (By Neurus).-
- Panel del admin, "Utilisateur?" -> "¿Usuario?", modificación en el lenguaje.-
- Por razones de seguridad elimine el phpinfo.-
- Panel del admin, "Lista de Usuarios" -> "Lista de Planetas", modificación en el lenguaje (Gracias Alberto14).-
- Solucionado el error en el orden por id de la alianza (By tarta).-
',


'1.3b EU' => ' 30/11/08 05:30

- No hace falta más ingresar el nombre del planeta, por defecto es "Planeta Principal".-
- Eliminadas imagenes del "sexo".-
- Optimizada la imagen del inicio, ahora carga más rápido.-
- Compatibilidad del auto-update con todas las versiones.-
- Nueva versión del auto update, más comprensible(creo).-
- Reparado el problema con la instalación (Gracias Anghelito).-
',

'1.3a' => ' 29/11/08 19:50

- XNova 100% TRADUCIDO AL ESPAÑOL [PUDE HABERME SALTEADO ALGO POR FAVOR AVISAR](By lucky).-
- Limpieza de scripts, eliminamos varios archivos de la carpeta scrips que notamos no necesarios.-
- Reparada la validación del index, ahora si la carpeta install existe no podras acceder al juego (By lucky).-
- Arreglado el modo vacaciones, ya no puedes entrar en vacaciones cuando estas atacando (By lucky).-
- No se muestran más los recursos negativos.-
- Redirección luego de enviar una flota (By tarta).-
- Ahora los días se muestran con una "d" y no con una "j" (By tarta).-
- Nuevamente agregamos los emoticons.-
- Ahora puedes cambiar el nombre en el juego, por fin solucionamos esto.-
- Nuevo diseño del auto-update, mucho mas vistoso y atractivo.-
- Reparada la instalación, ahora funcionan los misiles al instalar el juego.-
',

'1.2c EU' => ' 26/11/08 21:40

- Reparada la instalación.-
',

'1.2b' => ' 26/11/08 20:59

- Misiles finalmente funcionando (By lucky).-
- Desbaneo automático (By Anghelito).-
- Reparado el modo vacaciones.-
- Traducciones en varios archivos (By edering).-
- Reparado el modo debug (By tarta).-
- Reparado el link de las notas (By lucky).-
- Eliminada la carpeta emoticones.-
- Fix ranking de flotas en vuelo (By Pada).-
- Mejoras en archivos de lenguaje.-
- Cambios en el mensaje de bienvenida.-
- Records reparados.- (By tarta).-
- Actualizado el auto-update para poder actualizar: 0.9a -> 1.2a / 1.1b -> 1.2a / 1.2a -> 1.2b (By lucky).-
- Cambios en el instalador.-
- Se elimino una tabla que no hacia falta.-
',

'1.2a' => ' 19/11/08 20:38

- Actualizado el auto-update para poder actualizar: 0.9a -> 1.2a y 1.1b -> 1.2a .-
- Reorganización, recodificación y reestructuración de los misiles interplanetarios, ademas de solucionar seberos bugs.-
- Solo se permiten caracteres alfanumericos en el nombre de los planetas, evita serios bugs y filtros de seguridad.-
- Arreglado el orden por puntos en la alianza.-
- Tutorial funcionando.-
- Correcciones en el mensaje de bienvenida pos-registro.-
- Solucionado el bug que no permitía la transferencia de la alianza.-
- Solucionado el bug que hace que salga el rango equivocado al usuario en la lista de miembros de la ally.-
- Solucionado el bug que permitía que se envien solicitudes una vez que la alianza habia sido borrada.-
- Reparada la red de investigación intergaláctica.-
- Cupula y protector planetario funcionando, y cada una solo puede ser edificada una vez.-
',

'1.1c' => ' 19/11/08 11:29

- Cambios en la organización de la carpeta templates.-
- Algunos fixes en el leftmenu del admin.-
- Nuevamente reparada la seccion de de Annonces (sirve para comerciar).-
- Volvimos a implementar el leftmenu antigüo, funciona más rápido.-
- Mejoras en algunas traducciones, y añadidas otras.-
- Añadida la hora al chat. [Aún no funciona en hostings].-
- Limpieza de archivos inecesarios y/o sin ninguna utilidad.-
- Añadido el auto-update.-
- Eliminado el upgrade desde ugamela.-
- Mejoras en la instalación.-
',

'1.1b' => ' 30/10/08 19:39

- Añadido un tutorial, desarrollado por PowerMaster para el XNova de Xtreme-gameZ.com.ar.-
- Cambios de nombre del archivo de instalacion "Installeur" a "Instalacion de XNova".-
- Cambios en el leftmenu para usuarios.-
- Actualizacion de Puntos Automaticamente, ahora si anda.-
- Introduccion del Release de Xtreme-GameZ en "credit.php" e "install.php".-
- Cambios de idioma de carpeta "fr" a carpeta "es" (requiere instalacion).-
',

'1.1a' => ' 28/10/08 11:30

- Antes, si mandaban una flota y cambian de planeta, tiraba error.-
- Antes, cuando estaban leyendo mensajes y cambian de planeta, tiraba error.-
- Ahora al cancelar una investigación te devuelve los recursos.-
- Cambio en el texto del primer mensaje recibido al registrarse en el juego.-
- Agregadas las estadísticas de batalla.-
- Fueron agregadas las defensas al ranking de la Visión General.-
',


'1.0b' => ' 26/10/08 22:44

- Primer release disponible para los usuarios.-
- Eliminado el warning que aparecía en la instalación del sistema.-
- El instalador ahora incluye la actualización de puntos automática, por ende el usuario ya no debera tocar nada en el código.-
- Aplicada la actualización automática de puntos.-
',


'1.0a' => ' 24/10/08 13:11 "Versión Inicial"

- Cambios de lenguaje en el changelog (100% traducido).-
- Mejora del menú de la izquierda se "visualiza" algo mejor.-
- Correciones de lenguaje en el install (install.mo).-
- Correciones en el Marchand (Mercader), ya esta funcionando correctamente, no tira más ese error del lenguaje.-
- Fixes en el link de Annonces, ahora esta funcionando, ya puedes publicar lo que desees comercias.-
- Inicio del proyecto XG (XG Proyect) basandonos en el pack hecho por XNova versión 0.9a.-
',
);
?>