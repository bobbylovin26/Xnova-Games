<?php

// ----------------------------------------------------------------------------------------------------------
// Interface !
$lang['nfo_page_title']  = "Informacion";
$lang['nfo_title_head']  = "Informacion de";
$lang['nfo_name']        = "Nombre";
$lang['nfo_destroy']     = "Destruir:";
$lang['nfo_level']       = "Nivel";
$lang['nfo_range']       = "Rango de Sensores";
$lang['nfo_used_energy'] = "Consumo de Energia";
$lang['nfo_used_deuter'] = "Consumo de deuterio";
$lang['nfo_prod_energy'] = "Producion de energia";
$lang['nfo_difference']  = "Diferencia";
$lang['nfo_prod_p_hour'] = "Producion/hora";
$lang['nfo_needed']      = "Necesita";
$lang['nfo_dest_durati'] = "Duracion de destruccion";

$lang['nfo_struct_pt']   = "Puntos de Estructura";
$lang['nfo_shielf_pt']   = "Integridad del Escudo";
$lang['nfo_attack_pt']   = "Poder de ataque";
$lang['nfo_rf_again']    = "Fuego rapido contra";
$lang['nfo_rf_from']     = "Fuego rapido de";
$lang['nfo_capacity']    = "Capacidad de carga";
$lang['nfo_units']       = "Unidades";
$lang['nfo_base_speed']  = "Velocidad base";
$lang['nfo_consumption'] = "Consumo de combustible (Deuterio)";

// ----------------------------------------------------------------------------------------------------------
// Interface Salto Cuantico
$lang['gate_start_moon'] = "Luna de partida";
$lang['gate_dest_moon']  = "Luna de destino :";
$lang['gate_use_gate']   = "Usar Salto Cuantico";
$lang['gate_ship_sel']   = "Numero de Naves";
$lang['gate_ship_dispo'] = "disponible";
$lang['gate_jump_btn']   = "Saltar";
$lang['gate_jump_done']  = "El Salto Cuantico no esta disponible, el proximo salto cuantico esta listo en : ";
$lang['gate_wait_dest']  = "El salto cuantico no esta listo en la Luna de Destino, estara listo en : ";


$lang['gate_no_dest_g']  = "No tienes Salto Cuantico en ese planeta !";
$lang['gate_wait_star']  = "El Salto Cuantico fue usado, tiempo para recargar su energia ";

$lang['gate_wait_data']  = "Error, no hay datos correctos del salto cuantico !";

// ----------------------------------------------------------------------------------------------------------
// ----------------------------------------------------------------------------------------------------------
// Edificios Minas!
$lang['info'][1]['name']          = "Mina de Metal";
$lang['info'][1]['description']   = " 	Las minas de metal proveen los recursos básicos de un imperio emergente, y permiten la construcción de edificios y naves. El metal es el material más barato disponible y requiere poca energía para su recolección, pero se usa mucho más frecuentemente que el resto de los recursos. Se encuentra en profundidad, debajo de la superficie, lo que conduce a minas cada vez más profundas que necesitan más energía para funcionar.";

$lang['info'][2]['name']          = "Mina de Cristal";
$lang['info'][2]['description']   = "Los cristales son el recurso principal usado para construir circuitos electrónicos y ciertas aleaciones. Comparado con el proceso de producción del metal, el proceso de conversión de estructuras cristalinas en cristales industriales, requiere aproximadamente el doble de energía; por lo que los cristales son más caros al comerciar. Cada nave y edificio necesita una cierta cantidad de cristales, pero los apropiados son muy escasos y se encuentran en grandes profundidades. Las minas necesarias para recolectarlos, por ello, se vuelven más caras al alcanzar mayores profundidades, pero, ciertamente, proveen de más cristales que minas menos profundas.";


$lang['info'][3]['name']          = "Sintetizador de deuterio";
$lang['info'][3]['description']   = "El deuterio es agua pesada: los núcleos de hidrogeno contienen un neutrón adicional y es muy útil como combustible para las naves por la gran cantidad de energía liberada de la reacción entre deuterio y tritio (reacción DT). El deuterio puede ser encontrado frecuentemente en el mar profundo, debido a su peso molecular, y mejorar el sintetizador de deuterio, permite la recolección de este recurso.";


// ----------------------------------------------------------------------------------------------------------
// Edificios Energia!
$lang['info'][4]['name']          = "Planta de Energ&iacute;a solar";
$lang['info'][4]['description']   = "Para proporcionar la energía necesaria para el funcionamiento de los edificios, se requieren enormes plantas de energía. Una planta solar es una forma de crear energía, puesto que utiliza semiconductores de células fotovoltaicas, que convierten los fotones en corriente eléctrica. Cuanto más se mejore la planta solar, mayor será el area para convertir la luz solar en energía y por tanto mayor será la generada. Las plantas de energía solar son la espina dorsal de cualquier infraestructura planetaria.";


$lang['info'][12]['name']         = "Planta de Fusion";
$lang['info'][12]['description']  = "En una planta de energía de fusión, los núcleos de hidrógeno son fusionados en núcleos de helio bajo una enorme temperatura y presión, despidiendo tremendas cantidades de energía. Por cada gramo de Deuterio consumido se pueden producir hasta 41,32*10^-13 Julios de energía; con 1 gramo eres capaz de producir 172MWh de energía.
<br><br>
Mayores complejos de reactores usan más deuterio y pueden producir más energía por hora. El efecto de energía puede ser aumentado investigando la tecnología de energía.
<br><br>
La producción de energía de las plantas de fusión se calcula de la siguiente forma:<br><br>
30 * [Nivel de la Planta de Fusión] * (1,05 + [Nivel de la Tecnología de Energía] * 0,01) ^ [Nivel de la Planta de Fusión]";


// ----------------------------------------------------------------------------------------------------------
// Edificios Generales!
$lang['info'][14]['name']         = "F&aacute;brica de Robots";
$lang['info'][14]['description']  = "Las fábricas de robots proporcionan unidades baratas y de fácil construcción que pueden ser usadas para mejorar o construir cualquier estructura planetaria. Cada nivel de mejora de la fábrica aumenta la eficiencia y el numero de unidades robóticas que ayudan en la construcción.";


$lang['info'][15]['name']         = "F&aacute;brica de Nanobots";
$lang['info'][15]['description']  = "Los nanobots son realmente unidades robóticas minúsculas, con un tamaño medio de apenas unos pocos nanómetros. Estos microbios mecánicos son conectados en red y programados para una tarea de construcción, ofrecen una velocidad de producción anteriormente desconocida. Los nanobots operan en niveles moleculares, y son inmensamente útiles para construir naves, puesto que permanecen como parte de su estructura y de esta forma sus capacidades de reparación pueden ser usadas para el control de daño y reparar lo que fuera necesario si consiguen suficiente energía y recursos.";

$lang['info'][21]['name']         = "Hangar";
$lang['info'][21]['description']  = "El hangar planetario es responsable de la construcción de naves espaciales y sistemas de defensa. Según va aumentando, puede producir una mayor variedad de naves a velocidades más altas. Si además existe una fábrica de nanobots en el planeta, la velocidad a la que se completan las unidades, aumenta considerablemente.";

$lang['info'][22]['name']         = "Almac&eacute;n de metal";
$lang['info'][22]['description']  = " 	Bodegas enormes para almacenar metal sin procesar. Mientras más grande sea el almacén, más aumentará la capacidad de almacenaje del planeta. La recolección de metal se detendrá cuando el almacén esté lleno.";


$lang['info'][23]['name']         = "Almac&eacute;n de cristal";
$lang['info'][23]['description']  = "Bodegas enormes para almacenar cristal sin procesar. Mientras más grande sea el almacén, más aumentará la capacidad de almacenaje. La recolección de cristal se detendrá cuando el almacén esté lleno.";

$lang['info'][24]['name']         = "Contenedor de deuterio";
$lang['info'][24]['description']  = "Contenedores enormes para almacenar deuterio. Los contenedores se encuentran a menudo cerca del hangar. Los contenedores grandes son capaces de almacenar más deuterio. La recolección de deuterio se detendrá cuando el contenedor esté lleno.";


$lang['info'][31]['name']         = "Laboratorio de investigaci&oacute;n";
$lang['info'][31]['description']  = "Para poder investigar en nuevas áreas de una tecnología, se necesita un laboratorio de investigación planetario. El nivel de mejoras de ese laboratorio, no solo incrementa la velocidad a la que se descubren nuevas tecnologías, sino que también abre nuevos campos para investigar. Para conducir una investigación en el menor tiempo posible, todos los científicos del imperio son enviados al planeta donde se inició el trabajo de investigación. En cuanto el trabajo se haya completado, volverán a sus planetas y llevarán con ellos la nueva tecnología descubierta. De este modo, el conocimiento sobre nuevas tecnologías puede ser fácilmente divulgado a través del imperio.";

$lang['info'][33]['name']         = "Terraformer";
$lang['info'][33]['description']  = " 	La pregunta sobre cómo disponer de más espacio para las estructuras en los planetas surgió durante el proceso de crecimiento de las infraestructuras de los mismos a través de las galaxias. Los métodos de construcción e ingenería tradicional eran insuficientes debido a la enorme necesidad de espacio edificable.
Un pequeño grupo de físicos de alta energía y nanotécnicos finalmente encontraron una solución: el Terraforming.<br>
Usando grandes cantidades de energía se pueden hacer incluso continentes enteros. En este edificio se producen nanobots diseñados especialmente para asegurar la calidad y usabilidad de las areas formadas.
<br><br>
Una vez construido, el terraformer no puede ser desmontado.";



$lang['info'][34]['name']         = "Dep&oacute;sito de la Alianza";
$lang['info'][34]['description']  = "El depósito de la alianza ofrece la posibilidad de repostar a las flotas aliadas que estén estacionadas en la órbita ayudando a defender. Cada mejora del depósito de alianza permite proveer de 10.000 unidades adicionales de deuterio, por hora, a las flotas estacionadas en la órbita.";



// ----------------------------------------------------------------------------------------------------------
// Edificios en Luna!
$lang['info'][41]['name']         = "Base Lunar";
$lang['info'][41]['description']  = " 	Dado que la luna no tiene atmósfera, se necesita una base lunar para generar espacio habitable. La base lunar no solo provee el oxígeno necesario, también la gravedad artificial, temperatura y protección necesarias. Cuanto más se mejore la base lunar, mayor es el área para construir estructuras. Cada nivel de la base lunar proporciona 3 campos lunares , hasta que la luna esté totalmente llena.
<br><br>
Una vez construida, la base lunar no puede ser desmontada.";


$lang['info'][42]['name']         = "Sensor Phalanx";
$lang['info'][42]['description']  = "Una cadena de sensores de alta resolución se usa para escanear un enorme espectro de frecuencia. Las unidades de proceso paralelo masivo analizan entonces las señales recibidas para detectar incluso la más mínima anomalía en la frecuencia o fortalecimiento, para detectar maniobras de flotas en imperios distantes. Debido a la complejidad del sistema, cada escaneo necesita una cantidad moderada de deuterio para proporcionar la energía necesaria.";

$lang['info'][43]['name']         = "Salto Cuantico";
$lang['info'][43]['description']  = "El Salto cuántico es un sistema de transceptores gigante capaz de enviar incluso las flotas más grandes a otro Salto cuántico en cualquier lugar del universo sin pérdida de tiempo. Este transmisor no necesita Deuterio, pero ha de pasar 1 hora entre dos saltos, de lo contrario se sobrecalentaría. Transportar recursos a través del salto no es posible. Toda la acción requiere tecnología muy desarrollada.";

$lang['info'][44]['name']         = "Silo";
$lang['info'][44]['description']  = "El silo es un lugar de almacenamiento y lanzamiento de misiles planetarios. Por cada nivel de tu silo, tienes espacio para 5 misiles interplanetarios o 10 misiles de intercepción. Es posible mezclar los tipos de misil; 1 interplanetario usa el espacio equivalente a 2 de intercepción.";



// ----------------------------------------------------------------------------------------------------------
// Laboratorio !
$lang['info'][106]['name']        = "Tecnología de espionaje";
$lang['info'][106]['description'] = "Usando esta tecnolog&iacute;a, puede obtenerse informaci&oacute;n sobre otros planetas.";


$lang['info'][108]['name']        = "Tecnología de computación";
$lang['info'][108]['description'] = "Cuanto m&aacute;s elevado sea el nivel de tecnolog&iacute;a de computaci&oacute;n, m&aacute;s flotas podr&aacute;s controlar simultaneamente. Cada nivel adicional de esta tecnologia, aumenta el numero de flotas en 1.";


$lang['info'][109]['name']        = "Tecnolog&iacute;a militar";
$lang['info'][109]['description'] = "Este tipo de tecnolog&iacute;a incrementa la eficiencia de tus sistemas de armamento. Cada mejora de la tecnolog&iacute;a militar a&ntilde;ade un 10% de potencia a la base de da&ntilde;o de cualquier arma disponible.";

$lang['info'][110]['name']        = "Tecnolog&iacute;a de defensa";
$lang['info'][110]['description'] = "La tecnolog&iacute;a de defensa se usa para generar un escudo de part&iacute;culas protectoras alrededor de tus estructuras. Cada nivel de esta tecnolog&iacute;a aumenta el escudo efectivo en un 10% (basado en el nivel de una estructura dada).";

$lang['info'][111]['name']        = "Tecnolog&iacute;a de blindaje";
$lang['info'][111]['description'] = "Las aleaciones altamente sofisticadas ayudan a incrementar el blindaje de una nave a&ntilde;adiendo el 10% de su fuerza en cada nivel a la fuerza base.";

$lang['info'][113]['name']        = "Tecnolog&iacute;a de energ&iacute;a";
$lang['info'][113]['description'] = "Entendiendo la tecnolog&iacute;a de diferentes tipos de energ&iacute;a, muchas investigaciones nuevas y avanzadas pueden ser adaptadas. La tecnolog&iacute;a de energ&iacute;a es de gran importancia para un laboratorio de investigaci&oacute;n moderno.";

$lang['info'][114]['name']        = "Tecnolog&iacute;a de hiperespacio";
$lang['info'][114]['description'] = "Incorporando la cuarta y quinta dimensi&oacute;n en la tecnolog&iacute;a de propulsi&oacute;n, se puede disponer de un nuevo tipo de motor; que es m&aacute;s eficiente y usa menos combustible que los convencionales.";
$lang['info'][115]['name']        = "Motor de combusti&oacute;n";
$lang['info'][115]['description'] = "Los motores de combusti&oacute;n pertenecen a los m&aacute;s antiguos en funcionamiento y se basan en la repulsi&oacute;n. Las part&iacute;culas son aceleradas y abandonan el motor generando una fuerza de repusli&oacute;n que mueve la nave en la direcci&oacute;n opuesta..";
$lang['info'][117]['name']        = "Motor de impulso";
$lang['info'][117]['description'] = "El sistema del motor de impulso se basa en el principio de la repulsi&oacute;n de part&iacute;culas. La materia repelida es basura generada por el reactor de fusi&oacute;n usado para proporcionar la energ&iacute;a necesaria para este tipo de motor de propulsi&oacute;n.";

$lang['info'][118]['name']        = "Propulsor hiperespacial";
$lang['info'][118]['description'] = "A trav&eacute;s de la curvatura del espacio-tiempo en el entorno inmediato de las naves viajantes, el espacio se comprime hasta tal grado que las distancias m&aacute;s grandes pueden ser cubiertas en un corto per&iacute;odo de tiempo.";

$lang['info'][120]['name']        = "Tecnolog&iacute;a l&aacute;ser";
$lang['info'][120]['description'] = "El l&aacute;ser (amplificaci&oacute;n de luz por emisi&oacute;n estimulada de radiaci&oacute;n), es un rayo de fotones monocrom&aacute;tico coherente con excelentes capacidades de enfoque..";

$lang['info'][121]['name']        = "Tecnolog&iacute;a i&oacute;nica";
$lang['info'][121]['description'] = "La tecnolog&iacute;a i&oacute;nica enfoca un rayo de iones acelerados en un objetivo, lo que puede provocar un gran da&ntilde;o debido a su naturaleza de electrones cargados de energ&iacute;a. Los rayos i&oacute;nicos son superiores a los rayos l&aacute;ser, pero requieren un mayor coste de investigaci&oacute;n.";

$lang['info'][122]['name']        = "Tecnolog&iacute;a de plasma";
$lang['info'][122]['description'] = "Las armas de plasma son incluso m&aacute;s peligrosas que cualquier otro sistema de armamento conocido, debido a la naturaleza agresiva del plasma. Es uno de los cuatro estados de la materia (s&oacute;lido, l&iacute;quido, gas, plasma), y consiste en un numero igual de part&iacute;culas de gas cargadas positiva y negativamente.";

$lang['info'][123]['name']        = "Red de investigaci&oacute;n intergal&aacute;ctica";
$lang['info'][123]['description'] = "Los cient&iacute;ficos de tus planetas pueden comunicarse entre ellos a trav&eacute;s de esta red.
Con cada nivel investigado, uno de tus laboratorios de investigaci&oacute;n del nivel m&aacute;s alto, ser&aacute; enlazado a la red. Sus niveles se a&ntilde;adir&aacute;n cuando la red se establezca.";

$lang['info'][124]['name']        = "Tecnolog&iacute;a de expedici&oacute;n";
$lang['info'][124]['description'] = "La Tecnolog&iacute;a de Expedici&oacute;n incluye diversas tecnolog&iacute;as de exploraci&oacute;n y permite dotar a las naves espaciales de diferentes tama&ntilde;os con un m&oacute;dulo de investigaci&oacute;n. Estos incluyen una base de datos y un laboratorio m&oacute;vil completamente equipado.";

$lang['info'][199]['name']        = "Tecnolog&iacute;a de gravit&oacute;n";
$lang['info'][199]['description'] = "Un gravit&oacute;n es una part&iacute;cula elemental responsable de los efectos de la gravedad. Es su propia antipart&iacute;cula, tiene masa cero y carece de carga, tambi&eacute;n posee un giro de 2. A trav&eacute;s del disparo de part&iacute;culas concentradas de gravit&oacute;n se genera un campo gravitacional artificial con suficiente potencia y poder de atracci&oacute;n para destruir no solo naves, sino lunas enteras.";


// ----------------------------------------------------------------------------------------------------------
// Flota !
$lang['info'][202]['name']        = "Nave chica de carga";
$lang['info'][202]['description'] = "Las naves chicas de carga son aproximadamente tan grandes como los cazadores, pero sin motores eficientes ni armamento para permitir m&aacute;s espacio de carga. La nave chica de carga tiene una capacidad de 5.000 unidades de recursos.";
$lang['info'][203]['name']        = "Nave grande de carga";
$lang['info'][203]['description'] = "Esta nave nunca deber&iacute;a ser enviada sola, puesto que apenas tiene armas u otras tecnolog&iacute;as, para permitir tanto espacio de carga como sea posible. La nave grande de carga sirve como un suministro r&aacute;pido de recursos entre planetas gracias a su sofisticado motor de combusti&oacute;n.";
$lang['info'][204]['name']        = "Cazador ligero";
$lang['info'][204]['description'] = "Dado su relativamente d&eacute;bil escudo y sus simples sistemas de armamento, los cazadores ligeros pertenecen al grupo de naves de soporte cuando comienza la batalla.";
$lang['info'][205]['name']        = "Cazador pesado";
$lang['info'][205]['description'] = "Durante el progreso del cazador ligero, los investigadores llegaron al punto en el que la tecnolog&iacute;a convencional alcanzaba su l&iacute;mite. Para proporcionar m&aacute;s agilidad al nuevo cazador, se uso en primer momento un potente motor de impulso.";
$lang['info'][206]['name']        = "Crucero";
$lang['info'][206]['description'] = "Con l&aacute;sers pesados y ca&ntilde;ones i&oacute;nicos emergiendo en los campos de batalla, los cazadores estaban cada vez m&aacute;s y m&aacute;s obsoletos. A pesar de muchas modificaciones en el sistema de armamento y escudos, no se lograba aumentar lo suficiente para soportar ante los nuevos sistemas de defensa.
Este es el motivo por el que se eligi&oacute; desarrollar un nuevo tipo de nave que poseyera m&aacute;s blindaje y arm&aacute;s m&aacute;s potentes. As&iacute; naci&oacute; el crucero.";
$lang['info'][207]['name']        = "Nave de batalla";
$lang['info'][207]['description'] = "Las naves de batalla son la espina dorsal de cualquier flota militar. Su pesado blindaje junto con un sistema de armamento impresionante y una velocidad de viaje relativamente alta hace que esta nave sea imprescindible para cualquier imperio.";
$lang['info'][208]['name']        = "Colonizador";
$lang['info'][208]['description'] = "El colonizador es una nave especialmente bien preparada para su prop&oacute;sito: permitir a un imperio expandirse y poblar nuevos mundos. En una maniobra muy inteligente, la estructura de las naves se usa como base para los primeros recursos que permiten crear las nuevas estructuras planetarias.";
$lang['info'][209]['name']        = "Reciclador";
$lang['info'][209]['description'] = "Los combates espaciales parecen estar aumentando constantemente y en una simple batalla, pueden destruirse miles de naves, con los consiguientes escombros que se perder&aacute;n para siempre. Las naves est&aacute;ndar de carga no tienen los medios para recolectar recursos &uacute;tiles, ni siquiera para acercarse a ellos.";
$lang['info'][210]['name']        = "Sonda de espionaje";
$lang['info'][210]['description'] = " 	Las sondas de espionaje son peque&ntilde;os droides no tripulados con un sistema de propulsi&oacute;n excepcionalmente r&aacute;pido usado para espiar en planetas extranjeros. Con su avanzado sistema de comunicaci&oacute;n, estas sondas pueden enviar de vuelta, a gran distancia, informaci&oacute;n inteligente. ";
$lang['info'][211]['name']        = "Bombardero";
$lang['info'][211]['description'] = "El Bombardero es una nave de prop&oacute;sito especial, desarrollado para atravesar las defensas planetarias m&aacute;s pesadas. Gracias a un sistema de ataque guiado por l&aacute;ser, las bombas de plasma pueden ser lanzadas con gran precisi&oacute;n sobre el objetivo, causando una inmensa devastaci&oacute;n en los sistemas de defensa planetaria.";
$lang['info'][212]['name']        = "Sat&eacute;lite solar";
$lang['info'][212]['description'] = "Los sat&eacute;lites solares son simples sat&eacute;lites en &oacute;rbita equipados con c&eacute;lulas fotovoltaicas y transmisores para llevar la energ&iacute;a al planeta. Se transmite por este medio a la tierra usando un rayo l&aacute;ser especial. La eficiencia de estas plataformas est&aacute; relacionada con la cantidad de luz solar, haci&eacute;ndolos m&aacute;s o menos eficientes dependiendo de la distancia de los planetas respecto al sol.";
$lang['info'][213]['name']        = "Destructor";
$lang['info'][213]['description'] = "Con el destructor, la madre de todas las naves de batalla entra en escena. Su sistemas de armamento multi-phalanx consisten en ca&ntilde;ones gauss, de plasma e i&oacute;nicos armados en torretas de respuesta r&aacute;pida, lo que permite eliminar a los cazadores operativos con una probabilidad del 99%.";
$lang['info'][214]['name']        = "Estrella de la muerte";
$lang['info'][214]['description'] = "Las estrellas de la muerte estan equipadas con grandes cantidades de ca&ntilde;&oacute;nes gauss, capaces de destruir cualquier cosa con un s&oacute;lo disparo, sean destructores o lunas. Para proveer la energ&iacute;a necesaria a este arma, se utilizan grandes &aacute;reas de las estrellas de la muerte para generadores de energ&iacute;a. El tama&ntilde;o de la nave tambi&eacute;n limita su velocidad de viaje, que es realmente baja. Se dice que el capit&aacute;n ayuda frecuentemente a aumentar su velocidad.";
$lang['info'][215]['name']        = "Acorazado";
$lang['info'][215]['description'] = "Esta nave, toda una filigrana tecnol&oacute;gica, es incre&iacute;blemente eficaz a la hora de destruir flotas atacantes. Con sus ca&ntilde;ones l&aacute;ser altamente desarrollados, ocupa una posici&oacute;n de privilegio en las batallas a gran escala, donde puede tumbar a varias naves con bastante facilidad. Dado su dise&ntilde;o peque&ntilde;o y su enorme armamento, la capacidad de carga es reducida, pero esto se ve equilibrado gracias al bajo consumo de su propulsor hiperespacial.";
$lang['info'][216]['name']        = "Supernova";
$lang['info'][216]['description'] = "La última nave de guerra. Te lo otorga como recompensa el emperador por la rigidez de tus habilidades.";


// ----------------------------------------------------------------------------------------------------------
// Defensas !


$lang['info'][401]['name']        = "Lanzamisiles";
$lang['info'][401]['description'] = " 	El lanzamisiles es un sistema de defensa sencillo, pero barato. Puede ser muy efectivo si se construye en grandes n&uacute;meros, no necesita tecnolog&iacute;a alguna puesto que es una sencilla arma bal&iacute;stica.";




$lang['info'][402]['name']        = "L&aacute;ser peque&ntilde;o";
$lang['info'][402]['description'] = "Para mantener el ritmo con el aumento notable de la velocidad de desarrollo en t&eacute;rminos de tecnolog&iacute;a especial, los cient&iacute;ficos tuvieron que llegar a un nuevo sistema de defensa, capaz de aguantar contra naves y flotas m&aacute;s fuertes y mejor equipadas.
De este modo, r&aacute;pidamente naci&oacute; el l&aacute;ser peque&ntilde;o, que era capaz de disparar un rayo l&aacute;ser altamente concentrado contra el objetivo y provocar un da&ntilde;o mucho m&aacute;s elevado que el impacto de los m&iacute;siles bal&iacute;sticos.";




$lang['info'][403]['name']        = "L&aacute;ser grande";
$lang['info'][403]['description'] = "El l&aacute;ser grande es la evoluci&oacute;n l&oacute;gica del peque&ntilde;o, en &eacute;ste, la integridad estructural ha sido aumentada y se han adoptado nuevos materiales. De esta manera el blindaje pod&iacute;a ser mejorado, con la nueva energ&iacute;a y sistemas de ordenadores a bordo, se libera mucha m&aacute;s potencia sobre un objetivo que usando un l&aacute;ser peque&ntilde;o.";



$lang['info'][404]['name']        = "Ca&ntilde;&oacute;n Gauss";
$lang['info'][404]['description'] = "Un Ca&ntilde;&oacute;n Gauss actualmente no es nada m&aacute;s que un acelerador de part&iacute;culas masivo de gran tama&ntilde;o, donde los proyectiles con un peso de varias toneladas son acelerados usando enormes bobinas electromagn&eacute;ticas. La velocidad de salida de estas enormes part&iacute;culas es tan grande que las part&iacute;culas de polvo en el aire circundante se queman y la repulsi&oacute;n del disparo sacude la tierra.";






$lang['info'][405]['name']        = "Ca&ntilde;&oacute;n i&oacute;nico";
$lang['info'][405]['description'] = "En el siglo 21 hab&iacute;a una tecnolog&iacute;a, denominada EMP, relacionada con los impulsos electromagn&eacute;ticos. Tal impulso de energ&iacute;a es peligroso principalmente para los sistemas que usan energ&iacute;a el&eacute;ctrica o son sensibles a &eacute;l. En aquellos d&iacute;as, estas armas eran transportadas en bombas o misiles, pero con el desarrollo continuado del area del EMP es actualmente posible montar estas unidades en ca&ntilde;ones sencillos. El ca&ntilde;&oacute;n i&oacute;nico, es de lejos, el mejor equipado con estas armas.";


$lang['info'][406]['name']        = "Ca&ntilde;&oacute;n de plasma";
$lang['info'][406]['description'] = " 	La tecnolog&iacute;a l&aacute;ser hab&iacute;a sido llevada casi a la perfecci&oacute;n, la tecnolog&iacute;a i&oacute;nica parec&iacute;a haber alcanzado su tope, y en general, no hab&iacute;a una visi&oacute;n sobre como llegar a conseguir mejorar los sistemas de armamento existentes. Pero esto cambi&oacute; cuando naci&oacute; la idea de unir estas dos tecnolog&iacute;as, mientras que el l&aacute;ser se utiliza para calentar las part&iacute;culas de deuterio varios millones de grados, la tecnolog&iacute;a i&oacute;nica, entonces, carga esas part&iacute;culas sobrecalentadas el&eacute;ctricamente, el conocimiento de la electromagn&eacute;tica era imprescindible para contener este peligroso plasma. ";




$lang['info'][407]['name']        = "C&uacute;pula peque&ntilde;a de protecci&oacute;n";
$lang['info'][407]['description'] = "Mucho antes de que los generadores de escudos fueran integrados y port&aacute;tiles, hab&iacute;a grandes y viejos generadores en la superficie de los planetas. Estos eran capaces de crear un enorme escudo alrdedor de la superficie del planeta, capaz de absorber grandes cantidades de energ&iacute;a cuando eran atacados.";


$lang['info'][408]['name']        = "C&uacute;pula grande de protecci&oacute;n";
$lang['info'][408]['description'] = "Esta es una versi&oacute;n avanzada de la c&uacute;pula de protecci&oacute;n, y su caracter&iacute;stica principal es el aumento de su capacidad para absorber energia. Est&aacute; basado en el mismo conocimiento tecnol&oacute;gico que la c&uacute;pula peque&ntilde;a. Pero, los generadores son menos ruidosos al estar en funcionamiento.";

$lang['info'][409]['name']        = "Protector Planetario";

$lang['info'][409]['description'] = "La mejor protección más avanzada para tu planeta.";



// ----------------------------------------------------------------------------------------------------------
// Missiles !
$lang['info'][502]['name']        = "Misil de intercepci&oacute;n";
$lang['info'][502]['description'] = "Los misiles de intercepci&oacute;n destruyen los misiles interplanetarios. Cada mis&iacute;l de intercepci&oacute;n destruye un mis&iacute;l interplanetario.";


$lang['info'][503]['name']        = "Misil interplanetario";
$lang['info'][503]['description'] = "Los misiles interplanetarios destruyen los sistemas de defensa del enemigo. Los sistemas de defensa destruidos por los misiles interplanetarios no ser&aacute;n reparados.";



// ----------------------------------------------------------------------------------------------------------
// Officiers !
$lang['info'][601]['name']        = "Ge&oacute;logo";
$lang['info'][601]['description'] = "El ge&oacute;logo es un experto en astrominerolog&iacute;a y astrocristalograf&iacute;a. Asiste a sus equipos en la metalurgia y qu&iacute;mica y tambi&eacute;n se encarga de las comunicaciones interplanetarias para optimizar el uso y refinamiento de la materia bruta a lo largo de todo el imperio.<br><br>+5% de producci&oacute;n. Nivel Max. : 20";


$lang['info'][602]['name']        = "Almirante de flota";
$lang['info'][602]['description'] = "El almirante de flota es un veterano de guerra experimentado y un habilidoso estratega. En las batallas mas duras, es capaz de hacerse una idea de la situaci&oacute;n y contactar a sus almirantes subordinados. Un emperador sabio puede apoyarse en su ayuda durante los combates.<br><br>+5% Escudo de Naves. Nivel Max. : 20";


$lang['info'][603]['name']        = "Ingeniero";
$lang['info'][603]['description'] = "El Ingeniero es un especialista en gesti&oacute;n de energ&iacute;a. En tiempos de paz, aumenta la energ&iacute;a de todas las colonias. En caso de ataque, garantiza el abastecimiento de energ&iacute;a a los ca&ntilde;ones, evitando una posible sobrecarga, lo que conduce a una reducci&oacute;n de defensas perdidas en batalla.<br><br>+5% de energia. Nivel Max. : 10";


$lang['info'][604]['name']        = "Tecn&oacute;crata";
$lang['info'][604]['description'] = "El gremio de los Tecn&oacute;cratas est&aacute; compuesto de aut&eacute;nticos genios, y siempre los encontrar&aacute;s en ese peligroso borde donde todo saltar&iacute;a en mil pedazos antes de poder encontrar una explicaci&oacute;n tecnol&oacute;gica y racional. Ning&uacute;n ser humano normal tratar&iacute;an jam&aacute;s intentar descifrar el c&oacute;digo de un tecn&oacute;crata, con su presencia, inspira a los investigadores del imperio.<br><br>+5% Velocidad Construcci&oacute;n Naves. Nivel Max : 10";


$lang['info'][605]['name']        = "Constructor";
$lang['info'][605]['description'] = "El Constructor tiene alterado su ADN, uno solo de estos hombres puede construir una ciudad entera en poco tiempo.<br><br>+10% Rapidez Construccion Edificios. Nivel Max. : 3";


$lang['info'][606]['name']        = "Cientifico";
$lang['info'][606]['description'] = "Los cient&iacute;ficos forman parte de un gremio concurente a la de los tecn&oacute;cratas. Ellos se especializan en la mejora de las tecnolog&iacute;as.<br><br>+10% Rapidez de Investigacion. Nivel Max. : 3";


$lang['info'][607]['name']        = "Almacenista";
$lang['info'][607]['description'] = "El almacenista es parte de la antigua Hermandad del planeta Hsac. Su lema es ganar el m&aacute;ximo, pero por esta raz&oacute;n que necesita espacios de almacenamiento enormes. Esa es la raz&oacute;n por la que el Constructor ha desarrollado una nueva t&eacute;cnica de almacenamiento.<br><br>+50% de Almacenamiento. Nivel Max. : 2";


$lang['info'][608]['name']        = "Defensor";
$lang['info'][608]['description'] = "El defensor es un miembro del ej&eacute;rcito imperial. Su celo en su trabajo le permite construir una formidable defensa en un breve espacio de tiempo en las colonias hostiles.<br><br>+50% Rapidez Construccion Defensas.";


$lang['info'][609]['name']        = "Bunker";
 $lang['info'][609]['description'] = "El emperador se&ntilde;al&oacute; el impresionante trabajo que usted proporciona a su imperio. Dar las gracias a usted le da la oportunidad de convertirse en Bunker. El Bunker es la m&aacute;s alta distinci&oacute;n de la Miner&iacute;a de la rama del Ej&eacute;rcito Imperial.<br><br>Desbloquear la Proteccion Planetaria.";


$lang['info'][610]['name']        = "Espia";
$lang['info'][610]['description'] = "El esp&iacute;a es una persona enigm&aacute;tica. Nadie nunca vio su verdadero rostro, a menos que est&eacute; muerto.<br><br>+5 Niveles de Espionaje. Nivel Max. : 2";
$lang['info'][611]['name']        = "Comandante";
$lang['info'][611]['description'] = "El comandante del ej&eacute;rcito imperial ha dominado el arte del manejo de flotas. Su cerebro puede calcular las trayectorias de muchos flota, mucho m&aacute;s que la de un humano normal.<br><br>+3 slots de Flotas. Nivel Max. : 3";


$lang['info'][612]['name']        = "Destructor";
$lang['info'][612]['description'] = "El destructor es un funcionario sin misericordia. &eacute;l masacra a todos en los planetas s&oacute;lo por placer. Actualmente est&aacute; desarrollando un nuevo m&eacute;todo de producci&oacute;n de las estrellas de la muerte.<br><br>2 Estrellas al hacer 1. Nivel Max. : 1";


$lang['info'][613]['name']        = "General";
$lang['info'][613]['description'] = "El venerable General es una persona que ha servido desde hace muchos a&ntilde;os en el ej&eacute;rcito. Los fabricantes de naves producen mas r&aacute;pido en su presencia.<br><br>+25% Rapidez Hangares. Nivel Max. : 3";
$lang['info'][614]['name']        = "Raider";
$lang['info'][614]['description'] = "El emperador ha detectado en usted innegables cualidades de conquistador. Le ofrece convertirse en Raider. El Raider es el m&aacute;s alto rango del ej&eacute;rcito imperial.<br><br>Desbloquear la SuperNova.";
$lang['info'][615]['name']        = "Emperador";
$lang['info'][615]['description'] = "Usted puso de manifiesto que usted es el m&aacute;s grande conquistador del universo. Es momento para que usted tome el lugar que merece.<br><br>Desbloquear la Destrucci&oacute;n de Planetas.";


?>