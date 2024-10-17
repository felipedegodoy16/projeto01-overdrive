if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready(){
    let eventoCep = document.querySelector('input[name=cep]')
    eventoCep.addEventListener("keyup", buscaCep)
    const btnEntrega = document.getElementsByClassName("checked")
    for(let i = 0; i < btnEntrega.length; i++){
        btnEntrega[i].addEventListener("click", entrega)
    }
}


function buscaCep() {
    let inputCep = document.querySelector('input[name=cep]')
    let cep = inputCep.value.replace('-', '').replace(".", "")
    if(cep.length == 8) {
        let url = 'http://viacep.com.br/ws/' + cep + '/json'
        let xhr = new XMLHttpRequest()
        xhr.open('GET', url, true)
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200)
                    preencheCampos(JSON.parse(xhr.responseText))
            }
        }
        xhr.send();
    } else {
        document.querySelector('input[name=rua]').value = ''
        document.querySelector('input[name=bairro]').value = ''
        document.querySelector('input[name=numero]').value = ''
        document.querySelector('input[name=cidade]').value = ''
        document.querySelector('input[name=estado]').value = ''
    }
}

function preencheCampos(json) {
    if(json.localidade != undefined){
        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=numero]').value = json.numero
        document.querySelector('input[name=cidade]').value = json.localidade
        document.querySelector('input[name=estado]').value = json.uf
    }
}

function entrega() {
    const checkbox = document.getElementsByClassName("checked")
    const formEntrega = document.getElementById("endereco")
    if(checkbox[0].checked){
        formEntrega.style.display = "block"
    } else {
        formEntrega.style.display = "none"
    }
}