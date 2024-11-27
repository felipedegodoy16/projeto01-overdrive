<?php 
    
    require_once '../_verify/verificacaoFilesComum.php';
    require_once '../_class/UsuarioDAO.php';
    require_once '../_class/Empresa.php';

    $campo = $_GET['campo'];
    $ordem = $_GET['ordem'];

    // Instanciação de um objeto usuário e objeto de usuárioDAO
    $usuario = new Usuario();
    $usuarioDAO = new UsuarioDAO($usuario);

    // Chamando método para listar usuário em ordem no banco
    $dadosUsers = $usuarioDAO->listarUsuariosOrdem($campo, $ordem);

    // Instanciação de um objeto empresa
    $empresa = new Empresa();

    // Chamando método para listar empresa em ordem no banco
    $dadosEmps = $empresa->listarEmpresasOrdem($campo, $ordem);

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