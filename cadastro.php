<?php require_once '_files/gravar_registro.php'; ?>

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

    <!-- Link icons flaticon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css'>

    <!-- Link para Favicon -->
    <link rel="shortcut icon" href="_images/favicon_io/favicon.ico" type="image/x-icon">

    <title>Overdrive - Cadastro</title>
  </head>

  <?php if(!empty($message)): ?>
    <div id="request_cadastro" class="center status_cadastro <?= $message['class'] ?>" style="display: flex;">
      <p id="p_status_request" style="margin: 0; text-align: center;"><?= $message['message'] ?></p>
    </div>
  <?php endif; ?>

  <body id="full_content_cadastro" class="center" style="flex-direction: column;">
    <main id="main_cadastro" class="col-10 center">
      <div id="seta_index">
        <a href="index.php"><i id="back_index" class="fi fi-rr-arrow-small-left center <?= $backIndex ?>"></i></a>
      </div>
      <div id="cadastro_emp" class="cadastro col-12 col-md-8 center transition_section <?= $empStyle ?>">
        <h1>Cadastrar Empresa</h1>
        <form class="form_cadastro" action="<?= $_SERVER['PHP_SELF'] . "?tipo=empresa" ?>" method="post" enctype="multipart/form-data">
            <div class="column_left">
                <p>
                    <label for="id_cnpj_emp">CNPJ</label>
                    <input type="text" name="cnpj_emp" id="id_cnpj_emp" minlength="18" maxlength="18" placeholder="Digite o CNPJ" value="<?= $cnpjEmp ?>" required>
                    <small id="cnpjTeste"></small>
                </p>
                <p>
                    <label for="id_nome_emp">Razão Social</label>
                    <input type="text" name="nome_emp" id="id_nome_emp" maxlength="255" placeholder="Digite a Razão Social" value="<?= $nomeEmp ?>" required>
                </p>
                <p>
                    <label for="id_fantasia_emp">Fantasia</label>
                    <input type="text" name="fantasia_emp" id="id_fantasia_emp" maxlength="255" placeholder="Digite o Nome Fantasia" value="<?= $fantasiaEmp ?>" required>
                </p>
                <p id="p_telefone_emp">
                    <label for="id_telefone_emp">Telefone</label>
                    <input type="text" name="telefone_emp" id="id_telefone_emp" minlength="10" maxlength="15" placeholder="Digite o Telefone" value="<?= $telefoneEmp ?>" onfocus="tirarFormat(this)" oninput="removeChar(this)" required>
                </p>
                <p>
                    <label for="id_responsavel_emp">Reponsável</label>
                    <input type="text" name="responsavel_emp" id="id_responsavel_emp" maxlength="255" placeholder="Digite o Responsável" value="<?= $responsavelEmp ?>" required>
                </p>
                <p>
                    <label for="id_foto_emp" class="label_foto" style="margin-top: .5em;">Escolher arquivo</label>
                    <input type="file" name="foto_emp" id="id_foto_emp" style="margin-top: 1em; border-bottom: none; display: none;">
                </p>
            </div>

            <div class="address_data">
                <p>
                    <label for="id_cep_emp">CEP</label>
                    <input type="text" data-mask="00000-000" name="cep_emp" id="id_cep_emp" minlength="9" maxlength="9" placeholder="Digite o CEP" value="<?= $cepEmp ?>" required>
                    <small id="cepTesteEmp"></small>
                </p>
                <p>
                    <label for="id_rua_emp">Rua</label>
                    <input type="text" name="rua_emp" id="id_rua_emp" maxlength="255" placeholder="Digite a Rua" value="<?= $ruaEmp ?>" required>
                </p>
                <p>
                    <label for="id_bairro_emp">Bairro</label>
                    <input type="text" name="bairro_emp" id="id_bairro_emp" maxlength="255" placeholder="Digite o Bairro" value="<?= $bairroEmp ?>" required>
                </p>
                <p>
                    <label for="id_numero_emp">Numero</label>
                    <input type="text" name="numero_emp" id="id_numero_emp" maxlength="6" placeholder="Digite o Número" value="<?= $numeroEmp ?>" required> 
                </p>
                <p>
                    <label for="id_cidade_emp">Cidade</label>
                    <input type="text" name="cidade_emp" id="id_cidade_emp" maxlength="255" placeholder="Digite a Cidade" value="<?= $cidadeEmp ?>" required>
                </p>
                <p>
                    <label for="id_estado_emp">Estado (UF)</label>
                    <input type="text" name="estado_emp" id="id_estado_emp" minlength="2" maxlength="2" placeholder="Exemplo: SP, RJ..." value="<?= $estadoEmp ?>" required>
                </p>
            </div>
            <p class="center p_btn_cadastrar" style="flex-direction: row;">
                <button onclick="changeForm()" class="btn_habilitado" style="text-transform: uppercase;">Trocar Formulário</button>
                <input type="submit" class="btn_form btn_habilitado" id="btn_cadastrar_emp" value="Cadastrar">
            </p>
        </form>
      </div>
      <div id="call_another_form" class="col-12 col-md-4 center">
        <h1 id="text_change_form"><?= $h1Text ?></h1>
        <i id="seta_cadastro" class="fi center <?= $setaCadastro ?>" onclick="changeForm()"></i>
      </div>
      <div id="cadastro_user" class="cadastro col-12 col-md-8 center transition_section <?= $userStyle ?>">
        <h1>Cadastrar Usuário</h1>
        <form class="form_cadastro" action="<?= $_SERVER['PHP_SELF'] . "?tipo=usuario" ?>" method="post" enctype="multipart/form-data">
            <div class="column_left">
                <p>
                    <label for="id_nome">Nome</label>
                    <input type="text" name="nome" id="id_nome" maxlength="255" placeholder="Digite o Nome" value="<?= $nome ?>" required>
                </p>
                <p>
                    <label for="id_cpf">CPF</label>
                    <input type="text" data-mask="000.000.000-00" name="cpf" id="id_cpf" minlength="14" maxlength="14" placeholder="Digite o CPF" value="<?= $cpf ?>" required>
                    <small id="cpfTeste"></small>
                </p>
                <p>
                    <label for="id_cnh">CNH</label>
                    <input type="text" data-mask="000000000" name="cnh" id="id_cnh" minlength="9" maxlength="9" placeholder="Digite a CNH" value="<?= $cnh ?>" required>
                </p>
                <p id="p_telefone">
                    <label for="id_telefone">Telefone</label>
                    <input type="text" name="telefone" id="id_telefone" minlength="10" maxlength="15" placeholder="Digite o Telefone" value="<?= $telefoneEmp ?>" onfocus="tirarFormat(this)" oninput="removeChar(this)" required>
                </p>
                <p>
                    <label for="id_carro">Carro</label>
                    <input type="text" name="carro" id="id_carro" maxlength="255" placeholder="Digite o Carro" value="<?= $carro ?>" required>
                </p>
                <p>
                    <label for="id_empresa">Empresa</label>
                    <select name="empresa" id="id_empresa">
                        <option value="INATIVO" selected>INATIVO</option>
                    </select>
                </p>
                <p style="position: relative;">
                    <label for="id_password">Senha</label>
                    <input type="password" name="password" id="id_password" placeholder="DIGITE A SENHA" minlength="8" required style="text-transform: none;">
                    <i id="eye_cadastro" class="fi fi-rr-eye icon-eye"></i>
                    <div id="passwordTips" style="display: none;">
                        <ul>
                            <li class="tip"><i class="fi fi-rr-x icon-tip center"></i> Mínimo 8 caracteres</li>
                            <li class="tip"><i class="fi fi-rr-x icon-tip center"></i> Letras Maiúsculas e Minúsculas</li>
                            <li class="tip"><i class="fi fi-rr-x icon-tip center"></i> Números</li>
                            <li class="tip"><i class="fi fi-rr-x icon-tip center"></i> Caractere especial</li>
                        </ul>
                    </div>
                </p>
                <p style="position: relative;">
                    <label for="id_password_confirm">Confirmar Senha</label>
                    <input type="password" name="password_confirm" id="id_password_confirm" placeholder="CONFIRME A SENHA" minlength="8" required style="text-transform: none;">
                    <i id="eye_cadastro_confirm" class="fi fi-rr-eye icon-eye"></i>
                    <small id="smallConfirm"></small>
                </p>
            </div>

            <div class="address_data">
                <p>
                    <label for="id_cep">CEP</label>
                    <input type="text" data-mask="00000-000" name="cep" id="id_cep" minlength="9" maxlength="9" placeholder="Digite o CEP" value="<?= $cep ?>" required>
                    <small id="cepTesteUser"></small>
                </p>
                <p>
                    <label for="id_rua">Rua</label>
                    <input type="text" name="rua" id="id_rua" maxlength="255" placeholder="Digite a Rua" value="<?= $rua ?>" required>
                </p>
                <p>
                    <label for="id_bairro">Bairro</label>
                    <input type="text" name="bairro" id="id_bairro" maxlength="255" placeholder="Digite o Bairro" value="<?= $bairro ?>" required>
                </p>
                <p>
                    <label for="id_numero">Numero</label>
                    <input type="text" name="numero" id="id_numero" maxlength="6" placeholder="Digite o Número" value="<?= $numero ?>" required> 
                </p>
                <p>
                    <label for="id_cidade">Cidade</label>
                    <input type="text" name="cidade" id="id_cidade" maxlength="255" placeholder="Digite a Cidade" value="<?= $cidade ?>" required>
                </p>
                <p>
                    <label for="id_estado">Estado (UF)</label>
                    <input type="text" name="estado" id="id_estado"minlength="2" maxlength="2" placeholder="Exemplo: SP, RJ..." value="<?= $estado ?>" required>
                </p>
                <p>
                    <label for="id_foto" class="label_foto" style="margin-top: 1em;">Escolher arquivo</label>
                    <input type="file" name="foto" id="id_foto" style="margin-top: 1em; border-bottom: none; display: none;">
                </p>
            </div>
            <p class="center p_btn_cadastrar" style="flex-direction: row;">
                <button onclick="changeForm()" class="btn_habilitado" style="text-transform: uppercase;">Trocar Formulário</button>
                <input id="btn_cadastrar_user" type="submit" class="btn_form btn_habilitado" value="Cadastrar">
            </p>
        </form>
      </div>
    </main>

    <!-- Meus scrips JS -->
    <script src="_js/cadastro.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>