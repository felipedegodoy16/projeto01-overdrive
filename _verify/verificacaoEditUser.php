<?php 

  require_once '_class/Usuario.php';
  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoIndex.php';

  $edit = (bool) $_GET['edit'];
  $id_edit = $_GET['id'];

  if($_SESSION['cargo'] === 'C' && $_SESSION['id'] != $id_edit) {
    header('Location: index.php');
    exit();
  }

  // Validação do CPF
  if(!validaCpf($_POST['cpf'])) {
    echo "<script>
        alert('O CPF não é válido!')
        window.location='../cadastro.php'
    </script>";
    exit();
  }
  
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

  // Função para validação do CPF
  function validaCPF($cpf) {
    // Extrai somente os números
    $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
     
    // Verifica se foi informado todos os digitos corretamente
    if (strlen($cpf) != 11) {
        return false;
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    if (preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
  }