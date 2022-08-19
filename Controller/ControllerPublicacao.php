<?php
session_start();
require_once("../model/publicacao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "postOp") == 1) { //insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - Post
        $titulo = filter_input(INPUT_POST, "txt_titulo");
        $descricao = filter_input(INPUT_POST, "txtBody");
        $userId = $_SESSION['idUser'];
        $nome_prof = filter_input(INPUT_POST, "txt_nome_prof");
        $ministrou_disciplina = filter_input(INPUT_POST, "txt_ministrou");
        $email_prof = filter_input(INPUT_POST, "txt_email_prof");



        // criando um novo obj do tipo post
        $post = new publicacao();
        //pt-br inserindo valores do formulário para o obj post
        $post->set_titulo($titulo);
        $post->setDescricao($descricao);
        $post->setUserId($userId);
        $post->setnome_prof($nome_prof);
        $post->set_ministrou_disciplina($ministrou_disciplina);
        $post->setemail_prof($email_prof);
        //$post->setCategoryId($categoryId);
        //classe do tipo Date para formatar data e hora que serão enviados para o banco
        $data = new DateTime();
        // setando o horário de são paulo
        $data->setTimezone(new DateTimeZone('America/Sao_Paulo'));
        // formatando a data
        $dt = $data->format('Y-m-d H:i:s');

        // chamando a função insert do post que retorna true or false, passando seus devidos parametros
        if ($post->insert($post->getnome_prof(), $post->getemail_prof(), $dt, $post->get_titulo(), $post->getdescricao(), $post->get_ministrou_disciplina(),  0, $post->getUserId()) == true) {
            echo "<script type='text/javascript'>alert('Post saved successfully!');window.location.href = '../view/avaliacao.php';</script>";
        } else echo "<script type='text/javascript'>alert('Something went wrong, try again');window.location.href = '../view/new-avaliacao.php';</script>";
    } else if (filter_input(INPUT_POST, "postOp") == 2) { //Se o postOp for igual a 2 então o usuário acabou de dar like em um post
        $idPublicacao = filter_input(INPUT_POST, "idPublicacao");    //pegando o id do post
        $post = new publicacao($idPublicacao);                      // instânciando um obj do tipo post e passando o id do post
        echo $post->likepublicacao();                        // se der certo então retorna a quantidade de likes, se não false

    } else if (filter_input(INPUT_POST, "postOp") == 3) {    // Se o postOp for igual a 3 então o usuário deseja deletar
        echo $idPublicacao = filter_input(INPUT_POST, "idPublicacao");       // pegando o id do post

        //para excluir um post preciso excluir os comentarios antes
        $post = new Publicacao();             //instanciando um obj do tipo post
        $comentario = new Comentario();       //instanciando um obj do tipo Comentário

        //Contando comentarios na publicação que desejo excluir e verifico se tem comentários
        if ($comentario->deletecomentario($idPublicacao) == true) {      // se entrou no if então tenho comentários, deleto os comentários passando o id do post
            if (!empty($idPublicacao)) {
                if ($post->deletePublicacao($idPublicacao) > 0) {       // depois de deletar os comentários então agora eu consigo excluir o post
                    echo "<script type='text/javascript'>alert('Publicação deletada com sucesso!');window.location.href = '../view/avaliacao.php';</script>";
                } else echo "<script type='text/javascript'>alert('Publicação ID não encontrada, tente novamente');window.location.href = '../view/publica-avaliacao.php';</script>";
            } else echo "<script type='text/javascript'>alert('Insira um ID para deletar publicação, tente novamente');window.location.href = '../view/publica-avaliacao.php';</script>";
        } else { //se o post não tem comentarios então excluo normalmente passando o id
            if ($post->deletepublicacao($idPublicacao) > 0) {
                echo "<script type='text/javascript'>alert('Publicação deletada com sucesso!');window.location.href = '../view/avaliacao.php';</script>";
            } else echo "<script type='text/javascript'>alert('Publicação ID não encontrada, tente novamente');window.location.href = '../view/publica-avaliacao.php';</script>";
        }
    }
}
