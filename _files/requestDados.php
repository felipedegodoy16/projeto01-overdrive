<?php 
require_once "../_class/Empresa.php";
require_once "../_class/Usuario.php";

$usuarios = new Usuario();

$dadosUsers = $usuarios->listarUsuarios();

echo json_encode($dadosUsers);
