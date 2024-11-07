
// Funções para validação do CPF
function validacoesCpf(){
    const strCpf = document.querySelector('input[name=cpf]').value
    const cpfAlert = document.getElementById('cpfTeste')
    const btnCadastrar = document.getElementById('btn_cadastrar_user')
    cpf = strCpf.replace(/[^0-9]/g, '')

    if(cpf.length === 11){
        cpfTestado = validaCPF(cpf)
        if(cpfTestado){
            cpfAlert.innerText = 'CPF válido'
            cpfAlert.style.color = '#0c6800'
            btnCadastrar.setAttribute('type', 'submit')
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
function buscaCnpj(){

    const cnpjTeste = document.getElementById('cnpjTeste')
    const btnCadastrar = document.getElementById('btn_cadastrar_emp')
    let inputCnpj = document.querySelector('input[name=cnpj_emp]')
    let cnpj = inputCnpj.value.replace(/[^0-9]/g, '')

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

    } else {
        
        cnpjTeste.innerText = 'CNPJ inválido'
        cnpjTeste.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')

    }
}

//Função para preencher os campos com o CNPJ
function preencheCamposCnpj(json){
    const cnpjTeste = document.getElementById('cnpjTeste')
    const btnCadastrar = document.getElementById('btn_cadastrar_emp')
    const cep_teste = document.getElementById('cepTesteEmp')

    if(json.nome != undefined){

        cnpjTeste.innerText = 'CNPJ válido'
        cnpjTeste.style.color = '#0c6800'
        btnCadastrar.setAttribute('type', 'submit')
        cep_teste.innerText = 'CEP válido'
        cep_teste.style.color = '#0c6800'

        document.querySelector('input[name=nome_emp]').value = json.nome
        document.querySelector('input[name=fantasia_emp]').value = json.fantasia
        document.querySelector('input[name=cep_emp]').value = json.cep.replace('.', '')
        document.querySelector('input[name=rua_emp]').value = json.logradouro
        document.querySelector('input[name=bairro_emp]').value = json.bairro
        document.querySelector('input[name=numero_emp]').value = json.numero
        document.querySelector('input[name=cidade_emp]').value = json.municipio
        document.querySelector('input[name=estado_emp]').value = json.uf

    } else {

        cnpjTeste.innerText = 'CNPJ inválido'
        cnpjTeste.style.color = 'var(--red-dark)'
        btnCadastrar.setAttribute('type', 'button')

    }
}