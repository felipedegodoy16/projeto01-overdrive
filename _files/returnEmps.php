<?php
session_start();

require_once "../_class/Empresa.php";

$_SESSION['logged'] = $_SESSION['logged'] ?? false;

if(!$_SESSION['logged']){
    header("Location: ../login.php");
}

if($_SESSION['cargo'] === 'A'){

    // Instanciação de um objeto empresa
    $empresa = new Empresa();

    // Chamando método para remoção do usuário no banco
    $dados = $empresa->listarNomesEmps();

    echo json_encode($dados);

} else {

    header("Location: ../index.php");

}