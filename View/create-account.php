<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php include("helper/head.php");
    session_start();
    require_once("../model/user.php"); ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <?php include("helper/navbar-login.php") ?>
    <div class="container panel panel-default" style=" margin-top: 70px;">
        <div class="panel-body">
            <div class="text-center">
                <h2>Crie uma conta</h2>
                <hr style="height:1px;background-color:gray">
            </div>
            <form action="../controller/ControllerUser.php" method="post" id="form">

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Nome</label>
                        <input required type="text" class="form-control" name="txt_nome" placeholder="Primeiro e último nome">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Data de nascimento</label>
                        <input required type="date" class="form-control" name="txt_data">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Selecione o tipo de usuário</label>
                        
                        <select required name="txt_tipo" class="form-control">
                            <option value="D">Default User</option>
                            <option value="P">Professor</option>
                            <option value="A">Aluno</option>
                        </select>
                        <small class="text-muted">

                        </small>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Email Institucional</label>
                        <input required type="email" class="form-control" name="txt_email" id="inputEmail" placeholder="name@example.com">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirme seu Email</label>
                        <input required type="email" class="form-control" name="txt_emailC" id="inputEmailC" placeholder="name@example.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Senha</label>
                        <input required type="password" class="form-control" name="txt_senha" id="inputsenha">
                        <small id="passwordHelpInline" class="text-muted">
                            Entre 8-20 characters.
                        </small>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirme sua senha</label>
                        <input required type="password" class="form-control" name="txt_senhaC" id="inputsenhaC">
                        <small id="passwordHelpInline" class="text-muted">
                        Entre 8-20 characters.
                        </small>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <h3 class="text-center">Insira a sua universidade e curso</h3>
                        <hr>
                        <div class="form-group col-md-4">
                            <label>Universidade</label>
                            <input type="text" class="form-control" name="txt_faculdade" placeholder="Nome da universidade">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Curso</label>
                            <input type="text" class="form-control" name="txt_curso" placeholder="Nome do curso">
                        </div>
                    </div>


                <div class="form-row">
                    <div class="form-group col-md-offset-5 ">
                        <input type="hidden" value="1" name="userOp">
                        <button class="btn btn-md btn-primary" type="submit">Criar Conta</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php include("helper/footer.php") ?>
    <!--<script src="js/validateEmail-Password.js"></script>
    <script type="text/javascript">
        $(function(){
            $("#submit").click(function(event){
                event.preventDefault();
                if(validatePassword() == true && validateEmail() == true){
                    $("form").submit();
                }
            });
        });
        function validatePassword() {
            let pass = document.getElementById("InputPassword").value;
            let passC = document.getElementById("InputPasswordC").value;
            if ( pass == passC) {
                input.setCustomValidity('');
                return true;
            } else {
                input.setCustomValidity('Password are not the sam, please try again!');
                return false;
                
            }
        }
        function validateEmail() {
            if (document.getElementById("InputEmailC").value == document.getElementById("InputEmail").value) {
                input.setCustomValidity('');
                return true;
            } else {
                input.setCustomValidity('Emails are not the sam, please try again!');
                return false;
                
            }
        }
    </script>!-->
</body>

</html>