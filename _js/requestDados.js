if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready(){

  requestDados()

}

function requestDados(){
  let url = 'http://localhost/projeto01-overdrive/_files/requestDados.php'
  let xhr = new XMLHttpRequest()
  xhr.open('GET', url, true)
  xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
          if (xhr.status == 200) {
            responseJson(JSON.parse(xhr.responseText))
          }
      }
  }
  xhr.send();
}

function responseJson(json){
  const divUsers = document.getElementById('section_users')
  const divEmps = document.getElementById('section_emps')
  const activeView = document.getElementsByClassName('active_view')[0]

  const formatter = Intl.DateTimeFormat("pt-BR", {
    dateStyle: "short"
  })

  var tag = ''
  divUsers.innerHTML = ''
  divEmps.innerHTML = ''

  if(json.error){
    const main = document.getElementById('main_index')

    main.innerHTML = '<p style="margin: 0; color: var(--red-dark); font-size: 35pt; margin-bottom: 2em;">Ainda não há dados registrados no banco!</p>'

  } else {

    divUsers.innerHTML +=
    `
      <div class="title_sections center col-12">
        <div class="col-md-4 line"></div>
          <h1 class="col-12 col-md-4 h1_sections">Funcionários</h1>
        <div class="col-md-4 line"></div>
      </div>
    `

    divEmps.innerHTML +=
    `
      <div class="title_sections center col-12">
        <div class="col-md-4 line"></div>
          <h1 class="col-12 col-md-4 h1_sections">Empresas</h1>
        <div class="col-md-4 line"></div>
      </div>
    `

    if(json.usuarios !== -1){

      if(activeView.classList.contains('icon_table')) {
        var table = 
        `
        <div class="table-responsive" style="text-transform: uppercase; margin-bottom: 2em;">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">CPF</th>
                <th scope="col">CNH</th>
                <th scope="col">Telefone</th>
                <th scope="col">Carro</th>
                <th scope="col">Empresa</th>
                <th scope="col">Endereço</th>
                <th scope="col">Registro</th>
              </tr>
            </thead>
          <tbody>
        `

        json.usuarios.map(function(usuario){  
          table +=
          `
          <tr class="filter_table">
            <th scope="row">${usuario.id}</th>
            <td class="name">${usuario.nome}</td>
            <td class="cpf_cnpj">${usuario.cpf}</td>
            <td>${usuario.cnh}</td>
            <td>${usuario.telefone}</td>
            <td>${usuario.carro}</td>
            <td class="empresa">${usuario.empresa}</td>
            <td>${usuario.rua}, ${usuario.numero} - ${usuario.bairro}, ${usuario.cidade} - ${usuario.estado}, ${usuario.cep}</td>
            <td>${formatter.format(Date.parse(usuario.registro + 'UTC-3'))}</td>
          </tr>
          `
        })

        table +=
        `
            </tbody>
          </table>
        </div>
        `

        divUsers.innerHTML += table
          
      } else {
        json.usuarios.map(function(usuario){

          var heightAdmin = `min-height: 420px;`

          if(json.sessao === 'A') {
            tag = `<p class="center" style="margin-top: .7em; margin-bottom: 1.5em;"><i class="fi fi-rr-trash icons_cards center icon_trash user_trash"></i><a href="editarUser.php?id=${usuario.id}" style="text-decoration: none;"><i class="fi fi-rr-edit icons_cards center icon_edit"></i></a></p>`

            heightAdmin = `min-height: 500px;`
          }
  
          if(usuario.foto != null){
            var foto = usuario.foto
          } else {
            var foto = 'fotoUser.jpg'
          }
  
          divUsers.innerHTML +=
          `
          <div class="col-10 col-sm-6 col-md-4 col-lg-3">
            <div class="center card_register" style="justify-content: space-between; flex-direction: column; ${heightAdmin}">
              <img class="img_user_emp" src="_images/uploads/${foto}" alt="Imagem do Usuário ou Empresa">
              <div class="card_user_body" style="padding-bottom: 2em;">
                <header>
                  <p style="position: absolute; padding: 0; left: 1em; top: 1em;">#${usuario.id}</p>
                </header>
                <p style="margin-top: 4.5em;" class="name">Nome: ${usuario.nome}</p>
                <p class="cpf_cnpj">CPF: ${usuario.cpf}</p>
                <p>CNH: ${usuario.cnh}</p>
                <p>Telefone: ${usuario.telefone}</p>
                <p>Carro: ${usuario.carro}</p>
                <p class="empresa">Empresa: ${usuario.empresa}</p>
                <details style="margin-bottom: .4em;">
                  <summary>Endereço</summary>
                  <p style="margin: .4em 0;">${usuario.rua}, ${usuario.numero} - ${usuario.bairro}</p>
                  <p>${usuario.cidade} - ${usuario.estado}, ${usuario.cep}</p>
                </details>
                <p>Registro: ${formatter.format(Date.parse(usuario.registro + 'UTC-3'))}</p>
              </div>
              ${tag}
            </div>
          </div>
          `
        })
      }

    } else {

      divUsers.innerHTML += '<p style="margin: 0; color: var(--red-dark); font-size: 35pt; margin-bottom: 2em;">Não há registros de usuários ainda.</p>'

    }

    if(json.empresas !== -1){

      if(activeView.classList.contains('icon_table')) {
        var table = 
        `
        <div class="table-responsive" style="text-transform: uppercase; margin-bottom: 2em;">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Razão Social</th>
                <th scope="col">Fantasia</th>
                <th scope="col">CNPJ</th>
                <th scope="col">Telefone</th>
                <th scope="col">Responsável</th>
                <th scope="col">Endereço</th>
                <th scope="col">Registro</th>
              </tr>
            </thead>
          <tbody>
        `

        json.empresas.map(function(empresa){  
          if(empresa.fantasia !== "INATIVO") {
            table +=
            `
            <tr class="filter_table">
              <th scope="row">${empresa.id}</th>
              <td class="name">${empresa.nome}</td>
              <td class="empresa">${empresa.fantasia}</td>
              <td class="cpf_cnpj">${empresa.cnpj}</td>
              <td>${empresa.telefone}</td>
              <td>${empresa.responsavel}</td>
              <td>${empresa.rua}, ${empresa.numero} - ${empresa.bairro}, ${empresa.cidade} - ${empresa.estado}, ${empresa.cep}</td>
              <td>${formatter.format(Date.parse(empresa.registro + 'UTC-3'))}</td>
            </tr>
            `
          }
        })
        table +=
        `
            </tbody>
          </table>
        </div>
        `

        divEmps.innerHTML += table
          
      } else {

        json.empresas.map(function(empresa){

          var heightAdmin = `min-height: 420px;`

          if(empresa.fantasia !== "INATIVO") {
            if(json.sessao === 'A') {
              tag = `<p class="center" style="margin-top: .7em; margin-bottom: 1.5em;"><i class="fi fi-rr-trash icons_cards center icon_trash emp_trash"></i><a href="editarEmp.php?id=${empresa.id}" style="text-decoration: none;"><i class="fi fi-rr-edit icons_cards center icon_edit"></i></a></p>`

              heightAdmin = `min-height: 500px;`
            }
    
            if(empresa.foto != null){
              var foto = empresa.foto
            } else {
              var foto = 'fotoEmp.jpg'
            }
    
            divEmps.innerHTML +=
            `
            <div class="col-10 col-sm-6 col-md-4 col-lg-3">
              <div class="center card_register" style="justify-content: space-between; flex-direction: column; ${heightAdmin}">
                <img class="img_user_emp" src="_images/uploads/${foto}" alt="Imagem do Usuário ou Empresa">
                <div class="card_user_body" style="padding-bottom: 2em;">
                  <header>
                    <p style="position: absolute; padding: 0; left: 1em; top: 1em;">#${empresa.id}</p>
                  </header>
                  <p style="margin-top: 4.5em;" class="name">Razão: ${empresa.nome}</p>
                  <p class="empresa">Fantasia: ${empresa.fantasia}</p>
                  <p class="cpf_cnpj">CNPJ: ${empresa.cnpj}</p>
                  <p>Telefone: ${empresa.telefone}</p>
                  <p>Responsável: ${empresa.responsavel}</p>
                  <details style="margin-bottom: .4em;">
                    <summary>Endereço</summary>
                    <p style="margin: .4em 0;">${empresa.rua}, ${empresa.numero} - ${empresa.bairro}</p>
                    <p>${empresa.cidade} - ${empresa.estado}, ${empresa.cep}</p>
                  </details>
                  <p>Registro: ${formatter.format(Date.parse(empresa.registro + 'UTC-3'))}</p>
                </div>
                ${tag}
              </div>
            </div>
            `
          }

        })

      }

    } else {

      divEmps.innerHTML += '<p style="margin: 0; color: var(--red-dark); font-size: 35pt; margin-bottom: 2em;">Não há registros de empresas ainda.</p>'

    }

    addEvents()

    createFilter()

  }
}

function addEvents(){

  // Adicionar eventos de entrada e saída de mouse do card
  var cards = document.getElementsByClassName('card_register')
  for(let i = 0; i < cards.length; i++){
    // Adicionando evento de mouse entrando no elemento
    cards[i].addEventListener("mouseenter", transitionCard)

    // Adicionar evento de mouse deixando o elemento
    cards[i].addEventListener("mouseleave", backCard)
  }

  // Adicionando evento de remoção de dado dos usuários
  var iconsRemoveUsers = document.getElementsByClassName('user_trash')
  for(let i = 0; i < iconsRemoveUsers.length; i++){
    iconsRemoveUsers[i].addEventListener("click", removeDataUsers)
  }

  // Adicionando evento de remoção de dado das empresas
  var iconsRemoveEmps = document.getElementsByClassName('emp_trash')
  for(let i = 0; i < iconsRemoveEmps.length; i++){
    iconsRemoveEmps[i].addEventListener("click", removeDataEmps)
  }

}

// Função para card em destaque
function transitionCard(event){
  e = event.target

  if(e.classList.contains('back_card')){
    e.classList.add('transition_card')
    e.classList.remove('back_card')
  } else {
    e.classList.add('transition_card')
  }
}

// Função para voltar o card
function backCard(event){
  e = event.target

  if(e.classList.contains('transition_card')){
    e.classList.add('back_card')
    e.classList.remove('transition_card')
  }
}

// Função para remoção do registro de usuários
function removeDataUsers(event){
  const divStatus = document.getElementById('status_request')
  const pStatus = document.getElementById('p_status_request')
  const idSession = document.getElementById('id_session').innerText
  const search = document.getElementById('search')
  let idRemove = event.target.parentNode.parentNode.children[1].children[0].children[0].innerText.replace('#', '')

  if(idSession == idRemove){

    pStatus.innerText = `Não é possível remover o seu próprio usuário.`

    window.scrollTo(0, 0)
    divStatus.style.display = 'flex'

  } else {

    let comando = prompt("Por favor, confirme a instrução (DELETE) para excluir os registros do usuário.")

    if(comando === 'DELETE'){

      window.scrollTo(0, 0)
      divStatus.style.display = 'flex'

      let url = 'http://localhost/projeto01-overdrive/_files/removeData.php?id=' + idRemove + '&tipo=usuario'
      let xhr = new XMLHttpRequest()
      xhr.open('GET', url, true)
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {

            json = JSON.parse(xhr.responseText)

            if(json.status){

              pStatus.innerText = `${json.message}`
              divStatus.classList.add('status_accept')
              search.value = ''
              requestDados()

            } else {

              pStatus.innerText = `${json.message}`

            }
          }
        }
      }
      xhr.send();

    } else if(comando !== null && comando !== 'DELETE') {

      window.scrollTo(0, 0)
      divStatus.style.display = 'flex'

      pStatus.innerText = `Não foi possível remover o usuário.`

    }
  }
}

// Função para remoção do registro de empresas
function removeDataEmps(event){
  const divStatus = document.getElementById('status_request')
  const pStatus = document.getElementById('p_status_request')
  const search = document.getElementById('search')
  let idRemove = event.target.parentNode.parentNode.children[1].children[0].children[0].innerText.replace('#', '')
  let comando = prompt("Por favor, confirme a instrução (DELETE) para excluir os registros da empresa.")

  if(comando === 'DELETE') {

    window.scrollTo(0, 0)
    divStatus.style.display = 'flex'

    let url = 'http://localhost/projeto01-overdrive/_files/removeData.php?id=' + idRemove + '&tipo=empresa'
    let xhr = new XMLHttpRequest()
    xhr.open('GET', url, true)
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {

          json = JSON.parse(xhr.responseText)

          if(json.status){

            pStatus.innerText = `${json.message}`
            divStatus.classList.add('status_accept')
            search.value = ''
            requestDados()

          } else {

            pStatus.innerText = `${json.message}`

          }
        }
      }
    }
    xhr.send();

  } else if(comando !== null && comando !== 'DELETE') {

    window.scrollTo(0, 0)
    divStatus.style.display = 'flex'

    pStatus.innerText = `Não foi possível remover a empresa.`

  }
}

// Função para fechar status
function closeStatus(){
  const divStatus = document.getElementById('status_request')

  divStatus.style.display = 'none'
  divStatus.classList.remove('status_accept')
}

// Função para fazer o filtro de pesquisa
function createFilter(){
  const filterElement = document.getElementById('search')

  filterElement.addEventListener('input', filterElements)
}

// Função para filtrar elementos
function filterElements(){
  const activeView = document.getElementsByClassName('active_view')[0]

  if(activeView.classList.contains('icon_table')) {
    filterTable()
  } else {
    filterCards()
  }
}

// Função para filtrar cards
function filterCards() {
  const filterElement = document.getElementById('search')
  const cards = document.getElementsByClassName('card_register')

  if(filterElement.value != '') {
    for(let card of cards) {
      let nome = card.getElementsByClassName('name')[0]
      nome = nome.textContent.replace('Nome: ', '').toLowerCase()

      let cpfCnpj = card.getElementsByClassName('cpf_cnpj')[0]
      cpfCnpj = cpfCnpj.textContent.replace('CPF: ', '').replace('CNPJ: ', '').replace('.', '').replace('.', '').replace('/', '').replace('-', '').toLowerCase()

      let empresa = card.getElementsByClassName('empresa')[0]
      empresa = empresa.textContent.replace('Empresa: ', '').replace('Fantasia: ', '').toLowerCase()

      let filterText = filterElement.value.replace('.', '').replace('.', '').replace('/', '').replace('-', '').toLowerCase()

      if(!nome.includes(filterText) && !cpfCnpj.includes(filterText) && !empresa.includes(filterText)) {
        card.classList.remove('back_card')
        card.classList.add('transition_section')
        card.parentNode.style.display = 'none'
      } else {
        card.parentNode.style.display = 'block'
      }
    }
  } else {
    for(let card of cards) {
      card.parentNode.style.display = 'block'
    }
  }
}

// Função para filtrar linhas da tabela
function filterTable() {
  const filterElement = document.getElementById('search')
  const lines = document.getElementsByClassName('filter_table')

  if(filterElement.value != ''){
    for(let line of lines){
      let nome = line.getElementsByClassName('name')[0]
      nome = nome.textContent.toLowerCase()

      let cpfCnpj = line.getElementsByClassName('cpf_cnpj')[0]
      cpfCnpj = cpfCnpj.textContent.replace('.', '').replace('.', '').replace('/', '').replace('-', '').toLowerCase()

      let filterText = filterElement.value.replace('.', '').replace('.', '').replace('/', '').replace('-', '').toLowerCase()

      if(!nome.includes(filterText) && !cpfCnpj.includes(filterText)){
        line.style.display = 'none'
      } else{
        line.style.display = ''
      }
    }
  } else{
    for(let line of lines){
      line.style.display = ''
    }
  }
}

// Função para fazer filtro de ordem
function listarCardsOrdem(campo, ordem) {
  const search = document.getElementById('search')
  let url = 'http://localhost/projeto01-overdrive/_files/orderFilters.php?campo=' + campo + '&ordem=' + ordem  
  let xhr = new XMLHttpRequest()
  xhr.open('GET', url, true)
  xhr.onreadystatechange = function() {
    if (xhr.readyState == 4) {
      if (xhr.status == 200) {
        search.value = ''
        responseJson(JSON.parse(xhr.responseText))
      }
    }
  }
  xhr.send();
}

//Função para alterar visualização dos registros
function alterView(event) {

  if(!event.target.classList.contains('active_view')) {

    var obj_active = document.getElementsByClassName('active_view')[0]
    obj_active.classList.remove('active_view')
    event.target.classList.add('active_view')
    requestDados()

  }

}