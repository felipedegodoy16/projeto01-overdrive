<?php 

  require_once '_class/Usuario.php';
  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoUser.php';

  $edit = (bool) $_GET['edit'];
  $tipo = $_GET['tipo'];
  $id_edit = $_GET['id'];

  $usuario = new Usuario();
  $empresa = new Empresa();
  $endereco = new Endereco();

  if($edit) {

    if($tipo === 'usuario') {

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

    } else if($tipo === 'empresa') {

      $endereco->setCep(strtoupper($_POST['cep_emp']));
      $endereco->setRua(strtoupper($_POST['rua_emp']));
      $endereco->setBairro(strtoupper($_POST['bairro_emp']));
      $endereco->setNumero(strtoupper($_POST['numero_emp']));
      $endereco->setCidade(strtoupper($_POST['cidade_emp']));
      $endereco->setEstado(strtoupper($_POST['estado_emp']));

      // Inserindo o endereço no banco ou pegando um endereço já existente
      $endereco->inserirEndereco();

      $empresa->setId($id_edit);
      $empresa->setCnpj(strtoupper($_POST['cnpj_emp']));
      $empresa->setNome(strtoupper($_POST['nome_emp']));
      $empresa->setFantasia(strtoupper($_POST['fantasia_emp']));
      $empresa->setTelefone(strtoupper($_POST['telefone_emp']));
      $empresa->setResponsavel(strtoupper($_POST['responsavel_emp']));
      $empresa->setEndereco($endereco);
      if(isset($_FILES['foto_emp']['name']) && $_FILES['foto_emp']['error'] == 0){
          $arquivo_tmp = $_FILES['foto_emp']['tmp_name'];
          $nomeImagem = $_FILES['foto_emp']['name'];
          $extensao = strrchr($nomeImagem, '.');
          $extensao = strtolower($extensao);
          if(strstr('.jpg;.jpeg;.png', $extensao)){
              $novoNome = md5(microtime()) .$extensao; ;
              $destino = '../_images/uploads/' . $novoNome; 
              @move_uploaded_file($arquivo_tmp, $destino);
              $empresa->setFoto(strtoupper($novoNome));
          } else {
              $empresa->setFoto('');
          }
      } else {
          $empresa->setFoto('');
      }

      // Alterando usuário existente no banco
      $empresa->alterarEmpresa();

      echo "<script>
          alert('Empresa alterada com sucesso!')
          window.location='index.php'
      </script>";
    }

  }

  if($tipo === 'usuario') {

    $dados = $usuario->retornarUsuario($id_edit);

    if($dados === -1) {
        echo "<script>
            alert('O id desse usuário não existe!')
            window.location='index.php'
        </script>";
    }

  } else if($tipo === 'empresa') {

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