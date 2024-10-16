<?php 
require_once 'ConexaoDAO.php';

abstract class Endereco {
    // Atributos
    private int $cep, $numero;
    private string $rua, $cidade, $estado, $bairro;

    // Método construtor
    public function __construct(){
        
    }

    // Método para verificação de endereço
    public function verificaEndereco(){
        $sql = "SELECT id FROM enderecos WHERE
        cep = " . $this->getCep() . " AND
        numero = " . $this->getNumero() . " AND
        rua = " . $this->getRua() . " AND
        cidade = " . $this->getCidade() . " AND
        estado = " . $this->getEstado() . " AND
        bairro = " . $this->getBairro();

        $stmt = ConexaoDAO::getConexao()->prepare($sql);
        $dado = $stmt->execute() or die(print_r($stmt->errorInfo(), true));

        if(count($dado) != 0){
            print_r($dado);
            // return $dado;
        }

        return -1;
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