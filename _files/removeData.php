<?php 
session_start();

require_once "../_class/Usuario.php";
require_once "../_class/Empresa.php";

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if(!$_SESSION['logged']){
    header("Location: ../login.php");
}

if($_SESSION['cargo'] === 'A'){

    if($_GET['tipo'] === 'usuario'){
        // Pegando id do usuário ou empresa que será excluído do banco
        $id = (int) $_GET['id'];

        // Instanciação de um objeto usuário
        $usuarios = new Usuario();

        // Chamando método para remoção do usuário no banco
        $usuarios->removerUsuario($id);

        echo "<script>
            alert('Usuário removido com sucesso!')
            window.location='../index.php'
        </script>";
    } else if($_GET['tipo'] === 'empresa'){

    } else{
        echo "<script>
            alert('O tipo de registro não é válido!')
            window.location='../index.php'
        </script>";
    }
    

}

header("Location: ../index.php");