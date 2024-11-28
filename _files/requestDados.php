<?php 

    require_once '../_verify/verificacaoFilesComum.php';
    require_once '../_class/EmpresaDAO.php';
    require_once '../_class/UsuarioDAO.php';

    // Instanciação de um objeto usuário e objeto de usuárioDAO
    $usuarios = new Usuario();
    $usuariosDAO = new UsuarioDAO($usuarios);

    // Retorno de uma lista de todos os registros de usuários do banco
    $dadosUsers = $usuariosDAO->listarUsuarios();

    // Instanciação de um objeto empresa e objeto empresaDAO
    $empresas = new Empresa();
    $empresasDAO = new EmpresaDAO($empresas);

    // Retorno de uma lista de todos os registros de empresas do banco
    $dadosEmps = $empresasDAO->listarEmpresas();

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