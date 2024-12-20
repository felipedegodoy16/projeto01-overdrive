if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

var cnpjAtual

function ready(){
    
    let body = document.getElementsByTagName('body')[0]
    if(body.querySelector('input[name=cnpj_emp]') != undefined) {

        const strCnpj = document.querySelector('input[name=cnpj_emp]').value
        const cnpjAlert = document.getElementById('cnpjTeste')
        cnpj = strCnpj.replace(/[^0-9]/g, '')

        cnpjTestado = validaCnpj(cnpj)
        if(cnpjTestado){
            cnpjAlert.innerText = 'CNPJ válido'
            cnpjAlert.style.color = '#0c6800'
        }

        cnpjAtual = strCnpj

        let divEmp = document.getElementById('cadastro_emp')
        let inputsEmp = divEmp.getElementsByTagName('input')
        for(let i = 0; i < inputsEmp.length; i++) {
            inputsEmp[i].addEventListener("input", validaCamposEmp)
        }

        validaCamposEmp()
        
    } else if(body.querySelector('input[name=cpf]') != undefined) {
        let divUser = document.getElementById('cadastro_user')
        let inputsUser = divUser.getElementsByTagName('input')
        for(let i = 0; i < inputsUser.length; i++) {
            inputsUser[i].addEventListener("input", validaCamposUser)
        }

        const inputPassword = document.getElementById('id_password')
        inputPassword.addEventListener("input", passwordTips)

        validacoesCpf()
        validaCamposUser()
    }

    // Função de CEP para Usuário
    let eventoCep = document.querySelector('input[name=cep]')
    eventoCep.addEventListener("input", buscaCep)

}

// Funções para validação do CPF
function validacoesCpf(){
    const strCpf = document.querySelector('input[name=cpf]').value
    const cpfAlert = document.getElementById('cpfTeste')
    cpf = strCpf.replace(/[^0-9]/g, '')

    if(cpf.length === 11){
        cpfTestado = validaCPF(cpf)
        if(cpfTestado){
            cpfAlert.innerText = 'CPF válido'
            cpfAlert.style.color = '#0c6800'
            
            return true
        } else {
            cpfAlert.innerText = 'CPF inválido'
            cpfAlert.style.color = 'var(--red-dark)'
            
            return false
        }
    } else {
        cpfAlert.innerText = 'CPF inválido'
        cpfAlert.style.color = 'var(--red-dark)'
        
        return false
    }
}

function validaCPF(cpf){

    // Verifica se foi informado todos os digitos corretamente
    if (cpf.length != 11) {
        return false
    }

    // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
    var regex = /([0-9]{2,3})\1/g
    if (regex.test(cpf)) {
        return false
    }

    // Faz o calculo para validar o CPF
    for (var i = 9; i < 11; i++) {
        var k = 0;
        for (var j = 0; j < i; j++) {
            k += cpf[j] * ((i + 1) - j);
        }
        k = ((10 * k) % 11) % 10;
        if (cpf[j] != k) {
            return false;
        }
    }
    return true;
}

// Funções para validação do CNPJ
function validacoesCnpj(){
    const strCnpj = document.querySelector('input[name=cnpj_emp]').value
    const cnpjAlert = document.getElementById('cnpjTeste')
    cnpj = strCnpj.replace(/[^0-9]/g, '')

    if(cnpj.length === 14){
        cnpjTestado = validaCnpj(cnpj)
        if(cnpjTestado){
            if(cnpjAlert.innerText != 'CNPJ válido' || cnpjAtual !== strCnpj) {
                cnpjAtual = strCnpj
                buscaCnpj(cnpj)
            }

            cnpjAlert.innerText = 'CNPJ válido'
            cnpjAlert.style.color = '#0c6800'

            return true
        } else {
            cnpjAlert.innerText = 'CNPJ inválido'
            cnpjAlert.style.color = 'var(--red-dark)'
            
            document.querySelector('input[name=nome_emp]').value = ''
            document.querySelector('input[name=numero]').value = ''

            return false
        }
    } else {
        cnpjAlert.innerText = 'CNPJ inválido'
        cnpjAlert.style.color = 'var(--red-dark)'
        
        document.querySelector('input[name=nome_emp]').value = ''
        document.querySelector('input[name=numero]').value = ''

        return false
    }
}

function validaCnpj(cnpj) {

    var tamanhoTotal = cnpj.length - 2
    var cnpjSemDigitos = cnpj.substring(0, tamanhoTotal);
    var digitosVerificadores = cnpj.substring(tamanhoTotal);
    var soma = 0;
    var pos = tamanhoTotal - 7;
    for (i = tamanhoTotal; i >= 1; i--) {
        soma += cnpjSemDigitos.charAt(tamanhoTotal - i) * pos--;
        if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitosVerificadores.charAt(0))
        return false;

    tamanhoTotal = tamanhoTotal + 1;
    cnpjSemDigitos = cnpj.substring(0, tamanhoTotal);
    soma = 0;
    pos = tamanhoTotal - 7;
    for (i = tamanhoTotal; i >= 1; i--) {
        soma += cnpjSemDigitos.charAt(tamanhoTotal - i) * pos--;
        if (pos < 2)
            pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitosVerificadores.charAt(1))
        return false;

    return true;
}

// Função para telefone
function verificaTel(e){
    var input_telefone = document.querySelector('input[name=telefone]')
    var body = document.getElementsByTagName('body')[0]

    if (input_telefone.value === '(') {
        input_telefone.value = ''
    }

    changeFormat(e)

    if(body.querySelector('input[name=cnpj_emp]') != undefined) {
        validaCamposEmp()
    } else {
        validaCamposUser()
    }
}

// Remover qualquer caractere que não for número
function removeChar(e) {
    e.value = e.value.replace(/\D/g, '')
    if(e.value.length > 11) {
        
    }
}

// Tirar hífen do input
function tirarFormat(e) {
    const textoAtual = e.value
    const textoAjustado = textoAtual.replace(/\D/g, '')

    e.value = textoAjustado;
}

// Arrumando o formato do telefone
function changeFormat(e) {

    const textoAtual = e.value.length
    let textoAjustado = e.value

    if(textoAtual === 11) {

        const parte1 = e.value.slice(0, 2)
        const parte2 = e.value.slice(2, 7)
        const parte3 = e.value.slice(7, 11)
        textoAjustado = `(${parte1}) ${parte2}-${parte3}`

    } else if(textoAtual === 10) {

        const parte1 = e.value.slice(0, 2)
        const parte2 = e.value.slice(2, 6)
        const parte3 = e.value.slice(6, 10)
        textoAjustado = `(${parte1}) ${parte2}-${parte3}`

    }

    e.value = textoAjustado
    
}

// Função de verificação se a mesma senha foi digitada
function comparePassword() {
    const inputPassword = document.getElementById('id_password').value
    const inputPasswordConfirm = document.getElementById('id_password_confirm').value
    const smallConfirm = document.getElementById('smallConfirm')

    if(inputPassword === inputPasswordConfirm && inputPasswordConfirm !== '') {
        smallConfirm.innerText = 'As senhas estão iguais'
        smallConfirm.style.color = '#0c6800'
    } else {
        smallConfirm.innerText = 'As senhas estão diferentes'
        smallConfirm.style.color = 'var(--red-dark)'
    }
}

// Função para alternar senha entre visível e invisível
function revealPassword(event){
    const inputPassword = event.parentNode.children[1]

    if(inputPassword.type === 'text') {
        inputPassword.type = 'password'
        event.classList.remove('fi-rr-eye-crossed')
        event.classList.add('fi-rr-eye')
    } else {
        inputPassword.type = 'text'
        event.classList.add('fi-rr-eye-crossed')
        event.classList.remove('fi-rr-eye')
    }
}

// Função de dicas de senha para o usuário
function passwordTips() {
    const divTips = document.getElementById('passwordTips')
    const inputPassword = document.getElementById('id_password').value
    const li = document.getElementsByClassName('tip')

    if(divTips.style.display === 'none') {
        divTips.style.display = 'flex'
    }

    if(inputPassword === '') {
        divTips.style.display = 'none'
    }

    let size = passwordSize(inputPassword, li)
    let letters = passwordLetters(inputPassword, li) 
    let number = passwordNumber(inputPassword, li)
    let special = passwordSpecial(inputPassword, li)

    if(size && letters && number && special) {
        return true
    }

    return false
}

// Função verifica tamanho da senha
function passwordSize(inputPassword, li) {
    var element = li[0]
    var icon = element.getElementsByClassName('icon-tip')[0]

    if(inputPassword.length >= 8) {
        element.style.color = '#0c6800'

        if(icon.classList.contains('fi-rr-x')) {
            icon.classList.remove('fi-rr-x')
            icon.classList.add('fi-rr-check')
        }

        return true
    } else {
        element.style.color = 'rgb(90, 0, 0)'

        if(icon.classList.contains('fi-rr-check')) {
            icon.classList.remove('fi-rr-check')
            icon.classList.add('fi-rr-x')
        }

        return false
    }
}

// Função para verificar se há letras maiúsculas e minúsculas na senha
function passwordLetters(inputPassword, li) {
    var element = li[1]
    var icon = element.getElementsByClassName('icon-tip')[0]
    const regexLower = /[a-z]/gm
    const regexUpper = /[A-Z]/gm

    if(regexLower.test(inputPassword) && regexUpper.test(inputPassword)) {
        element.style.color = '#0c6800'

        if(icon.classList.contains('fi-rr-x')) {
            icon.classList.remove('fi-rr-x')
            icon.classList.add('fi-rr-check')
        }

        return true
    } else {
        element.style.color = 'rgb(90, 0, 0)'

        if(icon.classList.contains('fi-rr-check')) {
            icon.classList.remove('fi-rr-check')
            icon.classList.add('fi-rr-x')
        }

        return false
    }
}

// Função para verificar se há números na senha
function passwordNumber(inputPassword, li) {
    var element = li[2]
    var icon = element.getElementsByClassName('icon-tip')[0]
    const regex = /\d/

    if(regex.test(inputPassword)) {
        element.style.color = '#0c6800'

        if(icon.classList.contains('fi-rr-x')) {
            icon.classList.remove('fi-rr-x')
            icon.classList.add('fi-rr-check')
        }

        return true
    } else {
        element.style.color = 'rgb(90, 0, 0)'

        if(icon.classList.contains('fi-rr-check')) {
            icon.classList.remove('fi-rr-check')
            icon.classList.add('fi-rr-x')
        }

        return false
    }
}

// Função para verificar se há caracteres especiais na senha
function passwordSpecial(inputPassword, li) {
    var element = li[3]
    var icon = element.getElementsByClassName('icon-tip')[0]
    const regex = /[!@#$%*()_+^&{}}:;?.]/gm

    if(regex.test(inputPassword)) {
        element.style.color = '#0c6800'

        if(icon.classList.contains('fi-rr-x')) {
            icon.classList.remove('fi-rr-x')
            icon.classList.add('fi-rr-check')
        }

        return true
    } else {
        element.style.color = 'rgb(90, 0, 0)'

        if(icon.classList.contains('fi-rr-check')) {
            icon.classList.remove('fi-rr-check')
            icon.classList.add('fi-rr-x')
        }

        return false
    }
}

//Função de Busca CNPJ da Empresa
function buscaCnpj(cnpj){

    if(cnpj.length === 14){

        let url = 'https://receitaws.com.br/v1/cnpj/' + cnpj
        const xhr = new XMLHttpRequest();

        xhr.open('GET', url);
        xhr.setRequestHeader('Accept', 'application/json');

        xhr.addEventListener('readystatechange', function () {
            if (this.readyState === this.DONE) {
                preencheCamposCnpj(JSON.parse(xhr.responseText))
            }
        });

        xhr.send();

    }

}

//Função para preencher os campos com o CNPJ
function preencheCamposCnpj(json){
    if(json.nome != undefined){

        const cep_teste = document.getElementById('cepTeste')

        if(json.cep === '' || json.cep === undefined){
            cep_teste.innerText = 'CEP inválido'
            cep_teste.style.color = 'var(--red-dark)'
        } else {
            cep_teste.innerText = 'CEP válido'
            cep_teste.style.color = '#0c6800'
        }

        document.querySelector('input[name=nome_emp]').value = json.nome
        document.querySelector('input[name=cep]').value = json.cep.replace('.', '')
        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=numero]').value = json.numero
        document.querySelector('input[name=cidade]').value = json.municipio
        document.querySelector('input[name=estado]').value = json.uf
        validaCamposEmp()

    }
}

//Função de Busca CEP para Usuário
function buscaCep() {
    let inputCep = document.querySelector('input[name=cep]')
    let cep = inputCep.value.replace(/[^0-9]/g, '')
    const cep_teste = document.getElementById('cepTeste')

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
        
        document.querySelector('input[name=rua]').value = ''
        document.querySelector('input[name=bairro]').value = ''
        document.querySelector('input[name=cidade]').value = ''
        document.querySelector('input[name=estado]').value = ''

        if(document.getElementById('cadastro_user') != undefined) {
            validaCamposUser()
        } else if(document.getElementById('cadastro_emp') != undefined) {
            validaCamposEmp()
        }
    }
}

function preencheCampos(json) {
    const cep_teste = document.getElementById('cepTeste')

    if(json.localidade !== undefined){
        cep_teste.innerText = 'CEP válido'
        cep_teste.style.color = '#0c6800'

        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=cidade]').value = json.localidade
        document.querySelector('input[name=estado]').value = json.uf
    } else {
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
    }

    if(document.getElementById('cadastro_user') != undefined) {
        validaCamposUser()
    } else if(document.getElementById('cadastro_emp') != undefined) {
        validaCamposEmp()
    }
}

// Função para pegar o tamanho do arquivo
function fileSize(event) {
    const size = event.files[0].size
    const small = event.parentNode.getElementsByTagName('small')[0]

    if(size && size > 10000000) {
        small.innerText = 'O tamanho máximo do arquivo permitido é 10MB'
        small.style.color = 'var(--red-dark)'
    } else if(size <= 10000000) {
        small.innerText = ''
    }
}

// Função para habilitar o botão
function habilitarBtn(btn) {
    btn.setAttribute('type', 'submit')
    if(btn.classList.contains('btn_desabilitado')) {
        btn.classList.add('btn_habilitado')
        btn.classList.remove('btn_desabilitado')
    }
}

// Função para desabilitar o botão
function desabilitarBtn(btn) {
    btn.setAttribute('type', 'button')
    if(btn.classList.contains('btn_habilitado')) {
        btn.classList.add('btn_desabilitado')
        btn.classList.remove('btn_habilitado')
    }
}

// Função para validar todos os campos do usuário
function validaCamposUser() {
    let divUser = document.getElementById('cadastro_user')
    let inputs = divUser.getElementsByTagName('input')
    let btn = document.getElementById('btn_cadastrar')
    let smallCep = document.getElementById('cepTeste').innerText
    let inputPassword = document.getElementById('id_password')
    const smallConfirm = document.getElementById('smallConfirm').innerText

    if(inputPassword.value !== '') {
        if(!passwordTips() || smallConfirm === 'As senhas estão diferentes' || smallConfirm == '') {
            desabilitarBtn(btn)
            return
        }
    }

    if(!validacoesCpf()) {
        desabilitarBtn(btn)
        return
    }

    if(smallCep !== 'CEP válido') {
        desabilitarBtn(btn)
        return
    }

    for(let i = 0; i < inputs.length-3; i++) {
        if(inputs[i].value === '' && (i < 5 || i > 6)) {
            desabilitarBtn(btn)
            return
        }
    }

    habilitarBtn(btn)
}

// Função para validar todos os campos da empresa
function validaCamposEmp() {
    let divEmps = document.getElementById('cadastro_emp')
    let inputs = divEmps.getElementsByTagName('input')
    let btn = document.getElementById('btn_cadastrar')
    let smallCep = document.getElementById('cepTeste').innerText

    for(let i = 0; i < inputs.length; i++) {
        if(inputs[i].value === '' && (i < 5 || i > 6)) {
            desabilitarBtn(btn)
            return
        }
    }

    if(!validacoesCnpj()) {
        desabilitarBtn(btn)
        return
    }

    if(smallCep !== 'CEP válido') {
        desabilitarBtn(btn)
        return
    }

    habilitarBtn(btn)
}