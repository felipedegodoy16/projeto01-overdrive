if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {
    // Funções Usuário
    const inputCpf = document.querySelector('input[name=cpf]')
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

    document.addEventListener("mouseup", function(event) {
        var obj_telefone = document.getElementById('p_telefone')
        var input_telefone = document.querySelector('input[name=telefone]')
    
        if (!obj_telefone.contains(event.target) && input_telefone.value === '(') {
            input_telefone.value = ''
        }
    })

    const magicEye = document.getElementById('eye_cadastro')
    magicEye.addEventListener("click", revealPassword)

    // Funções Empresa
    document.addEventListener("mouseup", function(event) {
        var obj_telefone_emp = document.getElementById('p_telefone_emp')
        var input_telefone_emp = document.querySelector('input[name=telefone_emp]')
    
        if (!obj_telefone_emp.contains(event.target) && input_telefone_emp.value === '(') {
            input_telefone_emp.value = ''
        }
    })
}

// Função para validação do CPF
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

// Função para alternar senha entre visível e invisível
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

//Função de Busca CNPJ da Empresa
function buscaCnpj() {
    
}

// function preencheCampos(json) {
//     if(json.localidade != undefined){
//         document.querySelector('input[name=nome_emp]').value = json.nome
//         document.querySelector('input[name=fantasia_emp]').value = json.fantasia
//         document.querySelector('input[name=cep_emp]').value = json.cep
//         document.querySelector('input[name=rua_emp]').value = json.logradouro
//         document.querySelector('input[name=bairro_emp]').value = json.bairro
//         document.querySelector('input[name=numero_emp]').value = json.numero
//         document.querySelector('input[name=cidade_emp]').value = json.municipio
//         document.querySelector('input[name=estado_emp]').value = json.uf
//     }
// }