<?php 

    require_once '_class/UsuarioDAO.php';

    function gravarUser() {
    
        date_default_timezone_set("America/Sao_Paulo");

        // Chamando função para fazer validação dos campos preenchidos
        $message = validacoesUser();

        if(!empty($message)) {
            return $message;
        }

        // Verificando se a senha segue os padrões de segurança
        $retorno = verificaSenha($_POST['password']);
        if(!$retorno) {
            $message = [
                'message' => 'A senha não segue os padrões de segurança!',
                'class' => 'status_error'
            ];

            return $message;
        }

        $cpf = strtoupper($_POST['cpf']);
        $cnh = strtoupper($_POST['cnh']);
        $cep = strtoupper($_POST['cep']);
        $rua = strtoupper($_POST['rua']);
        $bairro = strtoupper($_POST['bairro']);
        $numero = strtoupper($_POST['numero']);
        $cidade = strtoupper($_POST['cidade']);
        $estado = strtoupper($_POST['estado']);
        $nome = strtoupper($_POST['nome']);
        $telefone = strtoupper($_POST['telefone']);
        $carro = strtoupper($_POST['carro']);

        // Instanciando um objeto usuário e objeto usuárioDAO
        $usuario = new Usuario();
        $usuarioDAO = new UsuarioDAO($usuario);

        $usuario->setCpf($cpf);
        $usuario->setCnh($cnh);

        $verificaDados = $usuarioDAO->verificaDados();

        if($verificaDados === -1) {

            // Instanciado o objeto endereço com as informações passadas
            $endereco = new Endereco();

            $endereco->setCep($cep);
            $endereco->setRua($rua);
            $endereco->setBairro($bairro);
            $endereco->setNumero($numero);
            $endereco->setCidade($cidade);
            $endereco->setEstado($estado);

            // Inserindo o endereço no banco ou pegando um endereço já existente
            $endereco->inserirEndereco();

            // Instanciando o objeto de empresa
            $empresa = new Empresa();

            $empresa->setFantasia(strtoupper($_POST['empresa']));
            $empresa->empresaUsuario();

            // Finalizando a instanciação do usuário
            $usuario->setNome($nome);
            $usuario->setTelefone($telefone);
            $usuario->setCarro($carro);
            $usuario->setCargo('C');
            $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
            $usuario->setEndereco($endereco);
            $usuario->setEmpresa($empresa);
            if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0 && $_FILES['foto']['size'] <= 10000000) {
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
            $usuario->setRegistro(date("y/m/d"));

            // Inserindo usuário no banco
            $usuarioDAO->inserirUsuario();

            $_POST['cpf'] = null;
            $_POST['cnh'] = null;
            $_POST['cep'] = null;
            $_POST['rua'] = null;
            $_POST['bairro'] = null;
            $_POST['numero'] = null;
            $_POST['cidade'] = null;
            $_POST['estado'] = null;
            $_POST['nome'] = null;
            $_POST['telefone'] = null;
            $_POST['carro'] = null;

            $message = [
                'message' => 'Usuário cadastrado com sucesso!',
                'class' => 'status_success'
            ];

            return $message;

        } else {

            $message = [
                'message' => 'O CPF ou a CNH digitados já foram registrados no Banco!',
                'class' => 'status_error'
            ];

            return $message;
            
        }
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
    function validacoesUser() {

        $message = [];

        // Validando se dados não estão vazios
        foreach($_POST as $data) {
            if($data === '') {
                $message = [
                    'message' => 'Algum dado não foi preenchido corretamente!',
                    'class' => 'status_error'
                ];
    
                return $message;
            }
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
        if(strlen($_POST['nome']) > 255 || strlen($_POST['cnh']) != 9 || strlen($_POST['telefone']) < 14 || strlen($_POST['telefone']) > 15 || strlen($_POST['carro']) > 255) {
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