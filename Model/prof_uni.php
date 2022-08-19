<?php
require_once("banco.php");

//criando classe pontos de acesso
class prof_uni
{
    //pt-br criando os atributos privados
    //en-us creating the private atributes
    private $nome_prof;
    private $nome_uni;
    private $idProf_Uni;
    private $endereco;
    private $conexao;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        //en-us creating the object to connect to the bank
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set
    // en-us assigning values ​​with set
    public function set_nome_prof($nome_prof)
    {
        $this->nome_prof = $nome_prof;
    }

    public function set_nome_uni($nome_uni)
    {
        $this->nome_uni = $nome_uni;
    }

    public function set_idProf_Uni($idProf_Uni)
    {
        $this->idProf_Uni = $idProf_Uni;
    }
    public function set_endereco($endereco)
    {
        $this->endereco = $endereco;
    }

    //pt-br pegando os dados com get
    //en-us getting the data with get
    public function get_nome_prof()
    {
        return  $this->nome_prof;
    }
    public function get_nome_uni()
    {
        return  $this->nome_uni;
    }
    public function get_idProf_Uni()
    {
        return  $this->idProf_Uni;
    }
    public function get_endereco()
    {
        return  $this->endereco;
    }
    //CRUD
    //pt-br criando a função de inserir um novo ponto de acesso
    //en-us creating the function to insert a new access point
    public function insertPoint($nome_prof, $nome_uni, $endereco)
    {
        $sql = 'INSERT INTO PROF_UNI (nome_prof, nome_uni, endereco) VALUES (?, ?, ?);';

        $prepare = $this->conexao->prepare($sql);   //pt-br prepara uma instrução para execução e retorna um obj de instrução | en-us prepares an instruction for execution and returns an instruction obj

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $nome_prof);
        $prepare->bindParam(2, $nome_uni);
        $prepare->bindParam(3, $endereco);

        if ($prepare->execute() == TRUE) { //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }
    //pt-br criando a função de listar os pontos de acesso 
    //en-us creating the function to list the hotspots
    public function listPoint()
    {
        //pt-br comando select do banco de dados buscando os atributos no banco
        //en-us database select command fetching the attributes in the database
        $sql = 'SELECT idProf_Uni, nome_prof, nome_uni, endereco FROM PROF_UNI;';

        //pt-br declarando um array que vai ser preenchido e retornado
        //en-us declaring an array that will be filled and returned
        $p = [];

        foreach ($this->conexao->query($sql) as $value) {  //pt-br pegando a lista de obj do ponto de acesso e inserindo no array point | en-us taking the access point's obj list and inserting it into the point array
            array_push($p, $value);
        }
        return $p;
    }

    public function delete($idPoint)
    {

        //para excluir um accessPoint antes preciso excluir os comentarios
        $sql = 'delete from prof_uni where idProf_Uni = ?';

        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $idPoint);

        if ($prepare->execute() == TRUE) {
            $count = $prepare->rowCount();
            return $count;
        } else {
            return false;
        }
    }
}