<?php require_once '_verify/verificacaoLogin.php'; ?>

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
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

    <!-- Link para Favicon -->
    <link rel="shortcut icon" href="_images/favicon_io/favicon.ico" type="image/x-icon">

    <title>Overdrive - Login</title>
  </head>
  
  <body id="full_content_login">
    <main id="main_login" class="center">
      <div id="form_login" class="center">
        <h1 id="title_login">LOGIN</h1>
        <form id="form" action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
          <div id="user_field" style="margin-bottom: 0;">
            <label for="user_login">CPF</label>
            <input id="user_login" data-mask="000.000.000-00" name="user_input" type="text" onfocus="transition_text(event.target)" onclick="transition_text(event.target)" minlength="14" maxlength="14" value="<?=$usuario?>" required>
            <div style="z-index: 1002; height: 0">
              <i class="fi fi-rr-circle-user icons"></i>
            </div>
          </div>
          <div id="password_field" style="margin-top: 0;">
            <label for="password_login">Senha</label>
            <input id="password_login" name="password_input" type="password" onfocus="transition_text(event.target), change_icon()" onclick="transition_text(event.target), change_icon()" minlength="8" maxlength="64" required>
            <div style="z-index: 1002;">
              <i id="icon_password" class="fi fi-rr-lock icons" onclick="show_password(event.target)"></i>
            </div>
          </div>
          <?php 
            if($status === 0){
              echo '
              <div id="error_status" class="center error_status">
                <p style="margin: 0;">CPF e/ou senha incorreto(s)!</p>
              </div>';
            }
          ?>
          <div id="div_btn_login" class="center">
            <input id="btn_login" type="submit" value="Entrar">
          </div>
        </form>
        <img id="img_logo" src="_images/overdrive_logo.png" alt="">
      </div>
    </main>

    <!-- Meus scripts JS -->
    <script src="_js/login.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>