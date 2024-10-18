if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready(){
    // Função de CEP para Usuário
    let eventoCep = document.querySelector('input[name=cep]')
    eventoCep.addEventListener("keyup", buscaCep)

    // Função de CEP para Empresa
    let eventoCepEmp = document.querySelector('input[name=cep_emp]')
    eventoCepEmp.addEventListener("keyup", buscaCepEmp)
}

//Função de Busca CEP para Usuário
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
        document.querySelector('input[name=cidade]').value = ''
        document.querySelector('input[name=estado]').value = ''
    }
}

function preencheCampos(json) {
    if(json.localidade != undefined){
        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=cidade]').value = json.localidade
        document.querySelector('input[name=estado]').value = json.uf
    }
}

///////////////////////////////////////////////////////////////

//Função de Busca CEP para Empresa
function buscaCepEmp() {
    let inputCep = document.querySelector('input[name=cep_emp]')
    let cep = inputCep.value.replace('-', '').replace(".", "")
    if(cep.length == 8) {
        let url = 'http://viacep.com.br/ws/' + cep + '/json'
        let xhr = new XMLHttpRequest()
        xhr.open('GET', url, true)
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status == 200)
                    preencheCamposEmp(JSON.parse(xhr.responseText))
            }
        }
        xhr.send();
    } else {
        document.querySelector('input[name=rua_emp]').value = ''
        document.querySelector('input[name=bairro_emp]').value = ''
        document.querySelector('input[name=cidade_emp]').value = ''
        document.querySelector('input[name=estado_emp]').value = ''
    }
}

function preencheCamposEmp(json) {
    if(json.localidade != undefined){
        document.querySelector('input[name=rua_emp]').value = json.logradouro
        document.querySelector('input[name=bairro_emp]').value = json.bairro
        document.querySelector('input[name=cidade_emp]').value = json.localidade
        document.querySelector('input[name=estado_emp]').value = json.uf
    }
}