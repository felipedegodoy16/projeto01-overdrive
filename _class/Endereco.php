<?php 
require_once 'ConexaoDAO.php';

class Endereco {
    // Atributos
    private int $id, $numero;
    private string $rua, $cep, $cidade, $estado, $bairro;

    // Método construtor
    public function __construct(){
        
    }

    // Método para verificação de endereço
    public function verificaEndereco() {
        try {

            // Query
            $sql = "SELECT * FROM enderecos WHERE
            cep = :cep AND numero = :numero AND
            rua = :rua AND cidade = :cidade AND
            estado = :estado AND bairro = :bairro;";

            // Conectando ao banco e preparando a query
            $stmt = ConexaoDAO::getConexao()->prepare($sql);
            $stmt->bindValue(":cep", $this->cep, PDO::PARAM_STR);
            $stmt->bindValue(":numero", $this->numero, PDO::PARAM_INT);
            $stmt->bindValue(":rua", $this->rua, PDO::PARAM_STR);
            $stmt->bindValue(":cidade", $this->cidade, PDO::PARAM_STR);
            $stmt->bindValue(":estado", $this->estado, PDO::PARAM_STR);
            $stmt->bindValue(":bairro", $this->bairro, PDO::PARAM_STR);

            // Executando a query no banco
            $stmt->execute() or die(print_r($stmt->errorInfo(), true));
            $dado = $stmt->fetchAll();
            
            foreach($dado as $d){
                $d['id_end'];
                $d['cep'];
                $d['numero'];
                $d['rua'];
                $d['cidade'];
                $d['estado'];
                $d['bairro'];
            }

            // Verificando existência do endereço no banco
            if(count($dado) > 0){
                $this->setId($d['id_end']);
                return $dado[0];
            }

            return -1;

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Método para inserção do endereço no Banco
    public function inserirEndereco(){
        try {

            // Recebendo retorno de outro método
            $dadoVerificado = $this->verificaEndereco();
        
            // Verificando existência de um endereço já existente
            if($dadoVerificado == -1){

                // Query
                $sql = "INSERT INTO enderecos VALUES
                (DEFAULT, :cep, :numero, :rua, :cidade, :estado, :bairro);";

                // Conectando ao banco e preparando query
                $stmt = ConexaoDAO::getConexao()->prepare($sql);
                $stmt->bindValue(":cep", $this->cep, PDO::PARAM_STR);
                $stmt->bindValue(":numero", $this->numero, PDO::PARAM_INT);
                $stmt->bindValue(":rua", $this->rua, PDO::PARAM_STR);
                $stmt->bindValue(":cidade", $this->cidade, PDO::PARAM_STR);
                $stmt->bindValue(":estado", $this->estado, PDO::PARAM_STR);
                $stmt->bindValue(":bairro", $this->bairro, PDO::PARAM_STR);

                // Executando query no banco
                $stmt->execute() or die(print_r($stmt->errorInfo(), true));

                $this->verificaEndereco();
            }

        } catch(Exception $e) {

            echo "Exceção $e";

        }
    }

    // Getters e Setters
    public function getId(){
        return $this->id;
    }

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

    public function setId($id){
        $this->id = $id;
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