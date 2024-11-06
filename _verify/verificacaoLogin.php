<?php 

  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if($_SESSION['logged']) {
    header('Location: index.php');
  }

  require_once '_class/Usuario.php';

  $usuario = $_POST['user_input'] ?? '';
  $senha = $_POST['password_input'] ?? '';

  $status = 1;

  if($usuario != '' && $senha != ''){
    $userAcesso = new Usuario();

    $userAcesso->setCpf($_POST['user_input']);
    $userAcesso->setSenha($_POST['password_input']);
    
    $status = $userAcesso->verificarAcesso();
  }