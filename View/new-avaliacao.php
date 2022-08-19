<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <?php include("helper/head.php") ?>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://cdn.tiny.cloud/1/yurkwx6m9mhihtylqvdycmktq2zl3kh9tq8eied6qhuzetqd/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>
    <?php
    session_start();
    require_once("../model/publicacao.php");
    //Antes de carregar a pagina crio a verificação com as variaveis de sessão para saber se
    //o usuário tem permissão para escrever post's
    // userType values -> A= Aluno; D = Padrão; P = Professor

    if ($_SESSION['tipo'] == 'P') {
        echo "<script type='text/javascript'>alert('Usuário não permitido para escrever publicações');window.location.href = 'home.php';</script>";
    } else $_SESSION["postOp"] = 1;

    ?>
    <?php include("helper/navbar.php") ?>

    <div class="container panel panel-default">
        <div class="row class01">
            <div class="col-md card">
                <div class="text-center">
                    <h2>Nova Avaliação</h2>
                    <hr style="height:2px;background-color:gray">
                </div>

                <form class="form-horizontal" method="post" action="../controller/ControllerPublicacao.php">

                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input id="focusedInput" class="form-control input-lg" type="text" name="txt_titulo" placeholder="Titulo da avaliação" required autofocus />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input id="nomeprof" class="form-control input-lg" type="text" name="txt_nome_prof" placeholder="Nome Professor" required />

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input id="emailprof" class="form-control input-lg" type="email" name="txt_email_prof" placeholder="Email professor" required />

                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input id="ministro" class="form-control input-lg" type="text" name="txt_ministrou" placeholder="Já cursou a materia: (S ou N)" required />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <textarea id="edit-post" class="form-control" name="txtBody" required style="height: 300px;">Escreva aqui a sua avaliação</textarea>
                        </div>
                    </div>

            </div>
            <input type="hidden" value="1" name="postOp">
            <input type="hidden" value="<?php echo $_SESSION['idUser'] ?>" name="idUser">
            <div class="form-group">
                <div class="col">
                    <button class="btn btn-lg btn-success btn-block" type="submit">Enviar avaliação</button>
                </div>
            </div>
            </form>

        </div>
    </div>
    </div>

    <?php include("helper/footer.php") ?>

    <script>
        tinymce.init({
            selector: '#edit-post'
        });
    </script>
</body>

</html>