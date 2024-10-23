<?php 
require_once "../_class/Empresa.php";
require_once "../_class/Usuario.php";

session_start();

// Instanciação de um objeto usuário
$usuarios = new Usuario();

// Retorno de uma lista de todos os registros de usuários do banco
$dadosUsers = $usuarios->listarUsuarios();

// Instanciação de um objeto empresa
$empresas = new Empresa();

// Retorno de uma lista de todos os registros de empresas do banco
// $dadosEmps->listarEmpresas();

// if($dadosUsers === -1 && $dadosEmps === -1){

// } else {

    $allDados = [
        'sessao' => $_SESSION['cargo'],
        'usuarios' => $dadosUsers
        // 'empresas' => $dadosEmps 
    ];

    // var_dump(json_encode($allDados));
    echo json_encode($allDados);
// }
