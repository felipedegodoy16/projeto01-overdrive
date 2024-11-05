<?php 
require_once '../_class/Empresa.php';

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
    $empresa->setRegistro(date("y/m/d"));

    // Inserindo a empresa no bacno
    $empresa->inserirEmpresa();

    echo "<script>
        alert('Empresa cadastrada com sucesso!')
        window.location='../cadastro.php'
    </script>";

} else {

    echo "<script>
        alert('O CNPJ digitado já foi registrado no Banco')
        history.back()
    </script>";

}