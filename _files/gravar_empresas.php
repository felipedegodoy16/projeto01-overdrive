<?php 

    require_once '_class/EmpresaDAO.php';
    require_once '_class/EnderecoDAO.php';

    function gravarEmp() {

        // Chamando função para fazer algumas validações dos campos do formulário
        $message = validacoesEmp();

        if(!empty($message)) {
            return $message;
        }

        $cnpjEmp = strtoupper($_POST['cnpj_emp']);
        $cepEmp = strtoupper($_POST['cep_emp']);
        $ruaEmp = strtoupper($_POST['rua_emp']);
        $bairroEmp = strtoupper($_POST['bairro_emp']);
        $numeroEmp = strtoupper($_POST['numero_emp']);
        $cidadeEmp = strtoupper($_POST['cidade_emp']);
        $estadoEmp = strtoupper($_POST['estado_emp']);
        $nomeEmp = strtoupper($_POST['nome_emp']);
        $fantasiaEmp = strtoupper($_POST['fantasia_emp']);
        $telefoneEmp = strtoupper($_POST['telefone_emp']);
        $responsavelEmp = strtoupper($_POST['responsavel_emp']);

        // Instanciando um novo objeto empresa
        $empresa = new Empresa();
        $empresaDAO = new EmpresaDAO($empresa);

        $empresa->setCnpj($cnpjEmp);

        $verificarCnpj = $empresaDAO->verificaCnpj();

        date_default_timezone_set("America/Sao_Paulo");

        if($verificarCnpj === -1){

            // Instanciado o objeto endereço com as informações passadas
            $endereco = new Endereco();
            $enderecoDAO = new EnderecoDAO($endereco);

            $endereco->setCep($cepEmp);
            $endereco->setRua($ruaEmp);
            $endereco->setBairro($bairroEmp);
            $endereco->setNumero($numeroEmp);
            $endereco->setCidade($cidadeEmp);
            $endereco->setEstado($estadoEmp);

            // Inserindo o endereço no banco ou pegando um endereço já existente
            $enderecoDAO->inserirEndereco();

            // Finalizando a instanciação do objeto empresa
            $empresa->setNome($nomeEmp);
            $empresa->setFantasia($fantasiaEmp);
            $empresa->setTelefone($telefoneEmp);
            $empresa->setResponsavel($responsavelEmp);
            $empresa->setEndereco($endereco);
            if(isset($_FILES['foto_emp']['name']) && $_FILES['foto_emp']['error'] == 0 && $_FILES['foto_emp']['size'] <= 10000000){
                $arquivo_tmp = $_FILES['foto_emp']['tmp_name'];
                $nomeImagem = $_FILES['foto_emp']['name'];
                $extensao = strrchr($nomeImagem, '.');
                $extensao = strtolower($extensao);
                if(strstr('.jpg;.jpeg;.png', $extensao)){
                    $novoNome = md5(microtime()) .$extensao; ;
                    $destino = '_images/uploads/' . $novoNome; 
                    @move_uploaded_file($arquivo_tmp, $destino);
                    $empresa->setFoto(strtoupper($novoNome));
                } else {
                    $empresa->setFoto('');
                }
            } else {
                $empresa->setFoto('');
            }
            $empresa->setRegistro(date("y/m/d"));

            // Inserindo a empresa no bacno
            $empresaDAO->inserirEmpresa();

            $_POST['cnpj_emp'] = null;
            $_POST['cep_emp'] = null;
            $_POST['rua_emp'] = null;
            $_POST['bairro_emp'] = null;
            $_POST['numero_emp'] = null;
            $_POST['cidade_emp'] = null;
            $_POST['estado_emp'] = null;
            $_POST['nome_emp'] = null;
            $_POST['fantasia_emp'] = null;
            $_POST['telefone_emp'] = null;
            $_POST['responsavel_emp'] = null;

            $message = [
                'message' => 'Empresa cadastrada com sucesso!',
                'class' => 'status_success'
            ];

            return $message;

        } else {

            $message = [
                'message' => 'O CNPJ digitado já foi registrado no Banco!',
                'class' => 'status_error'
            ];

            return $message;

        }

    }

    // Validar numero de CNPJ
    function validaCnpj($cnpj) {

        // Verificar se foi informado
        if(empty($cnpj))
            return false;

        // Remover caracteres especias
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Verifica se o numero de digitos informados
        if (strlen($cnpj) != 14)
            return false;

            // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;

        $b = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

            for ($i = 0, $n = 0; $i < 12; $n += $cnpj[$i] * $b[++$i]);

            if ($cnpj[12] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
                return false;
            }

            for ($i = 0, $n = 0; $i <= 12; $n += $cnpj[$i] * $b[$i++]);

            if ($cnpj[13] != ((($n %= 11) < 2) ? 0 : 11 - $n)) {
                return false;
            }

        return true;
    }

    // Função para fazer validações dos campos preenchidos
    function validacoesEmp() {

        $message = [];

        // Verificando se nenhum campo foi deixado em branco
        foreach($_POST as $data) {
            if($data === '') {
                $message = [
                    'message' => 'Algum dado não foi preenchido corretamente!',
                    'class' => 'status_error'
                ];
    
                return $message;
            }
        }

        // Validando formatação do CNPJ
        $regexCnpj = '/^[0-9]{2}\.[0-9]{3}\.[0-9]{3}\/[0-9]{4}\-[0-9]{2}/';

        if(!preg_match($regexCnpj, $_POST['cnpj_emp'])) {
            $message = [
                'message' => 'O CNPJ não está formatado corretamente!',
                'class' => 'status_error'
            ];

            return $message;
        }

        // Validação do CNPJ
        if(!validaCnpj($_POST['cnpj_emp'])) {
            $message = [
                'message' => 'O CNPJ não é válido!',
                'class' => 'status_error'
            ];

            return $message;
        }

        // Verificação dos campos da empresa
        if(strlen($_POST['nome_emp']) > 255 || strlen($_POST['fantasia_emp']) > 255 || strlen($_POST['responsavel_emp']) > 255) {
            $message = [
                'message' => 'Algum dado não foi preenchido corretamente!',
                'class' => 'status_error'
            ];

            return $message;
        }

        // Validando telefone
        $regexCell = '/^[(]\d{2}[)]\s\d{5}-\d{4}/';
        $regexTel = '/^[(]\d{2}[)]\s\d{4}-\d{4}/';

        if(strlen($_POST['telefone_emp']) < 14 || strlen($_POST['telefone_emp']) > 15 || (!preg_match($regexCell, $_POST['telefone_emp']) && !preg_match($regexTel, $_POST['telefone_emp']))) {
            $message = [
                'message' => 'Algum dado não foi preenchido corretamente!',
                'class' => 'status_error'
            ];

            return $message;
        }

        // Verificação dos campos de endereço da empresa
        if(strlen($_POST['cep_emp']) != 9 || strlen($_POST['rua_emp']) > 255 || strlen($_POST['bairro_emp']) > 255 || strlen($_POST['numero_emp']) > 6 || strlen($_POST['cidade_emp']) > 255 || strlen($_POST['estado_emp']) != 2) {
            $message = [
                'message' => 'Algum dado não foi preenchido corretamente!',
                'class' => 'status_error'
            ];

            return $message;
        }

        return $message;
    }