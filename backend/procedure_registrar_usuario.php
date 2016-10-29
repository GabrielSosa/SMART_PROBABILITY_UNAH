<?php
	
	//Extraemos los datos del de seguridad del servidor y la base de datos
	require('datos_server.php');
	
	$txtDepartamento = $_POST['cbxDepartamento'];
	$txtNumeroCuenta = $_POST['txtNumeroCuenta'];
	$txtPnombre = $_POST['txtPnombre'];
	$txtSnombre = $_POST['txtSnombre'];
	$txtPapellido = $_POST['txtPapellido'];
	$txtSapellido = $_POST['txtSapellido'];
	$txtEmail = $_POST['txtEmail'];
	$txtpass = $_POST['txtpass'];

	$next_id_estudiante=0;
	$indice_global=0;
	$fecha_nacimiento="1993-01-01";
	$estado=1;
	$genero="X";
	$conformidad="X";
	$trabaja="X";
	$edad=20;

	//Creamos una consulta para verificar si el numero de cuenta existe la base de datos
	$query="SELECT * FROM tbl_estudiantes WHERE NUMERO_CUENTA=".$txtNumeroCuenta.";";

	// Ejecutamos la consulta
	$resultado = $mysqli->query($query);
	//  obtenermos la cantidad de registros de la consulta
	$n =$resultado->num_rows;

	if($n>0){
		//$resultado->num_rows>0 si esto se cumple indica que en la base de datos existe el numero de cuenta y 
		//enviamos a la funcion mensaje el valor 1
		mensaje(1);
	}
	else
	{
		//Obtenermos el el proximo id_estudiante a travez de la siquiente funcion, pasando como valor el objeto $mysql
		$next_id_estudiante= obtenerNextIdEstudiante($mysqli);

		$query="insert into tbl_estudiantes(ID_ESTUDIANTE, INDICE_GLOBAL, NUMERO_CUENTA, P_NOMBRE, S_NOMBRE, P_APELLIDO, S_APELLIDO, FECHA_NACIMIENTO, ID_DEPARTAMENTO, ESTADO, GENERO, CONFORMIDAD, TRABAJA, EDAD) VALUES (".$next_id_estudiante.
		 	",".$indice_global.
		 	",".$txtNumeroCuenta.
		 	",'".$txtPnombre.
		 	"','".$txtSnombre.
		 	"','".$txtPapellido.
		 	"','".$txtSapellido.
		 	"','".$fecha_nacimiento.
		 	"',".$txtDepartamento.
		 	",".$estado.
		 	",'".$genero.
		 	"','".$conformidad.
		 	"','".$trabaja.
		 	"',".$edad.");";

		if (!$mysqli->query($query)) {
			
			echo "Fallo al Agregar Estudiante (" . $mysqli->errno . ") " . $mysqli->error;
			//En caso de que la consulta no se haya ejecuta exitosamente mandamos mensaje con valor 2
    		mensaje(2);
    		
		}
		else
		{
			//Obtenermos el el proximo id_usuario a travez de la siquiente funcion, pasando como valor el objeto $mysql
			$next_id_usuario= obtenerNextIdUsurio($mysqli);

			$query="INSERT INTO tbl_usuarios(ID_USUARIO, ID_ESTUDIANTE, PASSWORD, EMAIL) VALUES (".$next_id_usuario.
				",".$next_id_estudiante.
				",'".$txtpass.
				"','".$txtEmail."');";
				
				if (!$mysqli->query($query)) {
			
					echo "Fallo al Agregar Usurio (" . $mysqli->errno . ") " . $mysqli->error;
					//Si el usuario no se crea bien entonces se debe borrar el estudiante anteriormente creado con la 
					//funcion eliminarEstudiante()
					eliminarEstudiante($mysqli,$next_id_estudiante);
					//En caso de que la consulta no se haya ejecuta exitosamente mandamos mensaje con valor 3
		    		mensaje(3);
				}

				else
				{	
					// El Estudiante se a creado exitosamente en la base de datos mandamos mensaje con valor 4 de Exito
					mensaje(4);
				}
		}

	}

	// Liberar resultados
	$resultado->close();
	// Cerrar la conexión
	$mysqli->close();
	
	function obtenerNextIdEstudiante($mysqli){

		//Obtenermos el el proximo id_estudiante a travez de la siquiente consulta
		$query="SELECT IF(MAX(ID_ESTUDIANTE) IS NULL, 1, MAX(ID_ESTUDIANTE) + 1) ContactoId FROM tbl_estudiantes";
		$resultado = $mysqli->query($query);
		$next_id_estudiante = mysqli_fetch_row($resultado);
		//Asignamos el valor de la unica fila y columna a la variable $next_id_estudiante
		$next_id_estudiante= $next_id_estudiante[0];

		return  $next_id_estudiante;
	}

	function obtenerNextIdUsurio($mysqli){

		//Obtenermos el el proximo id_usuario a travez de la siquiente consulta
		$query="SELECT IF(MAX(ID_USUARIO) IS NULL, 1, MAX(ID_USUARIO) + 1) ContactoId FROM tbl_usuarios";
		$resultado = $mysqli->query($query);
		$next_id_usuario = mysqli_fetch_row($resultado);
		//Asignamos el valor de la unica fila y columna a la variable $next_id_usuario
		$next_id_usuario= $next_id_usuario[0];

		return $next_id_usuario;
	}

	function eliminarEstudiante($mysqli, $id_estudiante){
		//Creamos la consulta para eliminar el estudiante

		$query="delete from tbl_estudiantes where ID_ESTUDIANTE = ".$id_estudiante.";";
		
		if (!$mysqli->query($query)) {
			echo "Error al Eliminar Estidiante(" . $mysqli->errno . ") " . $mysqli->error;

		}else{
			echo "Estudiante eliminado exitosamente";
		}


	}

	function mensaje($tipoMensaje)
	{
	  header('location: http://localhost/SMART_PROBABILITY_UNAH/register.php?mensaje='.$tipoMensaje.''); 
	}
?>