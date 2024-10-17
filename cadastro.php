<?php 
  $_SESSION['cargo'] = 'A';

  $_SESSION['logged'] = true ?? false;
  if(!$_SESSION['logged']) {
    header('Location: login.php');
  }

  if($_SESSION['cargo'] === 'C') {
    if($_SESSION['logged']) {
        header('Location: index.php');
    } else {
        header('Location: login.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Link meu CSS -->
    <link rel="stylesheet" href="_css/style.css">

    <!-- Link para icons -->
    <link href="_css/icomoon.css"rel="stylesheet">

    <!-- Link icons flaticon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css'>

    <!-- Link para Favicon -->
    <link rel="shortcut icon" href="_images/favicon_io/favicon.ico" type="image/x-icon">

    <title>Overdrive - Cadastro</title>
  </head>

  <body id="full_content_cadastro" class="center">
    <main id="main_cadastro" class="col-10 center">
      <div id="call_empresa" class="col-4 center">
        <h1>Mudar Formulário de Empresas</h1>
        <i id="seta_cadastro" class="fi fi-rr-arrow-small-right center"></i>
      </div>
      <div id="cadastro_user" class="col-8 center">
        <h1>Cadastrar Usuário</h1>
        <form id="form_cadastro" action="" method="post">
            <div id="user_data">
                <p>
                    <label for="id_nome">Nome</label>
                    <input type="text" name="nome" id="id_nome" maxlength="255" placeholder="Digite o Nome" required>
                </p>
                <p>
                    <label for="id_cpf">CPF</label>
                    <input type="text" name="cpf" id="id_cpf" maxlength="14" placeholder="Digite o CPF" required>
                </p>
                <p>
                    <label for="id_cnh">CNH</label>
                    <input type="text" name="cnh" id="id_cnh" maxlength="9" placeholder="Digite a CNH" required>
                </p>
                <p id="p_telefone">
                    <label for="id_telefone">Telefone</label>
                    <input type="text" name="telefone" id="id_telefone" maxlength="15" placeholder="Digite o Telefone" required> 
                </p>
                <p>
                    <label for="id_carro">Carro</label>
                    <input type="text" name="carro" id="id_carro" placeholder="Digite o Carro" required>
                </p>
                <p>
                    <label for="id_password">Senha</label>
                    <input type="password" name="password" id="id_password" placeholder="Digite a Senha" min="8" required>
                    <small>Mínimo 8 caracteres</small>
                </p>
                <p>
                    <label for="id_empresa">Empresa</label>
                    <input type="text" name="empresa" id="id_empresa" list="empresas" placeholder="Digite a Empresa" required>
                    <datalist id="empresas">
                        <option value="Rio de Janeiro"></option>
                        <option value="Noova Iguaçu"></option>
                        <option value="Niterói"></option>
                        <option value="Inativo"></option>
                    </datalist>
                </p>
            </div>

            <div id="address_data">
                <p>
                    <label for="">CEP</label>
                    <input type="text" name="cep" id="id_cep" maxlength="9" placeholder="Digite o CEP" required>
                </p>
                <p>
                    <label for="id_rua">Rua</label>
                    <input type="text" name="rua" id="id_rua" placeholder="Digite a Rua" required>
                </p>
                <p>
                    <label for="id_bairro">Bairro</label>
                    <input type="text" name="bairro" id="id_bairro" placeholder="Digite o Bairro" required>
                </p>
                <p>
                    <label for="id_numero">Numero</label>
                    <input type="text" name="numero" id="id_numero" min="0" placeholder="Digite o Número" required> 
                </p>
                <p>
                    <label for="id_cidade">Cidade</label>
                    <input type="text" name="cidade" id="id_cidade" placeholder="Digite a Cidade" required>
                </p>
                <p>
                    <label for="id_estado">Estado (UF)</label>
                    <input type="text" name="estado" id="id_estado" maxlength="2" placeholder="Exemplo: SP, RJ..." required>
                </p>
            </div>
            <p id="p_btn_cadastrar" class="center">
                <input type="submit" id="btn_cadastrar" value="Cadastrar">
            </p>
        </form>
      </div>
    </main>

    <!-- Meus scrips JS -->
    <script src="_js/main.js"></script>
    <script src="_js/cep.js"></script>
    <script src="_js/cadastro.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>