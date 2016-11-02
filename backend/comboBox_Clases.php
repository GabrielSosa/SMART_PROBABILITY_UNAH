<?php
	
	require_once ('datos_server.php');

	//Creamos la consulta 
	$consulta="SELECT `ID_CLASE`,`NOMBRE_CLASE` FROM `tbl_clases` WHERE `ID_DEPARTAMENTO`=1 or `ID_DEPARTAMENTO`=2";

	// Verificamos que en la consulta hayan datos 
	if ($resultado = $mysqli->query($consulta)) {

    echo '<select id="comboboxClases" onChange="ObtenerIdClase(this.value)" name="cbxClases" class="form-control">';
    echo '<option value=0>---------</option>';

		/* obtener un array asociativo */
		while ($fila = $resultado->fetch_assoc()) {
		      
	     /*Imprimimos los departamentos de honduras disponibles en la BD
	      y ponemos como valor ID_CLASE en Value */
		echo '<option id = '.utf8_encode($fila['ID_CLASE']).' value='.utf8_encode($fila['ID_CLASE']).'>'.utf8_encode($fila['NOMBRE_CLASE']).'</option>'; 
	
		}

    echo '</select>';
	
	}

	// Liberamos los datos de resultados 
	$resultado->free();
	// Cerramos la conexion 
	$mysqli->close();
	
?>