<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include("helper/head.php");
    session_start(); ?>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>


<body>
    <?php include("helper/navbar.php");

    if (!isset($_SESSION['idUser'])) {
        echo '  <div class="container">
          <div class="panel panel-default text center">
              <div class="panel-body">
              <h4>PARA REALIZAR SUGESTÕES, FAÇA LOGIN OU CRIE UMA CONTA</h4>
              <a href="login.php" class="text-center btn btn-md btn-primary"><b> Login</b> ou <b>Criar conta</b> </a>
              </div>
              </div>
          </div>';
        exit();
    }
    ?>

    <div class="container panel panel-default class02" style="color: black;">
        <div class=" title well text-center">
            <h2>
                <span> FAQ
            </h2>
        </div>
        <form method="post" action="../controller/ControllerFaq.php">

            <div class="form-group">
                <div class="form-row">
                    <label>Deixe sua sugestão</label>
                    <textarea required class="form-control" name="faq_desc" rows="5" placeholder="Escreva aqui"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <hr>
                    <h4>Insira nome e email para novidades!!</h4>
                    <hr>
                    <div class="form-group col-md-4">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="txt_nome_faq" placeholder="Exemplo: Neymara Santos">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Email</label>
                        <input type="email" class="form-control" name="txt_email_faq" placeholder="Exemplo: email@gmail.com">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-offset-5 ">
                    <button class="btn btn-md btn-primary btn-md3" type="submit">Enviar</button>
                </div>
            </div>
        </form>
    </div>
    <?php include("helper/footer.php") ?>
</body>

</html>