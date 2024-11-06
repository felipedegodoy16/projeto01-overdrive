<?php

    require_once '../_verify/verificacaoFilesAdmin.php';
    require_once '../_class/Empresa.php';

    // Instanciação de um objeto empresa
    $empresa = new Empresa();

    // Chamando método para remoção do usuário no banco
    $dados = $empresa->listarNomesEmps();

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