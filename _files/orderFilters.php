<?php 

    
    require_once '../_verify/verificacaoFilesComum.php';
    require_once '../_class/Usuario.php';
    require_once '../_class/Empresa.php';

    $campo = $_GET['campo'];
    $ordem = $_GET['ordem'];

    // Instanciação de um objeto usuário
    $usuario = new Usuario();

    // Chamando método para remoção do usuário no banco
    $dadosUsers = $usuario->listarUsuariosOrdem($campo, $ordem);

    // Instanciação de um objeto empresa
    $empresa = new Empresa();

    // Chamando método para remoção do usuário no banco
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