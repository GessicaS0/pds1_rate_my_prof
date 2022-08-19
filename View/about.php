<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <?php include("helper/navbar.php") ?>



    <div class="container panel panel-default testa2">
        <div class="panel-body">
            <div class="jumbotron">
                <h2 class="display-3 text-center">SOBRE NÓS</h2>
                <h6 class="tagh6">
                    <br></br>
                    Somos alunos da disciplina de PDS1 e desenvolvemos um site para que alunos de todas as faculdades possam avaliar seus professores de suas universidades.
                </h6>

            </div>
            <!-- 
                Criando seção dos parceiros com seus respectivos tamanhos de colunas    
            !-->
            <section id="parceiros">
                <div class="container-fluid text-center margin ">
                    <h3 class="margin">DEV's</h3>
                    <div class="container ">
                        <div class="row">
                            <!--  Coluna media mg, lg grande, sm smal-->
                            <div class="col-md-6">
                                <img src="img/gess.jpg" width="50%" class="img-circle">
                                <br>
                                <p><b>Géssica Santos</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="https://github.com/GessicaS0" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="https://www.linkedin.com/in/g%C3%A9ssica-santos-47b7911b3/" target="_blank">Linkedin</a>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img src="img/vini.jpg" width="40%" class="img-circle">
                                <br>
                                <p><b>Vinícius Ferreira</b></p>
                                <div class="btn-group">
                                    <a class="btn btn-primary" href="" target="_blank">Github</a>
                                    <a class="btn btn-primary" href="https://www.linkedin.com/in/vin%C3%ADcius-silva-ferreira-5b7a5a203/" target="_blank">Linkedin</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <?php include("helper/footer.php") ?>


</body>

</html>