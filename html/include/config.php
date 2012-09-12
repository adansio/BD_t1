<?php
/*
 *  Archivo de configuración global.
 *  Debe ser modificado con los datos de su grupo
 *  para lograr una correcta conexión a la base de datos.
 */

	if(!defined('MY_HOST')) {
    	# Nombre de host (por defecto localhost)
    	define('MY_HOST', "localhost");

    	# Puerto de la base de datos (por defecto 5432)
    	define('MY_PORT', "5432");

    	# Usuario de la base de datos
    	define('MY_USER', "bd22");

    	# Contraseña de la base de datos
    	define('MY_PASS', "g22bd");

    	# Nombre de la base de datos
    	define('MY_BD', "bd22");
  }
?>
