if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready(){

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
    const divUsers = document.getElementById('section_users')
    const divEmps = document.getElementById('section_emps')

    json.usuarios.map(function(usuario){
        divUsers.innerHTML +=
        `
        <div class="col-10 col-sm-6 col-md-4 col-lg-3">
            <div class="center card_user">
              <img class="img_user_emp" src="_images/back_cadastro.jpg" alt="Imagem do Usuário ou Empresa">
              <div class="card_user_body">
                <p>${usuario.id}</p>
                <p>${usuario.nome}</p>
                <p>${usuario.cpf}</p>
                <p>${usuario.cnh}</p>
                <p>${usuario.telefone}</p>
                <details style="margin-bottom: 1em;">
                  <summary>Endereço</summary>
                </details>
                <p>${usuario.carro}</p>
                <p>${usuario.empresa}</p>
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
    //       </div>
    //     `
    // })
    
}