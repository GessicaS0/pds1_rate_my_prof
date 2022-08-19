<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include("helper/head.php");
    session_start();  ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <?php include("helper/navbar.php");

    if ((!isset($_SESSION['idUser'])) || ($_SESSION['tipo'] == 'P')) {
        echo '  <div class="container">
        <div class="panel panel-default text center">
            <div class="panel-body">
            <h4>PARA PUBLICAR AVALIAÇÕES, FAÇA LOGIN OU CRIE UMA CONTA</h4>
            <a href="login.php" class="text-center btn btn-md btn-primary"> <b> Login</b> ou <b>Criar conta</b> </a>
            </div>
            </div>
        </div>';
        exit();
    }
    ?>

    <div class="container">

        <h2>Avaliações</h2>
        <hr>
        <div class="panel-group" id="accordion">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Inserir Avaliação</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <div class="btn-group">
                            <a href="new-avaliacao.php" class="btn btn-primary">Escrever nova Avaliação</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Deletar Avaliação</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="container">
                            <form class="form-inline" action="../controller/ControllerPublicacao.php" method="post">
                                <label>Informe o <b>'ID'</b> para deletar a avaliação:</label>
                                <input type="number" name="idPublicacao">
                                <input type="hidden" value="3" name="postOp">
                                <input class="btn btn-danger" type="submit" value="Deletar Avaliação">
                            </form>
                            <br>
                        </div>
                        <table id="post" class="display" style="width:98%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Curtidas</th>
                                    <th>Nome Professor</th>
                                    <th>Email Professor</th>
                                    <th>Ministrou Disciplina</th>
                                    <th>Nome Aluno</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                require_once("../model/publicacao.php");
                                $post = new publicacao();

                                $posts = $post->listAllpublicacao();

                                foreach ($posts as $key => $value) {
                                    $idPublicacao = $value['idPublicacao'];
                                    $title = $value['titulo'];
                                    $description = $value['descricao'];
                                    $date = $value['data'];
                                    $like = $value['likes'];
                                    $nome_prof = $value['nome_prof'];
                                    $email_prof = $value['email_prof'];
                                    $ministrou_disciplina = $value['ministrou_disciplina'];
                                    $name = $value['nome'];

                                    echo "
                                            <tr>
                                                <td>$idPublicacao</td>
                                                <td>$title</td>
                                                <td>$description</td>
                                                <td>$date</td>
                                                <td>$like</td>
                                                <td>$nome_prof</td>
                                                <td>$email_prof</td>
                                                <td>$ministrou_disciplina</td>
                                                <td>$name</td>
                                                
                                            </tr>";
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Titulo</th>
                                    <th>Descrição</th>
                                    <th>Data</th>
                                    <th>Curtidas</th>
                                    <th>Nome Professor</th>
                                    <th>Email Professor</th>
                                    <th>Ministrou Disciplina</th>
                                    <th>Nome Aluno</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("helper/footer.php") ?>
    <script>
        $(document).ready(function() {
            $('#post').DataTable({
                "dom": '<"top"f>rt<"bottom"lp><"clear">',
                lengthChange: false,
                language: {
                    "url": 'https://cdn.datatables.net/plug-ins/1.12.1/i18n/pt-BR.json'
                },
                "fnDrawCallback": function() {
                    $("#example_filter").detach().appendTo('#new-search-area');
                    $("input[type='search']").attr("id", "searchBox");
                    $('#dialPlanListTable').css('cssText', "margin-top: 0px !important;");
                    $("select[name='dialPlanListTable_length'], #searchBox").removeClass("input-sm");
                    $('#searchBox').css("width", "600px").focus();
                    $('#prof_uni_filter').css('margin-top', '1em');
                    $('#dialPlanListTable_filter').removeClass('dataTables_filter');
                }
            })
        });
    </script>
</body>

</html>