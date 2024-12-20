    <footer id="footer_index" class="col-12 center" style="flex-wrap: wrap; align-items: start;">
      <div class="col-12 col-lg-3 div_footer">
        <h3>Permissões</h3>
        <p><?php 
          if($_SESSION['cargo'] === 'A') {
            echo 'Você tem total acesso às funcionalidades do nosso sistema, podendo cadastrar novos usuários e empresas, editar registros já existentes e também excluí-los.';
          } else {
            echo 'Você tem acesso limitado às funcionalidades do nosso sistema, podendo utilizar os filtros disponibilizados e visualizar os dados dos registros.';
          }
        ?>
      </p>
      </div>
      <div id="infos" class="col-12 col-lg-6 div_footer">
        <h3>Informações</h3>
        <p>Este é um site voltado a mostrar um sistema de cadastro de empresas e funcionários utilizando a Linguagem de Marcação HTML5, a Lignuagem de Estilização CSS3, as Linguagens de Programação JavaScript e PHP e para manipulação do Banco de Dados a Linguagem MySQL.</p>
      </div>
      <div class="col-12 col-lg-3 div_footer">
        <h3>Contato</h3>
        <div id="icons_footer">
          <a href="https://www.instagram.com/feliipegodoyy/profilecard/?igsh=MXA4Y3lzenNoeTd3cQ==" target="_blank" class="a_icons"><i class="fi fi-brands-instagram icons_rs"></i></a>
          <a href="https://web.whatsapp.com/send?phone=5519998174730" target="_blank" class="a_icons"><i class="fi fi-brands-whatsapp icons_rs"></i></a>
          <a href="https://www.facebook.com/felipe.ricardopiresdegodoy?mibextid=ZbWKwL" target="_blank" class="a_icons"><i class="fi fi-brands-facebook icons_rs"></i></a>
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
        echo '<a href="cadastro.php?tipo=usuario" id="btn_adicionar" class="center"><i id="add_symbol" class="fi fi-rr-plus center"></i></a>';
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