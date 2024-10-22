<?php 
require_once 'Endereco.php';

class Empresa {
    // Atributos
    private int $id, $cnpj, $telefone;
    private string $nome, $fantasia, $responsavel;
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
            $stmt->bindValue(":cnpj", $this->cnpj, PDO::PARAM_INT);

            // Executando query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dados = $stmt->fetchAll();

            if(count($dados) > 0){
                return 1;
            }

            return -1;
 
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
}