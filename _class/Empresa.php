<?php 
require_once 'Endereco.php';

class Empresa {
    // Atributos
    private int $id;
    private string $nome, $cnpj, $telefone, $fantasia, $responsavel, $foto;
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
            (DEFAULT, :nome, :fantasia, :cnpj, :telefone, :responsavel, :foto, :id_endereco);";

            // Conectando o banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
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
}