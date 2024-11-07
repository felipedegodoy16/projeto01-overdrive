<?php 

  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoUser.php';

  $edit = (bool) $_GET['edit'];
  $id_edit = $_GET['id'];

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

        $empresa->setId($id_edit);
        $empresa->setCnpj(strtoupper($_POST['cnpj_emp']));
        $empresa->setNome(strtoupper($_POST['nome_emp']));
        $empresa->setFantasia(strtoupper($_POST['fantasia_emp']));
        $empresa->setTelefone(strtoupper($_POST['telefone']));
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

    $dados = $empresa->retornarEmpresa($id_edit);

    if($dados === -1) {
        echo "<script>
            alert('O id dessa empresa não existe!')
            window.location='index.php'
        </script>";
    }