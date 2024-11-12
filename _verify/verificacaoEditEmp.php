<?php 

  require_once '_class/Empresa.php';
  require_once '_verify/verificacaoUser.php';

  $edit = (bool) $_GET['edit'];
  $id_edit = $_GET['id'];

  $empresa = new Empresa();
  $endereco = new Endereco();

    if($edit) {

        // Validando dados preenchidos no formulário
        validacoes();

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
        if(strlen($_POST['cep']) != 9 || strlen($_POST['rua']) > 255 || strlen($_POST['bairro']) > 255 || strlen($_POST['numero']) > 6 || strlen($_POST['cidade']) > 255 || strlen($_POST['estado']) != 2) {
            echo "<script>  
                alert('Algum dado não foi preenchido corretamente!')
                window.location=history.back()
            </script>";
            exit();
        }
    }