<?php
/*	// Conectando, seleccionando la base de datos dominio,usuario,contraseña
	$link = mysql_connect('localhost', 'obsan', 'obsan')
	    or die('No se pudo conectar al servidor: ' . mysql_error());

	// Seleccionamos la base de datos obsan.db
	mysql_select_db('obsan') or die('No se pudo seleccionar la base de datos OBSAN');
*/
	$mysqli = new mysqli('localhost', 'root', '', 'unah ia');
	
	if (!$mysqli) {
	    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
	    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
	    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
	    exit;
	}
?>