if (document.readyState == "loading") {
    document.addEventListener("DOMContentLoaded", ready)
} else {
    ready()
}

function ready() {
    var items_menu = document.getElementsByTagName('li')
    for(let i = 0; i < items_menu.length; i++){
        items_menu[i].addEventListener("click", alter_active)
    }
}

function alter_active(event){
    var obj_active = document.getElementsByClassName('active')[0]
    var e = event.target
    if(!e.classList.contains('active')){
        obj_active.classList.remove('active')
        e.classList.add('active')
    }
}