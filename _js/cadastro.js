if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {
    // Funções Usuário
    const inputCpf = document.querySelector('input[name=cpf]')
    inputCpf.addEventListener("keypress", cpfComplete)
    inputCpf.addEventListener("input", () => {
        const strCpf = document.querySelector('input[name=cpf]').value
        const cpfAlert = document.getElementById('cpfTeste')
        const btnCadastrar = document.getElementById('btn_cadastrar_user')
        cpf = strCpf.replace('.', '').replace('.', '').replace('-', '')

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
    })

    const inputCep = document.querySelector('input[name=cep]')
    inputCep.addEventListener("keypress", cepComplete)

    const inputTelefone = document.querySelector('input[name=telefone]')
    inputTelefone.addEventListener("keypress", telefoneComplete)

    document.addEventListener("mouseup", function(event) {
        var obj_telefone = document.getElementById('p_telefone')
        var input_telefone = document.querySelector('input[name=telefone]')
    
        if (!obj_telefone.contains(event.target) && input_telefone.value === '(') {
            input_telefone.value = ''
        }
    })

    const inputCnh = document.querySelector('input[name=cnh]')
    inputCnh.addEventListener("keypress", (e) => {
        prevenirCaracteres(e)
    })

    const inputNumero = document.querySelector('input[name=numero]')
    inputNumero.addEventListener("keypress", (e) => {
        prevenirCaracteres(e)
    })

    const magicEye = document.getElementById('eye_cadastro')
    magicEye.addEventListener("click", revealPassword)

    // Funções Empresa
    const inputCnpj = document.querySelector('input[name=cnpj_emp]')
    inputCnpj.addEventListener("keypress", cnpjComplete)
    
    const inputCepEmp = document.querySelector('input[name=cep_emp]')
    inputCepEmp.addEventListener("keypress", cepCompleteEmp)

    const inputTelefoneEmp = document.querySelector('input[name=telefone_emp]')
    inputTelefoneEmp.addEventListener("keypress", telefoneCompleteEmp)

    document.addEventListener("mouseup", function(event) {
        var obj_telefone_emp = document.getElementById('p_telefone_emp')
        var input_telefone_emp = document.querySelector('input[name=telefone_emp]')
    
        if (!obj_telefone_emp.contains(event.target) && input_telefone_emp.value === '(') {
            input_telefone_emp.value = ''
        }
    })

    const inputNumeroEmp = document.querySelector('input[name=numero_emp]')
    inputNumeroEmp.addEventListener("keypress", (e) => {
        prevenirCaracteres(e)
    })
}

// Funções Usuário
function cpfComplete(e) {
    prevenirCaracteres(e)

    const input = document.querySelector('input[name=cpf]')
    let inputLength = input.value.length
    if(inputLength === 3 || inputLength === 7){
        input.value += '.'
    } else if(inputLength === 11){
        input.value += '-'
    }
}

function validaCPF(cpf) {

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

function cepComplete(e) {
    prevenirCaracteres(e)

    const input = document.querySelector('input[name=cep]')
    let inputLength = input.value.length
    if(inputLength === 5){
        input.value += '-'
    }
}

function telefoneComplete(e) {
    prevenirCaracteres(e)

    const input = document.querySelector('input[name=telefone]')
    let inputLength = input.value.length
    if(inputLength === 0){
        input.value = '(' + input.value
    }

    if(inputLength === 3){
        input.value += ') '
    } else if(inputLength === 10) {
        input.value += '-'
    }
}

function revealPassword() {
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

///////////////////////////////////////////////

// Função para prevenir caracteres
function prevenirCaracteres(e) {
    if(e.keyCode <= 47 || e.keyCode >= 58){
        e.preventDefault()
    }
}

///////////////////////////////////////////////

// Funções Empresa
function cnpjComplete(e) {
    prevenirCaracteres(e)

    const input = document.querySelector('input[name=cnpj_emp]')
    let inputLength = input.value.length
    if(inputLength === 2 || inputLength === 6){
        input.value += '.'
    } else if(inputLength === 10){
        input.value += '/'
    } else if(inputLength === 15){
        input.value += '-'
    }
}

function cepCompleteEmp(e) {
    prevenirCaracteres(e)

    const input = document.querySelector('input[name=cep_emp]')
    let inputLength = input.value.length
    if(inputLength === 5){
        input.value += '-'
    }
}

function telefoneCompleteEmp(e) {
    prevenirCaracteres(e)

    const input = document.querySelector('input[name=telefone_emp]')
    let inputLength = input.value.length
    if(inputLength === 0){
        input.value = '(' + input.value
    }

    if(inputLength === 3){
        input.value += ') '
    } else if(inputLength === 10) {
        input.value += '-'
    }
}

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