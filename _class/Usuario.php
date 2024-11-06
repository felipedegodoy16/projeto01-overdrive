<?php 
require_once 'Endereco.php';

class Usuario {
    // Atributos
    private string $nome, $telefone, $cpf, $cnh, $carro, $cargo, $empresa, $senha, $foto, $registro;
    private int $id;
    private Endereco $endereco;

    // Método construtor
    public function __construct(){
        
    }

    // Método para verificar se o usuário já foi cadastrado
    public function verificaDados(){
        try {

            // Query SQL
            $sql = "SELECT * FROM usuarios WHERE cpf = :cpf OR cnh = :cnh;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":cpf", $this->cpf, PDO::PARAM_STR);
            $stmt->bindValue(":cnh", $this->cnh, PDO::PARAM_STR);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dado = $stmt->fetchAll();

            if(count($dado) > 0){
                return 1;
            }

            return -1;

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para inserir usuário no banco
    public function inserirUsuario(){
        try {

            // Query SQL
            $sql = "INSERT INTO usuarios VALUES 
            (DEFAULT, :nome, :cpf, :cnh, :telefone, :carro, :cargo, :empresa, :senha, :foto, :registro, :id_endereco);";

            // Conectando o banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $this->cpf, PDO::PARAM_STR);
            $stmt->bindValue(":cnh", $this->cnh, PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $this->telefone, PDO::PARAM_STR);
            $stmt->bindValue(":carro", $this->carro, PDO::PARAM_STR);
            $stmt->bindValue(":cargo", $this->cargo, PDO::PARAM_STR);
            $stmt->bindValue(":empresa", $this->empresa, PDO::PARAM_STR);
            $stmt->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $stmt->bindValue(":foto", $this->foto, PDO::PARAM_STR);
            $stmt->bindValue(":registro", $this->registro, PDO::PARAM_STR);
            $stmt->bindValue(":id_endereco", $this->endereco->getId(), PDO::PARAM_INT);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));

        } catch(Exception $e) {
            
            echo "Exceção $e";
        
        }
    }

    // Método para fazer login do usuário
    public function verificarAcesso(){
        try {

            // Query
            $sql = "SELECT id_user, nome, cargo, senha FROM usuarios WHERE cpf = :cpf LIMIT 1;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":cpf", $this->getCpf(), PDO::PARAM_STR);

            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $usuario = $stmt->fetchAll();

            foreach($usuario as $u){
                $u['id_user'];
                $u['nome'];
                $u['cargo'];
                $u['senha'];
            }

            if(count($usuario) > 0 && password_verify($this->getSenha(), $u['senha'])){
                session_start();
                $_SESSION['logged'] = True;
                $_SESSION['id'] = $u['id_user'];
                $_SESSION['nome'] = $u['nome'];
                $_SESSION['cargo'] = $u['cargo'];
                header("Location: index.php");
            } else {

                return 0;

            }

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para retornar todos os usuários registrados no banco
    public function listarUsuarios(){
        try {

            // Query
            $sql = "SELECT * FROM usuarios u INNER JOIN enderecos e ON u.id_endereco = e.id_end;";

            // Conectando ao banco
            $stmt = ConexaoDAO::getConexao()->prepare($sql);

            // Executando a query no banco e recebendo os dados
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dados = $stmt->fetchAll();

            if(count($dados) > 0){

                foreach($dados as $d){

                    $users[] = array(
                        'id' => $d['id_user'],
                        'nome' => $d['nome'],
                        'carro' => $d['carro'],
                        'cargo' => $d['cargo'],
                        'empresa' => $d['empresa'],
                        'telefone' => $d['telefone'],
                        'cpf' => $d['cpf'],
                        'cnh' => $d['cnh'],
                        'foto' => $d['foto'],
                        'registro' => $d['registro'],
                        'cep' => $d['cep'],
                        'numero' => $d['numero'],
                        'rua' => $d['rua'],
                        'cidade' => $d['cidade'],
                        'estado' => $d['estado'],
                        'bairro' => $d['bairro']
                    );

                }

                return $users;

            }

            return -1;

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para retornar todos os usuários registrados no banco na ordem que for especificada
    public function listarUsuariosOrdem($campo, $ordem){
        try {

            // Query
            $sql = "SELECT * FROM usuarios u INNER JOIN enderecos e ON u.id_endereco = e.id_end ORDER BY $campo $ordem;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);

            // Executando a query no banco e recebendo os dados
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dados = $stmt->fetchAll();

            if(count($dados) > 0){

                foreach($dados as $d){

                    $users[] = array(
                        'id' => $d['id_user'],
                        'nome' => $d['nome'],
                        'carro' => $d['carro'],
                        'cargo' => $d['cargo'],
                        'empresa' => $d['empresa'],
                        'telefone' => $d['telefone'],
                        'cpf' => $d['cpf'],
                        'cnh' => $d['cnh'],
                        'foto' => $d['foto'],
                        'registro' => $d['registro'],
                        'cep' => $d['cep'],
                        'numero' => $d['numero'],
                        'rua' => $d['rua'],
                        'cidade' => $d['cidade'],
                        'estado' => $d['estado'],
                        'bairro' => $d['bairro']
                    );

                }

                return $users;

            }

            return -1;

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para retornar usuário do banco
    public function retornarUsuario($id) {
        try {
            
            // Query
            $sql = "SELECT * FROM usuarios u INNER JOIN enderecos e ON u.id_endereco = e.id_end WHERE u.id_user = :id;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dados = $stmt->fetchAll();

            if(count($dados) > 0) {
                foreach($dados as $d) {
                    $d['id_user'];
                    $d['nome'];
                    $d['carro'];
                    $d['cargo'];
                    $d['empresa'];
                    $d['telefone'];
                    $d['cpf'];
                    $d['cnh'];
                    $d['cep'];
                    $d['numero'];
                    $d['rua'];
                    $d['cidade'];
                    $d['estado'];
                    $d['bairro'];
                }

                return $dados;

            }

            return -1;

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para alterar dados do usuário no banco
    public function alterarUsuario(){
        try {

            // Query SQL
            $this->getSenha() === '' ? $sql = "UPDATE usuarios SET nome = :nome, cpf = :cpf, cnh = :cnh, telefone = :telefone, carro = :carro, empresa = :empresa, foto = :foto, id_endereco = :id_endereco WHERE id_user = :id;" : $sql = "UPDATE usuarios SET nome = :nome, cpf = :cpf, cnh = :cnh, telefone = :telefone, carro = :carro, empresa = :empresa, senha = :senha, foto = :foto, id_endereco = :id_endereco WHERE id_user = :id;";

            // Conectando o banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindValue(":cpf", $this->cpf, PDO::PARAM_STR);
            $stmt->bindValue(":cnh", $this->cnh, PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $this->telefone, PDO::PARAM_STR);
            $stmt->bindValue(":carro", $this->carro, PDO::PARAM_STR);
            $stmt->bindValue(":empresa", $this->empresa, PDO::PARAM_STR);
            $this->getSenha() === '' ? : $stmt->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $stmt->bindValue(":foto", $this->foto, PDO::PARAM_STR);
            $stmt->bindValue(":id_endereco", $this->endereco->getId(), PDO::PARAM_INT);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));

        } catch(Exception $e) {
            
            echo "Exceção $e";
        
        }
    }

    // Método para remover usuário do banco
    public function removerUsuario($id){
        try {
            
            // Query
            $sql = "DELETE FROM usuarios WHERE id_user = :id LIMIT 1;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Getters e Setters
    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getCpf(){
        return $this->cpf;
    }

    public function getCnh(){
        return $this->cnh;
    }    

    public function getTelefone(){
        return $this->telefone;
    }

    public function getCarro(){
        return $this->carro;
    }

    public function getCargo(){
        return $this->cargo;
    }

    public function getSenha(){
        return $this->senha;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function getEmpresa(){
        return $this->empresa;
    }

    public function getFoto(){
        return $this->foto;
    }

    public function getRegistro(){
        return $this->registro;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setCpf($cpf){
        $this->cpf = $cpf;
    }

    public function setCnh($cnh){
        $this->cnh = $cnh;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function setCarro($carro){
        $this->carro = $carro;
    }

    public function setCargo($cargo){
        $this->cargo = $cargo;
    }

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function setRegistro($registro){
        $this->registro = $registro;
    }
}