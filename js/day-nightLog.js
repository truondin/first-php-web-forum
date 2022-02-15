
/**
 * Pridava elementum classy pro zapnuti Dark mode.
 */
function dark(){
    document.body.classList.add("nightBody");
    document.querySelector(".box").classList.add("nightBox");
    document.querySelector("#user").classList.add("nightBox");
    document.querySelector("#password").classList.add("nightBox");
}

/**
 * Odebira elementum classy pro vypnuti Dark mode.
 */
function light(){
    document.body.classList.remove("nightBody");
    document.querySelector(".box").classList.remove("nightBox");
    document.querySelector("#user").classList.remove("nightBox");
    document.querySelector("#password").classList.remove("nightBox");
}



let theme = localStorage.getItem("theme");
if (theme === "dark"){
    dark();
}else{
    light()
}