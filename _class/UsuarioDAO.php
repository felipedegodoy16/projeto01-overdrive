<?php 
    require_once 'Usuario.php';

    class UsuarioDAO {
        // Atributo
        private Usuario $usuario;

        // Construtor da classe
        public function __construct($usuario) {
            $this->usuario = $usuario;
        }

        // Método para verificar se o usuário já foi cadastrado
        public function verificaDados(){
            try {

                // Query SQL
                $sql = "SELECT * FROM usuarios WHERE cpf = :cpf OR cnh = :cnh;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":cpf", $this->getUsuario()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":cnh", $this->getUsuario()->getCnh(), PDO::PARAM_STR);

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
                (DEFAULT, :nome, :cpf, :cnh, :telefone, :carro, :cargo, :id_empresa, :senha, :foto, :registro, :id_endereco);";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":nome", $this->getUsuario()->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $this->getUsuario()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":cnh", $this->getUsuario()->getCnh(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $this->getUsuario()->getTelefone(), PDO::PARAM_STR);
                $stmt->bindValue(":carro", $this->getUsuario()->getCarro(), PDO::PARAM_STR);
                $stmt->bindValue(":cargo", $this->getUsuario()->getCargo(), PDO::PARAM_STR);
                $stmt->bindValue(":id_empresa", $this->getUsuario()->getEmpresa()->getId(), PDO::PARAM_INT);
                $stmt->bindValue(":senha", $this->getUsuario()->getSenha(), PDO::PARAM_STR);
                $stmt->bindValue(":foto", $this->getUsuario()->getFoto(), PDO::PARAM_STR);
                $stmt->bindValue(":registro", $this->getUsuario()->getRegistro(), PDO::PARAM_STR);
                $stmt->bindValue(":id_endereco", $this->getUsuario()->getEndereco()->getId(), PDO::PARAM_INT);

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
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":cpf", $this->getUsuario()->getCpf(), PDO::PARAM_STR);

                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                foreach($dados as $d){
                    $d['id_user'];
                    $d['nome'];
                    $d['cargo'];
                    $d['senha'];
                }

                if(count($dados) > 0 && password_verify($this->getUsuario()->getSenha(), $d['senha'])){

                    session_start();
                    $_SESSION['logged'] = True;
                    $_SESSION['id'] = $d['id_user'];
                    $_SESSION['nome'] = $d['nome'];
                    $_SESSION['cargo'] = $d['cargo'];
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
                $sql = "SELECT u.id_user, u.nome, u.carro, u.cargo, u.telefone, u.cpf, u.cnh, u.foto, u.registro, e.cep, e.numero, e.rua, e.cidade, e.estado, e.bairro, emp.fantasia FROM usuarios u INNER JOIN enderecos e ON u.id_endereco = e.id_end INNER JOIN empresas emp ON u.id_empresa = emp.id_emp ORDER BY u.id_user;";

                // Conectando ao banco
                $stmt = ConnectionFactory::getConexao()->prepare($sql);

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
                            'empresa' => $d['fantasia'],
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
                $sql = "SELECT u.id_user, u.nome, u.carro, u.cargo, u.telefone, u.cpf, u.cnh, u.foto, u.registro, e.cep, e.numero, e.rua, e.cidade, e.estado, e.bairro, emp.fantasia FROM usuarios u INNER JOIN enderecos e ON u.id_endereco = e.id_end INNER JOIN empresas emp ON u.id_empresa = emp.id_emp ORDER BY u.$campo $ordem;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);

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
                            'empresa' => $d['fantasia'],
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

        // Método para verificar se o usuário já foi cadastrado
        public function verificaEdicao(){
            try {

                // Query SQL
                $sql = "SELECT * FROM usuarios WHERE (cpf = :cpf OR cnh = :cnh) AND id_user != :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":cpf", $this->getUsuario()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":cnh", $this->getUsuario()->getCnh(), PDO::PARAM_STR);
                $stmt->bindValue(":id", $this->getUsuario()->getId(), PDO::PARAM_INT);

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

        // Método para verificar se algum dado foi alterado
        public function verificaDadoAlterado() {
            try {

                $message = [];

                // Query
                $sql = "SELECT * FROM usuarios
                WHERE id_user = :idUser AND nome = :nome
                AND cpf = :cpf AND cnh = :cnh
                AND telefone = :telefone AND carro = :carro
                AND id_empresa = :idEmp AND id_endereco = :idEnd LIMIT 1;";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":idUser", $this->getUsuario()->getId(), PDO::PARAM_INT);
                $stmt->bindValue(":nome", $this->getUsuario()->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $this->getUsuario()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":cnh", $this->getUsuario()->getCnh(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $this->getUsuario()->getTelefone(), PDO::PARAM_STR);
                $stmt->bindValue(":carro", $this->getUsuario()->getCarro(), PDO::PARAM_STR);
                $stmt->bindValue(":idEmp", $this->getUsuario()->getEmpresa()->getId(), PDO::PARAM_INT);
                $stmt->bindValue(":idEnd", $this->getUsuario()->getEndereco()->getId(), PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                if(count($dados) > 0) {
                    $message = [
                        'message' => 'Nenhum dado foi alterado!',
                        'class' => 'status_error'
                    ];
                }

                return $message;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para alterar dados do usuário no banco
        public function alterarUsuario($foto){
            try {

                $stmtFoto = 0;

                $this->getUsuario()->getSenha() === '' ? $alterSenha = '' : $alterSenha = 'senha = :senha,';

                if(($this->getUsuario()->getFoto() !== '' && $foto === 0) || ($foto === 1)) {
                    $alterFoto = 'foto = :foto,';
                    $stmtFoto = 1;
                } else {
                    $alterFoto = '';
                }

                // Query SQL
                $sql = "UPDATE usuarios SET nome = :nome, cpf = :cpf, cnh = :cnh, telefone = :telefone, carro = :carro, id_empresa = :id_empresa, $alterSenha $alterFoto id_endereco = :id_endereco WHERE id_user = :id;";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $this->getUsuario()->getId(), PDO::PARAM_INT);
                $stmt->bindValue(":nome", $this->getUsuario()->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":cpf", $this->getUsuario()->getCpf(), PDO::PARAM_STR);
                $stmt->bindValue(":cnh", $this->getUsuario()->getCnh(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $this->getUsuario()->getTelefone(), PDO::PARAM_STR);
                $stmt->bindValue(":carro", $this->getUsuario()->getCarro(), PDO::PARAM_STR);
                $stmt->bindValue(":id_empresa", $this->getUsuario()->getEmpresa()->getId(), PDO::PARAM_INT);
                $this->getUsuario()->getSenha() === '' ? : $stmt->bindValue(":senha", $this->getUsuario()->getSenha(), PDO::PARAM_STR);
                $stmtFoto === 0 ? : $stmt->bindValue(":foto", $this->getUsuario()->getFoto(), PDO::PARAM_STR);
                $stmt->bindValue(":id_endereco", $this->getUsuario()->getEndereco()->getId(), PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }

        // Método para retornar usuário do banco
        public function retornarUsuario($id) {
            try {
                
                // Query
                $sql = "SELECT u.id_user, u.nome, u.carro, u.cargo, emp.fantasia, u.telefone, u.cpf, u.cnh, u.foto, e.cep, e.numero, e.rua, e.cidade, e.estado, e.bairro FROM usuarios u INNER JOIN enderecos e ON u.id_endereco = e.id_end INNER JOIN empresas emp ON u.id_empresa = emp.id_emp WHERE u.id_user = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
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
                        $d['fantasia'];
                        $d['telefone'];
                        $d['cpf'];
                        $d['cnh'];
                        $d['foto'];
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

        // Método para remover usuário do banco
        public function removerUsuario($id){
            try {

                $retorno = $this->retornarUsuario($id);

                if($retorno === -1) {
                    
                    return 0;

                } else {

                    // Query
                    $sql = "DELETE FROM usuarios WHERE id_user = :id LIMIT 1;";

                    // Conectando ao banco e preparando a query
                    $stmt = ConnectionFactory::getConexao()->prepare($sql);
                    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

                    // Executando a query no banco
                    $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                    return 1;
                    
                }
                
                

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Getters e Setters
        public function getUsuario() {
            return $this->usuario;
        }

        public function setUsuario($usuario) {
            $this->usuario = $usuario;
        }
    }