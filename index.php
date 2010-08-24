<?php

/**
 * index.php
 *
 * @version 1.0
 * @copyright 2008 by e-Zobar for XNova
 */

if (filesize('config.php') == 0) {
	header('location: install/');
	exit();
}
			elseif (file_exists('install/'))
		{
			echo("<h2><b>Por favor, elimine el archivo de instalación antes de continuar</b></h2><br>
			Por razones de seguridad, es obligatorio eliminar <i> (o cambiar el nombre) </i> gracias.");
		} else {
		header('location: login.php');
	exit();
	}
?>