<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>

<body>
    <?php
    include("helper/navbar.php");
    require_once("../model/publicacao.php");
    require_once("../model/banco.php");

    if (!isset($_SESSION['idUser'])) {
        echo '  <div class="container">
        <div class="panel panel-default text center">
            <div class="panel-body">
            <h4>PARA VER AS AVALIAÇÕES, FAÇA LOGIN OU CRIE UMA CONTA</h4>
            <a href="login.php" class="text-center btn btn-md btn-primary"> <b> Login</b> ou <b>Criar conta</b> </a>
            </div>
            </div>
        </div>';
        exit();
    }
    ?>


    <div class="container">
        <div class="row">
            <div class="leftcolumn">
                <?php
                $post = new publicacao();
                //for pagination
                if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
                    $page_no = $_GET['page_no'];
                } else {
                    $page_no = 1;
                }
                //Start - Insane calc of pagination
                $total_records_per_page = 4; //num of post per page
                $offset = ($page_no - 1) * $total_records_per_page;
                $previous_page = $page_no - 1;
                $next_page = $page_no + 1;
                $adjacents = "2";

                $total_records = $post->countpublicacaos();
                $total_no_of_pages = ceil($total_records / $total_records_per_page);
                $second_last = $total_no_of_pages - 1; // total page minus 1
                //Finish calc of pagination

                $all = $post->list($total_records_per_page, $offset);

                foreach ($all as $key => $value) {
                    $dt = date_create($value['data']); //criando obj tipo data para formatar 

                    if (strlen($value['descricao']) > 500) {
                        $descr = strip_tags($value['descricao']);
                        $d =  substr($descr, 0, 500);
                    } else $d = $value['descricao'];

                    echo '<div class="card class01">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="text-center">' . strtoupper($value['titulo']) . '</h2>
                                <hr>
                                <h5>
                                    <div class="row">
                                        <div class="col-sm-11 text-left"><b>' . date_format($dt, 'H:i:s  l, d-m-Y') . '</b></div>
                                        <div class="col-sm-1">
                                            <span class="glyphicon glyphicon-heart"></span> <span id="like-' . $value['idPublicacao'] . '"> ' . $value['likes'] . '</span>
                                        </div>
                                    </div>
                                </h5> 
                            </div>
                            <div class="panel-heading">  
                                <h5 class="text-left">Professor: ' . strtoupper($value['nome_prof']) . '</h5>
                                <h5 class="text-left">Ministrou Disciplina: ' . strtoupper($value['ministrou_disciplina']) . '</h5>
                            </div>
                            <div class="panel-body">
                                
                                <p>
                                ' . $d /*descricao*/ . '
                                </p>
                            </div>
                            <div>
                                <div class="btn-group btn-group-justified">
                                    <div class="btn-group" >
                                        <form method="get" action="comentario.php">
                                            <input type="hidden" name="idPublicacao" value="' . $value['idPublicacao'] . '">
                                            <button id="comment" type="submit" class="btn btn-primary"> <span class="glyphicon glyphicon-comment"></span> Comentário</button>
                                        </form>
                                    </div>
                                    <div class="btn-group">
                                        <button data-post-id="' . $value['idPublicacao'] . '" type="button" class="btn btn-primary tipolikeid"><span class="glyphicon glyphicon-heart"></span> Curtidas</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
                ?>
                <?php include("helper/pagination.php") ?>
                <script type="text/javascript">
                    $(function() {
                        $(".tipolikeid").click(function() {
                            postID = $(this).attr("data-post-id");
                            $.ajax({
                                method: "post",
                                url: "../controller/ControllerPublicacao.php",
                                data: {
                                    idPublicacao: postID,
                                    postOp: "2",
                                },
                                success: function(retorno) {
                                    $("#like-" + postID).html(retorno);
                                }
                            })
                        });
                    });
                </script>
            </div>

            <div class="rightcolumn">
                <div class="card text-center">
                    <h3>Avaliações mais Curtidas</h3>
                    <?php
                    $all = $post->listPopular();

                    foreach ($all as $key => $value) {
                        echo '
                        <div class="panel panel-default">
                            <div class=" panel-heading">
                                <div class="row">
                                    <div class="col-sm-10"><h5 class="text-center" style="text-size-adjust: auto;">
                                        ' . strtoupper($value['titulo']) . '
                                        </h5>
                                    </div>
                                    <div class="col-sm-1">
                                        <span class="glyphicon glyphicon-heart"></span>' . $value['likes'] . '
                                    </div>
                                </div>
                                <div class="row">
                                    <form method="get" action="comentario.php">
                                        <input type="hidden" name="idPublicacao" value="' . $value['idPublicacao'] . '">
                                        <button type="submit" class="btn btn-block btn-link btn-sm" style="padding:0px">Mais Detalhes</button>
                                    </form>
                                </div>
                            </div>
                            
                        </div>';
                    }
                    ?>
                </div>
                <div class="card text-center">
                    <h3>FAQ</h3>
                    <div class="panel panel-default">
                        <p class="text-justify bg-success">Para novas sugestões, dúvidas ou elogios para os Devs nos encaminhe um FAQ</p>

                        <div class=" panel-body">
                            <a href="faq_view.php">
                                <button class="btn btn-block btn-success btn-md" style="padding:0px">Nova sugestão</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card text-center">
                    <h2>Sobre Nós</h2>
                    <div class="panel panel-default">
                        <p class="bg-success">Estamos desenvolvendo um projeto voltado para avaliações dicentes para disciplina PDS1!</p>

                        <div class="panel-body">
                            <a href="about.php">
                                <button class="btn btn-block btn-success btn-md" style="padding:0px">Siga nos</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        if (tipo == 'D' || tipo == 'A') { //se for adm ou aluno mostro op adm
            document.getElementById('comenta').classList.remove('hide');
        }
    </script>
    <?php include("helper/footer.php") ?>
</body>

</html>