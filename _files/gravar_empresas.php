<?php 
require_once '../_class/Empresa.php';

// Instanciando um novo objeto empresa
$empresa = new Empresa();

$empresa->setCnpj($_POST['cnpj_emp']);

$verificarCnpj = $empresa->verificaCnpj();

if($verificarCnpj === -1){

    // Instanciado o objeto endereço com as informações passadas
    $endereco = new Endereco();

    $endereco->setCep(preg_replace( '/[^0-9]/is', '', $_POST['cep_emp']));
    $endereco->setRua($_POST['rua_emp']);
    $endereco->setBairro($_POST['bairro_emp']);
    $endereco->setNumero($_POST['numero_emp']);
    $endereco->setCidade($_POST['cidade_emp']);
    $endereco->setEstado($_POST['estado_emp']);

    // Inserindo o endereço no banco ou pegando um endereço já existente
    $endereco->inserirEndereco();

    // Finalizando a instanciação do objeto empresa
    $empresa->setNome($_POST['nome_emp']);
    $empresa->setFantasia($_POST['fantasia_emp']);
    $empresa->setTelefone(preg_replace( '/[^0-9]/is', '', $_POST['telefone_emp']));
    $empresa->setResponsavel($_POST['responsavel_emp']);
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
            $empresa->setFoto($novoNome);
        } else {
            $empresa->setFoto('');
        }
    } else {
        $empresa->setFoto('');
    }

    // Inserindo a empresa no bacno
    $empresa->inserirEmpresa();

} else {

    echo "<script>
        alert('O CNPJ digitado já foi registrado no Banco')
        history.back()
    </script>";

}