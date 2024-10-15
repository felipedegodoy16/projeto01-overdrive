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

    <title>Login - Overdrive</title>
  </head>
  <script src="_js/login.js"></script>
  <body id="full_content_login">
    <main id="main_login" class="center">
      <div id="form_login" class="center">
        <h1 id="title_login">LOGIN</h1>
        <form id="form" action="login.php" method="post">
          <div id="user_field" style="margin-bottom: 0;">
            <label for="user_login">Usuário</label>
            <input id="user_login" type="text" oninput="transition_text(event.target)" onclick="transition_text(event.target)" required>
            <div style="z-index: 1002; height: 0">
              <i class="icon-user icons"></i>
            </div>
          </div>
          <div id="password_field" style="margin-top: 0;">
            <label for="password_login">Senha</label>
            <input id="password_login" type="password" oninput="transition_text(event.target), change_icon()" onclick="transition_text(event.target), change_icon()" required>
            <div style="z-index: 1002;">
              <i id="icon_password" class="icon-lock2 icons" onclick="show_password(event.target)"></i>
            </div>
          </div>
          <div class="center">
            <input id="btn_login" type="submit" value="Entrar">
          </div>
          <!-- <div class="center">
            <details id="details_login" style="width: 25dvw; font-size: clamp(12px, 4dvw, 28);">
              <summary id="summary_login">Usuários para teste</summary>
              <div class="center" style="flex-direction: column;">
                <p>Admin: XXXXXXXXXXX - Senha: 1234</p>
                <p>Usuário: XXXXXXXXXXX - Senha: 1234</p>
              </div>
            </details>
          </div> -->
        </form>
        <img id="img_logo" src="_images/overdrive_logo.png" alt="">
      </div>
    </main>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>