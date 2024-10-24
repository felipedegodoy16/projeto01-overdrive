if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {

    // Adicionando evento de click a todos os li's da aba de filtros
    var li_filtros = document.getElementsByClassName('li_filtros')
    for(let i = 0; i < li_filtros.length; i++){
        li_filtros[i].addEventListener("click", verificaActive)
    }

}

// Adicionando classe ativa para li clicado e removendo o atualmente ativo 
function verificaActive(event){
    var obj_filtro_active = document.getElementsByClassName('active_filtro')[0]
    var e = event.target

    if(!e.classList.contains('active_filtro')){

        obj_filtro_active.classList.remove('active_filtro')
        e.classList.add('active_filtro')

    }
}

// Chamar aba de filtros
function callFilters(){

    var obj_aside = document.getElementById('aside_index')
    var obj_filter = document.getElementById('filter_symbol')

    if(obj_filter.classList.contains('fi-rr-bars-filter')){

        obj_aside.style.transition = 'transform .3s ease-in-out'
        obj_aside.style.transform = 'translateX(0)'
        obj_filter.classList.remove('fi-rr-bars-filter')
        obj_filter.classList.add('fi-rr-x')

    } else {

        obj_aside.style.transform = 'translateX(-110%)'
        obj_filter.classList.add('fi-rr-bars-filter')
        obj_filter.classList.remove('fi-rr-x')

    }

}

// Função para deixar visível todos os cards
function both(){
    var obj_visible_funcs = document.getElementById('section_users')
    var obj_visible_emps = document.getElementById('section_emps')

    if(!obj_visible_funcs.classList.contains('transition_section')){
        obj_visible_funcs.classList.add('transition_section')
        obj_visible_funcs.classList.remove('back_section')
    }

    if(!obj_visible_emps.classList.contains('transition_section')){
        obj_visible_emps.classList.add('transition_section')
        obj_visible_emps.classList.remove('back_section')
    }
}

// Função para deixar visível apenas cards de funcionários
function onlyFuncs(){
    var obj_visible = document.getElementById('section_users')
    var obj_hidden = document.getElementById('section_emps')
    var objs_back_card = document.getElementsByClassName('back_card')
    var objs_transition_card = document.getElementsByClassName('transition_card')

    for(i=0; i < objs_back_card.length; i++){
        objs_back_card[i].classList.remove('back_card')
    }

    for(i=0; i < objs_transition_card.length; i++){
        objs_back_card[i].classList.remove('transition_card')
    }

    if(obj_visible.classList.contains('back_section')){
        obj_visible.classList.add('transition_section')
        obj_visible.classList.remove('back_section')
    }

    obj_hidden.classList.remove('transition_section')
    obj_hidden.classList.add('back_section')
    
}

// Função para deixar visível apenas cards de empresas
function onlyEmps(){
    var obj_visible = document.getElementById('section_emps')
    var obj_hidden = document.getElementById('section_users')
    var objs_back_card = document.getElementsByClassName('back_card')
    var objs_transition_card = document.getElementsByClassName('transition_card')

    for(i=0; i < objs_back_card.length; i++){
        objs_back_card[i].classList.remove('back_card')
    }

    for(i=0; i < objs_transition_card.length; i++){
        objs_back_card[i].classList.remove('transition_card')
    }

    if(obj_visible.classList.contains('back_section')){
        obj_visible.classList.add('transition_section')
        obj_visible.classList.remove('back_section')
    }

    obj_hidden.classList.remove('transition_section')
    obj_hidden.classList.add('back_section')
}