<?php
	session_start(); /*Iniciamos la sesion*/
	$_SESSION['online']=0; /*Usuario Fuera de Linea (offline)*/
	session_destroy(); /*Destruimos la data de la sesion*/
	header("location: http://localhost/SMART_PROBABILITY_UNAH/"); /*retornamos al login del obsan*/
?>