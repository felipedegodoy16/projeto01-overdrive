<?php 
require_once 'Endereco.php';

class Usuario extends Endereco {
    // Atributos
    private string $nome, $cnh, $telefone, $carro, $cargo;
    private int $cpf;

    // Método construtor
    public function __construct(){
        
    }

    public function inserir(){

    }

    // Getters e Setters
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
}