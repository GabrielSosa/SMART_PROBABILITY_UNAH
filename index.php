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


    <div id="envolt" >

        <?php  
            /*Incluir Menu Lateral Izquierdo !Bajo la condicion de logeo¡*/
            include("backend/menus/menu_lateral_izq.php") 
        ?>
        
        <section> <!-- Page Section Content -->
            <div id="page-content-envolt"> <!-- Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xs-12 col-md-12 contenidoPrimario">
                            <table id="tblmenu-hamburger">
                                <thead>
                                    <br>
                                    
                                </thead>
                            </table>
                            <table align="center">
                                <thead>
                                    <div class="text-center"><h1>SMART PROBABILITY UNAH</h1></div>
                                </thead>
                            </table>
                        </div>
                        <div class="col-xs-12 col-md-12">
                            <div class="contenidoSegundario">
                                <div class="subContenidoSegundarioP">
                                    <h2 class="text-center">Sistemas Expertos</h2>
                                </div>

                            
                                <center><img src="img/logo01.png" class="img-responsive" style="max-height:250px; max-width:400px"></center>
                            
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
    </div><!-- End Sidebar -->


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
