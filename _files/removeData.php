<?php 

    require_once '../_verify/verificacaoFilesAdmin.php';
    require_once "../_class/Usuario.php";
    require_once "../_class/Empresa.php";

    // Pegando id do usuário ou empresa que será excluído do banco
    $id = (int) $_GET['id'];

    if($_GET['tipo'] === 'usuario'){

        // Instanciação de um objeto usuário
        $usuario = new Usuario();

        // Chamando método para remoção do usuário no banco
        $usuario->removerUsuario($id);

    } else if($_GET['tipo'] === 'empresa'){

        // Instanciação de um objeto empresa
        $empresa = new Empresa();

        // Chamando método para remoção do usuário no banco
        $dadoRetornado = $empresa->removerEmpresa($id);

        if($dadoRetornado === 0){

            $json = array(
                'status' => false,
                'message' => "A empresa selecionada já foi excluída."
            );

        } else if($dadoRetornado === 1){
            
            $json = array(
                'status' => false,
                'message' => "A empresa selecionada ainda possui vínculo com algum funcionário."
            );

        } else {

            $json = array(
                'status' => true,
                'message' => "Empresa removida com sucesso."
            );

        }

        echo json_encode($json);

    } else{
        echo "<script>
            alert('O tipo de registro não é válido!')
            window.location='../index.php'
        </script>";
    }