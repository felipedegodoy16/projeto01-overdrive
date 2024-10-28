<?php 
session_start();

require_once "../_class/Usuario.php";
require_once "../_class/Empresa.php";

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if(!$_SESSION['logged']){
    header("Location: ../login.php");
}

$campo = $_GET['campo'];
$ordem = $_GET['ordem'];

// Instanciação de um objeto usuário
$usuario = new Usuario();

// Chamando método para remoção do usuário no banco
$dadosUsers = $usuario->listarUsuariosAlfa($campo, $ordem);

// Instanciação de um objeto empresa
$empresa = new Empresa();

// Chamando método para remoção do usuário no banco
$dadosEmps = $empresa->listarEmpresasAlfa($campo, $ordem);

if($dadosUsers === -1 && $dadosEmps === -1){

    $allDados = [
        'error' => true
    ];

} else {

    $allDados = [
        'sessao' => $_SESSION['cargo'],
        'usuarios' => $dadosUsers,
        'empresas' => $dadosEmps,
        'error' => false
    ];

}

echo json_encode($allDados);