<?php 
require_once 'ConexaoDAO.php';

class Endereco {
    // Atributos
    private int $numero, $cep;
    private string $rua, $cidade, $estado, $bairro;

    // Método construtor
    public function __construct(){
        
    }

    // Método para verificação de endereço
    public function verificaEndereco() {
        $sql = "SELECT * FROM enderecos WHERE
        cep = :cep AND numero = :numero AND
        rua = :rua AND cidade = :cidade AND
        estado = :estado AND bairro = :bairro;";

        // Executando a query no banco
        $stmt = ConexaoDAO::getConexao()->prepare($sql);
        $stmt->bindValue(":cep", $this->cep, PDO::PARAM_INT);
        $stmt->bindValue(":numero", $this->numero, PDO::PARAM_INT);
        $stmt->bindValue(":rua", $this->rua, PDO::PARAM_STR);
        $stmt->bindValue(":cidade", $this->cidade, PDO::PARAM_STR);
        $stmt->bindValue(":estado", $this->estado, PDO::PARAM_STR);
        $stmt->bindValue(":bairro", $this->bairro, PDO::PARAM_STR);

        $stmt->execute() or die(print_r($stmt->errorInfo(), true));
        $dado = $stmt->fetchAll();
        
        foreach($dado as $d){
            $d['id'];
            $d['cep'];
            $d['numero'];
            $d['rua'];
            $d['cidade'];
            $d['estado'];
            $d['bairro'];
        }

        if(count($dado) != 0){
            // echo "<pre>";
            // print_r($dado[0]);
            // echo "</pre>";
            return $dado[0];
        }

        return -1;
    }

    // Método para inserção do endereço no Banco
    public function inserirEndereco(){
        $dadoVerificado = $this->verificaEndereco();
        
        if($dadoVerificado == -1){
            $sql = "INSERT INTO enderecos VALUES
            (DEFAULT, :cep, :numero, :rua, :cidade, :estado, :bairro);";

            $stmt = ConexaoDAO::getConexao()->prepare($sql);

            // Substituindo os valores pelos valores de entrada do formulário
            $stmt->bindValue(":cep", $this->cep, PDO::PARAM_INT);
            $stmt->bindValue(":numero", $this->numero, PDO::PARAM_INT);
            $stmt->bindValue(":rua", $this->rua, PDO::PARAM_STR);
            $stmt->bindValue(":cidade", $this->cidade, PDO::PARAM_STR);
            $stmt->bindValue(":estado", $this->estado, PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $this->bairro, PDO::PARAM_STR);

            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
        }
    }

    // Getters e Setters
    public function getCep(){
        return $this->cep;
    }

    public function getNumero(){
        return $this->numero;
    }

    public function getRua(){
        return $this->rua;
    }

    public function getCidade(){
        return $this->cidade;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function getBairro(){
        return $this->bairro;
    }

    public function setCep($cep){
        $this->cep = $cep;
    }

    public function setNumero($numero){
        $this->numero = $numero;
    }

    public function setRua($rua){
        $this->rua = $rua;
    }

    public function setCidade($cidade){
        $this->cidade = $cidade;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function setBairro($bairro){
        $this->bairro = $bairro;
    }
}