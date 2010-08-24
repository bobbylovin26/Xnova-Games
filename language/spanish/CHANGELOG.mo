<?php

$lang['Version']     = 'Versi�n';
$lang['Description'] = 'Descripci�n';
$lang['changelog']   = array(


'2.5' => ' 18/08/09

- [Novedad] Sistema de advertencias y errores en el panel de administraci�n (tambi�n informa la existencia de una nueva versi�n).-
- [Novedad] Ahora puedes determinar si al banear un jugador este debe entrar o no en modo vacaciones.-
- [Novedad] Gracias a 3R1K que tradujo el panel de administraci�n en su totalidad al idioma ingl�s.-
- [Novedad] Redise�ado el panel de administraci�n.-
- [Novedad] Ahora la p�gina de mensajes respeta el formato del OGame original, mostrando a los operadores del juego.- 
- [Novedad] Ahora cuando borras un planeta aparece planeta destruido como en el OGame original.-
- [Novedad] El misil interplanetario ahora requiere el hangar en nivel 1 y el motor de impulso en 1 como en el OGame original.-
- [Novedad] El misil de intercepci�n ahora requiere el hangar en nivel 1 como en el OGame original.-
- [Novedad] El silo ahora requiere el hangar en nivel 1 como en el OGame original.-

- [Fix][Varios] Varios bugs menores de estilo, plantillas y lenguaje reparados.-
- [Fix][Bug #14] No se pueden usar skins externos.-
- [Fix][Bug #47] Bug que provoca en IE que no se vea el menu y quede desplazado hacia arriba al bajar demasiado en una p�gina.-
- [Fix][Bug #61] Problemas en el conteo de los jugadores en la visi�n general.-
- [Fix][Bug #62] Peque�o bug que no muestra los stats correctamente en el overview.-
- [Fix][Bug #63] Bug en la funci�n del manejo de las sesiones.-
- [Fix][Bug #64] Bug con los permisos y con las lunas, evitando que sean atacadas.-
- [Fix][Bug #65] Bug que no permite espiar desde flota pero si desde la galaxia.-
- [Fix][Bug #66] Problemas en los niveles del phalanx.-
- [Fix][Bug #67] Producci�n ilimitada de misiles.-
- [Fix][Bug #68] Bug en el link para Continuar/Volver luego de enviar un mensaje circular en la alianza.-
- [Fix][Bug #69] Bug que muestra mal los mensajes de error cuando un usuario no esta logueado.-
- [Fix][Bug #70] Problemas con el salto de l�nea en los mensajes circulares.-
- [Fix][Bug #71] Problemas con la misi�n estacionar aliado, muestra un mensaje de que el jugador es muy fuerte.-
- [Fix][Bug #72] Bug en la diferencia de energ�a consumida actual, anterior y posterior.-
- [Fix][Bug #74] No se puede abandonar la alianza.-
- [Fix][Bug #75] Problemas en la actualizaci�n de puntos de algunos jugadores.-
- [Fix][Bug #76] La misi�n de espionaje ignora el estado de vacaciones desde la visi�n de galaxia.-
- [Fix][Bug #77] Al hacer regresar una flota con misi�n mantener posici�n no descuenta los tiempos correctamente.-
- [Fix][Bug #79] Bug que permite incrementar las tecnolog�as (Gracias a mikey302 y death).-
- [Fix][Bug #80] Bug en el limite de envio m�ximo de expediciones.-
- [Fix][Bug #81] Bug en la visi�n general de la alianza, mantiene el nombre "Fundador" del fundador de la alianza.-

- [Cambio] Ahora el n�mero de la versi�n de obtiene de la base de datos.-
- [Cambio] Mejoras de seguridad en la p�gina de la alianza.-
- [Cambio] Noticias removidas.-
- [Cambio] Mejorada la velocidad en que se genera la p�gina de estad�sticas y algunos cambios menores.-
- [Cambio] Nuevas alertas de presencia del directorio install y de escritura del archivo config.php.-
- [Cambio] Los recicladores ahora s�lo pueden transportar 20.000 unidades de recursos como en el OGame original.-
- [Cambio] Removida la p�gina de contacto, ahora puedes encontrar a los adms/mods/oper en el panel de mensajes como en el OGame.-
- [Cambio] Ahora a la derecha del nombre de la luna aparece la referencia (Luna) como en el OGame original.-
- [Cambio] Ahora si en la visi�n general tienes seleccionada la luna no se mostrar� esta otra vez a la izquierda.-
- [Cambio] Reformas en la galaxia en c�digo y organizaci�n de las clases y plantillas.-
- [Cambio] Juego adaptado al skin original del OGame, ahora el juego ser� a su vez compatible con cualquier skin.-
',


'2.4' => ' 25/07/09

- [Seguridad] Protecci�n con .htaccess de la carpeta includes, language y templates.-
- [Seguridad] Protecci�n con .htaccess de common.php, config.php y extension.inc.php.-
- [Seguridad] Cambio en el protecci�n de carpetas.-
- [Seguridad] Mejoras de seguridad en diversos archivos.-

- [Novedad] Nuevo sistema de estad�sticas, m�s r�pido, m�s simple, menos querys, menos carga, y nuevo panel para administrarlas; (By angelus_ira) Muchas gracias =) .-
- [Novedad] Nuevo sistema de idioma, ahora el idioma es configurable desde el panel de administraci�n, seleccionando un lenguaje a la vez.-
- [Novedad] La tecnolog�a de espionaje funciona como en el ogame original:
-------- Nivel 0 a 1 -> Sin datos de la flota.-
-------- Nivel 2 a 3 -> N�mero total de naves.-
-------- Nivel 4 a 7 -> N�mero total de naves y el tipo de las naves.-
-------- Nivel 8 -> N�mero total de naves, tipo de nave y cantidad de cada tipo.-

- [Novedad] Ahora el administrador puede decidir si los administradores y/o moderadores se les actualizar�n o no los puntos.-
- [Novedad] Ahora el administrador puede decidir si los administradores y/o moderadores pueden o no recibir ataques de otros jugadores.-
- [Novedad] Ahora en las investigaciones te muestra el nivel de espionaje y computaci�n que te dan los comandantes.-
- [Novedad] Cuando un usuario es baneado, ahora le muestra la fecha en que finaliza su ban.-

- [Fix][Varios] Corregidos varios bugs menores de redirecci�n, visuales, textos y configuraciones.-
- [Fix][Bug #1] Al achicar la pantalla se superpone el menu de recursos con el resto del cuerpo.-
- [Fix][Bug #2] Ahora cuando una cuenta es baneada, el jugador baneado no podr� acceder a la cuenta de ningun forma.-
- [Fix][Bug #3]	Al borrar una luna, ya no borrar� el planeta.-
- [Fix][Bug #4] Reparados algunos bugs en el phalanx.-
- [Fix][Bug #8] Corregida la visi�n del imperio, ahora muestra las investigaciones.-
- [Fix][Bug #9] Ahora al cerrar el servidor un usuario com�n no podr� ingresar.-
- [Fix][Bug #10] Problemas en los permisos de las alianzas.-
- [Fix][Bug #11] Ahora al cerrar el servidor no desaparece m�s el mensaje con el motivo para cerrarlo.-
- [Fix][Bug #12] Ahora la misi�n desplegar funciona correctamente.-
- [Fix][Bug #13] La misi�n estacionar en aliado funciona correctamente, no se repiten m�s mensajes, ni tampoco produce tiempos negativos cuando se selecciona como tiempo de estacionamiento 0 horas.-
- [Fix][Bug #15] Problemas con la misi�n de recoleccion o reciclaje, no entrega los recursos a quien corresponde.-
- [Fix][Bug #16] Problemas con los tiempos del hangar al cambiar de planeta, volviendo el tiempo a su estado incial.-
- [Fix][Bug #17] Los oficiales almirante y general funcionan correctamente [oficiales al 100%].-
- [Fix][Bug #18] Problemas con la planta en nivel 1 permitiendo la produccion de recursos (Fixed by zorro2666).-
- [Fix][Bug #19] Ahora si un jugador es fuerte o d�bil y al mismo tiempo est� inactivo podr� ser atacado de todas formas.-
- [Fix][Bug #20] Problemas de caracteres en los textos de registro.-
- [Fix][Bug #21] No funciona el enviar mensaje cuando recibes un ataque.-
- [Fix][Bug #22] Problemas con los mensajes al redactar un mensaje privado en la parte visual.-
- [Fix][Bug #23] Fallan los links que redirigen a la galaxia durante los movimientos de flotas.-
- [Fix][Bug #24] El hangar permite producir igual durante su ampliaci�n (Fixed by zorro2666).-
- [Fix][Bug #25] Se puede ampliar el hangar mientras de produce (Fixed by zorro2666).-
- [Fix][Bug #26] No sale el nombre del jugador en color verde en las estad�sticas.-
- [Fix][Bug #27] Bug que permite ampliar el laboratorio e investigar al mismo tiempo.-
- [Fix][Bug #29] Bug en el select de las estad�sticas al cambiar la p�gina mostrando la primer p�gina siempre.-
- [Fix][Bug #30] Problemas con los campos del planeta y las colas de contrucci�n.-
- [Fix][Bug #32] Bug para ver el reporte de combate desde el panel de administraci�n.-
- [Fix][Bug #33] Bugs diversos menores en los misiles interplanetarios (Fixed by lordz).-
- [Fix][Bug #34] Bugs menores que no muestran correctamente los textos.-
- [Fix][Bug #35] Posible bug en los almacenes, incrementan menos de lo que deben.-
- [Fix][Bug #36] No aparece el icono para lanzar misiles en la galaxia.-
- [Fix][Bug #37] Bug que provoca que las colonias en la visi�n general se vean en filas de 5 y no de 2.-
- [Fix][Bug #38] Bug en la misi�n colonizar, si se alcanz� el limite de planetas entonces regresa instantaneamente sin respetar los tiempos.-
- [Fix][Bug #39] Bug en las expediciones que provoca la perdida de la materia oscura.-
- [Fix][Bug #40] Bug que no muestra la materia oscura recolectada en las expediciones.-
- [Fix][Bug #41] Peque�o bug que provoca un error en el update de puntos (Fixed by angelus_ira).-
- [Fix][Bug #42] Problemas con los textos, se pierden las frases y la cantidad de recursos en algunos reportes.-
- [Fix][Bug #43] Problemas con la proteccion de novatos al enviar sondas desde la galaxia y desde flota.-
- [Fix][Bug #44] Problemas con el js que actualiza los recursos, no teniendo en cuenta la velocidad del servidor.-
- [Fix][Bug #45] Los almacenes funcionan mal, debido a un bug en la relaci�n de incremento por nivel.-
- [Fix][Bug #46] bbCode ni HTML funcionan en los textos de la alianza.-
- [Fix][Bug #48] Se perdi� el texto de advertencia en las expediciones.-
- [Fix][Bug #49] Problemas con la actualizaci�n de puntos de la alianza.-
- [Fix][Bug #50] Problemas con los atajos.-
- [Fix][Bug #51] No aparece el icono de los mensajes para responder.-
- [Fix][Bug #52] Bug en la alianza que probaca un error en la base de datos.-
- [Fix][Bug #53] Problemas de duplicaci�n en la misi�n transportar.-
- [Fix][Bug #54] Bug que no permite generar las estad�sticas (Fixed by angelus_ira).-
- [Fix][Bug #55] Bug que mostraba la luna luego de que fuera destruida.-
- [Fix][Bug #56] Bug que no muestra el porcentaje de creaci�n de las lunas.-
- [Fix][Bug #57] Bug que provoca que no se muestren los mensajes en las expediciones.-
- [Fix][Bug #58] No se muestran los informes de construcci�n en el panel del admin.-
- [Fix][Bug #59] Los reportes de construcci�n no figuran en ninguna categor�a.-
- [Fix][Bug #60] Bug que permitia obtener tecnolog�as sin ning�n costo.-

- [Cambio] Optimizaci�n del manejo de flotas (By shoghicp).-
- [Cambio] Optimizaci�n del overview del admin (By jtsamper).-
- [Cambio] Reorganizadas algunas carpetas.-
- [Cambio] Ahora los administradores no podr�n borrarse a si mismos.-
- [Cambio] Ahora s�lo los administradores podr�n borrar jugadores.-
- [Cambio] Reducci�n de l�neas y simplificaci�n en el panel de admnistraci�n.-
- [Cambio] Finalmente el directorio includes queda definido con 3 carpetas (classes, functions y pages).-
- [Cambio] Integrado el auto-update a index.php en la carpeta install.-
- [Cambio] Cuando se registra un usuario ahora es redirigido directamente dentro del juego.-
- [Cambio] Se volvio al viejo sistema de mensajes.-
- [Cambio] El pack de idioma de divide en 4 archivos:

-------- ADMIN.mo -> TODO LO DEL PANEL DE ADMINISTRACI�N.-
-------- CHANGELOG.mo -> CHANGELOG TAL Y CUAL COMO ES CONOCIDO.-
-------- INGAME.mo -> TODO EL CONTENIDO INTERNO DEL JUEGO Y NO ACCESIBLE SIN TENER UNA CUENTA.-
-------- PUBLIC.mo -> TODO EL CONTENIDO P�BLICO DEL JUEGO (index.php, reg.php, clave perdida y contacto).-

- [Cambio] Ahora en la p�gina de la flota se muestra correctamente la velocidad de las naves al posicionar el mouse sobre el nombre de las mismas.-
- [Cambio] Ahora al realizar cualquier movimiento de flota desde la galaxia, tambi�n se pasa el valor de la misi�n por lo que si por ejemplo seleccionas atacar ya aparecer� marcado en el env�o de las flotas.-
- [Cambio] Ahora si el jugador esta inactivo podr� ser atacado, funcionando de la misma forma que en el ogame original.-
- [Cambio] Los archivos ShowFleetPage.php, floten1.php, floten2.php, y floten3.php ahora utilizan plantillas.-
- [Cambio] Finaliza el soporte a las siguientes versiones v1.4a/v1.4b/1.4c,por lo tanto no habr� m�s auto-update.php.-
- [Cambio] class.FlyingFleetHandler.php maneja todo lo que sea flotas, misiones y funciones especificas de las mismas.-
- [Cambio] Eliminada la experiencia de guerrero y minero.-
- [Cambio] Las funciones CreateFleetPopupedMissionLink, CreateFleetPopupedFleetLink y BuildHostileFleetPlayerLink fueron hubicadas en class.FlyingFleetsTable.php.-
- [Cambio] Dentro de la clase class.FlyingFleetsTable.php, encontramos las funciones BuildFleetEventTable y BuildFlyingFleetTable y todas las funciones que estas necesitan para funcionar.-
- [Cambio] rw.php ahora se llama CombatReport.php.-
- [Cambio] raketenangriff.php del root cambiado a MissilesAjax.php; y flottenajax.php cambiado a FleetAjax.php.-
- [Cambio] La funci�n GetNextJumpWaitTime fue movida de GeneralFunctions.php a class.ShOWInfosPage.php.-
- [Cambio] infos.php y jumpgate.php se encuentran en class.ShOWInfosPage.php.-
- [Cambio] Eliminado quickfleet.php no ten�a utilidad.-
- [Cambio] Home reprogramado y simplificado.-
- [Cambio] Ahora los oficiales esp�a y comandante son obtenidos desde la base de datos directamente y no suman espionaje y computaci�n, asi es m�s f�cil de administrar.-
- [Cambio] constantes.php nuevamente se llama constants.php y funciones.php se llama ahora GeneralFunctions.php.-
- [Cambio] class.ShowShipyardPage.php maneja la construcci�n de defensas y naves.-
- [Cambio] Implementado el dise�o del OGame original para el overview.-
- [Cambio] Adaptado el dise�o de la p�gina de los oficiales al resto del juego.-
- [Cambio] En la visi�n de la galaxia no se realizan mas revisiones de los campos de los planetas.-
- [Cambio] La funci�n sendnewpassword fue integrada al lostpassword en el archivo index.php.-
- [Cambio] Limitada la query que traia los datos en la visi�n del imperio, reducida un poco la carga.-
- [Cambio] Las funciones de Strings.php fueron movidas a funciones.php.-
- [Cambio] Ahora si no tenes materia oscura para reclutar oficiales aparecer� el reclutar en rojo y bloqueado.-
- [Cambio] Notar que el manejo de las p�ginas esta en game.php.-
- [Cambio] Todas las p�ginas del juego ahora se manejan con funciones y/u objetos.-
- [Cambio] Inicio de la exportaci�n del c�digo a objetos.-
- [Cambio] Eliminados los title de las p�ginas, ahora s�lo se muestra el nombre del servidor.-
- [Cambio] Ahora la base lunar s�lo da 3 campos por nivel, tal cual y como es en el ogame original.-
- [Cambio] Ahora para mostrar que un usuario fue baneado, se imprime un texto y no se recurre a una plantilla.-
- [Cambio] Ahora no aparecen m�s mensajes de confirmaci�n al editar, crear o borrar una nota.-
- [Cambio] Ahora las notas nuevamente se abren en un pop-up.-
',

'2.3' => ' 30/05/09

- Corregido un bug que no permit�a cambiar el rango a los miembros dentro de las alianzas.-
- Varios cambios en el panel del admin:

-------- Integrados todos los archivos de lenguaje.-
-------- Renombrado el archivo para el reset del universo.-
-------- Unos cuantos cambios en mats.php, tanto de estilos como limpieza de c�digo.-
-------- Cambios en el left-menu del panel de administraci�n.-
-------- Renombrados algunos archivos y realizadas algunas correciones menores.-
-------- Unos cuantos ajustes en los textos y plantillas de varios archivos.-
-------- Mensaje de confirmaci�n al intentar eliminar a un jugador del servidor.-
-------- El archivo mats.php ahora se llama adminresources.php, ademas se le integro todos los archivos que manejaban las tecnolog�as y recursos.-
-------- Solucionado el bug de la actualizaci�n de puntos.-
-------- Nueva funci�n (optimizar tablas) (By Saint).-
-------- Corregido un bug que al crear una luna no le asignaba el nombre seleccionado.-
-------- Nueva funci�n (eliminar luna) (By tonique).-
-------- Corregido un bug que en la lista de lunas no mostraba el id real de la luna.-
-------- Si el usuario no tiene nivel 1 al menos no podr� ver nada del panel de administraci�n.-
-------- Optimizadas algunas querys en messall.php
-------- Eliminado el QueryExecuter.php

- Se finaliz� el soporte a las versiones v1.4d/v1.4e/v1.4f y tambi�n el auto-update de las mismas.-
- Eliminadas algunas querys innecesarias de MissionCaseMIP.php.-
- Se elimino una query innecesario de MissionCaseRecycling.php.-
- Limpieza de la base de datos de campos innecesarios dentro de la tabla users.-
- Algunos cambios y mejoras en el update.php.-
- Ahora s�lo sumar�n puntos de guerrero los jugadores que realicen batallas y no ambos.-
- Reparado un bug que mostraba el mensaje de la flota al finalizar la misi�n.-
- La experiencia del minero ya no se muestra m�s con decimales.-
- Se volvi� al antiguo dise�o de la construcci�n de edificios.-
- Corregido un bug que en al finalizar una construcci�n en el overview aparec�a Construcci�n() en vez de Libre.-
- Algunas modificaciones en los cr�ditos.-
- Modificados algunos aspectos en el aspecto interno del juego.-
- Cambiada la imagen dentro del juego.-
- Redise�ado el index, espero que les guste.-
- Agregado un favicon, cada uno podr� cambiarlo por el que quiera.-
- Eliminados algunos residuos provenientes de otras versiones.-
- Eliminados los frames, ahora el menu se muestra con la funci�n ShowLeftMenu.php y algo de estilos css para ajustar todo.-
- Cambiados todos los $xnova_root_path por $xgp_root.-
',

'2.2' => ' 06/05/09

- Se reemplazo el men� derecho e izquierdo por el original, y la imagen del fondo tambi�n.-
- Revisado todo messages.php,se eliminaron querys innecesarias, se organizo el c�digo, se restringieron algunas querys para optimizar la p�gina, se elimiaron elementos sin utilidad y se integro el lenguaje.-
- Toda la galaxia fue revisada, se hicieron algunas correciones en los textos y algunas mejoras visuales.-
- Corregido un bug que impedia cambiar la cantidad de planetas, sistemas y galaxias que se pod�an utilizar en el universo (modificable desde constantes.php), recomiendo dejarlo en 9-499-15, asi no saturan mucho el juego.-
- Renombrado functions.php a funciones.php
- Limpieza y revisado de constants.php, renombrado a constantes.php.-
- Corregido un bug en la p�gina de tecnolog�as.-
- Eliminadas las vars de los mensajes, no ten�an utilidad.-
- Se revisaron nuevamente todas las funciones y fueron nuevamente reasignadas utilizando el sistema de funciones_A y funciones_B.-
- Solucionado el bug de las p�ginas en blanco, dejando la versi�n bastante estable [BETA].-
- Nueva forma de distribuir las funciones, en A y B. Para mas detalles lean la informaci�n que deje comentada en commons.php, esto es provisorio, aunque creo que es la mejor forma de agilizar el juego, y tenerlo m�s estable.-
- Peque�o cambio en el ingreso, eliminando algunas lineas.-
- Algunos cambios en el commons.php y eliminadas algunas cosas innecesarias.-
- Corregido un peque�o bug en las listas de lunas.-
- Corregido un bug en la opci�n de crear lunas.-
',

'2.1' => ' 02/05/09

- Peque�o cambio en el index y la selecci�n de la p�gina.-
- Incluido reg.mo directamente a reg_form.tpl y reg.php.-
- Modificado el dise�o del registro y de la p�gina de clave perdida.-
- Correcciones gr�ficas en el index.-
- SACS funcionando al 50% [problemas en la coordinaci�n de los tiempos y en la visi�n de los movimientos de flotas].-
- Cambio visual en las estad�sticas, ahora el *, +1 y -1 (rankplus), se muestra con js(overlib).-
- Limpieza en commons.php con lo que durante el movimiento de flotas reducira la carga del juego.-
- Ahora al realizar un espionaje ya no aparecer� la p�gina en blanco ni tampoco tirara error.-
- Corregidos unos cuantos bugs provocados por la distribuci�n de las funciones.-
- Nuevas im�genes de planetas, mucho m�s vistosas.-
- Corregido un peque�o bug que no permit�a ver las p�ginas publicas(contact.php, reg.php, credit.php y la secci�n de clave perdida).-
',

'2.0' => ' 23/04/09

- Visi�n general del panel del admin mejorada, ajustada mejor la tabla e integrado el lenguaje a las plantillas.-
- Simplificaci�n del sistema de cr�ditos, e integraci�n del lenguaje.-
- Integrado el idioma a resources.php y a las respectivas plantillas.-
- Cambios en las tablas de las estad�sticas, incluci�n del lenguaje a las plantillas, revisi�n del c�digo y algunas mejoras en la carga.-
- Algunos cambios visuales en fleet.php.-
- Eliminada la funci�n AdminMessage, cumplia la misma funci�n que message.-
- Optimizaci�n e integraci�n del lenguaje a admin/settings.php
- Algunas correcciones que previenen que por la actualizaci�n de puntos se provoque un bug en el panel de administraci�n.-
- Optimizadas algunas querys de las flotas en commons.php.-
- Correciones en algunos textos en los mensajes de movimientos de flotas.-
- Mejora de seguridad, no podr�s ver las p�ginas internas del juego sino te logueaste.-
- Ahora se pueden ver bien los mensajes de error e informes de los mensajes.-
- Corregido un bug que al abandonar un planeta no borraba la luna, y esta pod�a ser utilizada.-
- Simplificaci�n y reorganizaci�n de BatimentBuildingPage.php.-
- Correcciones visuales en los edificios, y correciones de algunas tablas para ajustarlas mejor.-
- Nueva imagen de materia oscura en el men� superior, tambi�n se ampliaron los tama�os de las im�genes.-
- Reparado un bug que permit�a mover flotas en modo vacaciones.-
- Traducido el mensaje del modo vacaciones, y corregido un bug que no mostraba el tiempo real de vacaciones.-
- Cambiados algunos $ugamela por $xnova.-
- Implementaci�n de seguridad, fue renombrado el archivo extension.inc a extension.inc.php, no estaba protegido y pod�a leerse su contenido.-
- Algunas correcciones y simplificaci�n del c�digo en buddy.php.-
- Revisado todo el notes.php:

--------- Plantillas agregadas a su carpeta correspondiente "notes".-
--------- Algunas correciones visuales.-
--------- Integraci�n del idioma a las plantillas.-
--------- Reparados algunos bugs.-
--------- Ahora al editar el mensaje, se muestra el asunto y el mensaje.-
--------- Conteo de caracteres en js aplicado.-

- Eliminadas algunas funciones de administraci�n.-
- Reparado un bug que no mostraba el l�mite real de las flotas posibles a enviar.-
- Oficiales:

--------- Algunas correciones visuales.-
--------- Oficiales pendientes por reparar: Almirante y General.-
--------- Oficiales funcionando: Ge�logo, Ingeniero, Tecn�crata, Constructor, Cient�fico, Almacenista, Defensor, Bunker, Esp�a, Comandante, Destructor, Raider y Emperador.-
--------- Reparados los oficiales esp�a y Comandante.-
--------- Reparado el oficial empeador(By thyphoon) y destructor(By angelus_ira).-
--------- Integraci�n del idioma a las plantillas y c�digo.-

- Limpieza de scripts.-
- Re-organizadas todas las funciones del juego (optimizandolo incre�blemente)(cada funci�n se asigno a su archivo correspondiente).-
- Eliminado CombatEngine.php.-
- Algunas correciones en commons.php para agilizar el juego en general.-
- Limpieza y optimizaci�n del instalador.-
- La funci�n doquery fue unificada tambi�n dentro de functions.php.-
- Las funciones de unlocalised.php fueron integradas a functions.php
- Limpieza de funciones inutiles en includes/functions:

--------- Eliminado RevisionTime.php.-
--------- Eliminado SecureArrayFunction.php.-
--------- Eliminado ResetThisFuckingCheater.php.-
--------- Eliminado ElementBuildListQueue.php, el archivo ElementBuildListBox.php cumple la misma funci�n y se encuentra en uso.-

- Limpieza en functions.php,se borraron algunas funciones sin utilidad alguna.-
- Limpieza en unlocalised.php,se borraron algunas funciones sin utilidad alguna o vac�as.-
- Se reorganizaron casi todas las plantillas y se borraron algunas m�s sin utilidad (algunas pedientes a organizar).-
- Se borraron todas las plantillas de la galaxia que no ten�an utilidad(la galaxia la genera el c�digo php din�micamente).-
- Revisado todo el search.php:

--------- Borradas algunas lineas.-
--------- Reorganizado el c�digo.-
--------- Reorganizadas las plantillas en una carpeta en templates.-
--------- Se integro search.mo a las plantillas.-
--------- Se corrigi� un bug que no mostraba la alianza en la b�squeda por usuarios.-
--------- Se corrigi� un bug que no redirig�a correctamente a la vista de la alianza.-
--------- Se corrigi� un bug dentro de la alianza para poder verla desde search.php

- Revisado todo el mercader:

--------- Adherido marchand.mo a sus respectivas plantillas.-
--------- Corregidas todas las plantillas y bugs en la muestra de los recursos(no aparecen m�s en eltop).-
--------- Simplificaci�n del c�digo php, reorganizado y reprogramado lo que no funcionaba bien.-
--------- Corregidas las validaciones, admiten ceros, pero no n�meros negativos.-
--------- A�adidas las plantillas respectivas a una carpeta en templates(para una mejor organizaci�n).-

- Cookies.mo integrado a su archivo correspondiente.-
- Algunos textos fueron colocados en system.mo, ya que hacen al caracter general del juego, y no de un sector en especifico.-
- Optimizado MissionCaseAttack.php.-
- Optimizado el overview, se elimino c�digo innecesario, se reorganiz�, se eliminaron querys que no ten�an utilidad y se integro el idioma a las plantillas.-
- Reubicados algunos archivos.-
- Limpieza de la base de datos, de cosas que no se utilizaban.-
- Reorganizado el men� de opciones, integraci�n del idioma a la plantilla y se eliminaron querys innecesarias.-
- Algunos archivos de texto fueron integrados directamente a los archivos para agilizar el juego y su velocidad.-
- Se reorganizaron algunas plantillas y se eliminaron algunas otras in�tiles.-
- Eliminados los emoticones.-
- Como siempre actualizados el auto-update y el instalador para que todo sea m�s facil.-
- Cambios en el instalador.-
- Optimizadas unas cuantas p�ginas.-
- login.php, lostpassword.php y logout.php unificados en el index.php mejorando un poco el rendimiento y organizaci�n.-
- Algunas correcciones visuales en la visi�n del imperio.-

- Revisada toda la alianza:

--------- Mejoras varias.-
--------- Mejoras en lenguajes.-
--------- Mejoras en plantillas.-
--------- Se agregaron validaciones.-
--------- Se reorganiz� el c�digo.-
--------- Se reparo el texto de las solicitudes, ahora podr�s editarla.-
--------- Todos los mensajes ahora te redirigiran.-
--------- Se corrigi� un bug en los rangos.-
--------- Se optimiz� un poco, se eliminaron lineas in�tiles y se fixearon algunos bugs.-
--------- Se repararon todos los errores encontrados en los textos y plantillas que no se mostraban, asi como cosas que no se realizaban.-

- Cuando un usuario falla al intentar el login ahora es redirigido al inicio.-
- Mejorado el index ahora funciona mucho m�s r�pido.-
- Mejorados algunos textos en general, y corregidos algunos detalles.-
- Redise�ado el sistema de ingreso al panel del admin y regreso al juego.-
- Limpieza de archivos y residuos.-
- Eliminado el chat, loteria, razas, simulador, tutoria, records y todo aquello que no consideraba necesario.-
- Reprogramados los men�s derechos e izquierdos.-

- Un resumen de las figuras m�s destacadas de este proyecto:

--------- Tomo las riendas sobre la 1.5b saltando a la 2.0 para trerles todas las mejoras enunciadas a continuaci�n [By lucky].-
--------- Partiendo de la version 0.9a llegando hasta la 1.5b del XG Proyect por lucky, PowerMaster, Calzon, Tarta, Tonique y muchas personas m�s.-
--------- Continuado por UGamela Britania con varias mejoras, seguido por el equipo franc�s Raito, Chlorel, e-Zobar y Flousedid.-
--------- Proyecto ogame para todos y con todas las funciones iniciado por Perberos.-
',

'1.5b' => ' 03/04/09

- Cambios y correcciones en templates y textos.-
- Loteria reparada (By lucky).-
- Correciones en el instalador, soportando correctamente las razas, y tambi�n en el auto-update.-
- Razas corregidas (By Tonique).-
- Corregido un bug en el instalador.-
',

'1.5a' => ' 26/03/09

- Corregido el link de administraci�n.-
- Mejoras en el instalador.-
- Fix corregido bug que mostraba mal la leyenda en la galaxia.-
- Actualizado el auto-update para poder pasar f�cilmente de la versi�n 1.4f o de la 1.4c a la 1.5a.-
- Ahora la instalacion incluye la loter�a y el chat, no deber�s hacer nada manualmente.-
- Arreglada la p�gina de amigos ahora deber�a mostrar bien a tus amigos y no a vos (By lucky).-
- Mejorado el auto-update de puntos, ahora podr�s instalar sin realizar modificaciones en los archivos.-
- Unificamos la versi�n de XG Proyect con la de calzon.-
',

'1.4f' => ' 18/03/09

- Fix peque�as correciones en la base de datos.-
- Fix peque�as correcciones en traducciones generales.-
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

'1.4e' => ' 12/03/09

- Fix a textos e imagenes de naves y defensas nuevas asi como a razas.-
- Fix Enviar mutiples flotas, expediciones, misiones, al ir atras (modo test por ahora).-
- Fix Corregido bug en consumo de deuterio (flotenajax.php).-
- Fix corregido bug al abandonar colonias por fallo seguridad (overview.php).-
- Fix En Estadisticas aparecias en una alianza aunque ya hubieras salido (alliance.php).-
- Mod 4 Nuevas naves: Interceptor, Cazador Crucero, Transportador y Titan.-
- Mod 2 Nuevas defensas: Ca�on de Fotones y Base Espacial.-
- Mod Nueva Tecnologia de Desarrollo, aumenta colas posibles a edificios.
<font color="green">- Mod Razas: Humanos, Aliens, Predators y Darks, con cada nivel aumenta:.-</font>
<font color="green">- Humanos: Mina Metal +3% produccion, +2% Ataque y Escudos.-</font>
<font color="green">- Aliens: Mina Cristal +3% produccion, +3% Blindaje.-</font>
<font color="green">- Predators: +10% Ataque.-</font>
<font color="green">- Darks: Sintetizador Deuterio +3% produccion, +4% Blindaje y Escudos.-</font>
',

'1.4d' => ' 09/03/09

- Fix algunas traducciones.-
- Fix Ajustado a resolucion 1024x768, reacomodo en columnas de edificios y frames.php-
- Fix multiplicacion/Duplicacion de ligeros y estrellas de la muerte (flotten1.php).-
- Fix Seguridad de carpetas, una mas, aparte de la que ya existia.-
- Fix en Mercader, devolvia recursos al meter numeros negativos (marchand.php).-
- Fix Misiles (projectxnova) adaptado y corregido a esta version (MissionCaseMIP.php).-
- Fix agregado entero en funcion investigaciones (ResearchBuildingPage.php).-
- Fix, peque�a correccion en alianzas rangos y administracion(alliance.php).-
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

'1.4c' => ' 08/02/09

- Eliminados los recursos en tiempo real debido a que se quedaban congelados.-
- Reparados los oficiales esp�a y comandante.- (By jtsamper foro project.xnova.es)
- En la galaxia ya no puedes reciclar o espiar sin deuterio.-
- Prevenir n�meros negativos y car�cteres no num�ricos en la galaxia (By neurus foro Xproject.xnova.es).-
- Ahora para ver la galaxia necesitas deuterio (Original project.xnova.es fixeado por lucky).-
- Al disolver una alianza esta ya no aparece en las estad�sticas (By xesar foro project.xnova.es).-
- Corregida una redirecci�n que funcionaba mal en la alianza.-
- Corregido un peque�o error de sintaxis en la flota que tiraba severos reportes de errores (Gracias edering).-
- Agregado un mensaje recordatorio de como se debe incrementar o eliminar la materia oscura (Gracias edering).-
- Anuncios eliminados (Por votaci�n de los usuarios de XG).-
- El auto-update no soporta m�s las siguientes versiones:  v0.9a/v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a (Si tienes alguna des estas versiones deber�s usar un update anterior).-
- Ahora en la busqueda al hacer click en el link te redirecciona al sistema del jugador y no al tuyo (By Anghelito).-
',

'1.4b' => ' 06/12/08

- Desbaneo reparado.-
- Oficiales reparados.-
- Ahora al iniciar sesi�n con tu cuenta, iniciar� siempre desde el planeta principal y no desde una colonia.-
- Un moderador u operador ya no podr� cambiarse los permisos a Administrador.-
- Galaxia optimizada.-
- Ahora cuando colonizas tu planeta se llamar� "Colonia" y no "Planeta Principal" (By lucky).-
- El auto-update no soporta m�s las siguientes versiones:  v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a/v1.2b/v1.2c/v1.3a (Si tienes alguna des estas versiones deber�s usar un update anterior).-
- Corregidas algunas redirecciones y mejoradas otras.-
- Ahora puedes usar espacios en blanco en el nombre de tu planeta (By lucky).-
- Borrado de archivos innecesarios (esto no termina m�s).-
- Reparada la tabla que muestra las flotas en vuelo en el panel del admin.-
- Mejoras, organizaci�n, limpieza y optimizaci�n del lenguaje (No pongo m�s que cambie en los lenguajes porque ya es detallar mucho, para nada).-
',

'1.4a' => ' 06/12/08

- Reparado el reset del universo.-
- El auto-update no soporta m�s las siguientes versiones: v1.0a/v1.0b/v1.1a/v1.1b/v1.1c/v1.2a (Si tienes alguna des estas versiones deber�s usar un update anterior).-
- M�s limpieza de archivos innecesarios.-
- Limpieza y pulido del panel de admin (lenguaje).-
- Lista de planetas <-> Lista de usuarios cambiado (lenguaje - Gracias Alberto14).-
- Ahora puedes agregar y remover materia oscura desde el panel de administraci�n (By lucky).-
- Actualizaci�n en tiempo real de los recursos (By Alberto14).-
- Cambidas las im�genes del XNova, por las im�genes del OGame original.-
- Borradas im�genes innecesarias.-
- Optimizadas las im�genes de los oficiales.-
- Eliminado el multi totalmente (A pedido del p�blico).-
- Eliminados los records totalmente (A pedido del p�blico).-
- Eliminado el chat totalmente (A pedido del p�blico).-
- Traducidos algunos textos en el formulario de env�o de mensajes (lenguaje).-
- Complementado el infos.mo con los datos del verdadero OGame (lenguaje).-
- Pulido y limpieza del search (lenguaje).-
- Pulido y limpieza del overview (lenguaje).-
- Pulido y limpieza del leftmenu (lenguaje).-
- Pulido y limpieza del registro (lenguaje).-
- Pulido y limpieza del login (lenguaje).-
- Cambios de lenguaje en notes.-
- Cambios en el login Contact -> Contacto y Forum -> Foros.-
- Eliminado player.mo - no ten�a ninguna utilidad.-
- Limpieza del archivo de lenguaje login.-
- Reemplazados todos los "Titanio", "Silicio" y "Gashofa" por "Metal", "Cristal" y "Deuterio".-
- Correciones de lenguaje en el install y limpieza de dicho archivo (Gracias Alberto14).-
',

'1.3c DMV' => ' 30/11/08 "DMV = Dark Matter Version Exclusivo Xtreme-gameZ.com.ar"

- Correciones en los lenguajes de la supernova o super nave de batalla y el protector planetario (algo siempre me olvido).-
- Modificaci�n de la ubicaci�n de algunos arhcivos.-
- Eliminada una carpeta llamada .svn a la cual no le encontre utilidad.-
- Limpieza de archivos innecesarios y duplicados.-
- Implementada la materia oscura (C�digo 100% x lucky) (Gracias Reyndio por la idea).-
----- Los oficiales ahora se manejan por la materia oscura 1 punto oficial = 1000 materia oscura.-
----- En las expediciones se obtiene la materia oscura necesaria.-
----- No existen m�s los puntos de oficiales, aun asi se sube el nivel de minero y flota.-
----- Se siguen mostrando los registros de ataque.-
----- Auto-Update actualizado especialmente para soportar la materia oscura.-

- Ya no se pueden atacar lunas + fuerte o + debiles que uno (By Neurus).-
- Panel del admin, "Utilisateur?" -> "�Usuario?", modificaci�n en el lenguaje.-
- Por razones de seguridad elimine el phpinfo.-
- Panel del admin, "Lista de Usuarios" -> "Lista de Planetas", modificaci�n en el lenguaje (Gracias Alberto14).-
- Solucionado el error en el orden por id de la alianza (By tarta).-
',


'1.3b EU' => ' 30/11/08

- No hace falta m�s ingresar el nombre del planeta, por defecto es "Planeta Principal".-
- Eliminadas imagenes del "sexo".-
- Optimizada la imagen del inicio, ahora carga m�s r�pido.-
- Compatibilidad del auto-update con todas las versiones.-
- Nueva versi�n del auto update, m�s comprensible(creo).-
- Reparado el problema con la instalaci�n (Gracias Anghelito).-
',

'1.3a' => ' 29/11/08

- XNova 100% TRADUCIDO AL ESPA�OL [PUDE HABERME SALTEADO ALGO POR FAVOR AVISAR](By lucky).-
- Limpieza de scripts, eliminamos varios archivos de la carpeta scrips que notamos no necesarios.-
- Reparada la validaci�n del index, ahora si la carpeta install existe no podras acceder al juego (By lucky).-
- Arreglado el modo vacaciones, ya no puedes entrar en vacaciones cuando estas atacando (By lucky).-
- No se muestran m�s los recursos negativos.-
- Redirecci�n luego de enviar una flota (By tarta).-
- Ahora los d�as se muestran con una "d" y no con una "j" (By tarta).-
- Nuevamente agregamos los emoticons.-
- Ahora puedes cambiar el nombre en el juego, por fin solucionamos esto.-
- Nuevo dise�o del auto-update, mucho mas vistoso y atractivo.-
- Reparada la instalaci�n, ahora funcionan los misiles al instalar el juego.-
',

'1.2c EU' => ' 26/11/08

- Reparada la instalaci�n.-
',

'1.2b' => ' 26/11/08

- Misiles finalmente funcionando (By lucky).-
- Desbaneo autom�tico (By Anghelito).-
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

'1.2a' => ' 19/11/08

- Actualizado el auto-update para poder actualizar: 0.9a -> 1.2a y 1.1b -> 1.2a .-
- Reorganizaci�n, recodificaci�n y reestructuraci�n de los misiles interplanetarios, ademas de solucionar seberos bugs.-
- Solo se permiten caracteres alfanumericos en el nombre de los planetas, evita serios bugs y filtros de seguridad.-
- Arreglado el orden por puntos en la alianza.-
- Tutorial funcionando.-
- Correcciones en el mensaje de bienvenida pos-registro.-
- Solucionado el bug que no permit�a la transferencia de la alianza.-
- Solucionado el bug que hace que salga el rango equivocado al usuario en la lista de miembros de la ally.-
- Solucionado el bug que permit�a que se envien solicitudes una vez que la alianza habia sido borrada.-
- Reparada la red de investigaci�n intergal�ctica.-
- Cupula y protector planetario funcionando, y cada una solo puede ser edificada una vez.-
',

'1.1c' => ' 19/11/08

- Cambios en la organizaci�n de la carpeta templates.-
- Algunos fixes en el leftmenu del admin.-
- Nuevamente reparada la seccion de de Annonces (sirve para comerciar).-
- Volvimos a implementar el leftmenu antig�o, funciona m�s r�pido.-
- Mejoras en algunas traducciones, y a�adidas otras.-
- A�adida la hora al chat. [A�n no funciona en hostings].-
- Limpieza de archivos inecesarios y/o sin ninguna utilidad.-
- A�adido el auto-update.-
- Eliminado el upgrade desde ugamela.-
- Mejoras en la instalaci�n.-
',

'1.1b' => ' 30/10/08

- A�adido un tutorial, desarrollado por PowerMaster para el XNova de Xtreme-gameZ.com.ar.-
- Cambios de nombre del archivo de instalacion "Installeur" a "Instalacion de XNova".-
- Cambios en el leftmenu para usuarios.-
- Actualizacion de Puntos Automaticamente, ahora si anda.-
- Introduccion del Release de Xtreme-GameZ en "credit.php" e "install.php".-
- Cambios de idioma de carpeta "fr" a carpeta "es" (requiere instalacion).-
',

'1.1a' => ' 28/10/08

- Antes, si mandaban una flota y cambian de planeta, tiraba error.-
- Antes, cuando estaban leyendo mensajes y cambian de planeta, tiraba error.-
- Ahora al cancelar una investigaci�n te devuelve los recursos.-
- Cambio en el texto del primer mensaje recibido al registrarse en el juego.-
- Agregadas las estad�sticas de batalla.-
- Fueron agregadas las defensas al ranking de la Visi�n General.-
',


'1.0b' => ' 26/10/08

- Primer release disponible para los usuarios.-
- Eliminado el warning que aparec�a en la instalaci�n del sistema.-
- El instalador ahora incluye la actualizaci�n de puntos autom�tica, por ende el usuario ya no debera tocar nada en el c�digo.-
- Aplicada la actualizaci�n autom�tica de puntos.-
',


'1.0a' => ' 24/10/08 "Versi�n Inicial"

- Cambios de lenguaje en el changelog (100% traducido).-
- Mejora del men� de la izquierda se "visualiza" algo mejor.-
- Correciones de lenguaje en el install (install.mo).-
- Correciones en el Marchand (Mercader), ya esta funcionando correctamente, no tira m�s ese error del lenguaje.-
- Fixes en el link de Annonces, ahora esta funcionando, ya puedes publicar lo que desees comercias.-
- Inicio del proyecto XG (XG Proyect) basandonos en el pack hecho por XNova versi�n 0.9a.-
',
);
?>