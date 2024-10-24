<?php 
require_once '../_class/Usuario.php';

// Instanciando um objeto usuário
$usuario = new Usuario();

$usuario->setCpf($_POST['cpf']);
$usuario->setCnh($_POST['cnh']);

$verificaDados = $usuario->verificaDados();

if($verificaDados === -1) {

    // Instanciado o objeto endereço com as informações passadas
    $endereco = new Endereco();

    $endereco->setCep($_POST['cep']);
    $endereco->setRua($_POST['rua']);
    $endereco->setBairro($_POST['bairro']);
    $endereco->setNumero($_POST['numero']);
    $endereco->setCidade($_POST['cidade']);
    $endereco->setEstado($_POST['estado']);

    // Inserindo o endereço no banco ou pegando um endereço já existente
    $endereco->inserirEndereco();

    // Finalizando a instanciação do usuário
    $usuario->setNome($_POST['nome']);
    $usuario->setTelefone($_POST['telefone']);
    $usuario->setCarro($_POST['carro']);
    $usuario->setCargo('C');
    $usuario->setSenha(password_hash($_POST['password'], PASSWORD_DEFAULT));
    $usuario->setEndereco($endereco);
    $usuario->setEmpresa($_POST['empresa']);
    if(isset($_FILES['foto']['name']) && $_FILES['foto']['error'] == 0){
        $arquivo_tmp = $_FILES['foto']['tmp_name'];
        $nomeImagem = $_FILES['foto']['name'];
        $extensao = strrchr($nomeImagem, '.');
        $extensao = strtolower($extensao);
        if(strstr('.jpg;.jpeg;.png', $extensao)){
            $novoNome = md5(microtime()) .$extensao; ;
            $destino = '../_images/uploads/' . $novoNome; 
            @move_uploaded_file($arquivo_tmp, $destino);
            $usuario->setFoto($novoNome);
        } else {
            $usuario->setFoto('');
        }
    } else {
        $usuario->setFoto('');
    }

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