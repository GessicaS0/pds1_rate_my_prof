<?php
session_start();
require_once("../model/prof_uni.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (filter_input(INPUT_POST, "pointOp") == 1) { // pt-br se pontop for igual a 2 então é delete e 1 é insert

        //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - prof_uni
        $nome_prof = filter_input(INPUT_POST, "txtnome_prof");
        $nome_uni = filter_input(INPUT_POST, "txtnome_uni");
        $endereco = filter_input(INPUT_POST, "txt_endereco");
        /// crio um novo obj prof_uni
        $prof_uni = new prof_uni();

        //chamo a função de inserir prof_uni e passo os devidos parametros
        if ($prof_uni->insertPoint($nome_prof, $nome_uni, $endereco) == true) {

            echo "<script type='text/javascript'>alert('Professor e Universidade inseridos com sucesso!');window.location.href = '../view/home.php';</script>";
        }
        echo "<script type='text/javascript'>alert('Erro ao inserir Professor e Universidade, tente novamente!');window.location.href = '../view/home.php';</script>";
    } else if (filter_input(INPUT_POST, "pointOp") == 2) { //deletar prof_uni
        echo $idpub = filter_input(INPUT_POST, "idpub");       // pegando o id do prof_uni

        //para excluir um prof_uni preciso excluir a localização antes
        $prof_uni = new prof_uni();       //instanciando um obj do prof_uni

        if (!empty($idpub)) {
            if ($prof_uni->delete($idpub) > 0) {
                echo "<script type='text/javascript'>alert('Professor/Universidade deletado com sucesso!');window.location.href = '../view/home.php';</script>";
            } else echo "<script type='text/javascript'>alert('Usuário ID não encontrado, tente novamente');window.location.href = '../view/home.php';</script>";
        } else echo "<script type='text/javascript'>alert('Insira um ID para deletar Professor e Universidade, tente novamente');window.location.href = '../view/home.php';</script>";
    }
}
