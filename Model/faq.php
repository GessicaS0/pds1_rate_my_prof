<?php
require_once("banco.php");

Class FAQ {
    
    private $conexao;
    private $descricao;
    private $nome;
    private $email;
    private $userId;


    public function __construct()
    {
        //criando o objeto para conexão com o banco
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    //set
    public function set_descricao($descricao){
        $this->descricao = $descricao;
    }

    public function set_nome_faq($nome)
    {
        $this->nome = $nome;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function set_email_faq($email)
    {
        $this->email = $email;
    }

    //get
    public function getdescricao(){
        return $this->descricao;
    }

    public function getNomeFaq()
    {
        return $this->nome;
    }

    public function getEmailFaq()
    {
        return $this->email;
    }

    public function getUserId(){
        return $this->userId;
    }

    //Insert
    public function insert($descricao , $nome , $email , $userId){
        $sql = 'INSERT INTO FAQ (descricao, nome , email , user_idUser) VALUES (?,?,?,?)';
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $descricao);
        $prepare->bindParam(2, $nome);
        $prepare->bindParam(3, $email);
        $prepare->bindParam(4, $userId);
       
        if ($prepare->execute() == true) {
            return true;
        } else {
            return false;
        }
    }

    public function list()
    {
        //comando select do banco de dados buscando os atributos no banco
         $sql = 'SELECT f.idFAQ, f.descricao, f.nome , f.email , f.User_idUser from FAQ f ';

         // declarando um array que vai ser preenchido e retornado
        $faq = [];

         foreach ($this->conexao->query($sql) as $value) {  //pegando a lista de obj do suggestion e inserindo
             array_push($faq, $value);
         }
         return $faq;
    }
    
}
?>