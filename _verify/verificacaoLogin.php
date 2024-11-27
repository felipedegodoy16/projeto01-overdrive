<?php 

  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;
  
  if($_SESSION['logged']) {
    header('Location: index.php');
    exit();
  }

  require_once '_class/UsuarioDAO.php';

  $usuario = $_POST['user_input'] ?? '';
  $senha = $_POST['password_input'] ?? '';

  $status = 1;

  if($usuario != '' && $senha != ''){
    $userAcesso = new Usuario();
    $userAcessoDAO = new UsuarioDAO($userAcesso);

    $userAcesso->setCpf($_POST['user_input']);
    $userAcesso->setSenha($_POST['password_input']);
    
    $status = $userAcessoDAO->verificarAcesso();
  }