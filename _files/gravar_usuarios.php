<?php 
require_once '../_class/Usuario.php';
require_once '../_class/Endereco.php';

$endereco = new Endereco();

$endereco->setCep(preg_replace( '/[^0-9]/is', '', $_POST['cep']));
$endereco->setRua($_POST['rua']);
$endereco->setBairro($_POST['bairro']);
$endereco->setNumero($_POST['numero']);
$endereco->setCidade($_POST['cidade']);
$endereco->setEstado($_POST['estado']);

$idEnd = $endereco->inserirEndereco();

// $usuario = new Usuario();

// $usuario->setNome($_POST['nome']);
// $usuario->setCpf($_POST['cpf']);
// $usuario->setCnh($_POST['cnh']);
// $usuario->setTelefone($_POST['telefone']);
// $usuario->setCarro($_POST['carro']);
// $usuario->setCargo('C');
// $usuario->setSenha($_POST['password']);
// // $usuario->setEmpresa($_POST['empresa']);

// function validaCPF($cpf) {
//     // Extrai somente os números
//     $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
//     // Verifica se foi informado todos os digitos corretamente
//     if (strlen($cpf) != 11) {
//         return false;
//     }

//     // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
//     if (preg_match('/(\d)\1{10}/', $cpf)) {
//         return false;
//     }

//     // Faz o calculo para validar o CPF
//     for ($t = 9; $t < 11; $t++) {
//         for ($d = 0, $c = 0; $c < $t; $c++) {
//             $d += $cpf[$c] * (($t + 1) - $c);
//         }
//         $d = ((10 * $d) % 11) % 10;
//         if ($cpf[$c] != $d) {
//             return false;
//         }
//     }
//     return true;
// }