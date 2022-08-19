<!DOCTYPE html>
<html lang="pt-br">

<head>
  <?php include("helper/head.php") ?>
  <link rel="stylesheet" type="text/css" href="css/style-login.css" />
</head>

<body>
  <?php
  session_start();
  include("helper/navbar-login.php");
  ?>

  <div class="container">
    <div class="row thera">
      <div class="col-sm-6 col-md-4 col-md-offset-4">
        <div class="account-wall">
          <h3 class="text-center"><b>Acesse no AvalieMyProf</b></h3>
          <hr><hr>
          <img class="profile-img" src="img/img_avatar.png" alt="">
          <form class="form-signin" method="post" action="../controller/ControllerUser.php">
            <input type="text" class="form-control" name="email" placeholder="Email" required autofocus>
            <input type="password" class="form-control" name="senha" placeholder="Password" required>
            <input type="hidden" value="2" name="userOp">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
          </form>
        </div>
        <h5 class="text-center"><b>Não tem uma conta?</b> <a href="create-account.php"> <b>Inscreva-se</b> </a></h5>
      </div>
    </div>
  </div>
  <?php include("helper/footer.php") ?>
</body>

</html>