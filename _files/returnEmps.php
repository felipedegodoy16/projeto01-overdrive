<?php

    require_once '../_verify/verificacaoFilesAdmin.php';
    require_once '../_class/EmpresaDAO.php';

    // Instanciação de um objeto empresa e um objeto de empresaDAO
    $empresa = new Empresa();
    $empresaDAO = new EmpresaDAO($empresa);

    // Chamando método para remoção do usuário no banco
    $dados = $empresaDAO->listarNomesEmps();

    // Verificando se retornou dados do banco
    if($dados === 0){

        $allDados = [
            'status' => false
        ];

    } else {

        $allDados = [
            'status' => true,
            'empresas' => $dados
        ];

    }

    echo json_encode($allDados);