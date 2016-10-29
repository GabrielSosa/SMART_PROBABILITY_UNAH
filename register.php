<?php 
    if(isset($_GET['mensaje']) != "") 
        {
            if($_GET['mensaje']==1){
                echo '<script language="javascript">alert("Número de Cuenta Existente");</script>'; 
            }
            else if ($_GET['mensaje']==2) {
                echo '<script language="javascript">alert("Error al agregar Estudiante");</script>'; 
            }

            else if ($_GET['mensaje']==3) {
                echo '<script language="javascript">alert("Error al agregar Usurio Estudiante");</script>'; 
            }

            else if ($_GET['mensaje']==4) {
                echo '<script language="javascript">alert("Estudiante Creado Exitosamente");</script>'; 
            }
        }


?>

<!DOCTYPE html>
<html lang="es">

<head>

    <?php 
        /* Incluir los link y Meta del Head*/
        include ("backend/include_head.php");
    ?>

     <title>SMART PROBABILITY UNAH</title>

</head>

<body>

   <?php 
        /* Incluir Munu Superior o de Encabezado*/
        include ("backend/menus/menu_superior.php");
    ?>


    <div id="toggled">
        <section> <!-- Page Section Content -->
            <div id="page-content-envolt"> <!-- Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 contenidoPrimario">
                            <table align="center">
                                <thead>
                                    <div class="text-center"><h1>SMART PROBABILITY UNAH</h1></div>
                                </thead>
                            </table>
                        </div>
                        <div class="col-xs-12 col-md-12 contenidoSegundario">
                            <div class="subContenidoSegundarioP">
                                <h2 class="text-left transicionDerIzq">Registro de Nuevos Usuarios</h2>
                            </div>
                            <div>
                                <form class="form-horizontal" action="backend/procedure_registrar_usuario.php" method="post">
                                    <div class="form-group">
                                        <label for="inputDepartamento" class="col-sm-2 control-label">Seleccione una Carrera</label>
                                        <div class="col-sm-10">
                                        <select name="cbxDepartamento" class="form-control" id="inputDepartamento" required>
                                            <option value="1">Carrera de Ingenieria en Sistemas</option>
                                        </select>   
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputnumeroCuenta" class="col-sm-2 control-label">Número Cuenta</label>
                                        <div class="col-sm-10">
                                        <input type="text" pattern="[0-9]{11}"  name="txtNumeroCuenta"  class="form-control" id="inputnumeroCuenta" placeholder="Número Cuenta" title="NÚMERO DE CUENTA FORMATO NÚMERICO: 00000000000 (11 Digitos)" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPnombre" class="col-sm-2 control-label">Priner Nombre</label>
                                        <div class="col-sm-10">
                                        <input type="text" pattern="[(a-z)|(A-Z)|(\s)|(á)|(é)|(i)|(ó)|(ú)]*" name="txtPnombre" class="form-control" id="inputPnombre" placeholder="Primer Nombre" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSnombre" class="col-sm-2 control-label">Segundo Nombre</label>
                                        <div class="col-sm-10">
                                        <input type="text" pattern="[(a-z)|(A-Z)|(\s)|(á)|(é)|(i)|(ó)|(ú)]*" name="txtSnombre" class="form-control" id="inputSnombre" placeholder="Segundo Nombre" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPapellido" class="col-sm-2 control-label">Priner Apellido</label>
                                        <div class="col-sm-10">
                                        <input type="text" pattern="[(a-z)|(A-Z)|(\s)|(á)|(é)|(i)|(ó)|(ú)]*" name="txtPapellido" class="form-control" id="inputPapellido" placeholder="Primer Apellido" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSnombre" class="col-sm-2 control-label">Segundo Apellido</label>
                                        <div class="col-sm-10">
                                        <input type="text" pattern="[(a-z)|(A-Z)|(\s)|(á)|(é)|(i)|(ó)|(ú)]*" name="txtSapellido" class="form-control" id="inputSnombre" placeholder="Segundo Apellido" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                        <input type="email" name="txtEmail" class="form-control" id="inputEmail3" placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword" class="col-sm-2 control-label">Contraseña</label>
                                        <div class="col-sm-10">
                                          <input type="text" pattern=".{6,}" title="SEIS O MÁS CARACTERES" name="txtpass" class="form-control" id="inputPassword" placeholder="Contraseña" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="submit" class="btn btn-default">Registrar</button>
                                          <button type="reset" class="btn btn-default">Limpiar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>    
                        </div>
                    </div>
                </div>
                
                <?php
                    //inclucion del contenido del pie de pagina
                    include("backend/include_footer.php")
                ?>
                
            </div> <!-- End page-content-envolt -->
        </section> <!-- End Page Section Content -->
    </div>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#envolt").toggleClass("toggled");
    });
    </script>

</body>

</html>
