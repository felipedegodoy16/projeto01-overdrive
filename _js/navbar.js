if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {
    var items_menu = document.getElementsByClassName('li_navbar')
    for(let i = 0; i < items_menu.length; i++){
        items_menu[i].addEventListener("click", alter_active)
    }

    window.addEventListener("resize", function(){
        var menu = document.getElementById('menu_hamburguer')
        if(this.window.innerWidth > 768) {
            menu.style.transform = 'translateX(0)'
        } else {
            menu.style.transform = 'translateX(200%)'
        }
    })
}

function alter_active(event) {
    var obj_active = document.getElementsByClassName('active')[0]
    var e = event.target
    if(!e.classList.contains('active')){
        obj_active.classList.remove('active')
        e.classList.add('active')
    }
}

function callMenu(e) {
    var menu = document.getElementById('menu_hamburguer')
    if(e.classList.contains('fi-rr-menu-burger')) {
        menu.style.transition = 'transform .3s ease-in-out'
        menu.style.transform = 'translateX(0)'
        e.classList.remove('fi-rr-menu-burger')
        e.classList.add('fi-rr-x')
    } else {
        menu.style.transform = 'translateX(200%)'
        e.classList.add('fi-rr-menu-burger')
        e.classList.remove('fi-rr-x')
    }
}