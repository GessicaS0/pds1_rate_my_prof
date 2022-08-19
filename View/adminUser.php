<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <?php include("helper/head.php");
    session_start(); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body>
    <?php include("helper/navbar.php");
    require_once("../model/user.php");
    require_once("../model/faq.php"); ?>
    <div class="container card">
        <div class="panel-group hide card" id="accordionmaster">
            <div class=" title well text-center">
                <h3>CONTROLE DE USUÁRIOS</h3>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Lista de Usuários</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table id="userList" class="table display" style="width:98%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Senha</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Idade</th>
                                    <th scope="col">Faculdade</th>
                                    <th scope="col">Curso</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $user = new User();

                                $arrayU = $user->listUsers();
                                foreach ($arrayU as $key => $value) {
                                    $idUser = $value['idUser'];
                                    $Nome = $value['nome'];
                                    $email = $value['email'];
                                    $sn = $value['senha'];
                                    $Tipo_user = $value['tipo_user'];
                                    $idad = $value['idade'];
                                    $facul = $value['faculdade'];
                                    $curso = $value['curso'];

                                    echo "
                                        <tr>
                                            <td>$idUser</td>
                                            <td>$Nome</td>
                                            <td>$email</td>
                                            <td>$sn</td>
                                            <td>$Tipo_user</td>
                                            <td>$idad</td>
                                            <td>$facul</td>
                                            <td>$curso</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Senha</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Idade</th>
                                    <th scope="col">Faculdade</th>
                                    <th scope="col">Curso</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Deletar Usuário</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="container">
                            <form class="form-inline" action="../controller/ControllerUser.php" method="post">
                                <label>Informe o <b>'Id'</b> para deletar usuário:</label>
                                <input type="number" name="idUser" placeholder="Numero de ID">
                                <input type="hidden" value="3" name="userOp">
                                <input class="btn btn-danger btn-sm" type="submit" value="Deletar Usuário">
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Lista de sugestões</a>
                    </h4>
                </div>
                <div id="collapse3" class="panel-collapse collapse">
                    <div class="panel-body">
                        <table id="faq_list" class="display" style="width:98%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Id user</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $faq = new FAQ();

                                $arrayU = $faq->list();
                                foreach ($arrayU as $key => $value) {
                                    $idfaq = $value['idFAQ'];
                                    $desc = $value['descricao'];
                                    $nome_f = $value['nome'];
                                    $email_f = $value['email'];
                                    $userId = $value['User_idUser'];

                                    echo "
                                        <tr>
                                            <td>$idfaq</td>
                                            <td>$desc</td>
                                            <td>$nome_f</td>
                                            <td>$email_f</td>
                                            <td>$userId</td>
                                        </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Id user</th>
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
            $('#userList').DataTable({
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

        $(document).ready(function() {
            $('#faq_list').DataTable({
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

        let tipo = "<?php if (isset($_SESSION['tipo']) == true) {
                        echo $_SESSION['tipo'];
                    } else echo null;
                    ?>";

        if (tipo == 'D') { //se for adm mostro op adm
            document.getElementById('accordionmaster').classList.remove('hide');
        }
    </script>
</body>

</html>