<!DOCTYPE html>
<html lang="es">

<head>

    <?php 
        /* Incluir los link y Meta del Head*/
        include ("backend/include_head.php");
    ?>

     <title>SMART PROBABILITY UNAH | SONDEO DE CLASES</title>

</head>

<body>

    <?php 
        /* Incluir Munu Superior o de Encabezado*/
        include ("backend/menus/menu_superior.php");
    ?>


    <div id="envolt" >

        <?php  
            /*Incluir Menu Lateral Izquierdo !Bajo la condicion de logeo¡*/
            include("backend/menus/menu_lateral_izq.php"); 

            /*Verificamos que esta pagina solo este disponible para usuarios registrados en el sitema*/
            if($_SESSION['online']!=1)
            {header("location: http://localhost/SMART_PROBABILITY_UNAH/");}

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
                                    <h2 class="text-center">SONDEO DE CLASES</h2>
                                </div>

                                <div class="row">
                                    <div class="col-xs-12 col-md-3">
                                        <h3>Seleccione una clase</h3>
                                        <?php include("backend/comboBox_Clases.php") ?>
                                        <br>
                                        <button id="btnEvaluarClase" class="btn btn-default" onclick="EjecutarEvaluacion()">Evaluar</button>
                                        <button id="btnEliminarHistorial" class="btn btn-default" onclick="EliminarHistorial()">Eliminar Historial</button>
                                    </div>
                                    <div class="col-xs-12 col-md-9">
                                        <h3 class="text-center">HISTORIAL DE CONSULTAS</h3>
                                        <p><strong>APR:</strong>APROBADA<br><strong>RPB:</strong>REPROBADA<br><strong>UNKNOWN:</strong>RESULTADO INDETERMINADO<br></p>
                                        <div id="contenedorResultados">
                                           <!--Se Mostrara los resultados consultados por el usuario-->
                                        </div>
                                    </div
                                </div>
                            
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

    <!--Evaluacion de Clase-->
    <script type="text/javascript">
        var idClase=0;

        function EstadoEventoEvaluar(estado){
            $('#comboboxClases').attr("disabled", estado);
            $('#btnEvaluarClase').attr("disabled", estado);
        }

        function ObtenerIdClase(codigo_clase){
            idClase=codigo_clase;
        }

        function ObtenerNombreClaseComboBoxClases(){

            var nombreClase = $("#comboboxClases option:selected").text();
            return nombreClase;
        }

        function EliminarHistorial (){
    
            $("#contenedorResultados").empty();
        }

        function EjecutarEvaluacion(){

        if(idClase==0){alert("Seleccione una Clase")}
        else{
            EstadoEventoEvaluar(true);
            $.ajax({
                type:'POST',
                url:'backend/rslt_codigo_clase.php',
                data:'idClase='+idClase,
                success:function(data){
                  var valor = eval(data);
                  var claseLabel =$('<label class="resultClases">'+ObtenerNombreClaseComboBoxClases()+':'+valor+'</label>');
                  $("#contenedorResultados").append(claseLabel);
                  EstadoEventoEvaluar(false);
                }
              });
          }
        }
    </script>

</body>

</html>
