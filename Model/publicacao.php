<?php
//metodos de envio para o banco com PDO
require_once("banco.php");



class publicacao  
{
    //pt-br iniciando a variavel de likes em 0
    public $likes = 0;

    //pt-br criando os atributos privados
    private $titulo;
    private $descricao;
    private $userId;
    private $nome_prof;
    private $ministrou_disciplina;
    private $email_prof;
    private $idPublicacao;
    private $conexao;

    public function __construct($idPublicacao = null)
    {
        //pt-br após instanciar os atributos, crio um obj PDO para conexão com banco 
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    
        if ($idPublicacao != null) { //pt-br se instaciar a classe com idPublicacao set as variaveis | en-us 
            $sql = "Select * from publicacao where idPublicacao = $idPublicacao";

            foreach ($this->conexao->query($sql) as $value) {
                
                //pt-br pegando os dados no formulário e seto no obj publicacao
                $this->titulo = $value['titulo'];
                $this->descricao = $value['descricao'];
                $this->userId = $value['User_idUser'];
                $this->nome_prof = $value['nome_prof'];
                $this->ministrou_disciplina = $value['ministrou_disciplina'];
                $this->email_prof = $value['email_prof'];
                $this->idPublicacao = $value['idPublicacao'];
                $this->likes = $value['likes'];
            }
        }
    }
    //pt-br Função que incrmenta o like
    public function likepublicacao()
    {
        //pt-br se existir um publicacao
        if ($this->idPublicacao != null) {

            //pt-br atualizando o valor do like
            $sql = 'UPDATE publicacao SET likes = ? WHERE idPublicacao = ?';
            $prepare = $this->conexao->prepare($sql);

            //pt-br fazendo um like +1 e salvando no obj publicacao
            $this->likes = $this->likes + 1;

            $prepare->bindParam(1, $this->likes);
            $prepare->bindParam(2, $this->idPublicacao);

            
            //pt-br executando o sql no banco e salvando
            //
            if ($prepare->execute() == true) {
                return $this->likes; //se der certo então retorno a quantidade de like
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // pt-br atribuindo os valores com set

    public function set_titulo($titulo)
    {
        $this->titulo = $titulo;
    }
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }
    public function setnome_prof($nome_prof)
    {
        $this->nome_prof = $nome_prof;
    }
    public function set_ministrou_disciplina($ministrou_disciplina)
    {
        $this->ministrou_disciplina = $ministrou_disciplina;
    }
    public function setemail_prof($email_prof)
    {
        $this->email_prof = $email_prof;
    }

   
    //pt-br pegando os dados com get
    public function get_titulo()
    {
        return $this->titulo;
    }
    public function getnome_prof()
    {
        return $this->nome_prof;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function getpublicacaoId(): int
    {
        return $this->idPublicacao;
    }
    public function getdescricao()
    {
        return $this->descricao;
    }
    public function get_ministrou_disciplina()
    {
        return $this->ministrou_disciplina;
    }
    public function getemail_prof()
    {
        return $this->email_prof;
    }


    //pt-br criando a função de inserir 
    //en-us creating the insert function
    public function insert(string $nome_prof, string $email_prof, string $data, string $titulo, string $descricao, string $ministrou_disciplina, int $likes, int $idUser): int
    {
        $sql = 'INSERT INTO publicacao (nome_prof, email_prof, data, titulo, descricao, ministrou_disciplina ,likes, user_idUser) VALUES (?,?,?,?,?,?,?,?)'; 
        $prepare = $this->conexao->prepare($sql);//pt-br prepara uma instrução para execução e retorna um obj de instrução

        //pt-br vincula um parametro ao nome da variavel especificada
        $prepare->bindParam(1, $nome_prof);
        $prepare->bindParam(2, $email_prof);
        $prepare->bindParam(3, $data);
        $prepare->bindParam(4, $titulo);
        $prepare->bindParam(5, $descricao);
        $prepare->bindParam(6, $ministrou_disciplina);
        $prepare->bindParam(7, $likes);
        $prepare->bindParam(8, $idUser);
    

        if ($prepare->execute() == TRUE) {   //pt-br se executar então retorna true
            return true;
        } else {
            return false;
        }
    }

    //pt-br criando a função listar publicacao
    //en-us
    public function list($limit, $offset): array
    {
        //pt-br selecionando o publicacao e ordenando de forma decrescente, utilizo o limite para controlar a quantidade de publicacao e offset indica o inicio da leitura
        $sql = "select * from publicacao order by data desc limit $limit offset $offset ";


        $publicacaos = [];

        foreach ($this->conexao->query($sql) as $key => $value) {
            array_push($publicacaos, $value);
        }

        return $publicacaos;
    }

    //pt-br criando a função que lista os publicacaos mais curtidos
    public function listPopular()
    {
        $sql = "select idPublicacao, titulo, likes from publicacao order by likes desc limit 5; ";

        $publicacaos = [];

        foreach ($this->conexao->query($sql) as $key => $value) {
            array_push($publicacaos, $value);
        }

        return $publicacaos;
    }

    //pt-br criando a função que lista todos os publicacaos
    //en-us 
    public function listAllpublicacao()
    {
        //pt-brselecionando todos os publicacaos da tabela
        $sql = "SELECT p.idPublicacao, p.titulo, p.descricao, p.data, p.likes,p.nome_prof, p.email_prof,p.ministrou_disciplina, u.nome FROM publicacao p, user u WHERE p.user_idUser = u.idUser";

        $publicacaos = [];

        //pt-br conexão->query pega a lista de obj de publicacao e passando para o arry publicacaos
        //en-us 
        foreach ($this->conexao->query($sql) as $key => $value) { 
            array_push($publicacaos, $value);
        }

        return $publicacaos;
    }

    //pt-br criando a função que lista somente um publicacao
    public function listOnepublicacao($idPublicacao)
    {
        $sql = "select * from publicacao where idPublicacao = ? ";

        $stmt = $this->conexao->prepare($sql);
        $stmt->execute([$idPublicacao]);
        $publicacao = $stmt->fetch();

        return $publicacao;
    }

    //pt-br criando a função que conta 
    //en-us 
    public function countpublicacaos()
    {
        $sql = "SELECT COUNT(*) FROM Publicacao ";

        $prepare = $this->conexao->query($sql);
        return $prepare->fetchColumn();
    }

    //pt-br criando função update
    public function update(string $titulo, string $descricao, string $data, int $idPublicacao): int
    {
        $sql = 'UPDATE publicacao SET titulo = ?, descricao = ?, data = ?, nome_prof = ?, WHERE idPublicacao = ?';
        $prepare = $this->conexao->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        //en-us binds a parameter to the specified variable name
        $prepare->bindParam(1, $titulo);
        $prepare->bindParam(2, $descricao);
        $prepare->bindParam(3, $data);
        $prepare->bindParam(5, $idPublicacao);

        if ($prepare->execute() == TRUE) {  //pt-br se executar então retorna true | en-us if run then return true
            return true;
        } else {
            return false;
        }
    }

    //pt-br criando a função que deleta o publicacao  
    public function deletepublicacao($idPublicacao)
    {
        //pt-br para excluir um publicacao antes preciso excluir os comentarios
        $sql = 'delete from publicacao where idPublicacao = ?';

        //pt-br recebe o id, faz a conexão, prepara o sql e retorna true se der certo
        $prepare = $this->conexao->prepare($sql);
        $prepare->bindParam(1, $idPublicacao);
        if ($prepare->execute() == TRUE) {
            $count = $prepare->rowCount();
            return $count;
        } else {
            return false;
        }
    }
}

//pt-br criando a classe comentário
Class comentario{

    //pt-br criando os atributos privados
    private $conexao;
    private $descricao;
    private $like;
    private $data;
    private $tag;
    private $publicacaoId;
    private $userId;

    //pt-br o construtor instancia a conexão com o banco e retorna
    public function __construct()
    {
        $banco = new Banco();
        $this->conexao = $banco->getConnection();
    }

    //pt-br criando o insert do comentário 
    public function insert($descricao, $data, $tag, $publicacaoId, $userId)
    {
        $sql = 'INSERT into comentario (descricao, data, tag, publicacao_idPublicacao, user_idUser) values (?,?,?,?,?)';
        //pt-br isntancio a conexão e mando ela preparar o insert
        $prepare = $this->conexao->prepare($sql);

        //pt-br vincula um parametro ao nome da variavel especificada
        $prepare->bindParam(1, $descricao);
        $prepare->bindParam(2, $data);
        $prepare->bindParam(3, $tag);
        $prepare->bindParam(4, $publicacaoId);
        $prepare->bindParam(5, $userId);

        if ($prepare->execute() == TRUE) {
            return true;
        } else {
            return false;
        }
    }

    //pt-br criando listar os comentários 
    //en-us 
    public function list($publicacaoId){
        $sql = "Select c.descricao, c.curtida, c.data, c.tag, c.publicacao_idPublicacao, u.nome from Comentario c, User u where c.user_idUser = u.idUser  and c.publicacao_idPublicacao = $publicacaoId";
        $comentario = [];

        foreach ($this->conexao->query($sql) as $value) {
            array_push($comentario, $value);
        }
        return $comentario;
    }

    //pt-br função que conta os comentários 
    public function countcomentario($publicacaoId)
    {
        $sql = "SELECT COUNT(*) FROM Comentario where publicacao_idPublicacao = $publicacaoId";

        $prepare = $this->conexao->query($sql);
        return $prepare->fetchColumn();
    }

    //pt-br função que deleta o comentário 
    public function deletecomentario($publicacaoId)
    {
        //pt-br para excluir um publicacao antes preciso excluir os comentarios
        $sql = "delete from comentario Where publicacao_idPublicacao = ?"; 
        
        $prepare = $this->conexao->prepare($sql);

        $prepare->bindParam(1, $publicacaoId);
        
        if ($prepare->execute() == TRUE) {
            $count = $prepare->rowCount();
            return $count;
        } else {
            return false;
        }
    }
}
