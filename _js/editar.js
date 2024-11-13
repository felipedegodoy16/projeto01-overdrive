if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready(){
    
    let body = document.getElementsByTagName('body')[0]
    if(body.querySelector('input[name=cnpj_emp]') != undefined) {
        validacoesCnpj()
    } else if(body.querySelector('input[name=cpf]') != undefined) {
        validacoesCpf()
        buscaCep()
    }

    // Função de CEP para Usuário
    let eventoCep = document.querySelector('input[name=cep]')
    eventoCep.addEventListener("input", buscaCep)
}

// Funções para validação do CPF
function validacoesCpf(){
    const strCpf = document.querySelector('input[name=cpf]').value
    const cpfAlert = document.getElementById('cpfTeste')
    const btnCadastrar = document.getElementById('btn_cadastrar')
    cpf = strCpf.replace(/[^0-9]/g, '')

    if(cpf.length === 11){
        cpfTestado = validaCPF(cpf)
        if(cpfTestado){
            cpfAlert.innerText = 'CPF válido'
            cpfAlert.style.color = '#0c6800'
            btnCadastrar.setAttribute('type', 'submit')
        } else {
            cpfAlert.innerText = 'CPF inválido'
            cpfAlert.style.color = 'var(--red-dark)'
            btnCadastrar.setAttribute('type', 'button')
        }
    } else {
        cpfAlert.innerText = 'CPF inválido'
        cpfAlert.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')
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
    const btnCadastrar = document.getElementById('btn_cadastrar')
    cnpj = strCnpj.replace(/[^0-9]/g, '')

    if(cnpj.length === 14){
        cnpjTestado = validaCnpj(cnpj)
        if(cnpjTestado){
            cnpjAlert.innerText = 'CNPJ válido'
            cnpjAlert.style.color = '#0c6800'
            btnCadastrar.setAttribute('type', 'submit')
            buscaCnpj(cnpj)
        } else {
            cnpjAlert.innerText = 'CNPJ inválido'
            cnpjAlert.style.color = 'var(--red-dark)'
            btnCadastrar.setAttribute('type', 'button')
            document.querySelector('input[name=nome_emp]').value = ''
            document.querySelector('input[name=fantasia_emp]').value = ''
            document.querySelector('input[name=numero]').value = ''
        }
    } else {
        cnpjAlert.innerText = 'CNPJ inválido'
        cnpjAlert.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')
        document.querySelector('input[name=nome_emp]').value = ''
        document.querySelector('input[name=fantasia_emp]').value = ''
        document.querySelector('input[name=numero]').value = ''
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
function verificaTel(event){
    var obj_telefone = document.getElementById('p_telefone')
    var input_telefone = document.querySelector('input[name=telefone]')

    if (!obj_telefone.contains(event) && input_telefone.value === '(') {
        input_telefone.value = ''
    }
}

// Função para alternar senha entre visível e invisível
function revealPassword(){
    const inputPassword = document.getElementById('id_password')
    const iconEye = document.getElementById('eye_cadastro')
    if(inputPassword.type === 'text') {
        inputPassword.type = 'password'
        iconEye.classList.remove('fi-rr-eye-crossed')
        iconEye.classList.add('fi-rr-eye')
    } else {
        inputPassword.type = 'text'
        iconEye.classList.add('fi-rr-eye-crossed')
        iconEye.classList.remove('fi-rr-eye')
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

        document.querySelector('input[name=nome_emp]').value = json.nome
        document.querySelector('input[name=fantasia_emp]').value = json.fantasia
        document.querySelector('input[name=cep]').value = json.cep.replace('.', '')
        document.querySelector('input[name=rua]').value = json.logradouro
        document.querySelector('input[name=bairro]').value = json.bairro
        document.querySelector('input[name=numero]').value = json.numero
        document.querySelector('input[name=cidade]').value = json.municipio
        document.querySelector('input[name=estado]').value = json.uf
        buscaCep()

    }
}

//Função de Busca CEP para Usuário
function buscaCep() {
    let inputCep = document.querySelector('input[name=cep]')
    let cep = inputCep.value.replace(/[^0-9]/g, '')
    const cep_teste = document.getElementById('cepTeste')
    const btnCadastrar = document.getElementById('btn_cadastrar')

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
    const cep_teste = document.getElementById('cepTeste')
    const btnCadastrar = document.getElementById('btn_cadastrar')

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