// Verificar se a página já foi carregada completamente
if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {

    // Verifica se o campo de user está sem foco
    const inputUser = document.querySelector('input[name=user_input]')
    inputUser.addEventListener("blur", backLabelUser)

    if(inputUser.value) {
        transition_text(inputUser)
    }
    
    // Verifica se o campo de senha está sem foco
    const inputPassword = document.querySelector('input[name=password_input]')
    inputPassword.addEventListener("blur", backLabelPassword)
}

// Função para retorno da escrita do campo de usuário
function backLabelUser(){
    var input_user = document.getElementById('user_login').value
    var user = document.getElementsByTagName('label')[0]

    if (input_user == '' && user.classList.contains('transition_text')) {
        user.classList.remove('transition_text')
        user.classList.add('back_text')
    }
}

// Função para retorno da escrita do campo de senha
function backLabelPassword(){
    var input_password = document.getElementById('password_login').value
    var password = document.getElementsByTagName('label')[1]
    var icon_password = document.getElementById('password_login')
    
    if (input_password == '' && password.classList.contains('transition_text')) {
        password.classList.remove('transition_text')
        password.classList.add('back_text')
        icon_password.setAttribute('type', 'password')
        var obj_icon = document.getElementById('icon_password')

        if(obj_icon.classList.contains('fi-rr-eye')) {
            obj_icon.classList.remove('fi-rr-eye')
        } else {
            obj_icon.classList.remove('fi-rr-eye-crossed')
        }

        obj_icon.classList.add('fi-rr-lock')
        obj_icon.classList.remove('eye-password')
    }
}

// Função para fazer a transição da escrita
function transition_text(e){
    var obj_clicked = e.parentNode.children[0]

    if(obj_clicked.classList.contains('back_text')){
        obj_clicked.classList.remove('back_text')
        obj_clicked.classList.add('transition_text')
    } else {
        obj_clicked.classList.add('transition_text')
    }
    
}

// Função para mostrar e esconder senha
function show_password(e){
    var password = document.getElementById('password_login')
    if(password.getAttribute('type') == 'password' && e.classList.contains('fi-rr-eye')){
        password.setAttribute('type', 'text')
        e.classList.add('fi-rr-eye-crossed')
        e.classList.remove('fi-rr-eye')
    } else {
        password.setAttribute('type', 'password')
        e.classList.remove('fi-rr-eye-crossed')
        e.classList.add('fi-rr-eye')
    }
}

// Função para alterar o icon do campo de senha
function change_icon(){
    var obj_icon = document.getElementById('icon_password')
    if(obj_icon.classList.contains('fi-rr-eye-crossed')){
        obj_icon.classList.remove('fi-rr-eye-crossed')
    } else {
        obj_icon.classList.remove('fi-rr-lock')
    }
    obj_icon.classList.add('fi-rr-eye')
    obj_icon.classList.add('eye-password')
}