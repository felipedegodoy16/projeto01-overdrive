<?php 

  session_start();

  $_SESSION['logged'] = $_SESSION['logged'] ?? false;

  if(!$_SESSION['logged']) {
    header('Location: login.php');
  }

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

    <main id="main_index" class="col-12 center">

      <div id="section_users" class="col-12 center transition_section"></div>

      <div id="section_emps" class="col-12 center transition_section"></div>
      
    </main>

    <aside id="aside_index" class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div id="filtro" class="center">
        <h1>Filtros</h1>
        <i class="fi fi-rr-bars-filter icon_filtro"></i>
      </div>
      <ul id="lst_filtros">
        <li class="#">Pesquisar</li>
        <li class="active_filtro li_filtros">Categoria</li>
        <li class="li_filtros">A - Z</li>
        <li class="li_filtros">Z - A</li>
        <li class="li_filtros">Gênero</li>
        <li class="li_filtros">Empresa</li>
      </ul>
    </aside>

    <footer id="footer_index" class="col-12 center" style="flex-wrap: wrap; align-items: start;">
      <div class="col-12 col-lg-3 div_footer">
        <h3>Navegar</h3>
        <ul id="lst_footer">
          <li style="display: block;">Todos</li>
          <li style="display: block;">Funcionários</li>
          <li style="display: block;">Empresas</li>
        </ul>
      </div>
      <div id="infos" class="col-12 col-lg-6 div_footer">
        <h3>Informações</h3>
        <p>Este é um site voltado a mostrar um sistema de cadastro de empresas e funcionários utilizando a Linguagem de Marcação HTML5, a Lignuagem de Estilização CSS3, as Linguagens de Programação JavaScript e PHP e para manipulação do Banco de Dados a Linguagem MySQL.</p>
      </div>
      <div class="col-12 col-lg-3 div_footer">
        <h3>Contato</h3>
        <div id="icons_footer">
          <a href="#" target="_blank" class="a_icons"><i class="fi fi-brands-instagram icons_rs"></i></a>
          <a href="#" target="_blank" class="a_icons"><i class="fi fi-brands-whatsapp icons_rs"></i></a>
          <a href="#" target="_blank" class="a_icons"><i class="fi fi-brands-facebook icons_rs"></i></a>
          <a href="https://github.com/felipedegodoy16" target="_blank" class="a_icons"><i class="fi fi-brands-github icons_rs"></i></a>
        </div>
      </div>
      <div class="col-10 center footer_name">
        <p style="margin-bottom: 0;">&copy; Felipe Godoy | 2024</p>
      </div>
    </footer>

    <p id="btn_filtros" class="center" onclick="callFilters()"><i id="filter_symbol" class="fi fi-rr-bars-filter center"></i></p>
    <?php 
      if($_SESSION['cargo'] === 'A') {
        echo '<a href="cadastro.php" id="btn_adicionar" class="center"><i id="add_symbol" class="fi fi-rr-plus center"></i></a>';
      }
    ?>

    <!-- Meus scrips JS -->
    <script src="_js/navbar.js"></script>
    <script src="_js/main.js"></script>
    <script src="_js/requestDados.js"></script>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>