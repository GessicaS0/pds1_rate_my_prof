<?php
session_start();

require_once("../model/user.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "userOp") == 1) { //insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - User

        $nome = filter_input(INPUT_POST, "txt_nome", FILTER_SANITIZE_STRING);
        $idade = filter_input(INPUT_POST, "txt_data");
        $tipo_user = filter_input(INPUT_POST, "txt_tipo");
        $email = filter_input(INPUT_POST, "txt_emailC", FILTER_SANITIZE_EMAIL);
        $sh = filter_input(INPUT_POST, "txt_senhaC");
        $faculdade = filter_input(INPUT_POST, "txt_faculdade");
        $curso = filter_input(INPUT_POST, "txt_curso");

        if (
            isset($nome) && isset($idade) && isset($tipo_user)
            && isset($email) && isset($sh) && isset($faculdade) && isset($curso)
        ) {

            $user = new User();
            $user->set_nome($nome);
            $user->set_email($email);
            $user->set_senha($sh);
            $user->set_tipo_user($tipo_user);
            $user->set_idade($idade);
            $user->set_faculdade($faculdade);
            $user->set_curso($curso);

            if ($user->insert_user($user->get_nome(), $user->get_email(), $user->get_senha(), $user->get_tipo_user(), $user->get_idade(), $user->get_faculdade(), $user->get_curso())  == true) {
                echo "<script type='text/javascript'>alert('Conta criada com sucesso!')
                        ;window.location.href = '../view/login.php';</script>";
            } else {
                echo "<script type='text/javascript'>alert('Erro ao cadastrar, tente novamente');window.location.href = '../view/create-account.php';</script>";
            }
        }
    } else if (filter_input(INPUT_POST, "userOp") == 2) { //login
        $email = filter_input(INPUT_POST, "email");     // pegando email
        $sh = filter_input(INPUT_POST, "senha");    // pegando senha 
        $user_login = new User();       //instanciando um obj do tipo user
        $date = new DateTime();         // instanciando um obj do tipo data
        $date->setTimezone(new DateTimeZone('America/Sao_Paulo'));      /// setando o horário da região sp
        //$last_a = $date->format('Y-m-d H:i:s');

        $value = $user_login->select_user($email, $sh); // recebo de user um obj e salvo em value

        //eu verifico se meu value é diferente de falso - se falso user não existe no banco
        if ($value != false) {
            //pt-br pegando o as variavel do obj user e setando elas nas variaveis de sessão
            $_SESSION['idUser'] = $value['idUser'];
            $_SESSION['nomeUser'] = $value['nome'];
            $_SESSION['emailUser'] = $value['email'];
            $_SESSION['senhaUser'] = $value['senha'];
            $_SESSION['tipo'] = $value['tipo_user'];
            $_SESSION['idade_user'] = $value['idade'];
            $_SESSION['idfaculdade'] = $value['faculdade'];
            $_SESSION['idcurso'] = $value['curso'];



            echo "<script type='text/javascript'>alert('Login com sucesso');window.location.href = '../view/home.php';</script>";
        } else echo "<script type='text/javascript'>alert('Acesso negado, tente novamente ou crie uma conta');window.location.href = '../view/login.php';</script>";
    } else if (filter_input(INPUT_POST, "userOp") == 3) { //deletar usuario
        echo $idUser = filter_input(INPUT_POST, "idUser");
        $user = new User();                         //instanciando um obj do tipo user

        if (!empty($idUser)) {
            if ($user->delete($idUser) > 0) {
                echo "<script type='text/javascript'>alert('Usuário deletado com sucesso');window.location.href = '../view/adminUser.php';</script>";
            } else echo "<script type='text/javascript'>alert('Usuário ID não encontrado, tente novamente');window.location.href = '../view/adminUser.php';</script>";
        } else echo "<script type='text/javascript'>alert('Insira um ID para deletar usuário, tente novamente');window.location.href = '../view/adminUser.php';</script>";
    }
}
