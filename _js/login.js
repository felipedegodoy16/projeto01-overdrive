// Verificar onde ocorreu um click para o campo de usuário
document.addEventListener("mouseup", function(event) {
    var obj_user = document.getElementById('user_field')
    var input_user = document.getElementById('user_login').value
    var user = document.getElementsByTagName('label')[0]

    if (!obj_user.contains(event.target) && input_user == '' && user.classList.contains('transition_text')) {
        user.classList.remove('transition_text')
        user.classList.add('back_text')
    }
})

// Verificar onde ocorreu um click para o campo de usuário
document.addEventListener("mouseup", function(event) {
    var obj_password = document.getElementById("password_field")
    var input_password = document.getElementById('password_login').value
    var password = document.getElementsByTagName('label')[1]
    var icon_password = document.getElementById('password_login')
    
    if (!obj_password.contains(event.target) && input_password == '' && password.classList.contains('transition_text')) {
        password.classList.remove('transition_text')
        password.classList.add('back_text')
        icon_password.setAttribute('type', 'password')

        var obj_icon = document.getElementById('icon_password')
        obj_icon.classList.add('icon-lock2')
        obj_icon.classList.remove('icon-eye')
        obj_icon.classList.remove('eye-password')
    }
})

// Função para fazer a transição da escrita
function transition_text(e) {
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
    if(password.getAttribute('type') == 'password' && e.classList.contains('icon-eye')){
        password.setAttribute('type', 'text')
    } else {
        password.setAttribute('type', 'password')
    }
}

// Função para alterar o icon do campo de senha
function change_icon(){
    var obj_icon = document.getElementById('icon_password')
    obj_icon.classList.remove('icon-lock2')
    obj_icon.classList.add('icon-eye')
    obj_icon.classList.add('eye-password')
}