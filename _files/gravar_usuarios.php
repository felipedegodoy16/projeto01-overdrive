<?php 

    require_once '../_verify/verificacaoFilesAdmin.php'; 
    require_once '../_class/Usuario.php';
    
    date_default_timezone_set("America/Sao_Paulo");

    // Chamando função para fazer validação dos campos preenchidos
    validacoes();

    // Instanciando um objeto usuário
    $usuario = new Usuario();

    $usuario->setCpf(strtoupper($_POST['cpf']));
    $usuario->setCnh(strtoupper($_POST['cnh']));

    $verificaDados = $usuario->verificaDados();

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

        // Instanciando o objeto de empresa
        $empresa = new Empresa();

        $empresa->setFantasia(strtoupper($_POST['empresa']));
        $empresa->empresaUsuario();

        // Finalizando a instanciação do usuário
        $usuario->setNome(strtoupper($_POST['nome']));
        $usuario->setTelefone(strtoupper($_POST['telefone']));
        $usuario->setCarro(strtoupper($_POST['carro']));
        $usuario->setCargo('C');
        $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
        $usuario->setEndereco($endereco);
        $usuario->setEmpresa($empresa);
        if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0 || $_FILES['foto']['size'] > 10000000) {
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
        exit();

    } else {

        echo "<script>
            alert('O CPF ou a CNH digitados já foram registrados no Banco')
            history.back()
        </script>";
        exit();
        
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

        // Validando se dados não estão vazios
        foreach($_POST as $data) {
            if($data === '') {
                echo "<script>
                    alert('Algum dado não foi preenchido corretamente!')
                    window.location=history.back()
                </script>";
                exit();
            }
        }

        // Validação do CPF
        if(!validaCpf($_POST['cpf'])) {
            echo "<script>
                alert('O CPF não é válido!')
                window.location=history.back()
            </script>";
            exit();
        }

        // Validando se alguns dados estão conforme o especificado
        if(strlen($_POST['nome']) > 255 || strlen($_POST['cnh']) != 9 || strlen($_POST['telefone']) != 15 || strlen($_POST['carro']) > 255 || strlen($_POST['password']) < 8) {
            echo "<script>
                alert('Algum dado não foi preenchido corretamente!')
                window.location=history.back()
            </script>";
            exit();
        }

        // Verificação dos campos de endereço do usuário
        if(strlen($_POST['cep']) != 9 || strlen($_POST['rua']) > 255 || strlen($_POST['bairro']) > 255 || strlen($_POST['numero']) > 6 || strlen($_POST['cidade']) > 255 || strlen($_POST['estado']) != 2) {
            echo "<script>  
                alert('Algum dado não foi preenchido corretamente!')
                window.location=history.back()
            </script>";
            exit();
        }
    }
    