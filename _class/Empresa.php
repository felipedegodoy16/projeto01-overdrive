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