<?php 
require_once '../_class/Usuario.php';

// Instanciando um objeto usuário
$usuario = new Usuario();

$usuario->setCpf(preg_replace( '/[^0-9]/is', '', $_POST['cpf']));
$usuario->setCnh(preg_replace( '/[^0-9]/is', '', $_POST['cnh']));

// echo "<pre>";
// var_dump($usuario->getCpf());
// var_dump($usuario->getCnh());
// echo "</pre>";

$verificaDados = $usuario->verificaDados();

if($verificaDados === -1) {
    // Criando o objeto endereço com as informações passadas
    $endereco = new Endereco();

    $endereco->setCep(preg_replace( '/[^0-9]/is', '', $_POST['cep']));
    $endereco->setRua($_POST['rua']);
    $endereco->setBairro($_POST['bairro']);
    $endereco->setNumero($_POST['numero']);
    $endereco->setCidade($_POST['cidade']);
    $endereco->setEstado($_POST['estado']);

    // Inserindo o endereço no banco ou pegando um endereço já existente
    $endereco->inserirEndereco();

    // Finalizando a instanciação do usuário
    $usuario->setNome($_POST['nome']);
    $usuario->setTelefone(preg_replace( '/[^0-9]/is', '', $_POST['telefone']));
    $usuario->setCarro($_POST['carro']);
    $usuario->setCargo('C');
    $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $usuario->setEndereco($endereco);
    $usuario->setEmpresa($_POST['empresa']);

    // inserindo usuário no banco
    $usuario->inserirUsuario();
} else {
    echo "<script>
        alert('O CPF ou a CNH digitados já foram registrados no Banco')
        history.back()
    </script>";
}