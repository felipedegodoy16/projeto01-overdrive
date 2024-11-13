<?php 
require_once 'Endereco.php';

class Empresa {
    // Atributos
    private int $id;
    private string $nome, $cnpj, $telefone, $fantasia, $responsavel, $foto, $registro;
    private Endereco $endereco;

    // Método construtor
    public function __construct(){
        
    }

    // Verificando se a empresa já está registrada no banco
    public function verificaCnpj(){
        try {

            // Query
            $sql = "SELECT * FROM empresas WHERE cnpj = :cnpj;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":cnpj", $this->cnpj, PDO::PARAM_STR);

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
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindValue(":fantasia", $this->fantasia, PDO::PARAM_STR);
            $stmt->bindValue(":cnpj", $this->cnpj, PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $this->telefone, PDO::PARAM_STR);
            $stmt->bindValue(":responsavel", $this->responsavel, PDO::PARAM_STR);
            $stmt->bindValue(":foto", $this->foto, PDO::PARAM_STR);
            $stmt->bindValue(":registro", $this->registro, PDO::PARAM_STR);
            $stmt->bindValue(":id_endereco", $this->endereco->getId(), PDO::PARAM_INT);

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

            // Conectando com o banco
            $stmt = ConexaoDAO::getConexao()->prepare($sql);

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

            // Query
            $sql = "SELECT * FROM empresas emp INNER JOIN enderecos ende ON emp.id_endereco = ende.id_end ORDER BY emp.$campo $ordem;";

            // Conectando com o banco
            $stmt = ConexaoDAO::getConexao()->prepare($sql);

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
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
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
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":fantasia", $this->getFantasia(), PDO::PARAM_STR);

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

                $this->setId($d['id_emp']);

            }

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
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":cnpj", $this->cnpj, PDO::PARAM_STR);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);

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
    public function alterarEmpresa(){
        try {

            // Query SQL
            $sql = "UPDATE empresas SET nome = :nome, fantasia = :fantasia, cnpj = :cnpj, telefone = :telefone, responsavel = :responsavel, foto = :foto, id_endereco = :id_endereco WHERE id_emp = :id;";

            // Conectando o banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $this->id, PDO::PARAM_INT);
            $stmt->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $stmt->bindValue(":fantasia", $this->fantasia, PDO::PARAM_STR);
            $stmt->bindValue(":cnpj", $this->cnpj, PDO::PARAM_STR);
            $stmt->bindValue(":telefone", $this->telefone, PDO::PARAM_STR);
            $stmt->bindValue(":responsavel", $this->responsavel, PDO::PARAM_STR);
            $stmt->bindValue(":foto", $this->foto, PDO::PARAM_STR);
            $stmt->bindValue(":id_endereco", $this->endereco->getId(), PDO::PARAM_INT);

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
            $stmt = ConexaoDAO::getConexao()->prepare($sql);

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
    public function verificarVinculo($id){

        try {

            // Query
            $sql = "SELECT fantasia FROM empresas WHERE id_emp = :id LIMIT 1;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dados = $stmt->fetchAll();

            if(count($dados) > 0){
                foreach($dados as $d){
                    $d['fantasia'];
                }

                // Query
                $sql = "SELECT empresa FROM usuarios WHERE empresa = :fantasia;";

                // Conectando ao banco e preparando a query
                $stmt = ConexaoDAO::getConexao()->prepare($sql);
                $stmt->bindValue(":fantasia", $d['fantasia'], PDO::PARAM_STR);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));
                $empresas = $stmt->fetchAll();

                if(count($empresas) > 0){
                    return 1;
                }

                return -1;
            }

            return 0;

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para remover empresa do banco
    public function removerEmpresa($id){

        try {
            
            // Verificando vínculo de empresa com algum usuário
            $retorno = $this->verificarVinculo($id);

            // Verificando status do vínculo
            if($retorno === 0){

                return 0;

            } else if($retorno === 1){

                return 1;

            } else{

                // Query
                $sql = "DELETE FROM empresas WHERE id_emp = :id;";

                // Conectando o banco e preparando a query
                $stmt = ConexaoDAO::getConexao()->prepare($sql);
                $stmt->bindValue(":id", $id, PDO::PARAM_INT);

                // Executando a query no banco
                $stmt->execute() or die(print_r($stmt->erroInfo(), true));

                return -1;

            }

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Getters e Setters
    public function getId(){
        return $this->id;
    }

    public function getCnpj(){
        return $this->cnpj;
    }

    public function getTelefone(){
        return $this->telefone;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getFantasia(){
        return $this->fantasia;
    }

    public function getResponsavel(){
        return $this->responsavel;
    }

    public function getEndereco(){
        return $this->endereco;
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

    public function setCnpj($cnpj){
        $this->cnpj = $cnpj;
    }

    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function setFantasia($fantasia){
        $this->fantasia = $fantasia;
    }

    public function setResponsavel($responsavel){
        $this->responsavel = $responsavel;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function setRegistro($registro){
        $this->registro = $registro;
    }
}