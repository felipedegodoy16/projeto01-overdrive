<?php 

require_once '../_class/Usuario.php';

$userAcesso = new Usuario();

$userAcesso->setCpf($_POST['user_input']);
$userAcesso->setSenha($_POST['password_input']);

$userAcesso->verificarAcesso();