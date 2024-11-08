<?php 

    if(strlen($_POST['password']) < 8 || strlen($_POST['cpf']) != 14 || strlen($_POST['cnh']) != 9 || strlen($_POST['cep']) != 9 || strlen($_POST['numero']) > 6) {
        echo "<script>
            alert('Algum dado não foi preenchido corretamente!')
            window.location='../cadastro.php'
        </script>";
        return;
    }

    foreach($_POST as $data) {
        if($data === '') {
            echo "<script>
                alert('Algum dado não foi preenchido corretamente!')
                window.location='../cadastro.php'
            </script>";
            return;
        }
    }

    require_once '../_verify/verificacaoFilesAdmin.php';
    require_once '../_class/Usuario.php';

    // Instanciando um objeto usuário
    $usuario = new Usuario();

    $usuario->setCpf(strtoupper($_POST['cpf']));
    $usuario->setCnh(strtoupper($_POST['cnh']));

    $verificaDados = $usuario->verificaDados();
    // $verificaDados = -1;

    date_default_timezone_set("America/Sao_Paulo");

    if($verificaDados === -1) {

        // Instanciado o objeto endereço com as informações passadas
        $endereco = new Endereco();

        $endereco->setCep(strtoupper($_POST['cep']));
        $endereco->setRua(strtoupper($_POST['rua']));
        $endereco->setBairro(strtoupper($_POST['bairro']));
        $endereco->setNumero(strtoupper($_POST['numero']));
        $endereco->setCidade(strtoupper($_POST['cidade']));
        $endereco->setEstado(strtoupper($_POST['estado']));

        // Inserindo o endereço no banco ou pegando um endereço já existente
        $endereco->inserirEndereco();

        // Finalizando a instanciação do usuário
        $usuario->setNome(strtoupper($_POST['nome']));
        $usuario->setTelefone(strtoupper($_POST['telefone']));
        $usuario->setCarro(strtoupper($_POST['carro']));
        $usuario->setCargo('C');
        $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
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
        $usuario->setRegistro(date("y/m/d"));

        // Inserindo usuário no banco
        $usuario->inserirUsuario();

        echo "<script>
            alert('Usuário cadastrado com sucesso!')
            window.location='../cadastro.php'
        </script>";

    } else {

        echo "<script>
            alert('O CPF ou a CNH digitados já foram registrados no Banco')
            history.back()
        </script>";
        
    }