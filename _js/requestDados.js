if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready(){
        console.log('teste')
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

function responseJson(json) {
    const divTeste = document.getElementById('teste')

    json.map( function(element) {
        divTeste.innerHTML +=
        `
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
            <div class="center card_user">
              <img class="img_user_emp" src="_images/back_cadastro.jpg" alt="Imagem do Usuário ou Empresa">
              <div class="card_user_body">
                <p>${element.id}</p>
                <p>${element.nome}</p>
                <p>${element.cpf}</p>
                <p>${element.cnh}</p>
                <p>${element.telefone}</p>
                <details style="margin-bottom: 1em;">
                  <summary>Endereço</summary>
                </details>
                <p>${element.carro}</p>
                <p>${element.empresa}</p>
              </div>
            </div>
          </div>
        `
    })
    
}