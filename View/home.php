<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <?php include("helper/head.php");
    session_start(); ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <?php include("helper/navbar.php");
    require_once("../model/prof_uni.php");
    require_once("../model/publicacao.php"); ?>
    <div class="container panel panel-default testa2" style="padding: 98px;">
        <div class=" title well text-center">
            <h1>
                <span> Pesquisa Professor e Universidade
            </h1>
        </div>

        <div class="panel-body row p-2">
            <table id="prof_uni" class="display" style="width:100%">
                <thead>

                    <tr>
                        <th>Professor</th>
                        <th>Universidade</th>
                        <th>Endereço</th>

                    </tr>
                </thead>
                <tbody>

                    <?php
                    $prof_uni = new prof_uni();

                    $point = $prof_uni->listPoint();

                    foreach ($point as $key => $value) {
                        $nome_prof = $value['nome_prof'];
                        $nome_uni = $value['nome_uni'];
                        $endereco = $value['endereco'];
                        echo "
                        <tr>
                            <td>$nome_prof</td>
                            <td>$nome_uni</td>
                            <td>$endereco</td>
                         </tr>";
                    }

                    ?>

                </tbody>
                
            </table>
        </div>

        <!-- Daqui pra baixo só acessa se for ADM !-->

        <div class="panel-group hide card" id="accordionmaster">
            <div class=" title well text-center">
                <h2>
                    <span> Cadastrar Professor e Universidade
                </h2>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Inserir Professor e Universidade</a>
                    </h4>
                </div>
                <div id="collapse1" class="panel-collapse collapse">
                    <div class="panel-body">
                        <form action="../controller/ControllerProf_uni.php" method="post" id="form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Nome Professor</label>
                                    <input required type="text" class="form-control" name="txtnome_prof" placeholder="Nome Professor">
                                </div>

                            </div>
                            <div class="form-group col-md-6">
                                <label>Nome Universidade</label>
                                <input required type="text" class="form-control" name="txtnome_uni" placeholder="Nome Universidade">
                            </div>
                            <div class="form-group">
                                <div class=" title well text-center">
                                    <h3>Endereço Universidade</h3>
                                </div>
                                <div class="form-group col-md-8">
                                    <label>Endereço</label>
                                    <input required type="text" class="form-control" name="txt_endereco" placeholder="Escreva o endereço completo">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-offset-5 ">
                                    <input type="hidden" value="1" name="pointOp">
                                    <button required class="btn btn-md btn-primary" type="submit">Salvar mudança</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Deletar Professor e Universidade</a>
                    </h4>
                </div>
                <div id="collapse2" class="panel-collapse collapse">
                    <div class="panel-body">
                        <div class="container">
                            <form class="form-inline" action="../controller/ControllerProf_uni.php" method="post">
                                <label>Informe <b>'ID'</b> para deletar:</label>
                                <input type="number" name="idpub" placeholder="Numero de ID">
                                <input type="hidden" value="2" name="pointOp">
                                <input class="btn btn-danger" type="submit" value="Deletar ID">
                            </form>
                            <br>
                        </div>
                        <table id="accessPoint2" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Professor</th>
                                    <th>Nome Universidade</th>
                                    <th>Endereço</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $prof_uni = new prof_uni();

                                $point = $prof_uni->listPoint();
                                foreach ($point as $key => $value) {
                                    $idProf_uni = $value['idProf_Uni'];
                                    $nome_prof = $value['nome_prof'];
                                    $nome_uni = $value['nome_uni'];
                                    $endereco = $value['endereco'];

                                    echo "
                                        <tr>
                                            <td>$idProf_uni</td>
                                            <td>$nome_prof</td>
                                            <td>$nome_uni</td>
                                            <td>$endereco</td>
                                            
                                        </tr>";
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Nome Professor</th>
                                    <th>Nome Universidade</th>
                                    <th>Endereço</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#prof_uni').DataTable({
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

            });
        });
        $(document).ready(function() {
            $('#accessPoint2').DataTable({
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

        //php retorna a variavel session se tiver algo dentro senao retorna null
        let tipo = "<?php if (isset($_SESSION['tipo']) == true) {
                        echo $_SESSION['tipo'];
                    } else echo null;
                    ?>";

        if (tipo == 'D' || tipo == 'A') { //se for adm ou aluno mostro op adm
            document.getElementById('accordionmaster').classList.remove('hide');
        }
    </script>
    <?php include("helper/footer.php") ?>
</body>

</html>