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
  var tag = ''
  divUsers.innerHTML = ''
  divEmps.innerHTML = ''

  if(json.error){
    const main = document.getElementById('main_index')

    main.innerHTML = '<p>Ainda não há dados registrados no banco!</p>'

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

      json.usuarios.map(function(usuario){

        if(json.sessao === 'A') {
          tag = '<p class="center" style="margin-top: .7em;"><i class="fi fi-rr-trash icons_cards center icon_trash user_trash"></i><i class="fi fi-rr-edit icons_cards center icon_edit"></i></p>'
        }

        if(usuario.foto != null){
          var foto = usuario.foto
        } else {
          var foto = 'fotoDefault.jpg'
        }

        divUsers.innerHTML +=
        `
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
          <div class="center card_register">
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
              <p>Empresa: ${usuario.empresa}</p>
              <details style="margin-bottom: .4em; background-color: rgba(133, 133, 133, 0.08);">
                <summary style="background-color: #FFF;">Endereço</summary>
                <p style="margin: .4em 0;">${usuario.rua}, ${usuario.numero} - ${usuario.bairro}</p>
                <p>${usuario.cidade} - ${usuario.estado}, ${usuario.cep}</p>
              </details>
              ${tag}
            </div>
          </div>
        </div>
        `
      })

    } else {

      divEmps.innerHTML += '<p style="margin: 0; color: var(--red-dark);">Não há registros de usuários ainda.</p>'

    }

    if(json.empresas !== -1){

      json.empresas.map(function(empresa){

        if(json.sessao === 'A') {
          tag = '<p class="center" style="margin-top: .7em;"><i class="fi fi-rr-trash icons_cards center icon_trash emp_trash"></i><i class="fi fi-rr-edit icons_cards center icon_edit"></i></p>'
        }

        if(empresa.foto != null){
          var foto = empresa.foto
        } else {
          var foto = 'fotoDefault.jpg'
        }

        divEmps.innerHTML +=
        `
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
          <div class="center card_register">
            <img class="img_user_emp" src="_images/uploads/${foto}" alt="Imagem do Usuário ou Empresa">
            <div class="card_user_body" style="padding-bottom: 2em;">
              <header>
                <p style="position: absolute; padding: 0; left: 1em; top: 1em;">#${empresa.id}</p>
              </header>
              <p style="margin-top: 4.5em;" class="name">Razão: ${empresa.nome}</p>
              <p>Fantasia: ${empresa.fantasia}</p>
              <p class="cpf_cnpj">CNPJ: ${empresa.cnpj}</p>
              <p>Telefone: ${empresa.telefone}</p>
              <p>Responsável: ${empresa.responsavel}</p>
              <details style="margin-bottom: .4em; background-color: rgba(133, 133, 133, 0.08);">
                <summary style="background-color: #FFF;">Endereço</summary>
                <p style="margin: .4em 0;">${empresa.rua}, ${empresa.numero} - ${empresa.bairro}</p>
                <p>${empresa.cidade} - ${empresa.estado}, ${empresa.cep}</p>
              </details>
              ${tag}
            </div>
          </div>
        </div>
        `
      })

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
  let idRemove = event.target.parentNode.parentNode.children[0].children[0].innerText.replace('#', '')

  window.scrollTo(0, 0)
  divStatus.style.display = 'flex'

  if(idSession == idRemove){

    pStatus.innerText = `Não é possível remover o seu próprio usuário.`

  } else {

    let comando = prompt("Por favor, confirme a instrução (DELETE) para excluir os registros do usuário.")

    if(comando === 'DELETE'){

      let url = 'http://localhost/projeto01-overdrive/_files/removeData.php?id=' + idRemove + '&tipo=usuario'
      let xhr = new XMLHttpRequest()
      xhr.open('GET', url, true)
      xhr.onreadystatechange = function() {
        if (xhr.readyState == 4) {
          if (xhr.status == 200) {

            pStatus.innerText = `Usuário removido com sucesso.`
            divStatus.classList.add('status_accept')
            requestDados()

          }
        }
      }
      xhr.send();

    } else {

      pStatus.innerText = `Não foi possível remover o usuário.`

    }
  }
}

// Função para remoção do registro de empresas
function removeDataEmps(event){
  const divStatus = document.getElementById('status_request')
  const pStatus = document.getElementById('p_status_request')
  let idRemove = event.target.parentNode.parentNode.children[0].children[0].innerText.replace('#', '')
  let comando = prompt("Por favor, confirme a instrução (DELETE) para excluir os registros da empresa.")

  window.scrollTo(0, 0)
  divStatus.style.display = 'flex'

  if(comando === 'DELETE'){

    let url = 'http://localhost/projeto01-overdrive/_files/removeData.php?id=' + idRemove + '&tipo=empresa'
    let xhr = new XMLHttpRequest()
    xhr.open('GET', url, true)
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {

          json = JSON.parse(xhr.responseText)
          console.log(json)

          if(json.status){

            pStatus.innerText = `${json.message}`
            divStatus.classList.add('status_accept')
            requestDados()

          } else{

            pStatus.innerText = `${json.message}`

          }

        }
      }
    }
    xhr.send();

  } else {

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

  filterElement.addEventListener('input', filterCards)
}

// Função para filtrar
function filterCards(){
  const filterElement = document.getElementById('search')
  const cards = document.getElementsByClassName('card_register')

  if(filterElement.value != ''){
    for(let card of cards){
      let nome = card.getElementsByClassName('name')[0]
      nome = nome.textContent.replace('Nome: ', '').toLowerCase()

      let cpfCnpj = card.getElementsByClassName('cpf_cnpj')[0]
      cpfCnpj = cpfCnpj.textContent.replace('CPF: ', '').replace('CNPJ: ', '').replace('.', '').replace('.', '').replace('/', '').replace('-', '').toLowerCase()

      let filterText = filterElement.value.replace('.', '').replace('.', '').replace('-', '').toLowerCase()

      if(!nome.includes(filterText) && !cpfCnpj.includes(filterText)){
        card.classList.remove('back_card')
        card.classList.add('transition_section')
        card.parentNode.style.display = 'none'
      } else{
        card.parentNode.style.display = 'block'
      }
    }
  } else{
    for(let card of cards){
      card.parentNode.style.display = 'block'
    }
  }
}

// Função para fazer filtro de ordem alfabética
function alfaAsc(campo, ordem){
  let url = 'http://localhost/projeto01-overdrive/_files/orderFilters.php?campo=' + campo + '&ordem=' + ordem  
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