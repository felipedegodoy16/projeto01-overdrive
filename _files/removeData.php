<?php 

    require_once '../_verify/verificacaoFilesAdmin.php';
    require_once "../_class/UsuarioDAO.php";
    require_once "../_class/Empresa.php";

    // Pegando id do usuário ou empresa que será excluído do banco
    $id = (int) $_GET['id'];

    if($_GET['tipo'] === 'usuario'){

        // Instanciação de um objeto usuário e um objeto de usuárioDAO
        $usuario = new Usuario();
        $usuarioDAO = new UsuarioDAO($usuario);

        // Chamando método para remoção do usuário no banco
        $dadoRetornado = $usuarioDAO->removerUsuario($id);

        if($dadoRetornado === 0){

            $json = array(
                'status' => false,
                'message' => 'O usuário selecionado já foi excluído.'
            );

        } else {

            $json = array(
                'status' => true,
                'message' => 'Usuário removido com sucesso.'
            );

        }

    } else if($_GET['tipo'] === 'empresa'){

        // Instanciação de um objeto empresa
        $empresa = new Empresa();

        // Chamando método para remoção do usuário no banco
        $dadoRetornado = $empresa->removerEmpresa($id);

        if($dadoRetornado === 0){

            $json = array(
                'status' => false,
                'message' => 'A empresa selecionada já foi excluída.'
            );

        } else {

            $json = array(
                'status' => true,
                'message' => 'Empresa removida com sucesso.'
            );

        }

    } else{

        echo "<script>
            alert('O tipo de registro não é válido!')
            window.location='../index.php'
        </script>";
        exit();
        
    }

    echo json_encode($json);