 <!--------------------------- Barra menu superior !--------------------------->
 <nav class="navbar navbar-inverse navbar-static-top">
     <div class="container-fluid">
         <div class="navbar-header">
             <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                 <span class="icon-bar"></span>

             </button>
             <a class="navbar-brand" href="home.php">
                 <img src="img/AvalieMyProf.png" style="max-width:150px; margin-top: -7px;">
             </a>
         </div>
         <div class="collapse navbar-collapse" id="myNavbar">
             <ul class="nav navbar-nav navbar-left">
                 <li><a href="home.php">Página Inicial</a></li>
                 <li><a href="avaliacao.php">Avaliações</a></li>
                 <?php
                    if (isset($_SESSION['tipo']) && $_SESSION['tipo'] != 'P') {
                        //echo '<hr style="height:1px;background-color:ligth-gray; padding:0px; margin:5px;">';
                        echo '<li><a href="publica-avaliacao.php">Publicar Avaliação</a></li>';
                    }
                    ?>

                 <li><a href="faq_view.php">FAQ</a></li>
                 <li><a href="about.php">Sobre Nós</a></li>
             </ul>
             <ul class="nav navbar-nav navbar-right">
                 <?php
                    if (isset($_SESSION['nomeUser']) == true) { //se tem usuário setado
                        if ($_SESSION['tipo'] == 'P' || $_SESSION['tipo'] == 'W') { //se usuario é padrão não habilita crud de admin
                            echo '<li><a><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['nomeUser'] . '</b></a></li>';
                            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <b>Sair</b></a></li>';
                        } else { //usuário admin
                            echo '<li><a href="adminUser.php"><span class="glyphicon glyphicon-user"></span> ' . $_SESSION['nomeUser'] . '</b></a></li>';
                            echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <b>Sair</b></a></li>';
                        }
                    } else echo '<li><a href="login.php"><span class="glyphicon glyphicon-user"></span> <b>Login</b> ou <b>Criar conta</b></a></li>';
                    ?>
             </ul>
         </div>
     </div>
 </nav>

 <!--------------------------- FIM Barra menu superior !--------------------------->