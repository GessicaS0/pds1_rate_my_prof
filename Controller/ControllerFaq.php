<?php
session_start();
require_once("../model/faq.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $desc = filter_input(INPUT_POST, "faq_desc");
    $userId = $_SESSION['idUser'];


    //pt-br relacionando as váriaveis input do formulário com as váriaveis do php - Location
    $nome_faq = filter_input(INPUT_POST, "txt_nome_faq", FILTER_SANITIZE_STRING);
    $email_faq = filter_input(INPUT_POST, "txt_email_faq", FILTER_SANITIZE_STRING);
    
    if ($desc != "") {
        $faq = new FAQ();
        
        $faq->insert($desc, $nome_faq, $email_faq , $userId);
            
        echo "<script type='text/javascript'>alert('Sugestão enviada com sucesso!');window.location.href = '../view/home.php';</script>";

    }else echo "<script type='text/javascript'>alert('Sugestão não enviada ou erro de usuário');window.location.href = '../view/home.php';</script>";
}
