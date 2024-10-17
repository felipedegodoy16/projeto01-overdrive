if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {
    const inputCpf = document.querySelector('input[name=cpf]')
    inputCpf.addEventListener("keypress", cpfComplete)

    const inputCep = document.querySelector('input[name=cep]')
    inputCep.addEventListener("keypress", cepComplete)

    const inputTelefone = document.querySelector('input[name=telefone]')
    inputTelefone.addEventListener("keypress", telefoneComplete)
    inputTelefone.addEventListener("click", () => {
        if(inputTelefone.value === ''){
            inputTelefone.value = '(' + inputTelefone.value
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

    document.addEventListener("mouseup", function(event) {
        var obj_telefone = document.getElementById('p_telefone')
        var input_telefone = document.querySelector('input[name=telefone]')
    
        if (!obj_telefone.contains(event.target) && input_telefone.value === '(') {
            input_telefone.value = ''
        }
    })
}

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
    if(inputLength === 3){
        input.value += ') '
    } else if(inputLength === 10) {
        input.value += '-'
    }
}

function prevenirCaracteres(e) {
    if(e.keyCode <= 47 || e.keyCode >= 58){
        e.preventDefault()
    }
}