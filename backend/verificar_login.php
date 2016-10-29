<?php

	$numeroCuenta=$_POST['inputNumeroCuenta'];
	$contraseña=$_POST['inputPassword'];

	//Extraemos los datos del de seguridad del servidor y la base de datos
	require('datos_server.php');

	// Realizamos la consulta de email y contraseña del usuario si existe en la tbl_usuarios
	$query = "SELECT ID_USUARIO , P_APELLIDO, PASSWORD, EMAIL FROM `tbl_estudiantes` A INNER JOIN tbl_usuarios B ON A.ID_ESTUDIANTE = B.ID_ESTUDIANTE WHERE NUMERO_CUENTA='".$numeroCuenta."' AND PASSWORD='".$contraseña."'";
	// Ejecutamos la consulta
	$resultado = $mysqli->query($query);

	//  obtenermos la cantidad de registros de la consulta
	$n =$resultado->num_rows;


	if($n>0){

		$registro = mysqli_fetch_row($resultado); //colocamos la informacion de la consulta en un registro

		session_start();
		$_SESSION['id_usuario']=$registro[0];  	 //obtenemos el id del usuario de la del indice 0 del registro
		$_SESSION['usuario']=$registro[1];	     //obtenemos el nombre de usuario de la del indice 1 del registro
		$_SESSION['pass']=$registro[2];			 //obtenemos la contraseña del usuario de la del indice 2 del registro
		$_SESSION['email']=$registro[3];	     //obtenemos el email del usuario de la del indice 3 del registro
		$_SESSION['online']=1;                   //verificamos que usuario esta en line 1 en caso contrario 0 (offline)

		header("location: ../index.php");
		}
	else
		{
		header("location: ../login.php");
		}
	

	// Liberar resultados
	$resultado->close();
	// Cerrar la conexión
	$mysqli->close();
	
?>