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
    let tag = ''

    if(json.sessao === 'A') {
      tag = '<p class="center" style="margin-top: .7em;"><i class="fi fi-rr-trash icons_cards center icon_trash" onclick="removeDado()"></i><i class="fi fi-rr-edit icons_cards center icon_edit"></i></p>'
    }



    json.usuarios.map(function(usuario){

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
            <p style="margin-top: 4.5em;">Nome: ${usuario.nome}</p>
            <p>CPF: ${usuario.cpf}</p>
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

    json.empresas.map(function(empresa){

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
            <p style="margin-top: 4.5em;">Razão: ${empresa.nome}</p>
            <p>Fantasia: ${empresa.fantasia}</p>
            <p>CNPJ: ${empresa.cnpj}</p>
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

    addEvents()
    
}

function addEvents(){
  var cards = document.getElementsByClassName('card_register')
    
  for(let i = 0; i < cards.length; i++){

    cards[i].addEventListener("mouseenter", () => {

      if(cards[i].classList.contains('back_card')){

        cards[i].classList.add('transition_card')
        cards[i].classList.remove('back_card')

      } else {

        cards[i].classList.add('transition_card')

      }
    })

    cards[i].addEventListener("mouseleave", () => {

      if(cards[i].classList.contains('transition_card')){

        cards[i].classList.add('back_card')
        cards[i].classList.remove('transition_card')

      }
    })
  }
}