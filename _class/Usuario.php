<?php 
require_once 'Endereco.php';
require_once 'Empresa.php';

class Usuario {
    // Atributos
    private string $nome, $cnh, $telefone, $carro, $cargo, $senha;
    private int $cpf;
    private Endereco $endereco;
    private Empresa $empresa;

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

    public function getSenha(){
        return $this->senha;
    }

    public function getEndereco(){
        return $this->endereco;
    }

    public function getEmpresa(){
        return $this->empresa;
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

    public function setSenha($senha){
        $this->senha = $senha;
    }

    public function setEndereco($endereco){
        $this->endereco = $endereco;
    }

    public function setEmpresa($empresa){
        $this->empresa = $empresa;
    }
}