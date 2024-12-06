if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

var cnpjAtual

function ready() {

    // Funções Usuário
    const inputCpf = document.querySelector('input[name=cpf]')
    inputCpf.addEventListener("input", validacoesCpf)

    if(inputCpf.value) {
        validacoesCpf()
    }

    let inputTel = document.querySelector('input[name=telefone]')
    inputTel.addEventListener("blur", verificaTel)

    const inputPassword = document.getElementById('id_password')
    inputPassword.addEventListener("input", passwordTips)

    const magicEye = document.getElementById('eye_cadastro')
    magicEye.addEventListener("click", revealPassword)

    const inputPasswordConfirm = document.getElementById('id_password_confirm')
    inputPasswordConfirm.addEventListener("input", comparePassword)

    const magicEyeConfirm = document.getElementById('eye_cadastro_confirm')
    magicEyeConfirm.addEventListener("click", revealPassword)

    let eventoCep = document.querySelector('input[name=cep]')
    eventoCep.addEventListener("input", buscaCep)

    if(eventoCep.value) {
        buscaCep()
    }

    let divUser = document.getElementById('cadastro_user')
    let inputsUser = divUser.getElementsByTagName('input')
    for(let i = 0; i < inputsUser.length; i++) {
        inputsUser[i].addEventListener("input", validaCamposUser)
    }
    
    // Funções Empresa
    const inputCnpj = document.querySelector('input[name=cnpj_emp]')
    inputCnpj.addEventListener("input", validacoesCnpj)

    if(inputCnpj.value) {
        validacoesCnpj()
    }

    cnpjAtual = inputCnpj.value

    let inputTelEmp = document.querySelector('input[name=telefone_emp]')
    inputTelEmp.addEventListener("blur", verificaTelEmp)

    let eventoCepEmp = document.querySelector('input[name=cep_emp]')
    eventoCepEmp.addEventListener("input", buscaCepEmp)

    let divEmp = document.getElementById('cadastro_emp')
    let inputsEmp = divEmp.getElementsByTagName('input')
    for(let i = 0; i < inputsEmp.length; i++) {
        inputsEmp[i].addEventListener("input", validaCamposEmp)
    }

    // Funcão para retornar empresas do banco
    requireEmps()

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
        document.querySelector('input[name=numero_emp]').value = ''

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

    if(input_telefone.value === '(') {
        input_telefone.value = ''
    }

    changeFormat(e)

    validaCamposUser()
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
    const inputPassword = event.target.parentNode.children[1]

    if(inputPassword.type === 'text') {
        inputPassword.type = 'password'
        event.target.classList.remove('fi-rr-eye-crossed')
        event.target.classList.add('fi-rr-eye')
    } else {
        inputPassword.type = 'text'
        event.target.classList.add('fi-rr-eye-crossed')
        event.target.classList.remove('fi-rr-eye')
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

    if(!inputPassword) {
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

// Função para alterar entre Formulário de Usuários e Formulário de Empresas
function changeForm() {
    var obj_user = document.getElementById('cadastro_user')
    var obj_emp = document.getElementById('cadastro_emp')
    var obj_back_index = document.getElementById('back_index')
    var h1_text = document.getElementById('text_change_form')
    var obj_seta_cadastro = document.getElementById('seta_cadastro')
    var div_seta_index = document.getElementById('seta_index')

    if(this.window.innerWidth < 768) { 
        if(obj_user.classList.contains('cadastro_user_hidden')){
            div_seta_index.style.right = 0
        } else {
            div_seta_index.style.left = 0
        }
    }

    if(obj_user.classList.contains('cadastro_user_hidden')){
        obj_user.classList.remove('cadastro_user_hidden')
        obj_emp.classList.remove('cadastro_emp_active')
        obj_back_index.classList.remove('back_index_right')
        obj_seta_cadastro.classList.remove('fi-rr-arrow-small-left')
        obj_seta_cadastro.classList.add('fi-rr-arrow-small-right')
        h1_text.innerText = 'Mudar para Formulário de Empresas'
    } else {
        obj_user.classList.add('cadastro_user_hidden')
        obj_emp.classList.add('cadastro_emp_active')
        obj_back_index.classList.add('back_index_right')
        obj_seta_cadastro.classList.add('fi-rr-arrow-small-left')
        obj_seta_cadastro.classList.remove('fi-rr-arrow-small-right')
        h1_text.innerText = 'Mudar para Formulário de Usuários'
    }
}

// Função para telefone da empresa
function verificaTelEmp(e){
    var input_telefone_emp = document.querySelector('input[name=telefone_emp]')

    if (input_telefone_emp.value === '(') {
        input_telefone_emp.value = ''
    }

    changeFormat(e)

    validaCamposEmp()
}

// Remover qualquer caractere que não for número
function removeChar(e) {
    e.value = e.value.replace(/\D/g, '')
}

// Tirar hífen do input
function tirarFormat(e) {
    const textoAtual = e.value
    const textoAjustado = textoAtual.replace(/\D/g, '')

    e.value = textoAjustado;
}

// Arrumando o formato do telefone
function changeFormat(e) {

    const textoAtual = e.target.value.length
    let textoAjustado = e.target.value

    if(textoAtual === 11) {

        const parte1 = e.target.value.slice(0, 2)
        const parte2 = e.target.value.slice(2, 7)
        const parte3 = e.target.value.slice(7, 11)
        textoAjustado = `(${parte1}) ${parte2}-${parte3}`

    } else if(textoAtual === 10) {

        const parte1 = e.target.value.slice(0, 2)
        const parte2 = e.target.value.slice(2, 6)
        const parte3 = e.target.value.slice(6, 10)
        textoAjustado = `(${parte1}) ${parte2}-${parte3}`

    }

    e.target.value = textoAjustado
    
}

//Função de Busca CNPJ da Empresa
function buscaCnpj(cnpj) {

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
    if(json.nome){

        const cep_teste = document.getElementById('cepTesteEmp')

        if(!json.cep){
            cep_teste.innerText = 'CEP inválido'
            cep_teste.style.color = 'var(--red-dark)'
        } else {
            cep_teste.innerText = 'CEP válido'
            cep_teste.style.color = '#0c6800'
        }

        document.querySelector('input[name=nome_emp]').value = json.nome
        document.querySelector('input[name=cep_emp]').value = json.cep.replace('.', '')
        document.querySelector('input[name=rua_emp]').value = json.logradouro
        document.querySelector('input[name=bairro_emp]').value = json.bairro
        document.querySelector('input[name=numero_emp]').value = json.numero
        document.querySelector('input[name=cidade_emp]').value = json.municipio
        document.querySelector('input[name=estado_emp]').value = json.uf

    }
}

// Função para listar as empresas dentro do select
function requireEmps(){

    let url = 'http://localhost/projeto01-overdrive/_files/returnEmps.php'
    let xhr = new XMLHttpRequest()
    xhr.open('GET', url, true)
    xhr.onreadystatechange = function() {
      if (xhr.readyState == 4) {
        if (xhr.status == 200) {
          preencherSelect(JSON.parse(xhr.responseText))
        }
      }
    }
    xhr.send();
    
}

function preencherSelect(json){

    if(json.status){

        var obj_select = document.getElementById('id_empresa')

        json.empresas.map(function(empresa){
            if(empresa.fantasia !== 'INATIVO') {
                obj_select.innerHTML += 
                `
                    <option value="${empresa.fantasia}">${empresa.fantasia}</option>
                `
            }
        })
        
    }
}

//Função de Busca CEP para Usuário
function buscaCep() {
    let inputCep = document.querySelector('input[name=cep]')
    let cep = inputCep.value.replace(/[^0-9]/g, '')
    const cep_teste = document.getElementById('cepTesteUser')

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
    }
}

function preencheCampos(json) {
    const cep_teste = document.getElementById('cepTesteUser')

    if(json.localidade){
        cep_teste.innerText = 'CEP válido'
        cep_teste.style.color = '#0c6800'

        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=cidade]').value = json.localidade
        document.querySelector('input[name=estado]').value = json.uf

        validaCamposUser()
    } else {
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
    }
}

//Função de Busca CEP para Empresa
function buscaCepEmp() {
    let inputCep = document.querySelector('input[name=cep_emp]')
    let cep = inputCep.value.replace(/[^0-9]/g, '')
    const cep_teste = document.getElementById('cepTesteEmp')

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

        document.querySelector('input[name=rua_emp]').value = ''
        document.querySelector('input[name=bairro_emp]').value = ''
        document.querySelector('input[name=cidade_emp]').value = ''
        document.querySelector('input[name=estado_emp]').value = ''
    }
}

function preencheCamposEmp(json) {
    const cep_teste = document.getElementById('cepTesteEmp')

    if(json.localidade){
        cep_teste.innerText = 'CEP válido'
        cep_teste.style.color = '#0c6800'

        document.querySelector('input[name=rua_emp]').value = json.logradouro
        document.querySelector('input[name=bairro_emp]').value = json.bairro
        document.querySelector('input[name=cidade_emp]').value = json.localidade
        document.querySelector('input[name=estado_emp]').value = json.uf

        validaCamposEmp()
    } else {
        cep_teste.innerText = 'CEP inválido'
        cep_teste.style.color = 'var(--red-dark)'
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
    let btn = document.getElementById('btn_cadastrar_user')
    let smallCep = document.getElementById('cepTesteUser').innerText
    const smallConfirm = document.getElementById('smallConfirm').innerText

    for(let i = 0; i < inputs.length-2; i++) {
        if(!inputs[i].value) {
            desabilitarBtn(btn)
            return
        }
    }

    if(smallConfirm === 'As senhas estão diferentes') {
        desabilitarBtn(btn)
        return
    }

    if(!passwordTips()) {
        desabilitarBtn(btn)
        return
    }

    if(!validacoesCpf()) {
        desabilitarBtn(btn)
        return
    }

    if(smallCep !== 'CEP válido') {
        desabilitarBtn(btn)
        return
    }

    habilitarBtn(btn)
}

// Função para validar todos os campos da empresa
function validaCamposEmp() {
    let divEmps = document.getElementById('cadastro_emp')
    let inputs = divEmps.getElementsByTagName('input')
    let btn = document.getElementById('btn_cadastrar_emp')
    let smallCep = document.getElementById('cepTesteEmp').innerText

    for(let i = 0; i < inputs.length; i++) {
        if(!inputs[i].value && i !== 5) {
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