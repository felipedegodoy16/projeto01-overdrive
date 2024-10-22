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
    let cep = inputCep.value.replace(/[^0-9]/g, '')
    const cep_teste = document.getElementById('cepTesteUser')
    const btnCadastrar = document.getElementById('btn_cadastrar_user')

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
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')
        document.querySelector('input[name=rua]').value = ''
        document.querySelector('input[name=bairro]').value = ''
        document.querySelector('input[name=cidade]').value = ''
        document.querySelector('input[name=estado]').value = ''
    }
}

function preencheCampos(json) {
    const cep_teste = document.getElementById('cepTesteUser')
    const btnCadastrar = document.getElementById('btn_cadastrar_user')

    if(json.localidade !== undefined){
        cep_teste.innerText = 'CEP válido'
        cep_teste.style.color = '#0c6800'
        btnCadastrar.setAttribute('type', 'submit')
        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=cidade]').value = json.localidade
        document.querySelector('input[name=estado]').value = json.uf
    } else {
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')
    }
}

///////////////////////////////////////////////////////////////

//Função de Busca CEP para Empresa
function buscaCepEmp() {
    let inputCep = document.querySelector('input[name=cep_emp]')
    let cep = inputCep.value.replace(/[^0-9]/g, '')
    const cep_teste = document.getElementById('cepTesteEmp')
    const btnCadastrar = document.getElementById('btn_cadastrar_emp')

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
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')
        document.querySelector('input[name=rua_emp]').value = ''
        document.querySelector('input[name=bairro_emp]').value = ''
        document.querySelector('input[name=cidade_emp]').value = ''
        document.querySelector('input[name=estado_emp]').value = ''
    }
}

function preencheCamposEmp(json) {
    const cep_teste = document.getElementById('cepTesteEmp')
    const btnCadastrar = document.getElementById('btn_cadastrar_emp')

    if(json.localidade !== undefined){
        cep_teste.innerText = 'CEP válido'
        cep_teste.style.color = '#0c6800'
        btnCadastrar.setAttribute('type', 'submit')
        document.querySelector('input[name=rua_emp]').value = json.logradouro
        document.querySelector('input[name=bairro_emp]').value = json.bairro
        document.querySelector('input[name=cidade_emp]').value = json.localidade
        document.querySelector('input[name=estado_emp]').value = json.uf
    } else {
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')
    }
}