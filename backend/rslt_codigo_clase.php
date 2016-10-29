<?php

	//Extraemos los datos del de seguridad del servidor y la base de datos
	require('datos_server.php');
	
	$idClase = $_POST['idClase'];

	//echo '<script> alert('.$idClase.'); </script>';

	//Llamamos al procedimeito
	$consulta="CALL `PA_ESTADISTICO_CLASE`(".$idClase.", @p1, @p2, @p3); ";

	//Declaracion de Variables
	$universo=0;
	$apr=0;
	$rpb=0;
	$estadoClase="DESCONOCIDO";

	// Ejecutamos la consulta
	$resultado = $mysqli->query($consulta);

	if($resultado->num_rows>0)// obtenermos la cantidad de registros de la consulta y la comparamos con 0
	{
		$registro = mysqli_fetch_row($resultado); //colocamos la informacion de la consulta en un registro
		$universo=$registro[0];
		$apr=$registro[1];
		$rpb=$registro[2];	
	}

	//

	if($universo>0){

		if($universo==($apr+$rpb)){

			if($apr>$rpb){
				$estadoClase="APR";
			}
			else if ($apr<$rpb){
				$estadoClase="RPB";
			}
			else if ($apr==$rpb){
				$estadoClase="APR|RPB";
			}
			else{
				$estadoClase="DESCONOCIDO";
			}
		}
		else{
			$estadoClase="DESCONOCIDO";
		}
	}
	else{
		$estadoClase="DESCONOCIDO";
	}

	// Imprimimos el Json para luego se carpturado con JAVASCRIPT
	echo json_encode($estadoClase);

	// Liberar resultados
	$resultado->close();
	// Cerrar la conexión
	$mysqli->close();
?>

