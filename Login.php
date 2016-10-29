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
                                <h2 class="text-left transicionDerIzq">Inicio de Sección</h2>
                            </div>
                            <div>
                                <form class="form-horizontal" action="backend/verificar_login.php" method="post">
                                    <div class="form-group">
                                        <label for="inputnombreUsu" class="col-sm-2 control-label">Número Cuenta</label>
                                        <div class="col-sm-10">
                                        <input type="text" name="inputNumeroCuenta" class="form-control" id="inputnombreUsu" placeholder="Número Cuenta" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputContraseña" class="col-sm-2 control-label">Contraseña</label>
                                        <div class="col-sm-10">
                                        <input type="password" name="inputPassword"  class="form-control" id="inputContraseña" placeholder="Contraseña" value="">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                          <button type="submit" class="btn btn-default">Login</button>
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
