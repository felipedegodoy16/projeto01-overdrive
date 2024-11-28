<?php 
require_once 'ConnectionFactory.php';

class Endereco {
    // Atributos
    private int $id;
    private string $rua, $cep, $cidade, $estado, $bairro, $numero;

    // Método construtor
    public function __construct(){
        
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