<?php 
session_start();

require_once "../_class/Usuario.php";
require_once "../_class/Empresa.php";

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if(!$_SESSION['logged']){
    header("Location: ../login.php");
}

if($_SESSION['cargo'] === 'A'){

    // Pegando id do usuário ou empresa que será excluído do banco
    $id = (int) $_GET['id'];

    if($_GET['tipo'] === 'usuario'){

        // Instanciação de um objeto usuário
        $usuario = new Usuario();

        // Chamando método para remoção do usuário no banco
        $usuario->removerUsuario($id);

        echo "<script>
            alert('Usuário removido com sucesso!')
            window.location='../index.php'
        </script>";

    } else if($_GET['tipo'] === 'empresa'){

        // Instanciação de um objeto empresa
        $empresa = new Empresa();

        // Chamando método para remoção do usuário no banco
        $empresa->removerEmpresa($id);

        // echo "<script>
        //     alert('Empresa removida com sucesso!')
        //     window.location='../index.php'
        // </script>";

    } else{
        echo "<script>
            alert('O tipo de registro não é válido!')
            window.location='../index.php'
        </script>";
    }
}

header("Location: ../index.php");