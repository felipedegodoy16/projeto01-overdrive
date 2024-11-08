<?php
  require_once '_verify/verificacaoIndex.php';
  require_once '_files/logout.php';
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

    <!-- Link icons flaticon -->
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet' href='https://cdn-uicons.flaticon.com/2.6.0/uicons-brands/css/uicons-brands.css'>

    <!-- Link para Favicon -->
    <link rel="shortcut icon" href="_images/favicon_io/favicon.ico" type="image/x-icon">

    <title>Overdrive - Consultas</title>
  </head>

  <!-- <body class="transition_section"> -->
  <body>
    <header>
      <nav id="navbar" class="center" style="justify-content: space-between;">
        <img src="_images/overdrive_logo.png" alt="Logo na Navbar" width="100px" height="auto" style="padding: .7em;">
        <i id="menu_icon" class="fi fi-rr-menu-burger icon_menu" onclick="callMenu(event.target)"></i>
        <div id="menu_hamburguer" class="center">
          <ul>
            <li class="active li_navbar" onclick="both()">Todos</li>
            <li class="li_navbar" onclick="onlyFuncs()">Funcionários</li>
            <li class="li_navbar" onclick="onlyEmps()">Empresas</li>
          </ul>
          <a id="btn_logout" href="?logout=1">SAIR</a>
        </div>
      </nav>
    </header>