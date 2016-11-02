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
                                        <div id="ComboBoxResultado">
                                            <?php include("backend/comboBox_Clases.php") ?>
                                        </div>
                                        <br>
                                        <button id="btnEvaluarClase" class="btn btn-default" onclick="EjecutarEvaluacion()">Añadir Clase</button>
                                        <button id="btnEvaluarTotal" class="btn btn-default" onclick="ImprimirTodo()">Evaluar</button>
                                        <button id="btnEliminarHistorial" class="btn btn-default" onclick="eliminarTodasFilas()">Eliminar</button>
                                    </div>
                                    <div class="col-xs-12 col-md-9">
                                        <h3 class="text-center">HISTORIAL DE CONSULTAS</h3>
                                       
                                       <div class="col-xs-12 col-md-12">
                                       
                                       <table id="tabla" class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <!--<td>Nº</td>-->
                                                    <td>Codigo</td>
                                                    <td>Asignatura</td>
                                                    <td>Periodo</td>
                                                    <td>Carrera</td>
                                                </tr>
                                            </thead>

                                        </table>    
                                    </div>

                                    <div id="contenedorResultados">
                                           <!--Se Mostrara los resultados consultados por el usuario-->
                                    </div>

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
            $('#btnEvaluarTotal').attr("disabled", estado);
            $('#btnEliminarHistorial').attr("disabled", estado);
        }

        function ObtenerIdClase(codigo_clase){
            idClase=codigo_clase;
        }

        function ObtenerNombreClaseComboBoxClases(){

            var nombreClase = $("#comboboxClases option:selected").text();
            return nombreClase;
        }



        var cont=0;
        var id_fila_selected=[];
        var arreglo = new Array();
        var valor = '';

        function EjecutarEvaluacion(){

        if(idClase==0){alert("Seleccione una Clase")}
        else{
            EstadoEventoEvaluar(true);
            $.ajax({
                type:'POST',
                url:'backend/rslt_codigo_clase.php',
                data:'idClase='+idClase,
                success:function(data){
                  valor = eval(data);
                  cont++;
                  var fila='<tr><td>'+idClase+'</td><td>'+ObtenerNombreClaseComboBoxClases()+'</td><td>2</td><td>Ingenieria en sistemas</td></tr>';
                  $('#tabla').append(fila);
                  arreglo.push(valor);
                  $('#'+idClase).remove();
                  idClase = 0;
                  EstadoEventoEvaluar(false);
                }
              });
          }
        }

        function eliminarTodasFilas(){
            $('#tabla tbody tr').each(function(){
            $(this).remove();
            });
            $("#contenedorResultados").empty();
            location.reload();
        }
        
        //Variables que cuentan el total de APROBADAS, REPROBADAS Y DESCONODIDAS
        var ConAPR = 0;
        var ConRPB = 0;
        var ConDES = 0;

        function ImprimirTodo(){
            var TotalClase = ResultadoTotal();
            $("#contenedorResultados").empty();
            var claseLabel =$('<label class="resultClases">EL RESULTADO ES: '+TotalClase+'</label>');
            $("#contenedorResultados").append(claseLabel);
            EstadoEventoEvaluar(false);
        }

       
        function ResultadoTotal(){
            for (var i = 0; i < arreglo.length; i++) {
                if(arreglo[i]=='APR'){
                 ConAPR ++;
                }else if(arreglo[i]=='RPB'){ 
                    ConRPB ++;
                }
                else{
                    ConDES++;
                }
            }
            
            //Verificar que resultado hay mas valores
            if(ConAPR>ConRPB && ConAPR>ConDES){
                return 'APROBADO';
            }else if(ConRPB>ConAPR && ConRPB>ConDES){
                return 'REPROBADO';
            }else{
                return 'DESCONOCIDO';
            }

            return 'DESCONOCIDO';
        }

    </script>

</body>

</html>
