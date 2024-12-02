<?php 
    require_once 'Empresa.php';

    class EmpresaDAO {
        // Atributo
        private Empresa $empresa;

        // Construtor da classe
        public function __construct($empresa) {
            $this->empresa = $empresa;
        }

        // Verificando se a empresa já está registrada no banco
        public function verificaCnpj(){
            try {

                // Query
                $sql = "SELECT * FROM empresas WHERE cnpj = :cnpj;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":cnpj", $this->getEmpresa()->getCnpj(), PDO::PARAM_STR);

                // Executando query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                // Testando se houve retorno do banco
                if(count($dados) > 0){
                    return 1;
                }

                return -1;
    
            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para inserção da empresa no banco
        public function inserirEmpresa(){
            try {

                // Query SQL
                $sql = "INSERT INTO empresas VALUES 
                (DEFAULT, :nome, :fantasia, :cnpj, :telefone, :responsavel, :foto, :registro, :id_endereco);";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":nome", $this->getEmpresa()->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":fantasia", $this->getEmpresa()->getFantasia(), PDO::PARAM_STR);
                $stmt->bindValue(":cnpj", $this->getEmpresa()->getCnpj(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $this->getEmpresa()->getTelefone(), PDO::PARAM_STR);
                $stmt->bindValue(":responsavel", $this->getEmpresa()->getResponsavel(), PDO::PARAM_STR);
                $stmt->bindValue(":foto", $this->getEmpresa()->getFoto(), PDO::PARAM_STR);
                $stmt->bindValue(":registro", $this->getEmpresa()->getRegistro(), PDO::PARAM_STR);
                $stmt->bindValue(":id_endereco", $this->getEmpresa()->getEndereco()->getId(), PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }

        // Método para retornar todas as empresas registradas no banco
        public function listarEmpresas(){
            try {

                // Query
                $sql = "SELECT * FROM empresas emp INNER JOIN enderecos ende ON emp.id_endereco = ende.id_end;";

                // Conectando com o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);

                // Excutando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                if(count($dados) > 0){

                    foreach($dados as $d){

                        $empresas[] = array(
                            'id' => $d['id_emp'],
                            'nome' => $d['nome'],
                            'cnpj' => $d['cnpj'],
                            'telefone' => $d['telefone'],
                            'fantasia' => $d['fantasia'],
                            'responsavel' => $d['responsavel'],
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

                    return $empresas;

                }

                return -1;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para retornar todas as empresas registradas no banco na ordem que for especificada
        public function listarEmpresasOrdem($campo, $ordem){
            try {

                if($campo !== 'cidade' && $campo !== 'estado') {
                    
                    // Query
                    $sql = "SELECT * FROM empresas emp INNER JOIN enderecos ende ON emp.id_endereco = ende.id_end ORDER BY emp.$campo $ordem;";

                } else {

                    // Query
                    $sql = "SELECT * FROM empresas emp INNER JOIN enderecos ende ON emp.id_endereco = ende.id_end ORDER BY ende.$campo $ordem;";

                }

                // Conectando com o banco
                $stmt = ConnectionFactory::getConexao()->prepare($sql);

                // Excutando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                if(count($dados) > 0){

                    foreach($dados as $d){

                        $empresas[] = array(
                            'id' => $d['id_emp'],
                            'nome' => $d['nome'],
                            'cnpj' => $d['cnpj'],
                            'telefone' => $d['telefone'],
                            'fantasia' => $d['fantasia'],
                            'responsavel' => $d['responsavel'],
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

                    return $empresas;

                }

                return -1;

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para retornar empresa do banco
        public function retornarEmpresa($id) {
            try {
                
                // Query
                $sql = "SELECT * FROM empresas emp INNER JOIN enderecos e ON emp.id_endereco = e.id_end WHERE emp.id_emp = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                if(count($dados) > 0) {
                    foreach($dados as $d) {
                        $d['id_emp'];
                        $d['nome'];
                        $d['cnpj'];
                        $d['telefone'];
                        $d['fantasia'];
                        $d['responsavel'];
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

        // Método para retornar usuário do banco
        public function empresaUsuario() {
            try {
                
                // Query
                $sql = "SELECT * FROM empresas WHERE fantasia = :fantasia LIMIT 1;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":fantasia", $this->getEmpresa()->getFantasia(), PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                if(count($dados) > 0) {
                    foreach($dados as $d) {
                        $d['id_emp'];
                        $d['nome'];
                        $d['cnpj'];
                        $d['telefone'];
                        $d['fantasia'];
                        $d['responsavel'];
                        $d['foto'];
                    }

                    $this->getEmpresa()->setId($d['id_emp']);

                }

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para verificar se algum dado foi alterado
        public function verificaDadoAlterado() {
            try {

                $message = [];

                // Query
                $sql = "SELECT * FROM empresas
                WHERE id_emp = :idEmp AND nome = :nome
                AND fantasia = :fantasia AND cnpj = :cnpj
                AND telefone = :telefone AND responsavel = :responsavel
                AND id_endereco = :idEnd LIMIT 1;";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":idEmp", $this->getEmpresa()->getId(), PDO::PARAM_INT);
                $stmt->bindValue(":nome", $this->getEmpresa()->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":fantasia", $this->getEmpresa()->getFantasia(), PDO::PARAM_STR);
                $stmt->bindValue(":cnpj", $this->getEmpresa()->getCnpj(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $this->getEmpresa()->getTelefone(), PDO::PARAM_STR);
                $stmt->bindValue(":responsavel", $this->getEmpresa()->getResponsavel(), PDO::PARAM_STR);
                $stmt->bindValue(":idEnd", $this->getEmpresa()->getEndereco()->getId(), PDO::PARAM_INT);

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

        // Verificando se a empresa já está registrada no banco
        public function verificaEdicao(){
            try {

                // Query
                $sql = "SELECT * FROM empresas WHERE cnpj = :cnpj AND id_emp != :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":cnpj", $this->getEmpresa()->getCnpj(), PDO::PARAM_STR);
                $stmt->bindValue(":id", $this->getEmpresa()->getId(), PDO::PARAM_INT);

                // Executando query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $dados = $stmt->fetchAll();

                // Testando se houve retorno do banco
                if(count($dados) > 0){
                    return 1;
                }

                return -1;
    
            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para alterar dados da empresa no banco
        public function alterarEmpresa($foto){
            try {

                $stmtFoto = 0;

                if(($this->getEmpresa()->getFoto() !== '' && $foto === 0) || ($foto === 1)) {
                    $alterFoto = 'foto = :foto,';
                    $stmtFoto = 1;
                } else {
                    $alterFoto = '';
                }

                // Query SQL
                $sql = "UPDATE empresas SET nome = :nome, fantasia = :fantasia, cnpj = :cnpj, telefone = :telefone, responsavel = :responsavel, $alterFoto id_endereco = :id_endereco WHERE id_emp = :id;";

                // Conectando o banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $this->getEmpresa()->getId(), PDO::PARAM_INT);
                $stmt->bindValue(":nome", $this->getEmpresa()->getNome(), PDO::PARAM_STR);
                $stmt->bindValue(":fantasia", $this->getEmpresa()->getFantasia(), PDO::PARAM_STR);
                $stmt->bindValue(":cnpj", $this->getEmpresa()->getCnpj(), PDO::PARAM_STR);
                $stmt->bindValue(":telefone", $this->getEmpresa()->getTelefone(), PDO::PARAM_STR);
                $stmt->bindValue(":responsavel", $this->getEmpresa()->getResponsavel(), PDO::PARAM_STR);
                $stmtFoto === 0 ? : $stmt->bindValue(":foto", $this->getEmpresa()->getFoto(), PDO::PARAM_STR);
                $stmt->bindValue(":id_endereco", $this->getEmpresa()->getEndereco()->getId(), PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

            } catch(Exception $e) {
                
                echo "Exceção $e";
            
            }
        }

        // Método para retornar os nomes de todas as empresas cadastradas no banco
        public function listarNomesEmps(){

            try {

                // Query
                $sql = "SELECT fantasia FROM empresas;";

                // Conectando ao banco
                $stmt = ConnectionFactory::getConexao()->prepare($sql);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $lista = $stmt->fetchAll();

                if(count($lista) > 0){

                    foreach($lista as $ls){

                        $empresas [] = array(
                            'fantasia' => $ls['fantasia']
                        );

                    }

                    return $empresas;

                }

                return 0;

            } catch(Exception $e) {

                echo "Exceção $e";
                
            }
        }

        // Método para verificar se a empresa está vinculada a algum usuário
        public function retirarVinculo($id){

            try {

                // Query
                $sql = "SELECT id_user FROM usuarios WHERE id_empresa = :id;";

                // Conectando ao banco e preparando a query
                $stmt = ConnectionFactory::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $usuarios = $stmt->fetchAll();

                if(count($usuarios) > 0){
                    foreach($usuarios as $usuario) {
                        // Query
                        $sql = "UPDATE usuarios SET id_empresa = 1 WHERE id_user = :id;";

                        // Conectando ao banco e preparando a query
                        $stmt = ConnectionFactory::getConexao()->prepare($sql);
                        $stmt->bindValue(":id", $usuario['id_user'], PDO::PARAM_INT);

                        // Executando a query no banco
                        $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                    }
                }

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Método para remover empresa do banco
        public function removerEmpresa($id){

            try {

                $retorno = $this->retornarEmpresa($id);

                // Verificando se a empresa existe no banco
                if($retorno === -1) {

                    return 0;

                } else {

                    // Verificando vínculo de empresa com algum usuário
                    $this->retirarVinculo($id);

                    // Query
                    $sql = "DELETE FROM empresas WHERE id_emp = :id;";

                    // Conectando o banco e preparando a query
                    $stmt = ConnectionFactory::getConexao()->prepare($sql);
                    $stmt->bindValue(":id", $id, PDO::PARAM_INT);

                    // Executando a query no banco
                    $stmt->execute() or die(print_r($stmt->erroInfo(), true));

                    return 1;

                }

            } catch(Exception $e) {

                echo "Exceção $e";

            }
        }

        // Getters e Setters
        public function getEmpresa() {
            return $this->empresa;
        }

        public function setEmpresa($empresa) {
            $this->empresa = $empresa;
        }
    }