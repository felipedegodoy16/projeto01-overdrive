<?php 

  require_once '_class/Usuario.php';
  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoUser.php';

  $tipo = $_GET['tipo'];
  $id_edit = $_GET['id'];

  if($tipo === 'usuario') {

    $usuario = new Usuario();
    $dados = $usuario->retornarUsuario($id_edit);

    if($dados === -1) {
        echo "<script>
            alert('O id desse usuário não existe!')
            window.location='index.php'
        </script>";
    }

  } else if($tipo === 'empresa') {

    $empresa = new Empresa();
    $dados = $empresa->retornarEmpresa($id_edit);

    if($dados === -1) {
        echo "<script>
            alert('O id dessa empresa não existe!')
            window.location='index.php'
        </script>";
    }

  } else {
            
    header('Location: index.php');

  }