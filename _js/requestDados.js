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
      tag = '<p class="center" style="margin-bottom: 2em;"><i class="fi fi-rr-trash icons_cards center icon_trash" onclick="removeDado()"></i><i class="fi fi-rr-edit icons_cards center icon_edit"></i></p>'
    }

    json.usuarios.map(function(usuario){
        divUsers.innerHTML +=
        `
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
          <div class="center card_user">
            <img class="img_user_emp" src="_images/back_cadastro.jpg" alt="Imagem do Usuário ou Empresa">
            <div class="card_user_body">
              <header>
                <p style="position: absolute; padding: 0; left: 1em; top: 1em;">#${usuario.id}</p>
              </header>
              <p style="margin-top: 4.5em;">Nome: ${usuario.nome}</p>
              <p>CPF: ${usuario.cpf}</p>
              <p>CNH: ${usuario.cnh}</p>
              <p>Telefone: ${usuario.telefone}</p>
              <details style="margin-bottom: .4em; background-color: rgba(133, 133, 133, 0.08);">
                <summary style="background-color: #FFF;">Endereço</summary>
                <p style="margin: .4em 0;">${usuario.rua}, ${usuario.numero} - ${usuario.bairro}</p>
                <p>${usuario.cidade} - ${usuario.estado}, ${usuario.cep}</p>
              </details>
              <p>Carro: ${usuario.carro}</p>
              <p>Empresa: ${usuario.empresa}</p>
              ${tag}
            </div>
          </div>
        </div>
        `
    })

    // json.empresas.map(function(empresa){
    //     `
    //     <div class="col-10 col-sm-6 col-md-4 col-lg-3">
    //         <div class="center card_user">
    //           <img class="img_user_emp" src="_images/back_cadastro.jpg" alt="Imagem do Usuário ou Empresa">
    //           <div class="card_user_body">
    //             <p>${usuario.id}</p>
    //             <p>${usuario.nome}</p>
    //             <p>${usuario.cpf}</p>
    //             <p>${usuario.cnh}</p>
    //             <p>${usuario.telefone}</p>
    //             <details style="margin-bottom: 1em;">
    //               <summary>Endereço</summary>
    //             </details>
    //             <p>${usuario.carro}</p>
    //             <p>${usuario.empresa}</p>
    //           </div>
    //         </div>
    //     </div>
    //     `
    // })

    addEvents()
    
}

function addEvents(){
  var cards = document.getElementsByClassName('card_user')
    
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