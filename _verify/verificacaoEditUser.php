<?php 

  require_once '_class/Usuario.php';
  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoUser.php';

  $edit = (bool) $_GET['edit'];
  $id_edit = $_GET['id'];

  $usuario = new Usuario();
  $empresa = new Empresa();
  $endereco = new Endereco();

  if($edit) {

    $endereco->setCep(strtoupper($_POST['cep']));
    $endereco->setRua(strtoupper($_POST['rua']));
    $endereco->setBairro(strtoupper($_POST['bairro']));
    $endereco->setNumero(strtoupper($_POST['numero']));
    $endereco->setCidade(strtoupper($_POST['cidade']));
    $endereco->setEstado(strtoupper($_POST['estado']));

    // Inserindo o endereço no banco ou pegando um endereço já existente
    $endereco->inserirEndereco();

    $usuario->setId($id_edit);
    $usuario->setCpf(strtoupper($_POST['cpf']));
    $usuario->setCnh(strtoupper($_POST['cnh']));
    $usuario->setNome(strtoupper($_POST['nome']));
    $usuario->setTelefone(strtoupper($_POST['telefone']));
    $usuario->setCarro(strtoupper($_POST['carro']));
    if($_POST['password'] == '') {
      $usuario->setSenha($_POST['password']);
    } else {
      $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
    }
    $usuario->setEndereco($endereco);
    $usuario->setEmpresa(strtoupper($_POST['empresa']));
    if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0){
        $arquivo_tmp = $_FILES['foto']['tmp_name'];
        $nomeImagem = $_FILES['foto']['name'];
        $extensao = strrchr($nomeImagem, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.png', $extensao)){
            $novoNome = md5(microtime()) .$extensao; ;
            $destino = '../_images/uploads/' . $novoNome; 
            @move_uploaded_file($arquivo_tmp, $destino);
            $usuario->setFoto(strtoupper($novoNome));
        } else {
            $usuario->setFoto('');
        }
    } else {
        $usuario->setFoto('');
    }

    // Alterando usuário existente no banco
    $usuario->alterarUsuario();

    echo "<script>
        alert('Usuário alterado com sucesso!')
        window.location='index.php'
    </script>";
  }

  $dados = $usuario->retornarUsuario($id_edit);
  $empresas = $empresa->listarNomesEmps();

  if($dados === -1) {
      echo "<script>
          alert('O id desse usuário não existe!')
          window.location='index.php'
      </script>";
  }