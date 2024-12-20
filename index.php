<?php include_once "_templates/header.php"; ?>

    <main id="main_index" class="col-12 center">

      <div id="status_request" class="center error_status" style="justify-content: space-between;"><p id="p_status_request" style="margin: 0;"></p><i id="close_status" class="fi fi-rr-x center" onclick="closeStatus()"></i></div>

      <div id="alter_view" class="center"><div class="center"><a href="editarUser.php?id=<?=$_SESSION['id']?>" id="btn_edit_user">Editar meu Usuário!</a></div><div class="center"><i class="icons_view fi fi-rr-table-tree center icon_table" onclick="alterView(event)"></i><i class="icons_view fi fi-rr-rectangle-vertical center icon_ret active_view" onclick="alterView(event)"></i></div></div>

      <div id="id_session" style="display: none;"><?=$_SESSION['id']?></div>

      <div id="section_users" class="col-12 center transition_section" style="justify-content: flex-start;"></div>

      <div id="section_emps" class="col-12 center transition_section" style="justify-content: flex-start;"></div>

    </main>

    <aside id="aside_index" class="col-6 col-sm-4 col-md-3 col-lg-2">
      <div id="filtro" class="center">
        <h1>Filtros</h1>
        <i class="fi fi-rr-bars-filter icon_filtro"></i>
      </div>
      <ul id="lst_filtros">
        <li class="input-wrapper center" style="cursor: auto;">
          <label for="search" class="sr-only">Filtrar Nome, CPF, CNPJ ou Empresa</label>
          <input type="text" id="search" placeholder="Nome, CPF, CNPJ ou Empresa">
          <i class="fi fi-rr-search" style="margin-left: 5px;"></i>
        </li>
        <li class="active_filtro li_filtros" onclick="requestDados()">Registro</li>
        <li class="li_filtros" onclick="listarCardsOrdem('registro', 'DESC')">Recente</li>
        <li class="li_filtros" onclick="listarCardsOrdem('nome', 'ASC')">A - Z</li>
        <li class="li_filtros" onclick="listarCardsOrdem('nome', 'DESC')">Z - A</li>
        <li class="li_filtros" onclick="listarCardsOrdem('cidade', 'ASC')">Cidade</li>
        <li class="li_filtros" onclick="listarCardsOrdem('estado', 'ASC')">Estado</li>
      </ul>
    </aside>

<?php include_once "_templates/footer.php"; ?>