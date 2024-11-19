<?php 

    require_once '_verify/verificacaoUser.php';
    require_once '_files/gravar_usuarios.php';
    require_once '_files/gravar_empresas.php';

    $message = [];

    // Variáveis de auto preenchimento do formulário de empresas
    // $cpf = $_POST['cpf'] ?? '';
    // $cnh = $_POST['cnh'] ?? '';
    // $cep = $_POST['cep'] ?? '';
    // $rua = $_POST['rua'] ?? '';
    // $bairro = $_POST['bairro'] ?? '';
    // $numero = $_POST['numero'] ?? '';
    // $cidade = $_POST['cidade'] ?? '';
    // $estado = $_POST['estado'] ?? '';
    // $nome = $_POST['nome'] ?? '';
    // $telefone = $_POST['telefone'] ?? '';
    // $carro = $_POST['carro'] ?? '';
    
    if(isset($_POST['cpf'])) {

        $message = [];
        $message = gravarUser($message);

    } else if(isset($_POST['cnpj_emp'])) {

        $message = [];
        $message = gravarEmp($message);

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