if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {
    var cards = document.getElementsByClassName('card_user')
    for(let i = 0; i < cards.length; i++){
        cards[i].addEventListener("mouseenter", () => {
            if(cards[i].classList.contains('back_card')){
                cards[i].classList.add('transition_card')
                cards[i].classList.remove('back_card')
            } else {
                cards[i].classList.add('transition_card')
            }
        })
        cards[i].addEventListener("mouseleave", () => {
            if(cards[i].classList.contains('transition_card')){
                cards[i].classList.add('back_card')
                cards[i].classList.remove('transition_card')
            }
        })
    }

    var li_filtros = document.getElementsByClassName('li_filtros')
    for(let i = 0; i < li_filtros.length; i++){
        li_filtros[i].addEventListener("click", (event) => {
            var obj_filtro_active = document.getElementsByClassName('active_filtro')[0]
            var e = event.target
            if(!e.classList.contains('active_filtro')){
                obj_filtro_active.classList.remove('active_filtro')
                e.classList.add('active_filtro')
            }
        })
    }
}

function call_filters() {
    var obj_aside = document.getElementById('aside_index')
    var obj_filter = document.getElementById('filter_symbol')

    if(obj_filter.classList.contains('fi-rr-bars-filter')){
        obj_aside.style.transition = 'transform .3s ease-in-out'
        obj_aside.style.transform = 'translateX(0)'
        obj_filter.classList.remove('fi-rr-bars-filter')
        obj_filter.classList.add('fi-rr-x')
    } else {
        obj_aside.style.transform = 'translateX(-100%)'
        obj_filter.classList.add('fi-rr-bars-filter')
        obj_filter.classList.remove('fi-rr-x')
    }
    
}