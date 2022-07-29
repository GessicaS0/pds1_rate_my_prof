<?php
require_once("banco.php");
class User
{
    ///pt-br criando os atributos privados
    /// en-us creating the private atributes
    private $nome;
    private $email;
    private $senha;
    private $tipo_user;
    private $idade;
    private $faculdade;
    private $curso;
    private $conexao;

    public function __construct()
    {
        //pt-br criando o objeto para conexão com o banco
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    // pt-br atribuindo os valores com set

    public function set_nome($nome)
    {
        $this->nome = $nome;
    }

    public function set_email($email)
    {
        $this->email = $email;
    }

    public function set_senha($senha)
    {
        $this->senha = $senha;
    }

    public function set_tipo_user($tipo_user)
    {
        $this->tipo_user = $tipo_user;
    }

    public function set_idade($idade)
    {
        $this->idade = $idade;
    }

    public function set_faculdade($faculdade)
    {
        $this->faculdade = $faculdade;
    }

    public function set_curso($curso)
    {
        $this->curso = $curso;
    }


    //pt-br pegando os dados com get
    public function get_nome()
    {
        return $this->nome;
    }

    public function get_email()
    {
        return $this->email;
    }

    public function get_senha()
    {
        return $this->senha;
    }

    public function get_tipo_user()
    {
        return $this->tipo_user;
    }

    public function get_idade()
    {
        return $this->idade;
    }

    public function get_faculdade()
    {
        return $this->faculdade;
    }

    public function get_curso()
    {
        return $this->curso;
    }

    //CRUD
    //Função de inserir usuário
    public function insert_user($nome, $email,  $senha, $tipo_user , $idade, $faculdade , $curso)
    {

        $sql = 'INSERT INTO user (nome , email , senha , tipo_user , idade , faculdade , curso) VALUES (?,?,?,?,?,?,?)';
        $prepare = $this->conexao->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable nome
        $prepare->bindParam(1, $nome);
        $prepare->bindParam(2, $email);
        $prepare->bindParam(3, $senha);
        $prepare->bindParam(4, $tipo_user);
        $prepare->bindParam(5, $idade);
        $prepare->bindParam(6, $faculdade);
        $prepare->bindParam(7, $curso);
       


        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //Função usava para fazer o login
    public function select_user($email, $sh)
    {   
        //pt-br Ela verifica se o usuário e senha existem no bd
        $stmt = $this->conexao->prepare("SELECT * from user where email = ? and senha = ?");
        $stmt->execute([$email, $sh]); 
        $user = $stmt->fetch();

        return $user;
    }

    public function listUsers()
    {
        //pt-br comando select do banco de dados buscando os atributos no banco
        //en-us database select command fetching the attributes in the database
        $sql = 'select * from user;';

        //pt-br declarando um array que vai ser preenchido e retornado
        //en-us declaring an array that will be filled and returned
        $user = [];

        foreach ($this->conexao->query($sql) as $value) {  //pt-br pegando a lista de obj do user e inserindo no user | en-us taking the user obj list and inserting it into the user array
            array_push($user, $value);
        }
        return $user;
    }

    public function delete($idUser){
         //para excluir um user antes preciso excluir os comentarios
         $sql = 'delete from user where idUser = ?';

         $prepare = $this->conexao->prepare($sql);
 
         $prepare->bindParam(1, $idUser);
 
         if ($prepare->execute() == TRUE) {
             return true;
         } else {
             return false;
         }
    }
}
