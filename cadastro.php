<?php 
  $_SESSION['cargo'] = 'A';

  $_SESSION['logged'] = true ?? false;

  if(!$_SESSION['logged']) {
    header('Location: login.php');
  }

  if($_SESSION['cargo'] === 'C') {
    header('Location: index.php');
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
      <div id="seta_index">
        <a href="index.php"><i id="back_index" class="fi fi-rr-arrow-small-left center"></i></a>
      </div>
      <div id="cadastro_emp" class="cadastro col-12 col-md-8 center">
        <h1>Cadastrar Empresa</h1>
        <form class="form_cadastro" action="" method="post">
            <div class="column_left">
                <p>
                    <label for="id_nome_emp">Nome</label>
                    <input type="text" name="nome_emp" id="id_nome_emp" maxlength="255" placeholder="Digite o Nome" required>
                </p>
                <p>
                    <label for="id_fantasia_emp">Nome Fantasia</label>
                    <input type="text" name="fantasia_emp" id="id_fantasia_emp" maxlength="255" placeholder="Digite o Nome Fantasia" required>
                </p>
                <p>
                    <label for="id_cnpj_emp">CNPJ</label>
                    <input type="text" name="cnpj_emp" id="id_cnpj_emp" maxlength="18" placeholder="Digite o CNPJ" required>
                </p>
                <p id="p_telefone_emp">
                    <label for="id_telefone_emp">Telefone</label>
                    <input type="text" name="telefone_emp" id="id_telefone_emp" maxlength="15" placeholder="Digite o Telefone" required> 
                </p>
                <p>
                    <label for="id_responsavel_emp">Reponsável</label>
                    <input type="text" name="responsavel_emp" id="id_responsavel_emp" placeholder="Digite o Responsável" required>
                </p>
            </div>

            <div class="address_data">
                <p>
                    <label for="id_cep_emp">CEP</label>
                    <input type="text" name="cep_emp" id="id_cep_emp" maxlength="9" placeholder="Digite o CEP" required>
                </p>
                <p>
                    <label for="id_rua_emp">Rua</label>
                    <input type="text" name="rua_emp" id="id_rua_emp" placeholder="Digite a Rua" required>
                </p>
                <p>
                    <label for="id_bairro_emp">Bairro</label>
                    <input type="text" name="bairro_emp" id="id_bairro_emp" placeholder="Digite o Bairro" required>
                </p>
                <p>
                    <label for="id_numero_emp">Numero</label>
                    <input type="text" name="numero_emp" id="id_numero_emp" min="0" placeholder="Digite o Número" required> 
                </p>
                <p>
                    <label for="id_cidade_emp">Cidade</label>
                    <input type="text" name="cidade_emp" id="id_cidade_emp" placeholder="Digite a Cidade" required>
                </p>
                <p>
                    <label for="id_estado_emp">Estado (UF)</label>
                    <input type="text" name="estado_emp" id="id_estado_emp" maxlength="2" placeholder="Exemplo: SP, RJ..." required>
                </p>
            </div>
            <p class="center p_btn_cadastrar" style="flex-direction: row;">
                <button onclick="changeForm()">Trocar Formulário</button>
                <input type="submit" class="btn_form" value="Cadastrar">
            </p>
        </form>
      </div>
      <div id="call_another_form" class="col-12 col-md-4 center">
        <h1 id="text_change_form">Mudar para Formulário de Empresas</h1>
        <i id="seta_cadastro" class="fi fi-rr-arrow-small-right center" onclick="changeForm()"></i>
      </div>
      <div id="cadastro_user" class="cadastro col-12 col-md-8 center">
        <h1>Cadastrar Usuário</h1>
        <form class="form_cadastro" action="" method="post">
            <div class="column_left">
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

            <div class="address_data">
                <p>
                    <label for="id_cep">CEP</label>
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
            <p class="center p_btn_cadastrar" style="flex-direction: row;">
                <button onclick="changeForm()">Trocar Formulário</button>
                <input type="submit" class="btn_form" value="Cadastrar">
            </p>
        </form>
      </div>
    </main>

    <!-- Meus scrips JS -->
    <script src="_js/cep.js"></script>
    <script src="_js/cadastro.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>