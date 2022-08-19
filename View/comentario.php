<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
</head>


<body>
    <?php
    include("helper/navbar.php");
    require_once("../model/publicacao.php");

    $id = filter_input(INPUT_GET, "idPublicacao"); //recuperando id post a ser comentado

    $post = new publicacao();
    if (isset($_GET['idPublicacao']) && $_GET['idPublicacao'] != "") { //para recuperar post caso pag seja recarregada
        $id = $_GET['idPublicacao'];
        $p = $post->listOnepublicacao($id);
        $dt = date_create($p['data']); 
    } else {
        echo "<script type='text/javascript'>alert('Fail to open post :( try again');window.location.href = 'avaliacao.php';</script>";
    }

    ?>

    <div class="container panel panel-default">
        <div class="row">
            <div class="col-md card">

                <div class="text-center">
                    <h2><?php echo strtoupper($p['titulo']) ?></h2>
                    <hr style="height:2px;background-color:gray">
                </div>

                <div class="card">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h5>
                                <div class="row">
                                    <div class="col-sm-11 text-left"><b><?php echo date_format($dt, 'H:i:s  l, d-m-Y'); ?></b></div>
                                    <div class="col-sm-1">
                                        <span class="glyphicon glyphicon-heart"></span> <?php echo $p['likes'] ?>
                                    </div>
                                </div>
                            </h5>
                        </div>
                        <div class="panel-body">
                            <p>
                                <?php echo $p['descricao'] ?>
                            </p>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <?php
                    $comentario = new comentario();
                    //$com = $comentario->list($id);
                    ?>
                    <h4 class="card">Deixar um comentario:</h4>
                    <form action=" " method="POST" role="form">
                        <div class="form-group">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tag" value="Positivo">Positivo
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tag" value="Negativo">Negativo
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="tag" value="Imparcial">Imparcial
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="idpublicacao" value=<?php echo $id ?>>
                            <textarea name="descricaoC" class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Enviar comentario</button>
                    </form>
                    <br><br>
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["descricaoC"])) {
                        $descrip = filter_input(INPUT_POST, "descricaoC", FILTER_SANITIZE_STRING);
                        $idp = filter_input(INPUT_POST, "idpublicacao");
                        $dt = date("Y-m-d H:i:s");
                        $tag = filter_input(INPUT_POST, "tag");

                        $comentario->insert($descrip, $dt, $tag, $idp, $_SESSION['idUser']);
                    }
                    ?>

                    <p><span class="badge">
                            <?php
                            echo $count = $comentario->countcomentario($id); //mostrando quantidade de comentarios
                            ?>
                        </span> comentarios:</p><br>

                    <?php //listar comentarios
                    $com = $comentario->list($id);
                    foreach ($com as $key => $value) {
                        $dt = date_create($value['data']);
                        echo '<div class="row">
                        <div class="col-sm-2 text-center">
                            <img src="img/img_avatar.png" class="img-circle" height="65" width="65" alt="Avatar">
                        </div>
                        <div class="col-sm-10">
                            <h4>' . $value['nome'] . ' <small>' . date_format($dt, 'H:i:s  l, d-m-Y') . '    Tag: <b>' . $value['tag'] . '<b></small></h4>
                            <p> ' . $value['descricao'] . '
                            </p>
                            <br>
                        </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include("helper/footer.php") ?>
</body>

</html>