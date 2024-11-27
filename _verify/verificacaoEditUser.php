<?php 

  require_once '_class/UsuarioDAO.php';
  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoIndex.php';

  $id_edit = $_GET['id'];

  if($_SESSION['cargo'] === 'C' && $_SESSION['id'] != $id_edit) {
    header('Location: index.php');
    exit();
  }

  $message = [];
  
  $usuario = new Usuario();
  $usuarioDAO= new UsuarioDAO($usuario);

  $empresa = new Empresa();
  $endereco = new Endereco();

  if(isset($_POST['cpf'])) {

    // Validação dos campos que foram preenchidos
    $message = validacoes();

    if(!empty($message)) {
        $dados = $usuarioDAO->retornarUsuario($id_edit);
        $empresas = $empresa->listarNomesEmps();
        return;
    }

    // Pegando dados para verificar possibilidade de ser repetido
    $usuario->setId($id_edit);
    $usuario->setCpf(strtoupper($_POST['cpf']));
    $usuario->setCnh(strtoupper($_POST['cnh']));

    $foto = 0;

    if(isset($_POST['action'])) {
        $foto = 1;
    }

    $verificaDados = $usuarioDAO->verificaEdicao();

    if($verificaDados === -1) {
        $endereco->setCep(strtoupper($_POST['cep']));
        $endereco->setRua(strtoupper($_POST['rua']));
        $endereco->setBairro(strtoupper($_POST['bairro']));
        $endereco->setNumero(strtoupper($_POST['numero']));
        $endereco->setCidade(strtoupper($_POST['cidade']));
        $endereco->setEstado(strtoupper($_POST['estado']));

        // Inserindo o endereço no banco ou pegando um endereço já existente
        $endereco->inserirEndereco();

        // Instanciando o objeto de empresa
        $empresaUser = new Empresa();

        $empresaUser->setFantasia(strtoupper($_POST['empresa']));
        $empresaUser->empresaUsuario();

        // Terminando instanciação do objeto usuário
        $usuario->setNome(strtoupper($_POST['nome']));
        $usuario->setTelefone(strtoupper($_POST['telefone']));
        $usuario->setCarro(strtoupper($_POST['carro']));
        if($_POST['password'] == '') {
            $usuario->setSenha($_POST['password']);
        } else {
            $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $retorno = verificaSenha($_POST['password']);
            if(!$retorno) {
                $dados = $usuarioDAO->retornarUsuario($id_edit);
                $empresas = $empresa->listarNomesEmps();

                $message = [
                    'message' => 'A senha não segue os padrões de segurança!',
                    'class' => 'status_error'
                ];

                return;
            }
        }
        $usuario->setEndereco($endereco);
        $usuario->setEmpresa($empresaUser);
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0 && $foto === 0 && $_FILES['foto']['size'] <= 10000000){
            $arquivo_tmp = $_FILES['foto']['tmp_name'];
            $nomeImagem = $_FILES['foto']['name'];
            $extensao = strrchr($nomeImagem, '.');
            $extensao = strtolower($extensao);
            if(strstr('.jpg;.jpeg;.png', $extensao)){
                $novoNome = md5(microtime()) .$extensao; ;
                $destino = '_images/uploads/' . $novoNome; 
                @move_uploaded_file($arquivo_tmp, $destino);
                $usuario->setFoto(strtoupper($novoNome));
            } else {
                $usuario->setFoto('');
            }
        } else {
            $usuario->setFoto('');
        }

        // Verificando se algum dado foi alterado
        if($usuario->getFoto() === '' && $usuario->getSenha() === '' && $foto === 0) {
            $message = $usuarioDAO->verificaDadoAlterado();
            if(!empty($message)) {
                $dados = $usuarioDAO->retornarUsuario($id_edit);
                $empresas = $empresa->listarNomesEmps();
                return;
            }
        }

        // Alterando usuário existente no banco
        $usuarioDAO->alterarUsuario($foto);

        $message = [
            'message' => 'Usuário alterado com sucesso!',
            'class' => 'status_success'
        ];

    } else {

        $message = [
            'message' => 'O CPF ou CNH digitados já foram registrados no Banco!',
            'class' => 'status_error'
        ];

    }
  }

  $dados = $usuarioDAO->retornarUsuario($id_edit);
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

  // Função para fazer validações dos campos preenchidos
  function validacoes() {
    $message = [];

    // Validando se dados não estão vazios
    $cont = 0;
    foreach($_POST as $data) {
        if($cont === 5 || $cont === 14) {
          $cont++;
          continue;
        }

        if($data === '') {
            $message = [
                'message' => 'Algum dado não foi preenchido corretamente!',
                'class' => 'status_error'
            ];

            return $message;
        }

        $cont++;
    }

    // Validação do CPF
    if(!validaCpf($_POST['cpf'])) {
        $message = [
            'message' => 'O CPF não é válido!',
            'class' => 'status_error'
        ];

        return $message;
    }

    // Validando se alguns dados estão conforme o especificado
    if(strlen($_POST['nome']) > 255 || strlen($_POST['cnh']) > 11 || strlen($_POST['cnh']) < 9 || strlen($_POST['carro']) > 255) {
        $message = [
            'message' => 'Algum dado não foi preenchido corretamente!',
            'class' => 'status_error'
        ];

        return $message;
    }

    // Validando telefone
    $regexCell = '/^[(]\d{2}[)]\s\d{5}-\d{4}/';
    $regexTel = '/^[(]\d{2}[)]\s\d{4}-\d{4}/';

    if(strlen($_POST['telefone']) < 14 || strlen($_POST['telefone']) > 15 || (!preg_match($regexCell, $_POST['telefone']) && !preg_match($regexTel, $_POST['telefone']))) {
        $message = [
            'message' => 'Algum dado não foi preenchido corretamente!',
            'class' => 'status_error'
        ];

        return $message;
    }

    // Verificação dos campos de endereço do usuário
    if(strlen($_POST['cep']) != 9 || strlen($_POST['rua']) > 255 || strlen($_POST['bairro']) > 255 || strlen($_POST['numero']) > 6 || strlen($_POST['cidade']) > 255 || strlen($_POST['estado']) != 2) {
        $message = [
            'message' => 'Algum dado não foi preenchido corretamente!',
            'class' => 'status_error'
        ];

        return $message;
    }

    return $message;

  }

  function verificaSenha($password) {
    if(strlen($password) < 8) {
        return false;
    }

    if(!preg_match('/\d+/', $password)) {
        return false;
    }

    if(!preg_match('/[a-z]+/', $password)) {
        return false;
    }

    if(!preg_match('/[A-Z]+/', $password)) {
        return false;
    }

    if(!preg_match('/[\'"\^~;:°?&*+@#$%!\(|\)=.,\/\\\\]/', $password)) {
        return false;
    }

    return true;
  }