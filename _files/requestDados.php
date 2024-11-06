<?php 

    require_once '../_verify/verificacaoFilesComum.php';
    require_once '../_class/Empresa.php';
    require_once '../_class/Usuario.php';

    // Instanciação de um objeto usuário
    $usuarios = new Usuario();

    // Retorno de uma lista de todos os registros de usuários do banco
    $dadosUsers = $usuarios->listarUsuarios();

    // Instanciação de um objeto empresa
    $empresas = new Empresa();

    // Retorno de uma lista de todos os registros de empresas do banco
    $dadosEmps = $empresas->listarEmpresas();

    if($dadosUsers === -1 && $dadosEmps === -1){

        $allDados = [
            'error' => true
        ];

    } else {

        $allDados = [
            'sessao' => $_SESSION['cargo'],
            'id_logged' => $_SESSION['id'],
            'usuarios' => $dadosUsers,
            'empresas' => $dadosEmps,
            'error' => false
        ];

    }

    echo json_encode($allDados);