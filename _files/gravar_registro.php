<?php 

    require_once '_verify/verificacaoUser.php';
    require_once '_files/gravar_usuarios.php';
    require_once '_files/gravar_empresas.php';

    $message = [];

    if($_GET['tipo'] === 'empresa') {
        $empStyle = 'cadastro_emp_active';
        $userStyle = 'cadastro_user_hidden';
        $backIndex = 'back_index_right';
        $setaCadastro = 'fi-rr-arrow-small-left';
        $h1Text = 'Mudar para Formulário de Usuários';
    } else if($_GET['tipo'] === 'usuario') {
        $userStyle = '';
        $empStyle = '';
        $backIndex = '';
        $setaCadastro = 'fi-rr-arrow-small-right';
        $h1Text = 'Mudar para Formulário de Empresas';
    } 
    
    if(isset($_POST['cpf'])) {

        $message = gravarUser();

    } else if(isset($_POST['cnpj_emp'])) {

        $message = gravarEmp();

    }

    // Variáveis de auto preenchimento do formulário de usuários
    $cpf = $_POST['cpf'] ?? '';
    $cnh = $_POST['cnh'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $rua = $_POST['rua'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $nome = $_POST['nome'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $carro = $_POST['carro'] ?? '';

    // Variáveis de auto preenchimento do formulário de empresas
    $cnpjEmp = $_POST['cnpj_emp'] ?? '';
    $cepEmp = $_POST['cep_emp'] ?? '';
    $ruaEmp = $_POST['rua_emp'] ?? '';
    $bairroEmp = $_POST['bairro_emp'] ?? '';
    $numeroEmp = $_POST['numero_emp'] ?? '';
    $cidadeEmp = $_POST['cidade_emp'] ?? '';
    $estadoEmp = $_POST['estado_emp'] ?? '';
    $nomeEmp = $_POST['nome_emp'] ?? '';
    $fantasiaEmp = $_POST['fantasia_emp'] ?? '';
    $telefoneEmp = $_POST['telefone_emp'] ?? '';
    $responsavelEmp = $_POST['responsavel_emp'] ?? '';