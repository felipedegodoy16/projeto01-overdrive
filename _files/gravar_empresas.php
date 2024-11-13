<?php 

    require_once '../_verify/verificacaoFilesAdmin.php';
    require_once '../_class/Empresa.php';

    // Chamando função para fazer algumas validações dos campos do formulário
    validacoes();

    // Instanciando um novo objeto empresa
    $empresa = new Empresa();

    $empresa->setCnpj(strtoupper($_POST['cnpj_emp']));

    $verificarCnpj = $empresa->verificaCnpj();

    date_default_timezone_set("America/Sao_Paulo");

    if($verificarCnpj === -1){

        // Instanciado o objeto endereço com as informações passadas
        $endereco = new Endereco();

        $endereco->setCep(strtoupper($_POST['cep_emp']));
        $endereco->setRua(strtoupper($_POST['rua_emp']));
        $endereco->setBairro(strtoupper($_POST['bairro_emp']));
        $endereco->setNumero(strtoupper($_POST['numero_emp']));
        $endereco->setCidade(strtoupper($_POST['cidade_emp']));
        $endereco->setEstado(strtoupper($_POST['estado_emp']));

        // Inserindo o endereço no banco ou pegando um endereço já existente
        $endereco->inserirEndereco();

        // Finalizando a instanciação do objeto empresa
        $empresa->setNome(strtoupper($_POST['nome_emp']));
        $empresa->setFantasia(strtoupper($_POST['fantasia_emp']));
        $empresa->setTelefone(strtoupper($_POST['telefone_emp']));
        $empresa->setResponsavel(strtoupper($_POST['responsavel_emp']));
        $empresa->setEndereco($endereco);
        if(isset($_FILES['foto_emp']['name']) && $_FILES['foto_emp']['error'] == 0 && $_FILES['foto_emp']['size'] < 10000000){
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
        $empresa->setRegistro(date("y/m/d"));

        // Inserindo a empresa no bacno
        $empresa->inserirEmpresa();

        echo "<script>
            alert('Empresa cadastrada com sucesso!')
            window.location='../cadastro.php'
        </script>";
        exit();

    } else {

        echo "<script>
            alert('O CNPJ digitado já foi registrado no Banco')
            window.location=history.back()
        </script>";
        exit();

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
    function validacoes() {

        // Verificando se nenhum campo foi deixado em branco
        foreach($_POST as $data) {
            if($data === '') {
                echo "<script>
                    alert('Algum dado não foi preenchido corretamente!')
                    window.location=history.back()
                </script>";
                exit();
            }
        }

        // Validação do CNPJ
        if(!validaCnpj($_POST['cnpj_emp'])) {
            echo "<script>
                alert('O CNPJ não é válido!')
                window.location=history.back()
            </script>";
            exit();
        }

        // Verificação dos campos da empresa
        if(strlen($_POST['nome_emp']) > 255 || strlen($_POST['fantasia_emp']) > 255 || strlen($_POST['telefone_emp']) != 15 || strlen($_POST['responsavel_emp']) > 255) {
            echo "<script>  
                alert('Algum dado não foi preenchido corretamente!')
                window.location=history.back()
            </script>";
            exit();
        }

        // Verificação dos campos de endereço da empresa
        if(strlen($_POST['cep_emp']) != 9 || strlen($_POST['rua_emp']) > 255 || strlen($_POST['bairro_emp']) > 255 || strlen($_POST['numero_emp']) > 6 || strlen($_POST['cidade_emp']) > 255 || strlen($_POST['estado_emp']) != 2) {
            echo "<script>  
                alert('Algum dado não foi preenchido corretamente!')
                window.location=history.back()
            </script>";
            exit();
        }
    }