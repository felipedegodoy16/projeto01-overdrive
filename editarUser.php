<?php require_once '_verify/verificacaoEditUser.php'; ?>

<!DOCTYPE html>
<html lang="pt-br" onmouseup="verificaTel(this.target)">
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

  <body id="full_content_cadastro" class="center">
    <main class="col-10 center" style="justify-content: center; color: var(--red-dark);">
        <div id="cadastro_user" class="cadastro col-12 col-md-8 center" style="border-radius: 40px; box-shadow: 10px 10px 20px #000; display: flex;">
            <a href="index.php"><i id="back_index" class="fi fi-rr-arrow-small-left center" style="left: 0;"></i></a>
            <h1 style="z-index: 1010;">Editar Usuário</h1>
            <form class="form_cadastro" action="<?= $_SERVER["PHP_SELF"] . '?&id=' . $id_edit . '&edit=1' ?>" method="post" enctype="multipart/form-data">
                <div class="column_left">
                    <p>
                        <label for="id_nome">Nome</label>
                        <input type="text" name="nome" id="id_nome" maxlength="255" placeholder="Digite o Nome" value="<?= $dados[0]['nome'] ?>" required>
                    </p>
                    <p>
                        <label for="id_cpf">CPF</label>
                        <input type="text" data-mask="000.000.000-00" name="cpf" id="id_cpf" minlength="14" maxlength="14" placeholder="Digite o CPF" value="<?= $dados[0]['cpf'] ?>" oninput="validacoesCpf()" required>
                        <small id="cpfTeste"></small>
                    </p>
                    <p>
                        <label for="id_cnh">CNH</label>
                        <input type="text" data-mask="000000000" name="cnh" id="id_cnh" minlength="9" maxlength="9" placeholder="Digite a CNH" value="<?= $dados[0]['cnh'] ?>" required>
                    </p>
                    <p id="p_telefone">
                        <label for="id_telefone">Telefone</label>
                        <input type="text" data-mask="(00) 00000-0000" name="telefone" id="id_telefone"minlength="15" maxlength="15" placeholder="Digite o Telefone" value="<?= $dados[0]['telefone'] ?>" onmouseup="verificaTel(this.target)" required> 
                    </p>
                    <p>
                        <label for="id_carro">Carro</label>
                        <input type="text" name="carro" id="id_carro" maxlength="255" placeholder="Digite o Carro" value="<?= $dados[0]['carro'] ?>" required>
                    </p>
                    <p style="position: relative;">
                        <label for="id_password">Senha</label>
                        <input type="password" name="password" id="id_password" placeholder="Digite a Senha" min="8">
                        <small>Mínimo 8 caracteres</small>
                        <i id="eye_cadastro" class="fi fi-rr-eye icon-eye" onclick="revealPassword()"></i>
                    </p>
                    <p>
                        <label for="id_empresa">Empresa</label>
                        <select name="empresa" id="id_empresa">
                            <?php foreach($empresas as $empresa => $nome):

                                if($nome['fantasia'] === $dados[0]['empresa']): ?>
                                    <option value="<?= $nome['fantasia'] ?>" selected><?= $nome['fantasia'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $nome['fantasia'] ?>"><?= $nome['fantasia'] ?></option>
                                <?php endif ?>

                            <?php endforeach ?>

                            <?php if($dados[0]['empresa'] === 'INATIVO'): ?>
                                <option value="INATIVO" selected>INATIVO</option>
                            <?php else: ?>
                                <option value="INATIVO">INATIVO</option>
                            <?php endif ?>

                        </select>
                    </p>
                </div>

                <div class="address_data">
                    <p>
                        <label for="id_cep">CEP</label>
                        <input type="text" data-mask="00000-000" name="cep" id="id_cep" minlength="9" maxlength="9" placeholder="Digite o CEP" value="<?= $dados[0]['cep'] ?>" required>
                        <small id="cepTeste"></small>
                    </p>
                    <p>
                        <label for="id_rua">Rua</label>
                        <input type="text" name="rua" id="id_rua" maxlength="255" placeholder="Digite a Rua" value="<?= $dados[0]['rua'] ?>" required>
                    </p>
                    <p>
                        <label for="id_bairro">Bairro</label>
                        <input type="text" name="bairro" id="id_bairro" maxlength="255" placeholder="Digite o Bairro" value="<?= $dados[0]['bairro'] ?>" required>
                    </p>
                    <p>
                        <label for="id_numero">Numero</label>
                        <input type="text" data-mask="000000" name="numero" id="id_numero" placeholder="Digite o Número" value="<?= $dados[0]['numero'] ?>" required> 
                    </p>
                    <p>
                        <label for="id_cidade">Cidade</label>
                        <input type="text" name="cidade" id="id_cidade" maxlength="255" placeholder="Digite a Cidade" value="<?= $dados[0]['cidade'] ?>" required>
                    </p>
                    <p>
                        <label for="id_estado">Estado (UF)</label>
                        <input type="text" name="estado" id="id_estado"minlength="2" maxlength="2" placeholder="Exemplo: SP, RJ..." value="<?= $dados[0]['estado'] ?>" required>
                    </p>
                    <p>
                        <label for="id_foto" class="label_foto" style="margin-top: 1em;">Escolher arquivo</label>
                        <input type="file" name="foto" id="id_foto" style="margin-top: 1em; border-bottom: none; display: none;">
                    </p>
                </div>
                <p class="center p_btn_cadastrar" style="flex-direction: row;">
                    <input id="btn_cadastrar" type="submit" class="btn_form" value="Editar">
                </p>
            </form>
        </div> 
    </main>

    <!-- Meus scrips JS -->
    <script src="_js/editarCep.js"></script>
    <script src="_js/editar.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>