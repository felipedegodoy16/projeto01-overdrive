<?php 
session_start();

require_once "../_class/Usuario.php";

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if(!$_SESSION['logged']){
    header("Location: ../login.php");
}

if($_SESSION['cargo'] === 'A'){

    // Pegando id do usuário que será excluído do banco
    $id = (int) $_GET['id'];

    // Instanciação de um objeto usuário
    $usuarios = new Usuario();

    // Chamando método para remoção do usuário no banco
    $usuarios->removerUsuario($id);

    echo "<script>
        alert('Usuário removido com sucesso!')
        window.location='../index.php'
    </script>";

}

header("Location: ../index.php");