<!-- Fixed navbar -->
    <section id="sectMenuPr">
        <nav class="navbar navbar-inverse navbar-fixed-top" id="navMenuPr">
          <div class="container">
            <div class="navbar-header">
                <?php
                    if (isset($_SESSION['online'])) {
                      echo '<button type="button" class="btn" id="menu-toggle" style="margin-top:15px; height:20px;">
                            <span class="glyphicon glyphicon-menu-hamburger" style="top:-5px;"></span>
                            </button>'; 
                    }

                ?>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              
                <a  class="navbar-brand" href="index.php">INICIO</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <?php
                if (isset($_SESSION['online'])) {

                  echo '
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i>'.$_SESSION['usuario'].'</a>
                        </li>
                        <li>
                            <a href="backend/offline.php"><i class="fa fa-fw fa-power-off"></i>Salir</a>
                        </li>
                    </ul>
                  ';

                }
                else{
                  echo'
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="login.php">Iniciar Sesión<span class="sr-only">(current)</span></a></li>
                      <li><a href="register.php">Registrarse<span class="sr-only">(current)</span></a></li>
                    </ul>
                  ';
                }
              ?>
            </div><!--/.nav-collapse -->
          </div>
        </nav>
    </section>